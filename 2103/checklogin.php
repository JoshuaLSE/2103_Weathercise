<?php 
$username = $_POST['username'] ;   
$password = $_POST['password'] ;
$conn = mysqli_connect("localhost", "sqldev", "P@55w0rd", "ICT2103");
if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM User WHERE UserName = '$username' and Password='$password'  " ; 
$sql_username = "SELECT UserName from Users where UserName ='$username'";
$search_result = mysqli_query($conn , $sql);   
$result = mysqli_query($conn, $sql_username);
$sql_memberid = "SELECT User_ID from member where UserName='UserName'";
$resultid = mysqli_query($conn,$sql_memberid);
// Return the number of rows in search result
$userfound = mysqli_num_rows($search_result);
$usernames = mysqli_num_rows($resultid);

$row = mysqli_fetch_assoc($result);
$rowid = mysqli_fetch_assoc($resultid);
$name = $row["UserName"];
$nameid = $rowid["User_ID"];

if($userfound >= 1) {
    session_start();
    
    $_SESSION['Username'] = $name;
    $_SESSION['ID']= $nameid;

    header("Location:dashboard.php");  	// go to main.php
}
else {
    // User record is NOT found in the userinfo table
    header("Location:login.php?fail");  	// go back to login page
}


?>