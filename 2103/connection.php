 <?php
$user = 'sqldev';
$password = 'P@55w0rd';
$database = 'ICT2103';
$servername = 'localhost';

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?> 

<?php
$conn = mysqli_connect("localhost", "sqldev", "P@55w0rd", "ICT2103");
if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<?php
$user = 'sqldev';
$password = 'P@55w0rd';
$database = 'ICT2103';
$servername = 'localhost';
$conn = new mysqli($servername, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// SQL query to select data from database
$sql = "SELECT * FROM food_history";
$result = $conn->query($sql);
$conn->close();
?>

<table>
    <tr>
        <th>Entry ID</th>
        <th>User ID</th>
        <th>Food ID</th>
        <th>Date</th>
        <th>Servings</th>
    </tr>
    <!-- PHP CODE TO FETCH DATA FROM ROWS-->
    <?php
    // LOOP TILL END OF DATA 
    while ($rows = $result->fetch_assoc()) {
        ?>
        <tr>
            <!--FETCHING DATA FROM EACH 
                ROW OF EVERY COLUMN-->
            <td><?php echo $rows['Entry ID']; ?></td>
            <td><?php echo $rows['User_ID']; ?></td>
            <td><?php echo $rows['Food_ID']; ?></td>
            <td><?php echo $rows['timing']; ?></td>
            <td><?php echo $rows['Servings']; ?></td>
        </tr>
        <?php
    }
    ?>
</table>