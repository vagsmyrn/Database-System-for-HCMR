<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Large Pelagic Database</title>
<link href="style.css" rel="stylesheet" type="text/css" /></head><body>
<div id="redirect">
<?php

session_start(); 
if(isset($_SESSION['sess_username']) && isset($_SESSION['sess_privileges']))
{
$usercheck = $_SESSION['sess_username'];
$privcheck = $_SESSION['sess_privileges'];
}
else {
	$privcheck=1;
	$usercheck=0;
	}
$con=mysqli_connect('localhost', 'root', 'george2533', 'ELKETHE_DB');

if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_set_charset($con, "utf8");
  
  $sql="INSERT INTO production_ID (name, code)
VALUES
('$_POST[name]', '$_POST[code]')";

if (!mysqli_query($con,$sql))
{
die('3Error: ' . mysqli_error($con));
}else{
echo "<img src=\"img/tick.png\" width=\"25\" height=\"25\" /><strong>Gear inserted succesfully</strong> <p> You are redirected to homepage... </p><p> <i>if you aren't redirected <a href=\"index.php\">click here</a></i></p>";
header("refresh:5;url=index.php");}



mysqli_close($con);
?>

</div>
</body>
</html>