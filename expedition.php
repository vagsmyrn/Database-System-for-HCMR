<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Large Pelagic Database</title>
<link href="style.css" rel="stylesheet" type="text/css" /></head><body>
<div id="redirect">
<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if(isset($_SESSION['sess_username']) && isset($_SESSION['sess_privileges']))
{
$usercheck = $_SESSION['sess_username'];
$privcheck = $_SESSION['sess_privileges'];
}
else {
	$privcheck=1;
	$usercheck=0;
	}
include ("dbcon.php");

/// Converting LATs and LONs
//// Start/End LAT and LON
$startlat= $_POST['startlatd'] + ($_POST['startlatm']/60) + ($_POST['startlats']/3600);
if($_POST['startlatdir'] == "S"){ $startlat=$startlat*(-1); }
$startlon= $_POST['startlond'] + ($_POST['startlonm']/60) + ($_POST['startlons']/3600);
if($_POST['startlondir'] == "W"){ $startlon=$startlon*(-1); }
$endlat= $_POST['endlatd'] + ($_POST['endlatm']/60) + ($_POST['endlats']/3600);
if($_POST['endlatdir'] == "S"){ $endlat=$endlat*(-1); }
$endlon= $_POST['endlond'] + ($_POST['endlonm']/60) + ($_POST['endlons']/3600);
if($_POST['endlondir'] == "W"){ $endlon=$endlon*(-1); }
//// Start/End Haul LAT and LON
$startlathaul= $_POST['startlathauld'] + ($_POST['startlathaulm']/60) + ($_POST['startlathauls']/3600);
if($_POST['startlathauldir'] == "S"){ $startlathaul=$startlathaul*(-1); }
$startlonhaul= $_POST['startlonhauld'] + ($_POST['startlonhaulm']/60) + ($_POST['startlonhauls']/3600);
if($_POST['startlonhauldir'] == "W"){ $startlonhaul=$startlonhaul*(-1); }
$endlathaul= $_POST['endlathauld'] + ($_POST['endlathaulm']/60) + ($_POST['endlathauls']/3600);
if($_POST['endlathauldir'] == "S"){ $endlathaul=$endlathaul*(-1); }
$endlonhaul= $_POST['endlonhauld'] + ($_POST['endlonhaulm']/60) + ($_POST['endlonhauls']/3600);
if($_POST['endlonhauldir'] == "W"){ $endlonhaul=$endlonhaul*(-1); }
/// END of converting LAT and LON

if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//Insert data to expedition ERROR: 1
$comments= htmlspecialchars($_POST['comments'], ENT_QUOTES);
if($comments=="comments")
{
	$comments = NULL;
}
$amascounter=$_POST['amascounter'];
$sql ="INSERT INTO expedition VALUES
(NULL, '$_POST[deploydate]','$_POST[returndate]','$_POST[hooksday]',
'$_POST[fishingdays]','$_POST[effort]','$_POST[gear]',
'$_POST[detailarea]','$_POST[startsettingtime]','$startlat',
'$startlon','$_POST[endsettime]','$endlat',
'$endlon','$_POST[starthaultime]','$startlathaul',
'startlonhaul','$_POST[endhaultime]','$endlathaul',
'$endlonhaul','$_POST[lightsticks]','$_POST[infoorigin]',
'$comments')";
if (!mysqli_query($con,$sql))
  {
  die('1Error: ' . mysqli_error($con));
  }
  else
  {
	  //Insert data to users_action_history ERROR: 2
	  $expedition_ID=mysqli_insert_id($con);
	  $useractions = "INSERT INTO users_action_history (action_ID, action_username, action_eexpedition_ID, action_date) VALUES
	  (NULL, '$usercheck', '$expedition_ID', NOW())";
	  if (!mysqli_query($con, $useractions))
	  {
		  die('2Error: ' . mysqli_error($con));
	  }
  }
//Insert data to vessel_expeditions ERROR: 3
for($i=1; $i<=$amascounter; $i++){
        $amas = $_POST['AMAS'.$i];
        $vessel_expeditions="INSERT INTO vessel_expeditions VALUES ('$amas','$expedition_ID','$amascounter')";
        if(!mysqli_query($con, $vessel_expeditions)){
            die('3Error: ' . mysqli_error($con));
        }
    }
//Insert expedition_size ERROR: 4 | 5
$spcounter = $_POST['speciescounter'];
for($i=0; $i<$spcounter; $i++)
{
	if($i==0)
	{
		$expedition_size="INSERT INTO expedition_size VALUES
		('$_POST[speciesweight]','$_POST[speciesnumber]','$_POST[species]','$expedition_ID')";
		if(!mysqli_query($con,$expedition_size))
		{
			die('4Error: ' . mysqli_error($con));
		}
	}else if($i!=0)
	{
		$speciesweight = $_POST['speciesweight'.$i];
		$speciesnumber= $_POST['speciesnumber'.$i];
		$species= $_POST['species'.$i];
		$expedition_size="INSERT INTO expedition_size VALUES
		('$speciesweight','$speciesnumber','$species','$expedition_ID')";
		if(!mysqli_query($con,$expedition_size))
		{
			die('5Error: ' . mysqli_error($con));
		}	
	}
}
//Insert species_measurements ERROR: 6 | 7
$spmcounter=$_POST['speciesmeasurecounter'];
for ($im=0; $im<=$spmcounter; $im++)
{
	//Get all the values for the $im field into variables
	$speciesmeasure = $_POST['speciesmeasure_'.$im];
	$fl=$_POST['measurefl_'.$im];
	$ljfl=$_POST['measureljfl_'.$im];
	$tl=$_POST['measuretl_'.$im];
	$pffl=$_POST['measurpffl_'.$im];
	$gg=$_POST['measuregg_'.$im];
	$dw=$_POST['measuredw_'.$im];
	$rw=$_POST['measurerw_'.$im];
	$sex=$_POST['measuresex_'.$im];
	$pfl=$_POST['measurepfl_'.$im];
	$matur_stage=$_POST['measurematur_stage_'.$im];
	$gon_wei=$_POST['measuregon_wei_'.$im];
	$head_length=$_POST['measurehead_length_'.$im];
	$life_status=$_POST['measurelife_status_'.$im];
	$parasites=$_POST['measureparasites_'.$im];
	$bait_type=$_POST['measurebait_type_'.$im];
	$commercial=$_POST['measurecommercial_'.$im];
	//If there is not species selected go to next $im in for()
	if($speciesmeasure == NULL || $speciesmeasure == "")
	{
		echo 'h for() espase sto '.$im;
		continue;
	}
	//Insert measurement if species is ALBacore
	else if($speciesmeasure == "Albacore")
	{
		$insertspeciesmeasurement="INSERT INTO species_measurements VALUES
		('$expedition_ID','$speciesmeasure',NULL)";
		if(!mysqli_query($con,$insertspeciesmeasurement))
		{
			die('6Error: ' . mysqli_error($con));
		}
		$measure_ID=mysqli_insert_id($con);
		$insertALBmeasure="INSERT INTO ALBmeasure VALUES 
		('$measure_ID','$fl','$gg','$dw','$rw','$sex','$matur_stage','$gon_wei','$life_status','$bait_type','$commercial')";
		if(!mysqli_query($con,$insertALBmeasure))
		{
			die('7Error: ' . mysqli_error($con));
		}
	}
	//Insert measurement if species is Bluefin Tuna BFT
	else if($speciesmeasure == "Bluefin Tuna")
	{
		$insertspeciesmeasurement="INSERT INTO species_measurements VALUES
		('$expedition_ID','$speciesmeasure',NULL)";
		if(!mysqli_query($con,$insertspeciesmeasurement))
		{
			die('6Error: ' . mysqli_error($con));
		}
		$measure_ID=mysqli_insert_id($con);
		$insertBFTmeasure="INSERT INTO BFTmeasure VALUES 
		('$measure_ID','$fl','$gg','$dw','$rw','$sex','$pfl','$matur_stage','$gon_wei','$life_status','$bait_type','$commercial')";
		if(!mysqli_query($con,$insertBFTmeasure))
		{
			die('7Error: ' . mysqli_error($con));
		}
	}
	//Insert measurement if species is Oilfish RVT
	else if($speciesmeasure == "Oilfish")
	{
		$insertspeciesmeasurement="INSERT INTO species_measurements VALUES
		('$expedition_ID','$speciesmeasure',NULL)";
		if(!mysqli_query($con,$insertspeciesmeasurement))
		{
			die('6Error: ' . mysqli_error($con));
		}
		$measure_ID=mysqli_insert_id($con);
		$insertRVTmeasure="INSERT INTO RVTmeasure VALUES 
		('$measure_ID','$fl','$tl','$pffl','$gg','$dw','$rw','$sex','$life_status','$bait_type','$commercial')";
		if(!mysqli_query($con,$insertRVTmeasure))
		{
			die('7Error: ' . mysqli_error($con));
		}
	}
	//Insert measurement if species is SWOrdfish
	else if($speciesmeasure == "Swordfish")
	{
		$insertspeciesmeasurement="INSERT INTO species_measurements VALUES
		('$expedition_ID','$speciesmeasure',NULL)";
		if(!mysqli_query($con,$insertspeciesmeasurement))
		{
			die('6Error: ' . mysqli_error($con));
		}
		$measure_ID=mysqli_insert_id($con);
		$insertSWOmeasure="INSERT INTO SWOmeasure VALUES 
		('$measure_ID','$ljfl','$gg','$sex','$rw','$dw','$pfl','$head_length','$matur_stage','$gon_wei','$parasites','$life_status','$bait_type','$commercial')";
		if(!mysqli_query($con,$insertSWOmeasure))
		{
			die('7Error: ' . mysqli_error($con));
		}
	}
	//Insert measurement if species is OTHER
	else
	{
		$insertspeciesmeasurement="INSERT INTO species_measurements VALUES
		('$expedition_ID','$speciesmeasure',NULL)";
		if(!mysqli_query($con,$insertspeciesmeasurement))
		{
			die('6Error: ' . mysqli_error($con));
		}
		$measure_ID=mysqli_insert_id($con);
		$scientificq="SELECT scientific FROM species WHERE common='$speciesmeasure'";
		$resultsciq=mysqli_query($con,$scientificq);
		$snamerow=mysqli_fetch_array($resultsciq);
		$scientificname=$snamerow['scientific'];
		$insertOTHERmeasure="INSERT INTO OTHERmeasure VALUES
		('$measure_ID','$scientificname','$speciesmeasure','$fl','$tl','$gg','$dw','$rw','$sex','$life_status','$bait_type','$commercial')";
		if(!mysqli_query($con,$insertOTHERmeasure))
		{
			die('7Error: ' . mysqli_error($con));
		}
	}
	
}
	  echo "<img src=\"img/tick.png\" width=\"25\" height=\"25\" /><strong>Expedition data stored succesfully!</strong> <p> You are redirected to homepage... </p><p> <i>if you aren't redirected <a href=\"index.php\">click here</a></i></p>";
	header("refresh:3;url=inserted.php");

mysqli_close($con);
?>
</div>
</body></html>