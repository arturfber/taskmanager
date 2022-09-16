<?php
session_start();
require_once('../connection.php');
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "tarefas_" . $_SESSION['id'] . ".xls"; 
 
// Column names 
$fields = ['id', 'description', 'creation_date', 'conclusion_date', 'status'];
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $con->query("SELECT * FROM tasks WHERE account_id = $_SESSION[id] ORDER BY id ASC"); 

if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
        
        $lineData = [
            $row['id'], 
            $row['description'], 
            $row['creation_date'],
            $row['conclusion_date'],
            $row['status']];
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;