<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$Function_lib = new function_lib();
$UserCheck->userchecks(3);

$FileFail = "";
$File_Input_Alert = "";
$UnknownTitleField = "REPLACE THIS";

$WHS_Dropdown = $Function_lib->getDropdown("select fldID, fldTitle from tbl_whs", "fldID", "fldTitle");
$Sus_Dropdown = $Function_lib->getDropdown("select fldID, fldProjectName from tbl_sus", "fldID", "fldProjectName");
$Doctype_Dropdown = $Function_lib->getDropdown("select fldID, fldType from tbl_doc_type", "fldID", "fldType");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $i_UploadedFile = $_FILES['file_upload'];
    $i_File = $Function_lib->Document_Handler($i_UploadedFile);
    $i_Doctype = $Function_lib->checkValue("DocType", "");
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
<div class="col-sm-4">
  <div class="col-sm-12">
    <h3>Upload A Document</h3>
  </div>
  <form action="Doc_Upload.php" method="post" enctype="multipart/form-data" class="margin-top" role="form">
      <div class="col-sm-12 margin-bottom">
        <label class="margin-top" for="file_upload">File to Upload : </label>
        <input required class="form-control btn btn-default $File_Input_Alert" type="file" name="file_upload" id="file_upload">
          $FileFail
      </div>
      <div class="col-sm-12">
        <label class="margin-top" for="Doc_type">Document Name : </label>
        <input class="form-control" type="text" required maxlength="45" name="Doc_Name" id="Doc_Name" Placeholder="Enter document name...">      </div
      </div>
      <div class="col-sm-12 margin-top">
        <label class="margin-top" for="Doc_type">Doc Type : </label>
        <select name="DocType" id="Doc_type" class="form-control">
            $Doctype_Dropdown
        </select>  
      </div>
      <div class="col-sm-12 margin-top margin-bottom">
          <input type="submit" name="Upload" value="Upload" class="form-control btn btn-default">
      </div>
  </form>
</div>
<div class="col-sm-8">
    <div class="col-sm-12">
      <h3 class="h1-margin-bottom">Documents for: "$UnknownTitleField"</h3> 
      <p>select a user to edit them</p>
      <table class="table">
        <!--generated table info-->
        <thead>
            <tr>
                <th>Document Title</th>
                <th>File Name</th>
                <th>DocType</th>
            </tr>
        </thead>
        <tbody>
            $TableRow
        </tbody>
    </table>
  </div>
</div>
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();
?>