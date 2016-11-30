<?php
require_once "CLASS_FILES/cClass_Connector.php";
$DBFunctions = new DB_Functions();
$FunctionLibary = new function_lib();
$UserCheck = new User_Account_Functions();
$UserCheck->userChecks(2);

$CurrDate = date('Y-m-d');
$Incident_Type_Dropdown = $FunctionLibary->getDropdown("select fldID, fldType from tbl_whs_type", "fldID", "fldType");
$Block_ID_Dropdown = $FunctionLibary->getDropdown("select fldID, fldLocation from tbl_block", "fldID", "fldLocation");


if($_SERVER['REQUEST_METHOD'] == "POST")
{
  $Incident_Title = $FunctionLibary->checkValue("Incident_Title","");
  $Incident_Type = $FunctionLibary->checkValue("Incident_Type","");
  $Incident_Date = $FunctionLibary->checkValue("date","");
  
  $date = strtotime($Incident_Date);
	$date = date('Y-m-d H:i:s', $date);	
  
  
  $Block_ID = $FunctionLibary->checkValue("Block_ID","");
  $sSQL =<<<SQL
    insert into tbl_whs
    (fldTitle, fldDate, fldFkWhsTypeId, fldFkBlockId)
    values
    (:IncidentTitle, :IncidentDate, :IncidentType, :IncidentBlock)
SQL;
  $Array = array(
    ":IncidentTitle" => $Incident_Title,
    ":IncidentDate" => $Incident_Date,
    ":IncidentType" => $Incident_Type,
    ":IncidentBlock" => $Block_ID
  );
  $IncidentID = $DBFunctions->commitSQL($sSQL, $Array); 
  header("location:Doc_Upload.php?Repository=1&ID=$IncidentID");
}

$outgoing_HTML =<<<HTML
<div class="col-sm-10 col-sm-offset-1">
  <h3>Create an Incident</h3>
  <form action="Create_Incident.php" method="post">
    <div class="form-group">
      <label for="Incident_Title">Enter the Incident location</label>
      <input class="form-control" type="text" required maxlength="45" name="Incident_Title" id="Incident_Title" Placeholder="Enter Incident Name...">
    </div>
    <div class="form-group">
      <div class='' id='datetimepicker1'>
        <label for="date">Enter the Incident Date</label>
        <input type='date' name="date" max="$CurrDate" class="form-control" value="$CurrDate">
      </div>
    </div>
    <div class="form-group">
      <label for="Incident_Type">Enter the Incident type</label>
      <select name="Incident_Type" id="Incident_Type" class="form-control">
        $Incident_Type_Dropdown              
      </select>
    </div>
    <div class="form-group">
      <label for="Block_ID">Enter the Incident type</label>
      <select name="Block_ID" id="Block_ID" class="form-control">
        $Block_ID_Dropdown              
      </select>
    </div>
    <div class="form-group">
      <input class="form-group btn btn-default col-sm-4 col-sm-offset-8" type="submit" name="Submit" value="Submit">
    </div>
  </form>    
</div>
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();