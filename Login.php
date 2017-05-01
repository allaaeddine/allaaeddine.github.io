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
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Home page</title>
    <?php include ('css.php'); ?>
    <?php include ('js.php');?>
  </head>
<body id="img">
  <div class="container">
        <div class="card card-container">
            <span class="glyphicon glyphicon-user" style="font-size:100px; margin-left:120px;"></span>
            <center><h3>Welcome</h3></center>
            <p id="profile-name" class="profile-name-card"></p>
            <form action="login.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
                <br/>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <br/>
                <button class="btn btn-lg  btn-block btn-signin" type="submit" name="login" id="login" style="background-color:rgba(0,0,0,0.4)">Login</button>
            </form>
             <center><p><a href="user.php" class="btn" role="button" style="font-size:30px; margin-top:20px;">Go Home</a></p></center>
        </div>
    </div>
</body>
</html>
