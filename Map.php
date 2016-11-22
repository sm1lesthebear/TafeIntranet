<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$UserCheck->userChecks(3);
$Function_lib = new function_lib();
$DBFunctions = new DB_Functions();

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
          <td>$Doc_Name</td>
          <td><a href="Doc_Upload.php?Repository=$Repository&ID=$ID">View</a></td>
        </tr>
HTML;
    }
  }
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
  </div>
</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="JS/imageMapResizer.min.js"></script>
	<script type="text/javascript">

		$('map').imageMapResize();

	</script>
<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Task', 'Hours per Day'],
    ['Work',     11],
    ['Eat',      2],
    ['Commute',  2],
    ['Watch TV', 2],
    ['Sleep',    7]
  ]);

  var options = {
    title: 'My Daily Activities'
  };
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
  -->
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();