<?php

session_start();
$server = "mongodb+srv://admin:Passw0rd@ict2103.jbggf.mongodb.net/test?authSource=admin&replicaSet=atlas-lie30k-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
$client = new MongoDB\Driver\Manager($server);
$bulk = new MongoDB\Driver\BulkWrite;

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $age = $_POST['age'];
    $username = $_POST['username'];
    $pword = $_POST['password'];
    $cpword = $_POST['cpassword'];
    $gender = $_POST['gender'];
$filter = ["UserName" => $username];

$stats = new MongoDB\Driver\Query($filter);

$res = $client->executeQuery("ICT2103.user", $stats);
if (empty(current($res->toArray()))) {
    // UserName not inside Can create new user
        if ($pword == $cpword) {
            $doc =[
                'Password' => $pword,
                'UserName' =>$username,
                'Gender' => $age,
                'Height' => $height,
                'Weight' => $weight,
                'IntakeCalories' => '0',
                'BurntCalories' => '0',
                'FirstName' => $firstname,
                'LastName' => $lastname,
                    
            ];
            $bulk->insert($doc);
            $result = $client ->executeBulkWrite('ICT2103.user', $bulk);


            if ($result) {
                header("Location:dashboard.php");
            } else {
                header("Location:signup.php?error=2");
            }
        } else {
            header("Location:signup.php?error=1");
        }
}else{
    //UserName inside
    header("Location:signup.php?error=2");
}


?>
