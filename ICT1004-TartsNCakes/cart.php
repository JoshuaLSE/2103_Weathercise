<!DOCTYPE html>
<html>
    <head>
        <?php
        include "phpFiles/headcontents.inc.php";
        ?> 
        <title>Cart</title>
    </head>
    <body>
        <?php
        include "phpFiles/nav.inc.php";
        include "phpFiles/banner.php";

        // Open session connection
        session_start();
        $userid = $_SESSION['userid'];
        $lastName = $_SESSION['username'];
        $config = parse_ini_file('../../private/db1-config.ini');
        $conn = new mysqli($config['servername'], $config['username'],
                $config['password'], $config['dbname']);
        if ($conn->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }
        ?> 

        <div class="container">
            <div class="col-xl" style="overflow-x:auto;">
                <h1 id="cartName"><?php echo $lastName ?>'s Shopping Cart</h1>
                <table id="orderhistory">
                    <tr>
                        <th>Item no.</th>
                        <th>Item Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Edit order</th>
                    </tr>
                    <?php
                    // Get the cartinformation from the db
                    $getCurrentCart = "SELECT shopping_cart.itemID, shopping_cart.itemQuantity, Items.Name, Items.Pricing FROM shopping_cart, Items WHERE shopping_cart.userID = '$userid' AND shopping_cart.itemID = Items.ItemID;";
                    $currentCart = mysqli_query($conn, $getCurrentCart);

                    //$numberOfRows = mysql_num_rows($currentCart);

                    if ($currentCart->num_rows > 0) {
                        // output data of each row
                        $totalCost = 0;
                        $rowcounter = 1;
                        while ($row = $currentCart->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $rowcounter . "</td>";
                            echo "<td>" . $row["Name"] . "</td>";
                            echo "<td>" . $row["itemQuantity"] . "</td>";
                            echo "<td>" . $row["Pricing"]* $row["itemQuantity"] . "</td>";
                           
                            echo "<td>";
                            echo "<form  id=\"form2\" action=\"Deleteitem.php\" method=\"post\">";
                            echo "<input type=\"submit\" name=\"submit\" value=\"Delete\">" ;
                            echo "<input type=\"hidden\" name=\"cid\" value=\"".$row['itemID']."\">";
                            echo "</form>";     
                            echo "</td>";
                            echo "</tr>";
                            $totalCost = $totalCost + ($row["Pricing"]* $row["itemQuantity"]);
                            $rowcounter++;
                            
                            
                        }
                        echo "<tr>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>Total Cost</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>" . $totalCost . "</td>";
                        echo "</tr>";
                        echo "</table>";
                    } else {
                        
                        echo "</table>";
                        echo "No items in cart!";
                    }
                    $conn->close();
                    ?>
            </div>
        </div>
        <div class="row">
            <div class="col-9"></div>
            <div class="col-3" style="padding: 1em">
                <form method="POST" id ="form1" action="paymentDetails.php">                   
                    <button type="submit" form="form1" class="center btn btn-secondary">Go to payment</button>
                </form>
            </div>
        <?php include "phpFiles/footer.inc.php"; ?> 
    </body>
</html>