<?php
require_once 'dbconnect.php';

$content = trim($_POST['content']);
$content = strip_tags($content);
$content = htmlspecialchars($content);

$email = trim($_POST['email']);
$email = strip_tags($email);
$email = htmlspecialchars($email);

if (isset($_POST['commenter'])) {
  $res = "INSERT INTO comments (content,email) VALUES ('$content','$email')";
  mysql_query($res);
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
  <nav class="navbar  nav-bar-sachmem" >
  <div class="container-fluid" >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Trình đơn</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
  </div>
</nav>

  <h4 style="margin-left:580px; color:#fff;">Les Cours(pdf)</h4>
  <div style="background-color:#ddd; height:200px; margin-left:150px; border-radius:5px; background-color:rgba(0,0,0,0.5); " class="col-md-9">
    <br/>
      <?php $res=mysql_query("SELECT * FROM cours");
      while ($row = mysql_fetch_array($res)) { ?>
      <div class="col-md-3" style="background-color:#fff; border-radius:4px; width:150px; margin-left:20px;">
       <center><h4 ><?php echo $row['namefile'] ?></h4></center>
       <p><a class="btn btn-danger" download role="button" style="font-size:12px; margin-top:px; margin-left:20px;">Download</a></p>
       <p><a href="<?php echo $row['pathfile'] ?>" class="btn btn-danger" role="button" style="font-size:12px; margin-top:-5px; margin-left:20px;">Show File</a></p>
      </div>
      <?php } ?>
  </div>

  <h4 style="margin-left:560px; color:#fff; margin-top:230px;">Ajouter un Commentaire</h4>
  <div style="background-color:#ddd; height:200px; margin-left:150px; border-radius:5px; background-color:rgba(0,0,0,0.5);" class="col-md-9">
    <form  action="user.php" method="post">
      <center>
        <input style="margin-top:-130px" type="text" name="email" id="email" placeholder="Enter Your Email">
       <textarea type="text" rows=3 cols=50 name="content" id="content" style="margin-left:-200px;border-radius:5px; margin-top:50px; color:#000;"></textarea>
       <button class="btn " style="margin-top:55px; margin-left:-300px; color:#000;" name="commenter" type="submit" id="commenter"> <span class="btn-label"></span>&emsp;&emsp;Commenter&emsp;&emsp;</button>
     </center>
   </form>
  </div>

</body>
</html>
