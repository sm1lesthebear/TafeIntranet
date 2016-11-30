<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$UserCheck->userChecks(3);
$Function_lib = new function_lib();
$DBFunctions = new DB_Functions();

$PieChartHTMl = "";
$PieChart="";

$MapAreaTagHTML = "";
$TableRow = "";
$BlockName = "Please select a block";
$BlockID = $Function_lib->checkValue("BlockID", Null);
$Repository = $Function_lib->checkValue("Repository", "");

if($Repository == 1)
{
  $RelatedTag = "Related Incidents";
  if(isset($BlockID))
  {
    $sSQL =<<<SQL
          select fldID, fldTitle from tbl_whs where fldFkBlockId = $BlockID
SQL;
    foreach($DBFunctions->getfromDB($sSQL) as $row)
    {
      $ID = $row['fldID'];
      $Title = $row['fldTitle'];
      
      $TableRow .=<<<HTML
        <tr data-href="Doc_Upload.php?Repository=$Repository&ID=$ID">
          <td>$Title</td>
          <td><a href="Doc_Upload.php?Repository=$Repository&ID=$ID" class="btn btn-default">View</a></td>
        </tr>
HTML;
    }
  }
			$sSQL =<<<SQL
				select count(W.fldFkWhsTypeId) as typecount, WT.fldType from tbl_whs W, tbl_whs_type WT where W.fldFkWhsTypeId = WT.fldID group by fldFkWhsTypeId
SQL;
		foreach($DBFunctions->getfromDB($sSQL) as $row)
		{
			
			$FieldName = $row['fldType'];
			$Count = $row['typecount'];
			
			$PieChartHTMl =<<<HTML
			<div class="margin-top col-sm-12">
				<div id="piechart" style="width: 300px; height: 225px;"></div>
			</div>		
HTML;
			
			$PieChart .=<<<HTML
				["$FieldName", $Count],
HTML;
		}
		$PieChart = rtrim($PieChart, ',');
}
elseif($Repository == 2)
{
  $RelatedTag = "Related Projects";
  if(isset($BlockID))
  {
    $sSQL =<<<SQL
          select S.fldID, S.fldProjectName from tbl_sus S, tbl_sus_block_bridge SB where SB.fldFKSusID = S.fldID and SB.fldFkBlockID = $BlockID
SQL;
    foreach($DBFunctions->getfromDB($sSQL) as $row)
    {
      $ID = $row['fldID'];
      $Title = $row['fldProjectName'];
      
      $TableRow .=<<<HTML
        <tr>
          <td>$Title</td>
          <td><a href="Doc_Upload.php?Repository=$Repository&ID=$ID" class="btn btn-default">View</a></td>
        </tr>
HTML;
    }
  }
}
else
{
  header("location:index.php");
}

$sSQL =<<<SQL
      select fldID, fldLocation, fldPosiX1, fldPosiY1, fldPosiX2, fldPosiY2 from tbl_block
SQL;
foreach($DBFunctions->getfromDB($sSQL) as $row)
{
  $BlockID = $row['fldID'];
  
  $Posx1 = $row['fldPosiX1'];
  $Posx2 = $row['fldPosiX2'];
  $Posy1 = $row['fldPosiY1'];
  $Posy2 = $row['fldPosiY2'];
  
  $Alt = $row['fldLocation'];
  
  $MapAreaTagHTML .=<<<HTML
      <area shape="rect" coords="$Posx1,$Posy1,$Posx2,$Posy2" href="Map.php?Repository=$Repository&BlockID=$BlockID" alt="$Alt">
HTML;
}

$outgoing_HTML =<<<HTML
<div class="row">
  <div class="col-sm-8">
    <h1>Campus Map</h1>
    <img src="RESOURCES/locations_map.png" usemap="#Campus_Map" id="Campus_Map">
    <map name="Campus_Map">
      $MapAreaTagHTML
    </map>
  </div>
  <div class="col-sm-4">
    <h3>$RelatedTag</h3>
    <table class="table">
        <!--generated table info-->
        <thead>
          <tr>
            <th>Title</th>
            <th>View</th>
          </tr>
        </thead>
        <tbody>
          $TableRow
        </tbody>
      </table>
			$PieChartHTMl
  </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="JS/imageMapResizer.min.js"></script>
<script type="text/javascript">

		$('map').imageMapResize();

	</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Type', 'Total'],
		$PieChart
  ]);

  var options = {
		backgroundColor: 'transparent',
    title: 'Incident type Ratio Report'
  };
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();