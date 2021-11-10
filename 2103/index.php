<!DOCTYPE HTML>
<html>
    <head>
        <title>Exercise Recommendation</title>
    </head>
    <body>
        <div class="container">
            <h1>Exercise Recommendation</h1>
            <a href="/ICT2103/signup.php">Sign Up</a>
            <a href="/ICT2103/login.php">Sign In</a>
            </div>
        </div>
    </body>

    <?php
    $conn=mysqli_connect("localhost","sqldev","P@55w0rd","ICT2103");
//    P@55w0rd
    if ($conn->connect_error) {
      die("Connection failed: " . mysqli_connect_error());
    } 
//    echo "connection successful";
//    $query=$conn->prepare("SELECT * FROM ICT2103.food_calories;");
//    $query->execute();
//    $query->bind_result($food_ID,$Food,$Serving,$Calories,$gram,$User_ID);
//    while($query->fetch())
//    {
//            echo "the food item is ".$Food.".";
//    }
    $query->close();
    
?>
</html>
