<?php
ini_set('display_startup_errors', TRUE);
ini_set('display_errors',1); 
error_reporting(E_ALL);
require_once 'core/init.php';
$fileId = $_GET["fileId"];
$DB = mysqli_connect("localhost", "host", "test", "test");
$sql = "SELECT * FROM sets WHERE id = $fileId";
$results = mysqli_query($DB, $sql);
$row = mysqli_fetch_assoc($results);
$file_type = 'file_type';
$type = (string)$file_type;
header("Content-type: ". $row['file_type']);
header("Content-length: ".$row['file_size']);
header("Content-disposition: attachment; filename=".$row['file_name']);        
print $row['file_data'];

?>