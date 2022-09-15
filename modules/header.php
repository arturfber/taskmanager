<?php
session_start();
require_once "../login/authenticate.php";
require_once "../connection.php";

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ====================  M E T A  T A G S  ==================== -->
    <meta charset="UTF-8">
    <meta name="description" content="PHP Taskmanager">
    <meta name="robots" content="index, follow">
    <meta name="copyright" content="PHP To Do">
    <meta name="generator" content="Visual Studio Code">
    <meta name="rating" content="general">
    <meta http-equiv="content-language" content="pt-br">
    <meta name="author" content="Artur Ferreira Bernardes">
    <meta name=”creator” content="Artur Ferreira Bernardes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>To Do List</title>

    <!-- ==================== L I N K S  ==================== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/img/icons/calendar.png">
</head>