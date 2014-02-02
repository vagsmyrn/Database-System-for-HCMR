<?php
require_once('dbcon.php');
if($_POST['selectquery'] === "measurements")
{
    /* SHOWS ALBACORE MEASUREMENTS
    //
    //
    */
    if($_POST['measurements_species_search'] === "ALB")
    {
        $searchyear=$_POST['measurements_year'];
        $albquery="SELECT * FROM
		ALBmeasure
		INNER JOIN species_measurements
		ON ALBmeasure.ALB_measure_ID = species_measurements.measure_ID
		INNER JOIN expedition
		ON species_measurements.measure_expedition_ID = expedition.expedition_ID
		WHERE YEAR(STR_TO_DATE(deployDate, '%Y-%m-%d'))='$searchyear' ORDER BY deployDate";
        $result=mysqli_query($con,$albquery);
        $forexport= '<table id="results" class="tablesorter">
                <thead>
				<tr id="results">
					<th>ID</th>
					<th>FL</th>
					<th>GG</th>
					<th>DW</th>
					<th>RW</th>
					<th>SEX</th>
					<th>MATURE STAGE</th>
					<th>GON WEIGHT</th>
					<th>LIFE STATUS</th>
					<th>BAIT TYPE</th>
					<th>COMMERCIAL</th>
					<th>DEPLOY DATE</th>
				</tr>
				</thead><tbody>';
        while($row = mysqli_fetch_array($result))
        {
            $forexport .= '<tr>
			<td>' . $row['ALB_measure_ID'] . '</td>
			<td>' . $row['fl'] . '</td>
			<td>' . $row['gg'] . '</td>
			<td>' . $row['dw'] . '</td>
			<td>' . $row['rw'] . '</td>
			<td>' . $row['sex'] . '</td>
			<td>' . $row['matur_stage'] . '</td>
			<td>' . $row['gon_wei'] . '</td>
			<td>' . $row['life_status'] . '</td>
			<td>' . $row['bait_type'] . '</td>
			<td>' . $row['commercial'] . '</td>
			<td>' . $row['deployDate'] . '</td>
			</tr>';

        }
        $forexport .='</tbody></table>';
        echo $forexport;
        echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		<input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		<label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="csv" id="selectcsv" required />
		<label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="xls" id="selectxls" />
		<input type="submit" value="Download" />';
    }
    /* SHOWS BFT MEASUREMENTS
    //
    //
    */
    else if($_POST['measurements_species_search'] === "BFT")
    {
        $searchyear=$_POST['measurements_year'];
        $bftquery="SELECT * FROM
		BFTmeasure
		INNER JOIN species_measurements
		ON BFTmeasure.BFT_measure_ID = species_measurements.measure_ID
		INNER JOIN expedition
		ON species_measurements.measure_expedition_ID = expedition.expedition_ID
		WHERE YEAR(STR_TO_DATE(deployDate, '%Y-%m-%d'))='$searchyear' ORDER BY deployDate";
        $result=mysqli_query($con,$bftquery);
        $forexport= '<table id="results" class="tablesorter">
				<thead>
				<tr id="results">
					<th>ID</th>
					<th>FL</th>
					<th>GG</th>
					<th>DW</th>
					<th>RW</th>
					<th>SEX</th>
					<th>PFL</th>
					<th>MATURE STAGE</th>
					<th>GON WEIGHT</th>
					<th>LIFE STATUS</th>
					<th>BAIT TYPE</th>
					<th>COMMERCIAL</th>
					<th>DEPLOY DATE</th>
				</tr>
				</thead><tbody>';
        while($row = mysqli_fetch_array($result))
        {
            $forexport .= '<tr>
			<td>' . $row['BFT_measure_ID'] . '</td>
			<td>' . $row['fl'] . '</td>
			<td>' . $row['gg'] . '</td>
			<td>' . $row['dw'] . '</td>
			<td>' . $row['rw'] . '</td>
			<td>' . $row['sex'] . '</td>
			<td>' . $row['pfl'] . '</td>
			<td>' . $row['matur_stage'] . '</td>
			<td>' . $row['gon_wei'] . '</td>
			<td>' . $row['life_status'] . '</td>
			<td>' . $row['bait_type'] . '</td>
			<td>' . $row['commercial'] . '</td>
			<td>' . $row['deployDate'] . '</td>
			</tr>';
        }
        $forexport .='</tbody></table>';
        echo $forexport;
        echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		<input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		<label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="csv" id="selectcsv" required />
		<label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="xls" id="selectxls" />
		<input type="submit" value="Download" />';
    }
    /* SHOWS RVT MEASUREMENTS
//
//
*/
    else if($_POST['measurements_species_search'] === "RVT")
    {
        $searchyear=$_POST['measurements_year'];
        $rvtquery="SELECT * FROM
		RVTmeasure
		INNER JOIN species_measurements
		ON RVTmeasure.RVT_measure_ID = species_measurements.measure_ID
		INNER JOIN expedition
		ON species_measurements.measure_expedition_ID = expedition.expedition_ID
		WHERE YEAR(STR_TO_DATE(deployDate, '%Y-%m-%d'))='$searchyear' ORDER BY deployDate";
        $result=mysqli_query($con,$rvtquery);
        $forexport= '<table id="results" class="tablesorter">
				<thead>
				<tr id="results">
					<th>ID</th>
					<th>FL</th>
					<th>TL</th>
					<th>PFFL</th>
					<th>GG</th>
					<th>DW</th>
					<th>SEX</th>
					<th>LIFE STATUS</th>
					<th>BAIT TYPE</th>
					<th>COMMERCIAL</th>
					<th>DEPLOY DATE</th>
				</tr>
				</thead><tbody>';
        while($row = mysqli_fetch_array($result))
        {
            $forexport .= '<tr>
			<td>' . $row['RVT_measure_ID'] . '</td>
			<td>' . $row['fl'] . '</td>
			<td>' . $row['tl'] . '</td>
			<td>' . $row['pffl'] . '</td>
			<td>' . $row['gg'] . '</td>
			<td>' . $row['dw'] . '</td>
			<td>' . $row['rw'] . '</td>
			<td>' . $row['sex'] . '</td>
			<td>' . $row['life_status'] . '</td>
			<td>' . $row['bait_type'] . '</td>
			<td>' . $row['commercial'] . '</td>
			<td>' . $row['deployDate'] . '</td>
			</tr>';
        }
        $forexport .='</tbody></table>';
        echo $forexport;
        echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		<input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		<label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="csv" id="selectcsv" required />
		<label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="xls" id="selectxls" />
		<input type="submit" value="Download" />';
    }
    /* SHOWS SWO MEASUREMENTS
//
//
*/
    else if($_POST['measurements_species_search'] === "SWO")
    {
        $searchyear=$_POST['measurements_year'];
        $swoquery="SELECT * FROM
		SWOmeasure
		INNER JOIN species_measurements
		ON SWOmeasure.SWO_measure_ID = species_measurements.measure_ID
		INNER JOIN expedition
		ON species_measurements.measure_expedition_ID = expedition.expedition_ID
		WHERE YEAR(STR_TO_DATE(deployDate, '%Y-%m-%d'))='$searchyear' ORDER BY deployDate";
        $result=mysqli_query($con,$swoquery);
        $forexport= '<table id="results" class="tablesorter">
				<thead>
				<tr id="results">
					<th>ID</th>
					<th>LJFL</th>
					<th>GG</th>
					<th>SEX</th>
					<th>RW</th>
					<th>DW</th>
					<th>PFL</th>
					<th>HEAD LENGTH</th>
					<th>MATURE STAGE</th>
					<th>GON WEIGHT</th>
					<th>PARASITES</th>
					<th>LIFE STATUS</th>
					<th>BAIT TYPE</th>
					<th>COMMERCIAL</th>
					<th>DEPLOY DATE</th>
				</tr>
				</thead><tbody>';
        while($row = mysqli_fetch_array($result))
        {
            $forexport .= '<tr>
			<td>' . $row['SWO_measure_ID'] . '</td>
			<td>' . $row['ljfl'] . '</td>
			<td>' . $row['gg'] . '</td>
			<td>' . $row['sex'] . '</td>
			<td>' . $row['rw'] . '</td>
			<td>' . $row['dw'] . '</td>
			<td>' . $row['pfl'] . '</td>
			<td>' . $row['head_length'] . '</td>
			<td>' . $row['matur_stage'] . '</td>
			<td>' . $row['gon_wei'] . '</td>
			<td>' . $row['parasites'] . '</td>
			<td>' . $row['life_status'] . '</td>
			<td>' . $row['bait_type'] . '</td>
			<td>' . $row['commercial'] . '</td>
			<td>' . $row['deployDate'] . '</td>
			</tr>';
        }
        $forexport .='</tbody></table>';
        echo $forexport;
        echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		<input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		<label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="csv" id="selectcsv" required />
		<label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		<input type="radio" name="filexport" value="xls" id="selectxls" />
		<input type="submit" value="Download" />';
    }
}
else if($_POST['selectquery'] === "expedition")
{
    //Vessel Columns and Expedition Columns check
    if(!empty($_POST['vesselcolumns']) && !empty($_POST['expeditioncolumns'])){
        $columns= implode(',', $_POST['vesselcolumns']) . ',' . implode(',', $_POST['expeditioncolumns']);
    }
    else if(!empty($_POST['vesselcolumns'])) {
        $columns= implode(',', $_POST['vesselcolumns']);
    }
    else if(!empty($_POST['expeditioncolumns'])) {
        $columns= implode(',', $_POST['expeditioncolumns']);
    }
    else {
        $columns='*';
    }
    //AMAS check
    if($_POST['searchv']==='0'){
        $amas='0';
    } elseif($_POST['searchv']!=""){
        $amas=$_POST['searchv'];
    } else {
        $amas=NULL;
    }
    //Deploy Date FROM and TO check
    if(empty($_POST['deploydatefrom']))
    {
        $datefrom = '0000-00-00';
    }
    else
    {
        $datefrom = $_POST['deploydatefrom'];
    }
    if(empty($_POST['deploydateto']))
    {
        $dateto = '9999-12-31';
    }
    else
    {
        $dateto = $_POST['deploydateto'];
    }
    if(!is_null($amas))
    {
        if($columns=="*"){
            $expeditionq="CREATE TEMPORARY TABLE IF NOT EXISTS tmptable AS
            (SELECT * FROM vessel
            INNER JOIN vessel_expeditions
            ON vessel.AMAS=vessel_expeditions.vexpedition_AMAS AND vessel.AMAS= '$amas'
            INNER JOIN expedition
            ON vessel_expeditions.veexpedition_ID=expedition.expedition_ID
            WHERE expedition.deployDate >= '$datefrom' AND expedition.deployDate <= '$dateto')";
            $resulteq=mysqli_query($con, $expeditionq);
            if($resulteq){
                $dpcolumn="ALTER TABLE tmptable DROP COLUMN vexpedition_AMAS, DROP COLUMN veexpedition_ID";
                $resultdpc=mysqli_query($con, $dpcolumn);
                if($resultdpc){
                    $expeditionq="SELECT * FROM tmptable";
                    $result=mysqli_query($con, $expeditionq);
                    $resultfields=mysqli_query($con, "SHOW COLUMNS FROM tmptable");
                    $colcounter=0;
                    while ($rcol = mysqli_fetch_array($resultfields)){
                        $rcolu[$colcounter] = $rcol['Field'];
                        $colcounter++;
                    }
                    $forexport = '<table id="results" class="tablesorter"><thead><tr>';
                    for($i=0; $i<$colcounter; $i++){
                        $forexport .= '<th>' . $rcolu[$i] . '</th>';
                    }
                    $forexport .= '</tr></thead><tbody>';
                    while($row=mysqli_fetch_array($result)){
                        $forexport .= '<tr>';
                        for($i=0; $i<$colcounter; $i++){
                            $forexport .= '<td>' . $row[$rcolu[$i]] . '</td>';
                        }
                        $forexport .= '</tr>';
                    }
                    $forexport .= '</tbody></table>';
                    echo $forexport;
                    echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		            <input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		            <label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="csv" id="selectcsv" required />
		            <label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="xls" id="selectxls" />
		            <input type="submit" value="Download" />';
                    $droptable = "DROP TEMPORARY TABLE IF EXISTS tmptable";
                    $resultdroptable = mysqli_query($con, $droptable);
                    if(!$resultdroptable){
                        die ('Error: ' . mysqli_error($con));
                    }
                }
            }
        }
        else{
            $expeditionq="SELECT $columns  FROM vessel
            INNER JOIN vessel_expeditions
            ON vessel.AMAS=vessel_expeditions.vexpedition_AMAS AND vessel.AMAS= '$amas'
            INNER JOIN expedition
            ON vessel_expeditions.veexpedition_ID=expedition.expedition_ID
            WHERE expedition.deployDate >= '$datefrom' AND expedition.deployDate <= '$dateto'";
            $resulteq=mysqli_query($con, $expeditionq);
            if($resulteq){
                $columnsarr = explode(',', $columns);
                $nocolumns = count($columnsarr);
                $forexport = '<table id="results" class="tablesorter"><thead><tr>';
                for($i=0; $i<$nocolumns; $i++){
                    $forexport .= '<th>' . $columnsarr[$i] . '</th>';
                }
                $forexport .= '</tr></thead><tbody>';
                while($row=mysqli_fetch_array($resulteq)){
                    $forexport .= '<tr>';
                    for($i=0; $i<$nocolumns; $i++){
                        $forexport .= '<td>' . $row[$columnsarr[$i]] . '</td>';
                    }
                    $forexport .= '</tr>';
                }
                $forexport .= '</tbody></table>';
                echo $forexport;
                echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		            <input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		            <label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="csv" id="selectcsv" required />
		            <label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="xls" id="selectxls" />
		            <input type="submit" value="Download" />';
            }
        }
    }
    else
    {
        if($columns=="*"){
            $expeditionq="CREATE TEMPORARY TABLE IF NOT EXISTS tmptable AS
            (SELECT * FROM vessel
            INNER JOIN vessel_expeditions
            ON vessel.AMAS=vessel_expeditions.vexpedition_AMAS
            INNER JOIN expedition
            ON vessel_expeditions.veexpedition_ID=expedition.expedition_ID
            WHERE expedition.deployDate >= '$datefrom' AND expedition.deployDate <= '$dateto')";
            $resulteq=mysqli_query($con, $expeditionq);
            if($resulteq){
                $dpcolumn="ALTER TABLE tmptable DROP COLUMN vexpedition_AMAS, DROP COLUMN veexpedition_ID";
                $resultdpc=mysqli_query($con, $dpcolumn);
                if($resultdpc){
                    $expeditionq="SELECT * FROM tmptable";
                    $result=mysqli_query($con, $expeditionq);
                    $resultfields=mysqli_query($con, "SHOW COLUMNS FROM tmptable");
                    $colcounter=0;
                    while ($rcol = mysqli_fetch_array($resultfields)){
                        $rcolu[$colcounter] = $rcol['Field'];
                        $colcounter++;
                    }
                    $forexport = '<table id="results" class="tablesorter"><thead><tr>';
                    for($i=0; $i<$colcounter; $i++){
                        $forexport .= '<th>' . $rcolu[$i] . '</th>';
                    }
                    $forexport .= '</tr></thead><tbody>';
                    while($row=mysqli_fetch_array($result)){
                        $forexport .= '<tr>';
                        for($i=0; $i<$colcounter; $i++){
                            $forexport .= '<td>' . $row[$rcolu[$i]] . '</td>';
                        }
                        $forexport .= '</tr>';
                    }
                    $forexport .= '</tbody></table>';
                    echo $forexport;
                    echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		            <input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		            <label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="csv" id="selectcsv" required />
		            <label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="xls" id="selectxls" />
		            <input type="submit" value="Download" />';
                    $droptable = "DROP TEMPORARY TABLE IF EXISTS tmptable";
                    $resultdroptable = mysqli_query($con, $droptable);
                    if(!$resultdroptable){
                        die ('Error: ' . mysqli_error($con));
                    }
                }
            }
        }
        else{
            $expeditionq="SELECT $columns  FROM vessel
            INNER JOIN vessel_expeditions
            ON vessel.AMAS=vessel_expeditions.vexpedition_AMAS
            INNER JOIN expedition
            ON vessel_expeditions.veexpedition_ID=expedition.expedition_ID
            WHERE expedition.deployDate >= '$datefrom' AND expedition.deployDate <= '$dateto'";
            $resulteq=mysqli_query($con, $expeditionq);
            if($resulteq){
                $columnsarr = explode(',', $columns);
                $nocolumns = count($columnsarr);
                $forexport = '<table id="results" class="tablesorter"><thead><tr>';
                for($i=0; $i<$nocolumns; $i++){
                    $forexport .= '<th>' . $columnsarr[$i] . '</th>';
                }
                $forexport .= '</tr></thead><tbody>';
                while($row=mysqli_fetch_array($resulteq)){
                    $forexport .= '<tr>';
                    for($i=0; $i<$nocolumns; $i++){
                        $forexport .= '<td>' . $row[$columnsarr[$i]] . '</td>';
                    }
                    $forexport .= '</tr>';
                }
                $forexport .= '</tbody></table>';
                echo $forexport;
                echo '<form name="exportanalysis" method="post" action="exportanalysis.php">
		            <input type="hidden" name="export" value="' . htmlspecialchars($forexport, ENT_QUOTES) . '" />
		            <label for="selectcsv"><img src="img/csv-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="csv" id="selectcsv" required />
		            <label for="selectxls"><img src="img/xls-icon.png" width="50" height="50" /> </label>
		            <input type="radio" name="filexport" value="xls" id="selectxls" />
		            <input type="submit" value="Download" />';
            }
        }
    }
}
mysqli_close($con);
?>