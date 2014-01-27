<?php session_start(); 
if(isset($_SESSION['sess_username']) && isset($_SESSION['sess_privileges']))
{
$usercheck = $_SESSION['sess_username'];
$privcheck = $_SESSION['sess_privileges'];
}
else {
	$privcheck=1;
	$usercheck=0;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href='css/redmond/jquery-ui-1.10.3.custom.min.css' rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script src="js/jquery-ui-timepicker.js"></script>
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <blockquote><h1>Large Pelagic Database</h1></blockquote>
            <blockquote><h2><a href="index.php">Home</a></h2></blockquote>
            <?php
            require_once("loginform.php");
            require_once("dbcon.php");
            ?>
        </div>
        <div id="main"></div>
        <div id="menu">
			<?php
            require_once("menu.php");
            ?>
        </div>
        
        <div id="content">
        
        </div>
    </div>
</body>
</html>