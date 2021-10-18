<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tarts N's Cake</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"  href="css/login.css">
        <?php
        include 'phpFiles/headcontents.inc.php';
        ?>



    </head>

    <body>
        <?php
        include "phpFiles/nav.inc.php";
        include "phpFiles/banner.php";
        ?> 

        <main class="container">        
            <section id="contentlogin">

                <article>
                    <h2>Existing customer</h2>

                    <h3>sign in with your account detail</h3>


                    <form name="form1" action="process_login.php" method="post" >    	
                        <div class="form-gorup1">
                            <label for="email">Email<span>*</span></label>
                            <input type="email"  class="form-control" placeholder="Enter your email here" pattern="^[a-zA-Z0-9]+@gmail\.com$" 
                                   title="Please enter a valid GMAIL addess" name="email" id="email" required>
                        </div>
                        <div class="form-gorup1">
                            <label for="pwd">Password<span>*</span></label>
                            <input type="password" class="form-control" placeholder="Enter your password here" name="pwd" id="pwd" required>
                        </div>
                        <div class="form-gorup1">
                            <input type="submit" value="SIGN IN" id="signinbutton">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>

                        <div class="verline">&nbsp;</div>

                    </form>
                </article>

                <aside id="info">
                    <h2>NEW CUSTOMER</h2>
                    <h3>Sign up today and you will be able to:</h3>
                    <div class="tick"><p>Speedy Checkouts</p></div>
                    <div  class="tick"><p>Easy Order Tracking</p></div>
                    <div class="tick"><p><b>Promotions</b></p></div>

                    <div id="registerbutton"> <a href="register.php" title="signup"><h4>REGISTER</h4></a></div>
                </aside>

            </section>                   

            <?php include "phpFiles/footer.inc.php"; ?> 

        </main>





    </body>


</html>
