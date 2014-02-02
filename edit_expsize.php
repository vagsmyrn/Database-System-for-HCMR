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
<title>Large Pelagic Database</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function check()
{
var user=document.forms["loginform"]["username"].value;
if (user==null || user=="")
  {
  alert("Ξέχασες να βάλεις username!");
  return false;
  }
var pass=document.forms["loginform"]["password"].value;
if (pass==null || pass=="")
  {
  alert("Ξέχασες να βάλεις password!");
  return false;
  }
}
</script>

</head>
<body>
<div id="wrapper">
	<div id="header">
        <blockquote><h1>Large Pelagic Database</h1></blockquote>
        <blockquote><h2><a href="index.php">Home</a></h2></blockquote>
       <?php require_once("loginform.php");?>
    </div>
    <div id="main"></div>
    	<div id="menu">
     <?php
	 require_once("menu.php");
	 require_once("dbcon.php");
	 if($privcheck == "admin" || $privcheck == "moderator" || $privcheck == "user" && $usercheck != "" && $usercheck != NULL) 
					 {
	  ?></div>
        <div id="content">
    	          <h2>EDIT EXPEDITION SIZE DATA</h2>
                  
                  <?php
				  		$name = $_GET["expsize"];
						$sql="SELECT * FROM expedition_size WHERE size_expedition_ID = '$name'";
						$result = mysqli_query($con, $sql);
						$row = mysqli_fetch_array($result);
				  
				  ?>
                  
    	          <form action="change_expsize.php" method="post" >
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  	<tr><th>Change the fields you want and press submit</th></tr>
                    <tr><td>expedition size ID:</td>			<td><input type="text" name="size_expedition_ID" value=" <?php echo $row['size_expedition_ID'];?>"></td></tr>
                    <tr><td>Weight:</td> 	<td><input type="text" name="weight" value=" <?php echo $row['weight'];?>"></td></tr>
                    <tr><td>Num:</td> 	<td><input type="text" name="num" value=" <?php echo $row['num'];?>"></td></tr>
                    <tr><td>Species:</td> 			<td><input type="text" name="species" value=" <?php echo $row['species'];?>"></td></tr>
                    <tr><td>Commercial:</td>		<td><input type="text" name="commercial" value=" <?php echo $row['commercial'];?>"></td></tr>
                    <tr><td><input type="submit" id="button" name="Submit"></td></tr>
                  </table>
				  </form>
                  </div>
		</div>
        <?php }

       else 
       {
       	echo "You have to login to see this page!";
       }      ?>
    <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
</div>
</body>
</html>