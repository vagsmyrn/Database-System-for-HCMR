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
<link href='css/redmond/jquery-ui-1.10.3.custom.min.css' rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker.js"></script>
<script type="text/javascript">
//Show/hide depending on Selected Query
function select_Query(target){
	if (target.value === "measurements")
	{
		$("#measurements").show("slow");
		$("#expeditiondata").hide("slow");
		$("#analysis_results").hide("slow");
	}
	if (target.value === "expedition")
	{
		$("#measurements").hide("slow");
		$("#expeditiondata").show("slow");
		$("#analysis_results").hide("slow");
	}
	if (target.value === "")
	{
		$("#measurements").hide("slow");
		$("#expeditiondata").hide("slow");
		$("#analysis_results").hide("slow");
	}
}
//Datepicker
$(function(){
	var elem = document.createElement('input');
	elem.setAttribute('type', 'date');
	if (elem.type === 'text') {
		$('.date').each(function(){
			$(this).datepicker({
				dateFormat: 'yy-mm-dd'
				});  
		});
	}
});
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
    function checkAMAS() {
        var amas=document.forms["analysis"]["searchv"].value;
        var selectval=document.forms["analysis"]["selectquery"].value;
        if(selectval === "expedition"){
            if(amas == null || amas == ""){
                confirm("No AMAS selected, do you want to see all Vessel and Expedition data?");
            }
        }
    }
</script>

</head>
<body>
<div id="wrapper">
	<div id="header">
        <blockquote><h1>Large Pelagic Database</h1></blockquote>
        <blockquote><h2><a href="index.php">Home</a></h2></blockquote>
       <?php require_once("loginform.php");
	   ?>
    </div>
    <div id="main"></div>
    	<div id="menu">
     <?php
	 require_once("menu.php");
	  ?></div>
  <div id="content">
				<?php
					 include("dbcon.php");
					 if($privcheck == "admin" || $privcheck == "moderator" || $privcheck == "user" && $usercheck != "" && $usercheck != NULL) 
					 {
						 ?>
    <form name="analysis" id="analysis" action="">
        <select name="selectquery" onchange="select_Query(this);">
                <option value="">Select Query</option>
                <option value="measurements">Species Measurements</option>
                <option value="expedition">Expedition Data</option>
        </select>
        <div id="measurements" style="display:none;">
                            <h2>Measurements Data</h2>
                            <p>
                            	<select name="measurements_species_search">
                                <option value="">Select Species</option>
                                <option value="ALB">Albacore</option>
                                <option value="BFT">Bluefin Tuna</option>
                                <option value="RVT">Oilfish | Ruvettus pretiosus</option>
                                <option value="SWO">Swordfish</option>
                                </select> 
                                <label for="measurements_year">Year:</label>
                                <input name="measurements_year" type="text" id="measurements_year" size="4" maxlength="4" />
                            </p>
                            </div><br />
                            <div id="expeditiondata" style="display:none;">
                            <h2>Expedition Data</h2>
                            <p>
                            	<label for="searchbox">Vessel AMAS: </label>
                                <input type="text" id="searchbox" autocomplete="off" id="searchbox" name="searchv" />
                                <sup style="color:#f00;"><em>(Τype in the whole number.)</em></sup>
 <label for="deploydatefrom">Deploy Date from:</label><input type="date" name="deploydatefrom" id="deploydatefrom" class="date" /> <label for="deploydateto">Deploy Date to:</label><input type="date" id="deploydateto" name="deploydateto"  class="date" /><br />
 <div id="showamas"></div><br />
 Choose the fields you want to show:<br />
 <table width="40%"><tr>
 <th><b>Vessel:</b></th><th><b>Expedition:</b></th></tr>
  <tr><td><label>
                             <input type="checkbox" name="vesselcolumns[]" value="AMAS" id="vesselcolumns_0" />
                             AMAS</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="vessel_name" id="vesselcolumns_1" />
                             Vessel Name</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="reg_no_state" id="vesselcolumns_2" />
                             Reg No State</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="port" id="vesselcolumns_3" />
                             Port</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="port_area" id="vesselcolumns_4" />
                             Port Area</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="grt" id="vesselcolumns_5" />
                             GRT</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="vl" id="vesselcolumns_6" />
                             VL</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="vlc" id="vesselcolumns_7" />
                             VLC</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="vw" id="vesselcolumns_8" />
                             VW</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="hp" id="vesselcolumns_9" />
                             HP</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="gears" id="vesselcolumns_10" />
                             Gears</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="navigation" id="vesselcolumns_11" />
                             Navigation</label>
                           <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="communication" id="vesselcolumns_12" />
                             Communication</label>
                            <br />
                           <label>
                             <input type="checkbox" name="vesselcolumns[]" value="vessel_num" id="vesselcolumns_11" />
                           Number of vessels deployed</label>
                           <br />
                           </td>
                             <td><p>
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="expedition_ID" id="expeditioncolumns_0" />
                                 ID</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="deployDate" id="expeditioncolumns_1" />
                                 Deploy Date</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="returnDate" id="expeditioncolumns_2" />
                                 Return Date</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="Hooks_day" id="expeditioncolumns_3" />
                                 Hooks/Day</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="FishingDays" id="expeditioncolumns_4" />
                                 Fishing Days</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="Effort" id="expeditioncolumns_5" />
                                 Effort</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="gear" id="expeditioncolumns_6" />
                                 Gear</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="Detail_Area" id="expeditioncolumns_7" />
                                 Detail Area</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="StartSettingTime" id="expeditioncolumns_8" />
                                 Start Setting Time</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="StartLat" id="expeditioncolumns_9" />
                                 Start LAT</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="StartLon" id="expeditioncolumns_10" />
                                 Start LON</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="EndSetTime" id="expeditioncolumns_11" />
                                 End Setting Time</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="EndLAT" id="expeditioncolumns_12" />
                                 End LAT</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="EndLON" id="expeditioncolumns_13" />
                                 End LON</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="StartHaulTime" id="expeditioncolumns_14" />
                                 Start Haul Time</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="StartLATHaul" id="expeditioncolumns_15" />
                                 Start Haul LAT</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="StartLONHaul" id="expeditioncolumns_16" />
                                 Start Haul LON</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="EndHaulTime" id="expeditioncolumns_17" />
                                 End Haul Time</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="EndLATHaul" id="expeditioncolumns_18" />
                                 End Haul LAT</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="EndLONHaul" id="expeditioncolumns_19" />
                                 End Haul LON</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="Lightsticks" id="expeditioncolumns_20" />
                                 Lightsticks</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="InfoOrigin" id="expeditioncolumns_21" />
                                 Info Origin</label>
                               <br />
                               <label>
                                 <input type="checkbox" name="expeditioncolumns[]" value="Comments" id="expeditioncolumns_22" />
                                 Comments</label>
                               <br />
                             </p></td>
          </tr>
                             </table>
                           </div>
                            <input type="button" id="searchanalysis" value="Submit" onclick="checkAMAS()"/>
                         </form>
                         <div id="analysis_results"></div>
    <script>

                        $(function () {
                            $("#searchanalysis").click(function () {
                                $.post("analysisdata.php", $("#analysis").serialize(), function (data) {
                                    $("#analysis_results").html(data);
                                    $("#analysis_results").show();
                                })
                            })
                        });

						var metritis=0;
						$('#searchbox').keypress(function(){
							$.post('getvessel.php', $("#searchbox").serialize(), function(data){
								$('#showamas').html(data);
                                if(metritis == 0){
                                    $('#showamas').show("slow");
                                    metritis ++;
                                }
							});
						});
						$(document).click(function(){
							$('#showamas').hide("slow");
						});


    </script>
                            
                   <?php
					 }
					 else
					 {
						 echo "You have to login to see this page!";
					 }
						 ?>
          </div>
  </div>
    <div id="footer"><a href="help/index.html" target="_blank">HELP</a></div>
</div>
</body>
</html>