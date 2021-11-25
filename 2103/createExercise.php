<?php

session_start();
if (empty($_SESSION['Username'])) {
    //echo "<h4>" . $_SESSION['Username'] . "</h4>";
    header("Location: login.php");
}

$m = new MongoDB\Driver\Manager("mongodb+srv://admin:Passw0rd@ict2103.jbggf.mongodb.net/test?authSource=admin&replicaSet=atlas-lie30k-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true");

$username = $_SESSION['Username'];

$filter = ['UserName' => $username];
$options = [];

$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $m->executeQuery('ICT2103.user', $query);

foreach ($cursor as $document) {
    $document;
}
$_SESSION['burntCalories'] = $document->BurntCalories;


$errorMsg = $username = "";
$success = true;
$exercise = $_POST['exercise'];
$condition = $_POST['condition'];
$intensity = $_POST['intensity'];
$caloriesGram = $_POST['caloriesGram'];

/* Helper function to write the member data to the DB */

function saveMemberToDB() {
    global $exercise, $condition, $errorMsg, $intensity, $caloriesGram, $success, $m;
    // Check connection
    if ($m == "") {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $filter = [];
        $options = ['sort' => array('Exercise_ID' => -1), 'limit' => 1]; # limit -1 from newest to oldest
        #constructing the querry
        $query = new MongoDB\Driver\Query($filter, $options);

        #executing
        $cursor = $m->executeQuery('ICT2103.exercise', $query);

        echo "dumping results<br>";
        foreach ($cursor as $document) {
            $document;
        }
        $max_id = $document->Exercise_ID;

        $bulk = new MongoDB\Driver\BulkWrite;

        $document1 = ['Exercise_ID' => $max_id + 1, 'Type' => $exercise, 'Condition' => $condition, 'intensity' => $intensity, 'Calories/gram' => $caloriesGram];

        $_id1 = $bulk->insert($document1);

        $result = $m->executeBulkWrite('ICT2103.exercise', $bulk);
        if (!$result == null) {
            $errorMsg = "Execute failed!";
            $success = false;
        }
    }
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
