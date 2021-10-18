<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tarts N's Cake</title>
        <link rel="stylesheet" href="css/profile.css"/>
        <?php
        include 'phpFiles/headcontents.inc.php';
        ?>



        
        <?php 
        session_start();
        if (!isset($_SESSION['whoami'])) { //check if there is an session
            header("Location:Login.php");
        }

        //open connection and select database
        $config = parse_ini_file('../../private/db1-config.ini');
        $conn = new mysqli($config['servername'], $config['username'],
                $config['password'], $config['dbname']);
        $useremail = $_SESSION['whoami'];
        $userid = $_SESSION['userid'];
        $userlname = $_SESSION['username'];
        $stmt = $conn->prepare("SELECT * FROM cake_member where userID ='$userid'");
        
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0)
        {
        $row = $result->fetch_assoc();
    $fname = $row["fname"];
    $lname = $row["lname"];
    $email = $row["email"];
    $phoneno = $row["phoneno"];
     $addr = $row["street"];
    $po = $row["PostalCode"];
    $unit = $row["Unit"];
    $profilepict = $row["profilepic"];
            
            }
        //$selectduser = mysqli_query($conn, $sql);
        //s$userinfo = mysqli_fetch_assoc($selectduser);
        ?>



    </head>

    <body>
<?php
include "phpFiles/nav.inc.php"
;
?> 
        <header id="Content">
            <?php
            include "phpFiles/banner.php";
            ?>
        </header>

        <main class="container">        
            <img id="profileimg" alt="profilepicture" src="<?php echo $profilepict; ?>">
            <br>
            <h1 style="color:darkgrey;"><?php echo $userinfo['lname']; ?>'s Profile</h1>        
            <br>
            <br>
            <p>             
                Manage and edit your account info.  
            </p>  


            <form id="form1" enctype="multipart/form-data" name="form1" action="process_updateprofile.php" method="post">
                <div class="form-gorup">
                    <label for="newfname">First Name:</label>            
                    <input class="form-control " type="text" id="newfname" required  name="newfname"                   
                           value="<?php echo  $fname; ?>" >    

                </div>
                <div class="form-gorup">
                    <label for="newlname">Last Name:</label>            
                    <input class="form-control" type="text" id="newlname"
                           required maxlength="45" name="newlname" value="<?php echo $lname; ?>">             
                </div>   

                <div class="form-gorup">
                    <label for="newemail">Email:</label>            
                    <input class="form-control" type="email" id="newemail" required name="newemail"                   
                           placeholder="Enter email" title="Please enter a valid email addess" value="<?php echo $email; ?>">            
                </div>      

                <div class="form-gorup">
                    <label for="newphoneno">Phone number:</label> 
                    <input  class="form-control" type="text" id="newphoneno"  required maxlength="11" name="newphoneno" 
                            pattern="[0-9]{8}" title="Please enter phone number as 8-digit numbers only" value="<?php echo $phoneno; ?>">  
                </div>               
                <div class="form-gorup">
                    <label for="newaddress">Street:</label> 
                    <input  class="form-control" type="text" id="newaddress"  required  name="newaddress" 
                            value="<?php echo $addr; ?>">  
                </div>
                
                <div class="form-gorup">
                    <label for="newpo">Postal code:</label> 
                    <input  class="form-control" type="text" id="newpo"  required  name="newpo"  name="postalcode" pattern="[0-9]{6}"  title="Please enter postal code number as 6-digit numbers only"
                            value="<?php echo $po; ?>">  
                </div>
                 <div class="form-gorup">
                    <label for="newunit">Unit:</label> 
                    <input  class="form-control" type="text" id="newunit"  required  name="newunit" pattern="[0-9][0-9]-[0-9][0-9]" title="Please enter valid unit number eg.06-57" 
                            value="<?php echo $unit; ?>">  
                </div>

                <div class="form-check">
                    <label for="fileToUpload">Update profile pic:</label>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>

                <?php
                if (isset($_GET['fail'])) {
                    echo "<span style='color:red'>Upload Failed !!!!</span>";
                }
                if (isset($_GET['big'])) {
                    echo "<script>
               alert('File Size Too Big, Fail To Upload File');
               window.location.href='profile.php';
               </script>";
                }
                ?>                 
                <div class="form-check">
                    <label>                
                        <input required  type="checkbox" name="agree">Agree to terms and conditions.</label>            
                </div> 
                <div class="form-gorup">
                    <button id="savebtn" class="btn btn-primary" type="submit">Save</button> 
                </div>
            </form>

<?php include "phpFiles/footer.inc.php"; ?> 

        </main>





    </body>


</html>

