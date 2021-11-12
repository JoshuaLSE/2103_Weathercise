<!DOCTYPE HTML>
<?php
// Create connection
$servername = "localhost";
$username = "sqldev";
$password = "P@55w0rd";
$database = "ICT2103";
$conn = new mysqli_connect($servername, $username, $password, $database);
//    P@55w0rd
if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>

<html>
    <head>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
        </style>
        <?php echo "<Title>" . $User_ID . "'s Food Page</Title>"; ?>
    </head>
    <body>
        <!-- Delete Or Update Past Servings-->
        <table>
            <tr>
                <th>Date</th>
                <th>Food</th>
                <th>Servings</th>
                <th>Calories</th>
            </tr>
            <?php
            $User_ID = $_SESSION['User_ID'];
            $serving = 0;
            $calories = 0;

            function deleteFOOD() {
                $sql = "DELETE FROM shopping_cart WHERE itemID = '$cidToDelete' AND userID = '$userIDING'";

                $Deletedcake = mysqli_query($conn, $sql);
            }

            function updateFOOD() {
                $sql = "DELETE FROM shopping_cart WHERE itemID = '$cidToDelete' AND userID = '$userIDING'";

                $Deletedcake = mysqli_query($conn, $sql);
            }

            $getUserHistory = "SELECT * FROM food_calories WHERE User_ID = '$User_ID'";
            $userHistory = mysqli_query($conn, $getUserHistory);
            if ($userHistory->num_rows > 0) {
                while ($row = $userHistory->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Date"] . "</td>";
                    echo "<td>" . $row["Food"] . "</td>";
                    echo "<td>" . $row["Servings"] . "</td>";
                    echo "<td>" . $row["Calories"] . "</td>";
                    echo "<form  id=\"form2\" action=\"Deleteitem.php\" method=\"post\">";
                    echo "<input type=\"submit\" name=\"submit\" value=\"Delete\">";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "Nothing in cart";
            }
            ?>
        </table> 
        <!--create calories/ food -->
        <h1>Add your recent meals!</h1>
        <form id="foodInsert" method="post" action="">
            <!--Making dropdown menu for food-->
            <h3>Food</h3>
            <select name="Food Options" id = "food">
                <?php
                $sql = "SELECT * FROM food_calories WHERE USER_ID = 0";
                $result = $conn->query($sql);
                while ($rows = $result->fetch_assoc()) {
                    $Food = $rows[];
                    echo "<option value='$Food'>$Food</option>";
                }
                ?>
            </select>   

            <h3>Servings</h3>
            <div>
                <label for="servings">Number of Servings:</label>
                <input type="number" id="servings" required name="servings"                   
                       placeholder="Enter servings" min="1">           
            </div>
            <div>
                <button type="submit">Submit</button> 
            </div>
        </form>
    </body>

    <?php
// Declare flag
    $success = true;
// Declare variables
    global $food, $servings;
    $food = $servings = "";

//Helper function that checks input for malicious or unwanted content.
    function sanitize_input($data) {
        $data = trim($data);               //remove whitespaces 
        $data = stripslashes($data);       //such as '
        $data = htmlspecialchars($data);   //such as >,<&
        return $data;
    }

#Validate the result when press submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["servings"])) {
            $errorMsg .= "Serving count is needed.<br>";
            $success = false;
        } else {
            $servings = sanitize_input($_POST["servings"]);
        }
    }

    /*
     * Helper function to write the member data to the DB
     */

    function saveMemberToDB() {
        global $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;
        $num = $_POST['phoneno'];
        $addr = $_POST['address'];
        $po = $_POST['postalcode'];
        $unit = $_POST['unit'];
        $country = $_POST['Country'];
        $bd = $_POST['birthdate'];

        // Create database connection.
        $config = parse_ini_file('../../private/db1-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        // Check connection
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {


            // Prepare the statement:
            $stmt = $conn->prepare("INSERT INTO cake_member(fname, lname,
   email, password, phoneno, birthdate, street,PostalCode,Unit,Country,token,status,profilepic) VALUES (?, ?, ?, ?, '$num', '$bd', '$addr', '$po','$unit','$country' , '" . $token . "','Inactive','images/defualtprofile.jpg')");

            // Bind & execute the query statement:
            $stmt->bind_param("ssss", $fname, $lname, $email, $pwd_hashed);
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

        echo "<div id=\"boxes\">";
        echo "<div id=\"dialog\" class=\"window\">";

        echo "<h2>Your registration is success please verify your email first!</h2>";
        echo "<h4>Thank you for signing up, " . $fname . " " . $lname . ".</h4>";
        echo "<a href='Login.php' class='btn btn-danger'>Log-in</a>";

        echo '</div>';
        echo '<div id="mask">';
        echo '</div>';
        echo '</div>';
    } else {
        echo "<div id=\"boxes\">";
        echo "<div id=\"dialog\" class=\"window\">";
        echo "<h2>Oops</h2>";
        echo "<h4>The following error were detected:</h4>";
        echo "<p>" . $errorMsg . "</p>";
        echo "<a href='register.php' class='btn btn-danger'>Return to Sign Up</a>";

        echo '</div>';
        echo '<div id="mask">';
        echo '</div>';
        echo '</div>';
    }
    ?>
</html>