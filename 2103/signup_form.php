<?php

session_start();
$conn = mysqli_connect("localhost", "sqldev", "P@55w0rd", "ICT2103");
if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
} else {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $age = $_POST['age'];
    $username = $_POST['username'];
    $pword = $_POST['password'];
    $cpword = $_POST['cpassword'];
    $gender = $_POST['gender'];
    
    $sql = "SELECT * FROM User WHERE UserName = '$username'";
    echo $sql;
    $acc_list = mysqli_query($conn, $sql);
    $accNo = mysqli_num_rows($acc_list);
    if ($accNo >= 1) {
        header("Location:signup.php?error=2");
        
    } else {
        if ($pword == $cpword) {

            $sql_insert = "INSERT INTO User (UserName,Password,Gender,Age,Height,Weight"
                    . ",IntakeCalories,BurntCalories,FirstName,LastName) "
                    . "VALUES ('$username','$pword','$gender','$age','$height','$weight',0,0,'$firstname','$lastname')";
            echo $sql_insert;
            $result = mysqli_query($conn, $sql_insert);


            if ($result) {
                header("Location:dashboard.php");
            } else {
                header("Location:signup.php?error=2");
            }
        } else {
            header("Location:signup.php?error=1");
        }
    }
}
?>