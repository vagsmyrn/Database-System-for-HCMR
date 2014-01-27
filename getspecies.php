<?php
include ("dbcon.php");
session_start();
$searchv = $_POST['searchv'];
if(empty($searchv)) {
	$sql = "SELECT * FROM species";
    } else {
    //If there is text in the search field, this code is executed every time the input changes.
	$sql = "SELECT * FROM species WHERE scientific LIKE '%$searchv%' OR common LIKE '%$searchv%'";
	}
$result = mysqli_query($con, $sql);
echo "<table id=\"results\">
<tr>
<th>scientific</th>
<th>common</th>
<th colspan=\"2\">Edit</th>
</tr>";
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['scientific'] . "</td>";
  echo "<td>" . $row['common'] . "</td>";
  echo "<td><a href=edit_production.php>Edit production</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
