<!DOCTYPE html>
<html>
    <head>
        <?php
        include "phpFiles/headcontents.inc.php";
        ?> 
        <title>Payment Details</title>
    </head>
    <body>
        <?php
        include "phpFiles/nav.inc.php";
        include "phpFiles/banner.php";

        // Open session connection
        session_start();

        // Check if logged in
        if (empty($_SESSION['userid'])) {
            $errorMsg = "Not logged in";
            header("Location:register");
        } else {
            $userid = $_SESSION['userid'];
        }
        $lastName = $_SESSION['username'];
        $useremail = $_SESSION['whoami'];


        $config = parse_ini_file('../../private/db1-config.ini');
        $conn = new mysqli($config['servername'], $config['username'],
                $config['password'], $config['dbname']);
        
        // Check connection
        if ($conn->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }
        
        // Prepare SQL statement
        $memberDetSQL = $conn->prepare("SELECT * FROM cake_member where userID = ?;");

        // Bind and execute the query statement
        $memberDetSQL->bind_param("s", $userid);
        $memberDetSQL->execute();
        $selectduser = $memberDetSQL->get_result();

        // Check if user had any cart information
        if ($selectduser->num_rows > 0) {
            $userinfo = $selectduser->fetch_assoc();
        } else {
            // Return them to index
            $errorMsg = "Not a user.";
            header("Location:index.php");
        }
        ?> 
        
        <div class="container">       
            <div class="col-xl col-md-sm">
                <form id="form1" enctype="multipart/form-data" name="form1" action="process_paymentDetails.php" method="post" >
                <div class="form-gorup">
                    <label for="newfname">First Name:</label>            
                    <input class="form-control " type="text" id="newfname" required  name="newfname"                   
                           value="<?php echo $userinfo['fname']; ?>">    

                </div>
                <div class="form-gorup">
                    <label for="newlname">Last Name:</label>            
                    <input class="form-control" type="text" id="newlname"
                           required maxlength="45" name="newlname" value="<?php echo $userinfo['lname']; ?>">             
                </div>   

                <div class="form-gorup">
                    <label for="newemail">Email:</label>            
                    <input class="form-control" type="email" id="newemail" required name="newemail"                   
                           placeholder="Enter email" title="Please enter a valid email addess" value="<?php echo $userinfo['email']; ?>">            
                </div>      

                <div class="form-gorup">
                    <label for="newphoneno">Phone number:</label> 
                    <input  class="form-control" type="text" id="newphoneno"  required maxlength="11" name="newphoneno" 
                            pattern="[0-9]{8}" title="Please enter phone number as 8-digit numbers only" value="<?php echo $userinfo['phoneno']; ?>">  
                </div>        

                <div class="form-gorup">
                    <label for="blkno">Block:</label> 
                    <input  class="form-control" type="text" id="blkno"  required  name="blkno">  
                </div>

                <div class="form-gorup">
                    <label for="unitno">Unit:</label> 
                    <input  class="form-control" type="text" id="unitno"  required  name="unitno">  
                </div>
                <div class="form-gorup">
                    <label for="newaddress">Address:</label> 
                    <input  class="form-control" type="text" id="newaddress"  required  name="newaddress" 
                            value="<?php echo $userinfo['street']; ?>">  
                </div>

                <div class="form-gorup">                   
                    <label for="ccn">Credit Card Number:</label>
                    <input required class="form-control" id="ccn" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="xxxx xxxx xxxx xxxx">
                </div>
                    
            </form>
            </div>
            <div class="col-xl col-md-sm" style="padding: 1em;">
                <table id="orderhistory" style="overflow-x:auto;">
                    <tr>
                        <th>Item no.</th>
                        <th>Item Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    <?php
                    
                    // Get the cartinformation from the db
                    // Prepare SQL statement
                    $getCurrentCart = $conn->prepare("SELECT shopping_cart.itemID, shopping_cart.itemQuantity, Items.Name, Items.Pricing FROM shopping_cart, Items WHERE shopping_cart.userID = ? AND shopping_cart.itemID = Items.ItemID;");

                    // Bind and execute the query statement
                    $getCurrentCart->bind_param("s", $userid);
                    $getCurrentCart->execute();
                    $currentCart = $getCurrentCart->get_result();

                    // Create cart table
                    if ($currentCart->num_rows > 0) {
                        
                        // Output data of each row
                        $totalCost = 0;
                        $rowcounter = 1;
                        while ($row = $currentCart->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $rowcounter . "</td>";
                            echo "<td>" . $row["Name"] . "</td>";
                            echo "<td>" . $row["itemQuantity"] . "</td>";
                            echo "<td>" . $row["Pricing"]*$row["itemQuantity"] . "</td>";
                            echo "</tr>";
                            $totalCost = $totalCost + ($row["Pricing"]*$row["itemQuantity"]);
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
                        echo "You have not added anything to cart yet!";
                    }
                    $memberDetSQL->close();
                    $getCurrentCart->close();
                    $conn->close();                    
                    ?></table>
            </div>
        </div>
        <div class="container">
            <div class="col-xl col-md-sm" style="padding: 1em">
                <form method="POST" id ="form1">                   
                    <button type="submit" form="form1" class="center btn btn-secondary">Checkout</button>
                </form>
            </div>
        </div>
        <?php include "phpFiles/footer.inc.php"; ?> 
    </body>
</html>