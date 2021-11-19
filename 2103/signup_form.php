<?php

session_start();
$conn = mysqli_connect("localhost", "sqldev", "P@55w0rd", "ICT2103");
if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $username = $_POST['$username'];
    $pword = $_POST['pword'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $IntakeCalories = 0;
    $BurntCalories = 0;
    $firstname = $_POST['fistname'];
    $lastname = $_POST['lastname'];


    $sql = "SELECT * FROM User WHERE username = '$username'";
    $acc_list = mysqli_query($conn, $sql);
    $accNo = mysqli_num_rows($acc_list);
    if ($accNo >= 1) {
        header("Location:Register.php?error=2");
    } else {
        if ($pword == $cpword) {
            echo "INSERT INTO User (UserName, Password, Gender, Age,Height,Weight,IntakeCalories,BurntCalories,FirstName,LastName)
VALUES ('$username','$pword','$gender','$age',$height,$weight,$IntakeCalories,$BurntCalories,'$firstname','$lastname') ";
//            $sql_insert = "INSERT INTO User (UserName, Password, Gender, Age,Height,Weight,IntakeCalories,BurntCalories,FirstName,LastName)
//VALUES ('$username','$pword','$gender','$age',$height,$weight,$IntakeCalories,$BurntCalories,'$firstname','$lastname') ";
//            $result = mysqli_query($conn, $sql_insert);


//            if ($result) {
//                header("Location:login.php");
//            } 
//            else {
//                header("Location:Register.php?error=2");
//            }
        } 
//        else {
//            header("Location:Register.php?error=1");
//        }
    }
}
?>