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
    <div id="main">
    </div>
    <div id="menu">
     <?php
	 require_once("menu.php");
	 if($privcheck == "admin" || $privcheck == "moderator" || $privcheck == "user" && $usercheck != "" && $usercheck != NULL) 
					 {
	  ?>
    </div>

        
        <div id="content">
    	          <h2>EDIT USER DATA</h2>
                  
                  <?php
				  require_once('dbcon.php');
				  	if($privcheck == "user" || $privcheck == "moderator" || $privcheck == "admin")
					{
						$sql = "SELECT action_username, action_AMAS, action_vproduction_ID, action_pproduction_ID, action_eexpedition_ID, 
										action_size_expedition_ID, action_ALBmeasure, action_BFTmeasure, action_RVTmeasure, action_SWOmeasure, 
										action_OTHERmeasure, action_date 
										FROM users_action_history 
										WHERE 
												action_username LIKE '$usercheck' AND 
												timestampdiff(day, users_action_history.action_date, now()) <= 2";
												
						$result = mysqli_query($con, $sql);
						if (!$result)
						  {
						  die('Error: ' . mysqli_error($con));
						  }
						echo "<table id=\"results\">
						<tr>
						<th>Username</th>
						<th>AMAS</th>
						<th>Dynamic Vessel ID</th>
						<th>Production ID</th>
						<th>Expedition ID</th>
						<th>Expedition Size ID</th>
						<th>ALB Measure</th>
						<th>BFT Measure</th>
						<th>RVT Measure</th>
						<th>SWO Measure</th>
						<th>OTHER Measure</th>
						<th>Date</th>
						</tr>";
						while($row = mysqli_fetch_array($result))
						{
							echo "<tr>";
							echo "<td>" . $row['action_username'] . "</td>";
							/*if($row['action_AMAS'] == NULL) {*/echo "<td>" . $row['action_AMAS'] . "</td>";//}
							//else{echo "<td><a href=\"edit_amas.php?takeamas=" . $row['action_AMAS'] . "\">Edit vessel</a></td>";}
							
							/*if($row['action_vproduction_ID'] == NULL) {*/echo "<td>" . $row['action_vproduction_ID'] . "</td>";//}
							//else{echo "<td><a href=\"edit_dvessel.php?dvessel=" . $row['action_vproduction_ID'] . "\">Edit dynamic vessel data</a></td>";}
							
							/*if($row['action_pproduction_ID'] == NULL) {*/echo "<td>" . $row['action_pproduction_ID'] . "</td>";//}
							//else{echo "<td><a href=\"edit_prod.php?production=" . $row['action_pproduction_ID'] . "\">Edit production data</a></td>";}
							
							if($row['action_eexpedition_ID'] == NULL)  {echo "<td>" . $row['action_eexpedition_ID'] . "</td>";}
							else{echo "<td><a href=\"edit_exp.php?exp=" . $row['action_eexpedition_ID'] . "\">Edit expedition data</a></td>";}
							
							if($row['action_size_expedition_ID'] == NULL) {echo "<td>" . $row['action_size_expedition_ID'] . "</td>";}
							else{echo "<td><a href=\"edit_expsize.php?expsize=" . $row['action_size_expedition_ID'] . "\">Edit expedition size</a></td>";}
							
							if($row['action_ALBmeasure'] == NULL) {echo "<td>" . $row['action_ALBmeasure'] . "</td>";}
							else{echo "<td><a href=\"edit_alb.php?alb=" . $row['action_ALBmeasure'] . "\">Edit ALBmeasure</a></td>";}
							
							if($row['action_BFTmeasure'] == NULL) {echo "<td>" . $row['action_BFTmeasure'] . "</td>";}
							else{echo "<td><a href=\"edit_bft.php?bft=" . $row['action_BFTmeasure'] . "\">Edit BFTmeasure</a></td>";}
							
							if($row['action_RVTmeasure'] == NULL) {echo "<td>" . $row['action_RVTmeasure'] . "</td>";}
							else{echo "<td><a href=\"edit_rvt.php?rvt=" . $row['action_RVTmeasure'] . "\">Edit RVTmeasure</a></td>";}
							
							if($row['action_SWOmeasure'] == NULL) {echo "<td>" . $row['action_SWOmeasure'] . "</td>";}
							else{echo "<td><a href=\"edit_swo.php?swo=" . $row['action_SWOmeasure'] . "\">Edit SWOmeasure</a></td>";}
							
							if($row['action_OTHERmeasure'] == NULL) {echo "<td>" . $row['action_OTHERmeasure'] . "</td>";}
							else{echo "<td><a href=\"edit_other.php?other=" . $row['action_OTHERmeasure'] . "\">Edit OTHERmeasure</a></td>";}
							
							echo "<td>" . $row['action_date'] . "</td>";
							echo "</tr>";
						}
						echo "</table>";
	
					}
					if ($privcheck == "moderator" || $privcheck == "admin")
					{
						
						echo "<h2>Insert username or date to search history</h2>";
                 		echo "<form id=\"searchform\" method=\"post\" onsubmit=\"return false;\">
						<input autocomplete=\"off\" id=\"searchbox\" name=\"searchv\" onkeyup=\"sendRequest()\" onclick=\"sendRequest()\" type=\"textbox\">
        				</form>
						<div id=\"show_results\">
						</div>
						<script src=\"prototype.js\" type=\"text/javascript\"></script>
						<script>
						function sendRequest() {
							new Ajax.Updater('show_results', 'search_history.php', { method: 'post', parameters: $('searchform').serialize() });
						}
         				</script>"; 
						
					}
	
					?>
                  
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