<?php 
    class db{
        private $connection;
        public $sql;

        public function __construct(){
            $this->connection = new mysqli('localhost', 'root', '', 'taskmanager_db');
        }

        public function insert($table, $data = []){
       
            $columns = implode(', ', array_keys($data));
            $values = implode("', '", $data);
            $sql = "INSERT INTO $table($columns) VALUES('$values')";

            $this->connection->query($sql);
        }

        public function update($table, $data = [], $id){
            $args = [];

            foreach ($data as $key => $value) {

                if($key == 'conclusion_date' AND $value == 'NULL'){
                    $args[] = "$key = $value"; 
                } else {
                    $args[] = "$key = '$value'"; 
                }
            }

            $sql="UPDATE  $table SET " . implode(',', $args);

            $sql .=" WHERE id = $id";

            $result = $this->connection->query($sql);
        }

        public function delete($table, $id){
            $sql="DELETE FROM $table";
            $sql .=" WHERE id = $id";

            $result = $this->connection->query($sql);
        }

        public function select($table, $rows="*", $where = NULL, $limit = NULL){

            // Mounting query
            if ($where != NULL) {

                // Where
                $cond = '';
                foreach ($where as $key => $value) {
                    if($value != end($where)){
                        $cond .= "$key = '$value' AND ";
                    } else {
                        $cond .= "$key = '$value'";
                    }
                }

                $sql = "SELECT $rows FROM $table WHERE $cond";
            }else{
                $sql = "SELECT $rows FROM $table";
            }

            // Limit
            if ($limit != NULL) $sql .= " LIMIT $limit";

           $result = $this->connection->query($sql);

            // Getting results
            $data = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                $data[] = $row;
                }
            }

            return $data;
        
        }

    }
