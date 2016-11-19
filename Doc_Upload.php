<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$Function_lib = new function_lib();
$DB_Function = new DB_Functions();
$UserCheck->userchecks(2);

$FileFail = "";
$File_Input_Alert = "";
$RepositoryName = "";
$Repository = "";
$RepositoryID = "";
$TableRow = "";

if($_SERVER['REQUEST_METHOD'] == "POST") 
{
  $i_UploadedFile = $_FILES['file_upload'];
  $i_File = $Function_lib->Document_Handler($i_UploadedFile);
  $i_Docname = $Function_lib->checkValue("Doc_Name", "");
  $i_Doctype = $Function_lib->checkValue("DocType", "");
  $Repository = $Function_lib->checkValue("Repository", "");
  $RepositoryID = $Function_lib->checkValue("ID", "");
  if (!isset($i_File)) 
  {
    $FileFail = "Unsuccessful File Upload";
    $File_Input_Alert = "input-alert";
  } 
  else 
  {
    $string = str_replace(' ', '', $i_File["name"]);
    $target_dir = "RESOURCES/Uploaded_Documents/";
    $target_file = $target_dir . basename($string);
    if (!file_exists($target_file)) 
    {
        move_uploaded_file($i_File["tmp_name"], $target_file);
    }
    $sSQL =<<<SQL
        Insert into tbl_doc 
        (fldName, fldLocation, fldFkDocTypeId, fldFkDocCategoryId)
        values
        (:Name, :Location, :DocType, :DocCategory)
SQL;
    $array = array(
      ":Name" => $i_Docname,
      ":Location" => $target_file,
      ":DocType" => $i_Doctype,
      ":DocCategory" => $Repository
    );
    $Uploaded_DocID = $DB_Function->commitSQL($sSQL, $array);

    $sSQL =<<<SQL
          Insert into tbl_whs_doc_bridge
          (fldFkDocId, fldFkWhsId)
          values
          (:DocID, :RepositoryID)
SQL;
    $array = array(
      ":DocID" => $Uploaded_DocID,
      ":RepositoryID" => $RepositoryID
    );
    $DB_Function->commitSQL($sSQL, $array);
  }   
}

if(($Repository = $Function_lib->checkValue("Repository", "")) == 1)
{
  $RepositoryID = $Function_lib->checkValue("ID", "");
  $sSQL =<<<SQL
          select 
            D.fldID, 
            D.fldName, 
            D.fldLocation, 
            (select fldType from tbl_doc_type where fldID = fldFkDocTypeId) as fldType 
          from 
            tbl_doc D, 
            tbl_whs_doc_bridge DB 
          where  
            D.fldID = DB.fldFkDocId 
          AND 
            DB.fldFkWhsId = $RepositoryID
SQL;
  $Doctype_Dropdown = $Function_lib->getDropdown("select fldID, fldType from tbl_doc_type", "fldID", "fldType");
  foreach($DB_Function->getfromDB($sSQL) as $row)
  {
    $Doc_ID = $row['fldID'];
    $Doc_Name = $row['fldName'];
    $Doc_File_Name = $row['fldLocation'];
    $Doc_Type = $row['fldType'];

    $TableRow .=<<<HTML
                  <tr style="cursor:pointer" data-href="$Doc_File_Name">
                      <td class="col-sm-4">$Doc_Name</td>
                      <td class="col-sm-4">$Doc_File_Name</td>
                      <td class="col-sm-2">$Doc_Type</td>
                      <td class="Document_Download_Table"><a href="$Doc_File_Name" download></a></td>
                  </tr>
HTML;
  }
  $sSQL =<<<SQL
      select W.fldTitle from tbl_whs W where W.fldID = $RepositoryID
SQL;
  foreach($DB_Function->getfromDB($sSQL) as $row)
  {
    $RepositoryName = $row['fldTitle'];
  }
}
elseif (($Repository =  $Function_lib->checkValue("Repository", "")) == 2)
{
  $RepositoryID = $Function_lib->checkValue("ID", "");
  $sSQL =<<<SQL
          select 
            D.fldID, 
            D.fldName, 
            D.fldLocation, 
            (select fldType from tbl_doc_type where fldID = fldFkDocTypeId) as fldType 
            from 
            tbl_doc D, 
            tbl_sus_doc_bridge DB 
          where 
            D.fldID = DB.fldFkDocId 
          AND 
            DB.fldFkSusId = $RepositoryID
SQL;
  $Doctype_Dropdown = $Function_lib->getDropdown("select fldID, fldType from tbl_doc_type", "fldID", "fldType");
  foreach($DB_Function->getfromDB($sSQL) as $row)
  {
    $Doc_ID = $row['fldID'];
    $Doc_Name = $row['fldName'];
    $Doc_File_Name = $row['fldLocation'];
    $Doc_Type = $row['fldType'];
    $TableRow .=<<<HTML
                  <tr style="cursor:pointer" data-href="$Doc_File_Name">
                      <td class="col-sm-4">$Doc_Name</td>
                      <td class="col-sm-4">$Doc_File_Name</td>
                      <td class="col-sm-2">$Doc_Type</td>
                      <td class="Document_Download_Table"><a href="$Doc_File_Name" download></a></td>
                  </tr>
HTML;
  }
  $sSQL =<<<SQL
      select S.fldProjectName from tbl_sus S where S.fldID = $RepositoryID
SQL;
  foreach($DB_Function->getfromDB($sSQL) as $row)
  {
    $RepositoryName = $row['fldProjectName'];
  }
}

$outgoing_HTML =<<<HTML
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
        <label class="margin-top" for="Doc_Name">Document Name : </label>
        <input class="form-control" type="text" required maxlength="45" name="Doc_Name" id="Doc_Name" Placeholder="Enter document name...">      
      </div>
      <div class="col-sm-12 margin-top">
        <label class="margin-top" for="Doc_type">Doc Type : </label>
        <select name="DocType" id="Doc_type" class="form-control">
            $Doctype_Dropdown
        </select>  
      </div>
          <input type="hidden" value="$Repository" name="Repository">
          <input type="hidden" value="$RepositoryID" name="ID">
      <div class="col-sm-12 margin-top margin-bottom">
          <input type="submit" name="Upload" value="Upload" class="form-control btn btn-default">
      </div>
  </form>
</div>
<div class="col-sm-8">
    <div class="col-sm-12">
      <h3 class="h1-margin-bottom">Documents for: $RepositoryName</h3> 
      <p>select a user to edit them</p>
      <table class="table">
        <!--generated table info-->
        <thead>
          <tr>
            <th>Document Title</th>
            <th>File Name</th>
            <th>DocType</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          $TableRow
        </tbody>
    </table>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('table tr').click(function(){
        window.location = $(this).data('href');
        return false;
    });
});
</script>
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();
?>