<?php
require_once "CLASS_FILES/cClass_Connector.php";
$DBFunctions = new DB_Functions();
$FunctionLibary = new function_lib();
$UserCheck = new User_Account_Functions();
$UserCheck->userChecks(2);

$Block_ID_Dropdown = $FunctionLibary->getDropdown("select fldID, fldLocation from tbl_block", "fldID", "fldLocation");


if($_SERVER['REQUEST_METHOD'] == "POST")
{
  $Project_Name = $FunctionLibary->checkValue("Project_Name","");
  $Block_ID = $FunctionLibary->checkValue("Block_ID","");
  $sSQL =<<<SQL
    insert into tbl_sus
    (fldProjectName)
    values
    (:ProjectName)
SQL;
  $Array = array(
    ":ProjectName" => $Project_Name
  );
  $ProjectID = $DBFunctions->commitSQL($sSQL, $Array);
  $sSQL =<<<SQL
        insert into tbl_sus_block_bridge
        (fldFKSusID, fldFkBlockID)
        values
        (:ProjectID, :BlockID)
SQL;
  $Array = array(
    ":ProjectID" => $ProjectID,
    ":BlockID" => $Block_ID
  );
  $DBFunctions->commitSQL($sSQL, $Array);
  header("location:Doc_Upload.php?Repository=2&ID=$ProjectID");
}



$outgoing_HTML =<<<HTML
<div class="col-sm-10 col-sm-offset-1">
 <h3>Create a Project</h3>
 <form action="Project_Create.php" method="post">
   <div class="form-group">
      <label for="Project_Name">Enter a Project name</label>
      <input class="form-control" type="text" required maxlength="45" name="Project_Name" id="Project_Name" Placeholder="Enter Project Name...">
   </div>
   <div class="form-group">
      <label for="Block_ID">Enter project location</label>
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
