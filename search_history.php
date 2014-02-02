<?php
include ("dbcon.php");
session_start();
$searchv = $_POST['searchv'];
if(empty($searchv)) {
	$sql = "SELECT action_username, action_AMAS, action_vproduction_ID, action_pproduction_ID, action_eexpedition_ID, 
										action_size_expedition_ID, action_ALBmeasure, action_BFTmeasure, action_RVTmeasure, action_SWOmeasure, 
										action_OTHERmeasure, action_date FROM users_action_history";
    } else {
    //If there is text in the search field, this code is executed every time the input changes.
	$sql = "SELECT action_username, action_AMAS, action_vproduction_ID, action_pproduction_ID, action_eexpedition_ID, 
										action_size_expedition_ID, action_ALBmeasure, action_BFTmeasure, action_RVTmeasure, action_SWOmeasure, 
										action_OTHERmeasure, action_date FROM users_action_history WHERE action_username LIKE '%$searchv%' OR 
										action_date LIKE '%$searchv%'";
	}
$result = mysqli_query($con, $sql);
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

