<!DOCTYPE html>
<html>
    <head>
        <title>Simple login form</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="login.css"/>
    </head>
    <body>
        <form action="checklogin.php" method="post">
            <h1>Login Form</h1>
            <div class="formcontainer">
                <hr/>
                <div class="container">
                    <label for="username"><strong>Username</strong></label>
                    <input type="text" placeholder="Enter Username" name="username" required>
                    <label for="psw"><strong>Password</strong></label>
                    <input type="password" placeholder="Enter Password" name="password" required>
                </div>
                <?php
                if (isset($_GET['fail'])) {

                    if ($_GET['fail'] == 1) {
                        echo "<p>Incorrect Username or Password</p>";
                    }
                }
                ?>
                <button type="submit">Login</button>
        </form>
    </body>
</html>