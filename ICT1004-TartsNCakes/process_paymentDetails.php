
<?php

// Only do any php if the request method is 'POST'
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Resume Connection
    session_start();

    // Validate user logged in
    if (empty($_SESSION['userid'])) {
        $errorMsg = "Please login before Purchasing!";
        $querySuccess = false;
        // Move them away from this page
        header("Location:register.php");
    } else {
        $u_id = $_SESSION['userid'];   //show login user id
    }

    // Open DB connection
    $config = parse_ini_file('../../private/db1-config.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);

    // Prepare SQL statement
    $RetrieveCartSQL = $conn->prepare("SELECT shopping_cart.itemID, shopping_cart.itemQuantity, Items.Name, Items.Pricing FROM shopping_cart, Items WHERE shopping_cart.userID = ? AND shopping_cart.itemID = Items.ItemID;");

    // Bind and execute the query statement
    $RetrieveCartSQL->bind_param("s", $u_id);
    $RetrieveCartSQL->execute();
    $RetrieveCartTable = $RetrieveCartSQL->get_result();

    // Check for cart table
    if ($RetrieveCartTable->num_rows > 0) {

        // Prepare SQL statement
        $orderHistorySQL = $conn->prepare("INSERT INTO order_history (itemID, userID, Date, Quantity) VALUES (?,  ?,  " . "CURDATE() + 1, ?);");      

        // Insert into orderHistory
        while ($currentRow = $RetrieveCartTable->fetch_assoc()) {

            // Bind and execute the query statement
            $orderHistorySQL->bind_param("sss", $currentRow['itemID'], $u_id, $currentRow['itemQuantity']);
            $orderHistoryResult = $orderHistorySQL->execute();
            
            if(!$orderHistoryResult){
                $insertion = false;
            }
        }

        // Delete from cart
        // Prepare SQL statement
        $deleteCartSQL = $conn->prepare("DELETE FROM shopping_cart WHERE userID = ?;");

        // Bind and execute the query statement
        $deleteCartSQL->bind_param("s", $u_id);
        $deleteCartSQL->execute();
        $deleteCartResult = $deleteCartSQL->get_result();

        if($RetrieveCartTable->num_rows == 0){
            $errorMsg="Deletion failed.";
        }
        
        
        $insertion = true;
        
        // Close connections
        $orderHistorySQL->close();
        $deleteCartSQL->close();
        $RetrieveCartSQL->close();
    } else {
        // Return back to cart
        $insertion = false;
        $RetrieveCartSQL->close();
        header("Location:cart.php");
    }

    if ($insertion == true) {
        header("Location:index.php");
    } else {
        alert("Purchase unsuccesful");
    }
} else {
    header("Location:index.php");
}
?> 

