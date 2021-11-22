<?php
session_start();
unset($_SESSION['Username']);
 unset($_SESSION['ID']);
header("Location:login.php");

