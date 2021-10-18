<?php
session_start();

$userIDING = $_SESSION['userid'];
$config = parse_ini_file('../../private/db1-config.ini');
$conn = new mysqli($config['servername'], $config['username'],
$config['password'], $config['dbname']);

$cidToDelete = $_POST["cid"];

$sql ="DELETE FROM shopping_cart WHERE itemID = '$cidToDelete' AND userID = '$userIDING'";

$Deletedcake = mysqli_query($conn,$sql);

if($Deletedcake >0)
{
	header("Location:cart.php");
}

?>
