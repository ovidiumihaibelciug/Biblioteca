<?php 
require_once '../includes/conn.php';
if (isset($_GET['delete'])) {
	$idBook = mysqli_real_escape_string($conn, htmlentities($_GET['delete']));	
	$queryDelete = "DELETE FROM `books` WHERE `id` = $idBook";
	mysqli_query($conn, $queryDelete);
	header('Location: main.php');
}


?>
