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
    	          <h2>EDIT VESSEL DATA</h2>
                  
                  <?php
				  		$name = $_GET["takeamas"];
						$sql="SELECT * FROM expedition WHERE AMAS = '$name'";
						$result = mysqli_query($con, $sql);
						$row = mysqli_fetch_array($result);
				  
				  ?>
                  
    	          <form action="change_vessel.php" method="post" >
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  	<tr><th>Change the fields you want and press submit</th></tr>
                    <tr><td>AMAS:</td>			<td><input type="text" name="amas" value=" <?php echo $row['AMAS'];?>"></td></tr>
                    <tr><td>Vessel name:</td> 	<td><input type="text" name="vessel_name" value=" <?php echo $row['vessel_name'];?>"></td></tr>
                    <tr><td>Reg_no_state:</td> 	<td><input type="text" name="reg_no_state" value=" <?php echo $row['reg_no_state'];?>"></td></tr>
                    <tr><td>Port:</td> 			<td><input type="text" name="port" value=" <?php echo $row['port'];?>"></td></tr>
                    <tr><td>PortArea:</td>		<td><input type="text" name="port_area" value=" <?php echo $row['port_area'];?>"></td></tr>
                    <tr><td>GRT:</td> 			<td><input type="text" name="grt" value=" <?php echo $row['grt'];?>"></td></tr>
                    <tr><td>VL:</td> 			<td><input type="text" name="vl" value=" <?php echo $row['vl'];?>"></td></tr>
                    <tr><td>VLC:</td> 			<td><input type="text" name="vlc" value=" <?php echo $row['vlc'];?>"></td></tr>
                    <tr><td>VW:</td> 			<td><input type="text" name="vw" value=" <?php echo $row['vw'];?>"></td></tr>
                    <tr><td>HP:</td>				<td><input type="text" name="hp" value=" <?php echo $row['hp'];?>"></td></tr>
                    <tr><td>Navigation:</td> 	<td><input type="text" name="navigation" value=" <?php echo $row['navigation'];?>"></td></tr>
					<tr><td>Communication:</td> 	<td><input type="text" name="communication" value=" <?php echo $row['communication'];?>"></td></tr>
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