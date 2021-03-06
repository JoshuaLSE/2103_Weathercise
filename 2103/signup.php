<!DOCTYPE html>
<html>
    <head>
        <title>New Member Registration</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="signup.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    </head>
    <body>
        <div class="testbox">
            <form method="post" action="signup_form.php">
                <div class="banner">
                    <h1>New Member Registration</h1>
                </div>
                <div class="colums">
                    <div class="item">
                        <label for="fname">First Name<span>*</span></label>
                        <input id="firstname" type="text" name="firstname" required/>
                    </div>
                    <div class="item">
                        <label for="lname"> Last Name<span>*</span></label>
                        <input id="lastname" type="text" name="lastname" required/>
                    </div>
                    <div class="item">
                        <label for="username">User Name<span>*</span></label>
                        <input id="username" type="text" name="username" required/>
                    </div>
                    <div class="item">
                        <label for="password">Password<span>*</span></label>
                        <input id="password" type="password" name="password" required/>
                    </div>
                     <div class="item">
                        <label for="cpassword">Confirm Password:<span>*</span></label>
                        <input id="cpassword" type="password" name="cpassword" required/>
                    </div>
                    <div class="question">
                        <label>Gender </label>
                        <div class="question-answer">
                            <div>
                                <input type="radio" value="M" id="radio_4" name="gender" checked/>
                                <label for="radio_4" class="radio"><span>Male</span></label>
                            </div>
                            <div>
                                <input  type="radio" value="F" id="radio_5" name="gender"/>
                                <label for="radio_5" class="radio"><span>Female</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <label for="age">Age<span>*</span></label>
                        <input id="age" type="number"   name="age" required/>
                    </div>
                    <div class="item">
                        <label for="height">Height (cm)<span>*</span></label>
                        <input id="height" type="number"   name="height" required/>
                    </div>
                    <div class="item">
                        <label for="weight">Weight (kg)<span>*</span></label>
                        <input id="weight" type="number" name="weight" required/>
                    </div>                    
                </div>
                <?php
                                    if(isset($_GET['error']))
                                    {

                                        if($_GET['error'] == 2)
                                        {
                                            echo "<p>Username registered before</p>";
                                        }
                                    }
                                ?>
                                <?php
                                    if(isset($_GET['error']))
                                    {

                                        if($_GET['error'] == 1)
                                        {
                                            echo "<p>Incorrect input of Password and Confirm Password</p>";
                                        }
                                    }
                                ?>
                <div class="btn-block">
                    <button type="submit" href="/">Submit</button>
                </div>

            </form>
        </div>

    </body>
</html>
