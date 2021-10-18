<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tarts N's Cake</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/register.css" />
        <?php
        include 'phpFiles/headcontents.inc.php';
        ?>

        <script>
            AOS.init();
        </script>



        <script>
            function same()
            {
                var p = document.form1.pwd.value;
                var c = document.form1.conconfirm.value;

                if (p == c)
                {
                    return true;

                } else
                {
                    alert("Your password does not match, Please enter your password again.");
                    document.form1.pwd.value = "";
                    document.form1.conconfirm.value = "";
                    return false;
                }
            }
        </script>


    </head>

    <body>
        <header id="Content">
            <?php
            include "phpFiles/nav.inc.php";
            include "phpFiles/banner.php";
            ?> 
        </header>

        <main class="container">        
            <h1>Member Registration</h1>        
            <p>             
                For existing members, please go to the 
                <a href="Login.php">Sign In page</a>.       
            </p>        
            <form id="form1" name="form1" action="process_register.php" method="post" onSubmit="return same();">
                <div class="form-gorup">
                    <label for="fname">First Name:</label>            
                    <input class="form-control " type="text" id="fname" required name="fname"                   
                           placeholder="Enter first name">           
                </div>
                <div class="form-gorup">
                    <label for="lname">Last Name:</label>            
                    <input class="form-control" type="text" id="lname"
                           required maxlength="45" name="lname" placeholder="Enter last name">             
                </div>   
                <div class="form-gorup">
                    <label for="email">Gmail:</label>            
                    <input class="form-control" type="email" id="email" pattern="^[a-zA-Z0-9]+@gmail\.com$" required name="email"                   
                           placeholder="Enter email" title="Please enter a valid GMAIL addess">            
                </div>
                <div class="form-gorup">
                    <label for="pwd">Password:</label>            
                    <input  class="form-control" type="password" id="pwd" required minlength="12" name="pwd"                                                                           
                            placeholder="Enter password">   
                </div>
                <div class="form-gorup">
                    <label for="conconfirm">Confirm Password:</label> 
                    <input  class="form-control" type="password" id="conconfirm" required  name="conconfirm" 
                            placeholder="Confirm password">  
                </div>           
                <div class="form-gorup">
                    <label for="phoneno">Phone number:</label> 
                    <input  class="form-control" type="text" id="phoneno"  required maxlength="11" name="phoneno" 
                            pattern="[0-9]{8}" title="Please enter phone number as 8-digit numbers only">  
                </div>               
                <div class="form-gorup">
                    <label for="address">Street:</label> 
                    <input  class="form-control" type="text" id="address"  required  name="address" 
                            placeholder="">  
                </div>
                <div class="form-gorup">
                    <label for="postalcode">Postal Code:</label> 
                    <input  class="form-control" type="text" id="postalcode"  required  name="postalcode" pattern="[0-9]{6}"  title="Please enter postal code number as 6-digit numbers only"
                            placeholder="">  
                </div>
                <div class="form-gorup">
                    <label for="unit">Unit:</label> 
                    <input  class="form-control" type="text" id="unit"  required  name="unit" pattern="[0-9][0-9]-[0-9][0-9]" title="Please enter correct unit number eg.06-57"
                            placeholder="06-57">  
                </div>

                <div class="form-gorup">
                    <label for="birthdate">Birthdate :</label> 
                    <input   class="form-control" type="date" id="birthdate"  required  name="birthdate" >  
                </div>

                <div class="form-gorup">
                    <label for="Country">Country:</label> 
                    <select id="Country" name="Country" required="Country">
                        <option value="Singapore">Singapore</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Taiwan">Taiwan</option>
                    </select>
                </div>

                <div class="form-check">
                    <label>                
                        <input required  type="checkbox" name="agree">Agree to terms and conditions.</label>            
                </div> 
                <div class="form-gorup">
                    <button id="registerbtn" class="btn btn-primary" type="submit">Submit</button> 
                </div>
            </form>


<?php include "phpFiles/footer.inc.php"; ?> 

        </main>





    </body>


</html>
