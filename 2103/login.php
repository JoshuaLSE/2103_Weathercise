<!DOCTYPE HTML>
<html>
    <head>

        <title>Sign In</title>
    </head>
    <body>
        <div class="container">
            <h1>Sign In</h1>

            </div>
    </body>
<?php
    $conn=mysqli_connect("localhost","sqldev","P@55w0rd","ICT2103");
    if ($conn->connect_error) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
?>

</html>
