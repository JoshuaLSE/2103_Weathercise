<?php

$username = $_POST['username'];
$password = $_POST['password'];
$filter = ["UserName" => $username, "Password" => $password];

$server = "mongodb+srv://admin:Passw0rd@ict2103.jbggf.mongodb.net/test?authSource=admin&replicaSet=atlas-lie30k-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
$client = new MongoDB\Driver\Manager($server);
//$options = ['find'=>array('password'=>$password)]; # limit -1 from newest to oldest

$stats = new MongoDB\Driver\Query($filter);

$res = $client->executeQuery("ICT2103.user", $stats);
if (empty(current($res->toArray()))) {
    header("Location:login.php?fail=1");
} else {
    session_start();

    echo $_SESSION['Username'] = $username;
    //echo $_SESSION['ID']= $nameid;

    header("Location:dashboard.php");
}
?>