<?php
// Resume current session
session_start();


//connect to db
$config = parse_ini_file('../../private/db1-config.ini');
$conn = new mysqli($config['servername'], $config['username'],
$config['password'], $config['dbname']);



$useremail = $_SESSION['whoami'];
$userid = $_SESSION['userid'];
$newvaluefname = $_POST['newfname'];
$newvaluelname = $_POST['newlname'];
$newvalueemail = $_POST['newemail'];
$newvaluephoneno = $_POST['newphoneno'];
$newvalueaddress = $_POST['newaddress'];
$newvaluepo = $_POST['newpo'];
$newvalueunit = $_POST['newunit'];


$newfname ="UPDATE cake_member SET fname = '$newvaluefname', lname = '$newvaluelname', email = '$newvalueemail', phoneno = '$newvaluephoneno', street = '$newvalueaddress' , PostalCode = '$newvaluepo', Unit = '$newvalueunit' WHERE userID = '$userid'";

 $sql = "select * from cake_member where email = '$newvalueemail' "; //to search for any duplicate email in the database
 $search_result = mysqli_query($conn, $sql);
 $emailfound = mysqli_num_rows($search_result);
 
  $sql="SELECT * FROM cake_member where userID ='$userid'";      
  $selectduser = mysqli_query($conn,$sql);
  $useremailing = mysqli_fetch_assoc($selectduser);
 
 
 if($useremailing['email'] == $newvalueemail)
   {
     //true if email not change mean can update
    $success = true;
   }
   else if($emailfound >= 1)
   {
     //fail as email has been found in database
     echo "<script>
     alert('Email already been use try other email');
      window.location.href='profile.php';
     </script>";
     $success = false;
     $newfname->close();
   }
   

$Updateuser = mysqli_query($conn,$newfname);

if($Updateuser >0)
{
    echo "<script>
   alert('Profile Update Successfully');
  window.location.href='profile.php';
   </script>";
}
else
{
  "<script>
   alert('Profile Update Unsuccessfully');
  window.location.href='profile.php';
   </script>";
}


function doSaveData($tgt)
{
    
$config = parse_ini_file('../../private/db1-config.ini');
$conn = new mysqli($config['servername'], $config['username'],
$config['password'], $config['dbname']);

$userid = $_SESSION['userid'];
    
    $sql = "UPDATE cake_member SET profilepic = '$tgt' WHERE userID = '$userid'";
     
    $result = mysqli_query($conn, $sql);
    
    if($result)
    {
    echo "<script>
    alert('Upload Success continue Shopping');
    window.location.href='index.php';
    </script>";
    }
    else
    {
    header("Location:profile.php?fail=1"); 
    }
}


     $filename = $_FILES['fileToUpload']['name'];
     $filesize = $_FILES['fileToUpload']['size'];
     $filetype = $_FILES['fileToUpload']['type'];
     
   
    
      $put_there = "images/" . $filename;
     
     if($filesize < 1000000000)
   {
         if($filetype == "image/jpeg" or
           $filetype == "image/jpg" or
           $filetype == "image/png" or
           $filetype == "image/gif" or
           $filetype == "image/bmp")
       {
         
          $result = move_uploaded_file( $_FILES['fileToUpload']['tmp_name'] , $put_there );
           

     if($result)
     {
        
        doSaveData($put_there);
     }
       else 
       echo  $filename . "Failed To Upload";
       
       }
       
   }
      else 
      {
        header("Location:profile.php?big=1"); 
      }
      

      
      

      
      



?>
