<?php
session_start();
 require_once 'dbconnect.php';

 if( isset($_POST['login']) ) {

  $username = trim($_POST['username']);
  $username = strip_tags($username);
  $username = htmlspecialchars($username);

  $password = trim($_POST['password']);
  $password = strip_tags($password);
  $password = htmlspecialchars($password);

   $res=mysql_query("SELECT id, password FROM users WHERE username='$username'");
   $row=mysql_fetch_array($res);
   $count = mysql_num_rows($res);

   if( $count == 1 && $row['password']==$password ) {
    $_SESSION['user'] = $row['id'];
    header("Location: home.php");
   } else {
    $errMSG = "Incorrect Credentials, Try again...";
   }

}
 ?>

