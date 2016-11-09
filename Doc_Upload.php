<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$Function_lib = new function_lib();
$UserCheck->userchecks(3);
$FileFail = "";
$File_Input_Alert = "";

$WHS_Dropdown = $Function_lib->getDropdown("select fldID, fldTitle from tbl_whs", "fldID", "fldTitle");
$Sus_Dropdown = $Function_lib->getDropdown("select fldID, fldProjectName from tbl_sus", "fldID", "fldProjectName");
$Doctype_Dropdown = $Function_lib->getDropdown("select fldID, fldType from tbl_doc_type", "fldID", "fldType");


if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $i_File = $Function_lib->Document_Handler($_FILES['file_upload']);
    $i_Project = $Function_lib->checkValue("ProjectID", "");
    $i_Doctype = $Function_lib->checkValue("DocType", "");
    $i_DocCategory = $Function_lib->checkValue("Sus_Whs_Check", "");
    
    if (!$i_DocCategory)
    {
        $i_DocCategory = "1";
    }else
    {
        $i_DocCategory = "2";
    }
    
    if (!isset($i_File)) 
    {
        $FileFail = "Unsuccessful File Upload";
        $File_Input_Alert = "input-alert";
    } 
    else 
    {
        $string = str_replace(' ', '', $i_File["name"]);
        $target_dir = "RESOURCES/StakeholderImages/";
        $target_file = $target_dir . basename($string);
        if (!file_exists($target_file)) 
        {
            move_uploaded_file($i_File["tmp_name"], $target_file);
        }
        
        $sSQL = <<<SQL
            Insert into tbl_doc
SQL;
    }    
}

$outgoing_HTML = <<<HTML
<div class="col-sm-10 col-sm-offset-1">
  <h3>Upload A Document</h3>
</div>
<form action="Stakeholder_Details.php" method="post" enctype="multipart/form-data" class="margin-top" role="form">
  <div class="form-group">
    <div class="col-sm-10 col-sm-offset-1 margin-bottom">
      <label class="margin-top" for="file_upload">File to Upload : </label>
      <input required class="form-control btn btn-default $File_Input_Alert" type="file" name="file_upload" id="file_upload">
        $FileFail
    </div>
  </div>
  <div class="form-group">
           <div class="col-sm-5 col-sm-offset-1 margin-top" id="WHS" style="display: block;">
            <p>Work health and safety</p>
            <select name="WHS_Dropdown" class="form-control">
                $WHS_Dropdown
                <option id="x">Cancertroy</option>
                <option id="x">Succ</option>
                <option id="x">Ghey</option>
                <option id="x">Homophobia</option>
                <option id="x">IntGain</option>
                <option id="x">RIkiIsalive</option>
            </select>  
        </div>
        <div class="col-sm-5 col-sm-offset-1 margin-top" style="display: none;" id="SUS">
            <p>Sustainability</p>
            <select name="SUS_Dropdown" class="form-control">
                $Sus_Dropdown
                <option id="x">Aids</option>
                <option id="x">Succ</option>
                <option id="x">Ghey</option>
                <option id="x">Homophobia</option>
                <option id="x">IntGain</option>
                <option id="x">RIkiIsalive</option>
            </select>  
        </div>
        <div class="col-sm-2 margin-top">                            
            <div style="float: right;">
                <p>Toggle WHS/SUS</p>
                <input id="Sus_Whs_Check" class="margin-bottom" type="checkbox" onClick="WHS_SUS_Check()">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-5 col-sm-offset-1 margin-top">
            <p>Doctype</p>
            <select name="DocType" class="form-control">
                $Doctype_Dropdown
            </select>  
        </div>
    </div>

</form>
<script>
  function WHS_SUS_Check()
  {
    if (document.getElementById("SUS").style.display == 'none')
    {
      document.getElementById("SUS").style.display = 'block';
      document.getElementById("SUS").input.name = "ProjectID"
      document.getElementById("WHS").style.display = 'none';
      document.getElementById("WHS").input.name = "NotProject"
    } else 
    {
      document.getElementById("SUS").style.display = 'none';
      document.getElementById("SUS").input.name = "NotProject"
      document.getElementById("WHS").style.display = 'block';
      document.getElementById("WHS").input.name = "ProjectID"

    }
  }
</script>
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();
?>