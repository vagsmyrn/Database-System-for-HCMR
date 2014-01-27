<?php
include ("dbcon.php");
session_start();
$searchv = $_POST['searchv'];
if(empty($searchv)) {
	$sql = "SELECT * FROM ports";
    } else {
    //If there is text in the search field, this code is executed every time the input changes.
	$sql = "SELECT * FROM ports WHERE name LIKE '%$searchv%' OR code LIKE '%$searchv%'";
	}
$result = mysqli_query($con, $sql);
echo "<table id=\"results\">
<tr>
<th>Name</th>
<th>Code</th>
<th colspan=\"2\">Edit</th>
</tr>";
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['code'] . "</td>";
  echo "<td><a href=edit_production.php>Edit production</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
