<?php 
require 'config.php';
unlink('upload/table.csv');
$link = new mysqli($servername, $sqlUsername, $sqlPassword, $dbname);
$sqlDeleteTable = "DROP TABLE uploadfile";
$resultDeleteTable = mysqli_query($link, $sqlDeleteTable);
header('Location: firstPage.php');
global $servername, $sqlUsername, $sqlPassword, $dbname;
?>