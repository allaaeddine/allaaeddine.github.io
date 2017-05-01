<?php

require_once 'dbconnect.php';

$res=mysql_query("SELECT * FROM users WHERE id=".$_SESSION['user']);
$row=mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>
<body>

  <img src="img\1.png" width="80px" height="80px" style="margin-left:600px; margin-top:50">
  <ul class="nav navbar-right">
    <li style="margin-left:-150px; font-size:25px; margin-top:50px;"><a href="log-out.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
  </ul>
</body>
</html>
