<?php 
include "conn.php";
$id = $_GET['id'];

//menghapus data dari database
$sql = "DELETE FROM muhammad_1 WHERE id_pembeli = '$id'";
$result = $mysqli->query($sql);


header("Location: index.php");

