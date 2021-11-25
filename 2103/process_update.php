<?php
session_start();
if (empty($_SESSION['Username'])) {
    //echo "<h4>".$_SESSION['user']. "</h4>";
    //header("Location: index.php");
}
?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/main3.css">
        <!--jQuery-->
        <script defer
                src="http://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                crossorigin="annoymous">
        </script>

        <!--Bootstrap JS-->
        <script defer
                src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
                integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"
                crossorigin="annoymous">
        </script>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <main class="container">
            <hr>
            <?php
            $m = new MongoDB\Driver\Manager("mongodb+srv://admin:Passw0rd@ict2103.jbggf.mongodb.net/test?authSource=admin&replicaSet=atlas-lie30k-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true");

            $username = $_SESSION['Username'];

            $filter = ['UserName' => $username];
            $options = [];

            $query = new MongoDB\Driver\Query($filter, $options);
            $cursor = $m->executeQuery('ICT2103.user', $query);

            foreach ($cursor as $document) {
                $document;
            }

            $errorMsg = $username = "";
            $success = true;
            $username = $_POST['username'];
            $password = $_POST['pwd'];
            $gender = $_POST['gender'];
            $age = $_POST['age'];
            $height = $_POST['height'];
            $weight = $_POST['weight'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $locationID = $_POST['location'];
            $oldUserName = ($_SESSION['Username']);
            $space = ' ';

            //Helper function that checks input for malicious or unwanted content.
            function sanitize_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            /* Helper function to write the member data to the DB */

            function saveMemberToDB() {
                global $m, $username, $pwd_hashed, $errorMsg, $gender, $age, $height, $weight, $fname, $lname, $success, $conn, $oldUserName, $locationID;

                // Check connection
                if ($m == null) {
                    $errorMsg = "Connection failed: ";
                    $success = false;
                } else {
                    $bulkWrite = new MongoDB\Driver\BulkWrite;
                    $bulkWrite->update(['UserName' => $oldUserName], 
                            ['$set' => ['UserName' => $username, 'Password' => $pwd_hashed, 'Gender' => $gender, 'Age' => $age, 'Height' => $height, 'Weight' => $weight, 'FirstName' => $fname, 'LastName' => $lname, 'location_id' => $locationID]],
                            ['multi' => false, 'upsert' => false]);
                    $m->executeBulkWrite('ICT2103.user', $bulkWrite);
                    $_SESSION['Username'] = $username;
                    echo $fname;
                }
            }

            if (!empty($_POST["username"])) {
                $username = sanitize_input($_POST["username"]);

                // Addition check to make sure e-mail address is well-formed.
                if (!filter_var($username, FILTER_SANITIZE_STRING)) {
                    $errorMsg .= "Invalid first name format.<br>";
                    $success = false;
                }
            }

            if (empty($_POST["pwd"])) {
                $errorMsg .= "Password is required.<br>";
                $success = false;
            } else {
                $pwd_hashed = $_POST["pwd"];
            }

            if ($success) {
                saveMemberToDB();
                echo "<h4>Your profile has been updated successfully!</h4>";
                echo "<h4>Thank you for signing up, " . $username . ".</h4>";
                echo '<form action="dashboard.php" method="post"><button type="submit" class="btn btn-success">Dashboard</button></form>';
            } else {
                echo "<h3>Oops!</h3>";
                echo "<h4>The following input errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo '<form action="update_profile.php" method="post"><button type="submit" class="btn btn-danger">Return to Sign Up</button></form>';
            }
            ?>

        </main>
        <br>
    </body>
</html>