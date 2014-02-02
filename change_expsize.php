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
require_once('dbcon.php');

$sql="UPDATE expedition_size
		SET 
		size_expedition_ID = '$_POST[size_expedition_ID]',
		weight = '$_POST[weight]', 
		num = '$_POST[num]', 
		species = '$_POST[species]', 
		commercial = '$_POST[commercial]'
		
	WHERE size_expedition_ID = '$_POST[size_expedition_ID]'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  
  

$query="INSERT INTO users_action_history (action_ID, action_username, action_size_expedition_ID, action_date)
VALUES
(NULL, '$usercheck', '$_POST[size_expedition_ID]', NOW())";

if (!mysqli_query($con,$query))
  {
  die('Error: ' . mysqli_error($con));
  }
  else
{
  echo "<img src=\"img/tick.png\" width=\"25\" height=\"25\" /><strong>Expedition size data  changed succesfully!</strong> <p> You are redirected to homepage... </p><p> <i>if you aren't redirected <a href=\"index.php\">click here</a></i></p>";
header("refresh:5;url=index.php");
} 


mysqli_close($con);
?>

</div>
</body>
</html>