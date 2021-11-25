<?php

session_start();
if (empty($_SESSION['Username'])) {
    //echo "<h4>" . $_SESSION['Username'] . "</h4>";
    header("Location: index.php");
}

$dbhost = "localhost";
$dbuser = "sqldev";
$dbpass = "P@55w0rd";
$db = "ICT2103";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

$errorMsg = $username = "";
$success = true;
$exercise = $_POST['exercise'];
$condition = $_POST['condition'];
$intensity = $_POST['intensity'];
$caloriesGram = $_POST['caloriesGram'];

/* Helper function to write the member data to the DB */

function saveMemberToDB() {
    global $exercise, $condition, $errorMsg, $intensity, $caloriesGram, $success, $conn;
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        // Prepare the statement:
        $stmt = $conn->prepare("INSERT INTO exercise (Type, `Condition`, intensity, `Calories/gram`) VALUES (?, ?, ?, ?)");
        // Bind & execute the query statement:
        $stmt->bind_param("sssd", $exercise, $condition, $intensity, $caloriesGram);
        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }
        $stmt->close();
    }

    $conn->close();
}

if ($success) {
    saveMemberToDB();
    echo "<Script>alert('updated')</script>";
    echo "<Script>location.replace('exercise.php')</script>";
} else {
    echo "<h3>Oops!</h3>";
    echo "<h4>The following input errors were detected:</h4>";
    echo "<p>" . $errorMsg . "</p>";
    echo '<form action="dashboard.php" method="post"><button type="submit" class="btn btn-danger">Dashboard</button></form>';
}
?>
