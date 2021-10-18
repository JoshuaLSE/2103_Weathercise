

<?php

// Only do insertion if the request method is 'POST'
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Initialise strings and booleans
    $errorMsg = "";
    $querySuccess = true;

// Resume current session
    session_start();

// Validate user logged in
    if (empty($_SESSION['userid'])) {
        $errorMsg = "Please login before adding to cart!";
        $querySuccess = false;
    } else {
        $u_id = $_SESSION['userid'];   //show login user id
    }


// Validate if user came from cart page
    if (empty($_POST['itemID'])) {
        $errorMsg = "Please add to cart from our store page!";
        $querySuccess = false;
    } else {
        $cke_id = $_POST['itemID'];
    }

// Only connect if so far successful
    if ($querySuccess) {

        // Connect to DB
        $config = parse_ini_file('../../private/db1-config.ini');
        $conn = new mysqli($config['servername'], $config['username'],
                $config['password'], $config['dbname']);

        // Prepare SQL statement
        $checkForCurrentSQL = $conn->prepare("SELECT * FROM shopping_cart WHERE userID = ? AND itemID = ?;");

        // Bind and execute the query statement
        $checkForCurrentSQL->bind_param("ss", $u_id, $cke_id);
        $checkForCurrentSQL->execute();
        $checkForCurrentEntryResult = $checkForCurrentSQL->get_result();

        // If more than 0, means there are entries returned
        if ($checkForCurrentEntryResult->num_rows > 0) {

            // Get current row
            $currentRow = $checkForCurrentEntryResult->fetch_assoc();

            // Increase quantity
            $newCount = $currentRow['itemQuantity'] + 1;


            // Prepare SQL statement
            $sql = $conn->prepare("UPDATE shopping_cart SET itemQuantity = ? WHERE userID = ? AND itemID = ?");

            // Bind and execute the query statement
            $sql->bind_param("sss", $newCount, $u_id, $cke_id);
            $checksqlResult = $sql->execute();

            // Check the SQL result
            if (!$checksqlResult) {
                $querySuccess = false;
            }
        } else {

            // Prepare SQL statement
            $sql = $conn->prepare("INSERT INTO shopping_cart (userID, itemID, itemQuantity) VALUES(?,? ,1)");

            // Bind and execute the query statement
            $sql->bind_param("ss", $u_id, $cke_id);
            $checksqlResult = $sql->execute();

            // Check the SQL result
            if (!$checksqlResult) {
                $querySuccess = false;
            }
        }
        $checkForCurrentSQL->close();
        $sql->close();
        $conn->close();
    }

//header("Location:Store.php");
// header("Location:index.php");
    if ($querySuccess == true) {

        header('Location:Store.php');
    } else {
        //alert("Insert to cart unsuccesfully");
        header('Location:Store.php');
    }
} else {
    header("Location:index.php");
}
?> 

