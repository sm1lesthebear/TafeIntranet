<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$Function_lib = new function_lib();
$DB_Function = new DB_Functions();
$TableRow = "No results found";
$UserCheck->userChecks(3);
$SearchText = "";
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
  $Dropdown = $Function_lib->checkValue("Dropdown", ""); 
  $SearchText = $Function_lib->checkValue("Search_Text", "");
    
  $sSQL =<<<SQL
        select 
          D.fldID, 
          D.fldName, 
          D.fldLocation, 
          (select fldType from tbl_doc_type where fldID = D.fldFkDocTypeId) as fldType 
        from 
          tbl_doc D
        where 
            fldFkDocTypeId = $Dropdown
         and
            fldName like "%$SearchText%"
SQL;
  if (($Function_lib->checkValue("search_all_check", "") == "Checked"))
  {
    $sSQL =<<<SQL
          select 
            D.fldID, 
            D.fldName, 
            D.fldLocation, 
            (select fldType from tbl_doc_type where fldID = D.fldFkDocTypeId) as fldType 
          from 
            tbl_doc D
          where
             fldName like "%$SearchText%"
SQL;
  }
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
}
$Dropdown = $Function_lib->getDropdown("select * from tbl_doc_type", "fldID", "fldType");
$outgoing_HTML =<<<HTML
                    <div class="col-sm-10 col-sm-offset-1">
                      <h3>Document Search Page</h3>
                    </div>
                    <form action="Doc_Search.php" method="POST">
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <p>Enter Search term(s)...</p>
                                <input required maxlength="45" type="text"  class="form-control" name="Search_Text" id="Search_Text" Placeholder="Enter Search term(s)..." value="$SearchText">
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-5 col-sm-offset-1 margin-top" id="Dropdown">
                            <p>Select Document Type</p>
                            <select name="Dropdown" class="form-control">
                                $Dropdown
                            </select>  
                          </div>
                          <div class="col-sm-5 margin-top">
                              <div style="float: right;">
                                  <p>Search all Documents</p>
                                  <input name="search_all_check" type="checkbox" value="Checked">
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-3 col-sm-offset-1">
                              <input class="btn btn-default margin-top" type="Submit" name="Submit" value="Submit">
                          </div>
                        </div>
                    </form>
                    <div class="col-sm-10 col-sm-offset-1">
                      <h3 class="h1-margin-bottom">Search Results: </h3> 
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
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();