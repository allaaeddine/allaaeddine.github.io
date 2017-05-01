<?php
session_start();
require_once 'dbconnect.php';

$target_dir = "cours/";
$target_file = $target_dir . basename($_FILES["userfile"]["name"]);
$uploadOk = 1;
$filetype = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (isset($_POST["upload"])) {

  $check = getimagesize($_FILES["userfile"]["tmp_name"]);

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["userfile"]["size"] > 90000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats

// if everything is ok, try to upload file
 else {
    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
$userfile = trim($_POST['userfile']);
$userfile = strip_tags($userfile);
$userfile = htmlspecialchars($userfile);
$query = "INSERT INTO cours (namefile,pathfile) ".
"VALUES ('$userfile','$target_file')";

mysql_query($query) or die('Error, query failed');
}

if (isset($_POST['delete'])) {
  $id = trim($_POST['id']);
  $id = strip_tags($id);
  $id = htmlspecialchars($id);
  $delete = "delete FROM cours WHERE id = '$id' ";
  mysql_query($delete);
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
  <?php  include 'logout.php'; ?>
</nav>
<?php
$res=mysql_query("SELECT * FROM users WHERE id=".$_SESSION['user']);
$row=mysql_fetch_array($res);
 if ($row['username'] == "admin") {  ?>
<h4 style="margin-left:560px; color:#fff;">Ajouter Un Cours(pdf)</h4>
<div style="background-color:#ddd; height:200px; margin-left:150px; border-radius:5px; background-color:rgba(0,0,0,0.5); " class="col-md-9">
  <!-- Upload file -->
  <form method="post" action="home.php" enctype="multipart/form-data">

      <div class="input-group file-preview">
          <input name="userfile" type="text" class="form-control file-preview-filename" style="width:200px; margin-top:10px;margin-left:350px;">
          <span class="input-group-btn">
         <div class="btn btn-default file-preview-input" style="right:220px;top:5px;">
          <span class="glyphicon glyphicon-folder-open"></span>
          <span class="file-preview-input-title">Browse</span>
         <input name="userfile" id="userfile" type="file" accept=".pdf" name="input-file-preview"/>
        </div>
        <button type="submit" name="upload" id="upload" class="btn btn-labeled" style="right:400px; width:200px; top:50px;"> <span class="btn-label"></span>Upload</button>
        </span>
       </div>
      <br /><br /><br />
</form>
      <!-- / Upload file -->
    <?php $res=mysql_query("SELECT * FROM cours");
    while ($row = mysql_fetch_array($res)) {;
       ?>
      <div class="col-md-3" style="background-color:#fff; border-radius:4px; width:150px; margin-left:20px;">
      <center><h4 ><?php echo $row['namefile'] ?></h4></center>
      <form  action="home.php" method="post">
      <input type="hidden" name="id" id="id" value="<?php echo $row['id'] ?>">
      <p><button name="delete" id="delete" class="btn btn-danger" role="button" style="font-size:12px; margin-top:px; margin-left:30px;">Delete</button></p>
      </form>
      <p><a href="<?php echo $row['pathfile'] ?>" class="btn btn-danger" role="button" style="font-size:12px; margin-top:-10px; margin-left:20px;">Show File</a></p>
      <br/>
     </div>
     <?php } ?>
 </div>

<h4 style="margin-left:600px; color:#fff; margin-top:230px;">Comments</h4>
<div style="background-color:#ddd; height:200px; margin-left:150px; border-radius:5px; background-color:rgba(0,0,0,0.5);" class="col-md-9">
  <?php $res=mysql_query("SELECT * FROM comments");
  while ($row1 = mysql_fetch_array($res)) {
     ?>
     <center>
    <textarea disabled="none" type="text" rows=3 cols=50 style="margin-left:px;border-radius:5px; margin-top:10px; color:#000;"><?php echo $row1['email'] ,'&nbsp;&nbsp;:&nbsp;&nbsp;', $row1 ['content'] ?></textarea>
  </center>
   <?php } ?>
</div>
<?php } ?>

</body>
</html>
