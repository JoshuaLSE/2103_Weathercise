<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/main.css" />
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
              integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
              crossorigin="anonymous">
<title>Register result</title>      
</head>
<body>
       <?php 
        include "phpFiles/nav.inc.php"
        ;?> 
         <header id="Content">
            <div class="jumbotron jumbotron-fluid text-center bg-cover" style="background-image: linear-gradient(to bottom, rgba(255,255,255,0.15),rgba(255,255,255,0.7)), url(images/sliced.png)">
                    <h1 class="display-4">Tarts N' Cakes</h1>
                    <hr class="lead">
                    <p>Best Thing Since Sliced Bread!</p>
                    <a class="btn btn-primary btn-lg" href="#" role="button">Baked!</a>
            </div>
        </header>
       
        
    <main class="container">        
        <hr>


<?php 
 $config = parse_ini_file('../../private/db1-config.ini');
 $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

//if(isset($_POST['login'])){
	
	$name = $_GET['name'];
	$token = $_GET['token'];

	$select = "UPDATE cake_member SET status = 'Active' WHERE lname = '$name' AND token = '$token'";
	$result = mysqli_query($conn,$select);
	if ($result) 
        {
		echo "<h2>Verify successful, " . $name . "  you can log in now</h2>";
                echo "<a href='Login.php' class='btn btn-danger'>Login now</a>";
	}else
        {
		echo "verify failed please try again or create another account";
	}

//}

?>

     </main>
    <br>
     <?php    include "phpFiles/footer.inc.php";?>       
</body>
</html>
