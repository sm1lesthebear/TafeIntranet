<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$UserCheck->userChecks(1);
$Function_lib = new function_lib();
$DBFunctions = new DB_Functions();
$image_fail = "";
$image_input_alert = "";
$StakeholderOptions = "";
$StakeholderID = "";
$StakeholderImage = "";
$SubmitButtonClass = "col-sm-4 col-sm-offset-2";
$DeleteButton = '<div class="' . $SubmitButtonClass . '">
                    <input type="submit" name="Submit" value="Submit" class="form-control btn btn-default">
                  </div>';
$i_Image = "";
$i_First_Name = "";
$i_Last_Name = "";
$i_Info = "";
if($_SERVER['REQUEST_METHOD'] == "POST") {
    switch ($_POST['Submit']) {
        case 'Submit':
            $i_posted_image = $_FILES["file_upload"];
            $StakeholderID = $Function_lib->checkValue("StakeholderID", "");
            $i_First_Name = $Function_lib->checkValue("First_Name", "");
            $i_Last_Name = $Function_lib->checkValue("Last_Name", "");
            $i_Info = $Function_lib->checkValue("Info", "");
            $i_Image = $Function_lib->image_handler($i_posted_image);
            
            if (!isset($i_Image)) 
            {
                $image_fail = "Unsuccessful image upload";
                $image_input_alert = "input-alert";
            } 
            else 
            {
                $string = str_replace(' ', '', $i_Image["name"]);
                $target_dir = "RESOURCES/StakeholderImages/";
                $target_file = $target_dir . basename($string);
                if (!file_exists($target_file)) 
                {
                    move_uploaded_file($i_Image["tmp_name"], $target_file);
                }

            }
            if ($StakeholderID == null) 
            {
                $sSQL = <<<SQL
                insert into tbl_stakeholders
                (fldFirstName,fldLastName,fldImageLocation,fldInfo)
                values
                (:Firstname, :LastName, :Image, :Info)
SQL;
            } 
            $Array = array(
                ":Firstname" => $i_First_Name,
                ":LastName" => $i_Last_Name,
                ":Image" => $target_file,
                ":Info" => $i_Info
            );
            $StakeholderID = $DBFunctions->commitSQL($sSQL, $Array);
            
            header("location:Stakeholder_Details.php?StakeholderID=$StakeholderID");
            break;
      case "Delete":
            $StakeholderID = $Function_lib->checkValue("StakeholderID", "");
            $sSQL = <<<SQL
                    delete from tbl_stakeholders
                    where fldID = $StakeholderID
SQL;
            $DBFunctions->getfromDB($sSQL);
            header("location:Stakeholder_Details.php");
            break;
        default:
            break;
    }
}

if (($StakeholderID = $Function_lib->checkValue("StakeholderID", "")) != "") 
{
            if ($StakeholderID > 0) {
                $sSQL = <<<SQL
                          select fldFirstName, fldLastName, fldInfo, fldImageLocation from tbl_stakeholders where fldID = $StakeholderID
SQL;
                foreach ($DBFunctions->getfromDB($sSQL) as $row) {
                    $i_First_Name = $row['fldFirstName'];
                    $i_Last_Name = $row['fldLastName'];
                    $i_Info = $row['fldInfo'];
                    $i_ImageLocation = $row['fldImageLocation'];
                  $StakeholderImage = <<<HTML
                <!--      <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                          <h4 class="margin-bottom">Current Stakeholder Image:</h4>
                          <img src="$i_ImageLocation" class="image_fluid">
                        </div>
                      </div>
                      -->
                    <div class="stakeholder-container col-sm-10 col-sm-offset-1 margin-bottom margin-top">
                        <div class="col-sm-12">
                            <h4 class="margin-bottom">Current Stakeholder Image:</h4>
                            <img src="$i_ImageLocation" class="image_fluid">
                        </div>
                    </div>
HTML;
                }
              $DeleteButton = <<<HTML
                            <div class="col-sm-4 col-sm-offset-2 margin-bottom">
                                <input type="submit" name="Submit" value="Delete" class="form-control btn btn-default">
                            </div>
HTML;
            }
          
}




$outgoing_HTML =<<<HTML
                            <div class="col-sm-10 col-sm-offset-1">
                                <h3>Edit a Stakeholder </h3>
                            </div>
                            
                            <div class="margin-top">
                              <form action="Stakeholder_Details.php" enctype="multipart/form-data" method="post" class="form-horizontal margin-top" role="form">
                                  <div class="form-group" id="">
                                      <label class="col-sm-10 col-sm-offset-1" for="First_Name">First Name :</label>
                                      <div class="col-sm-10 col-sm-offset-1">
                                          <input required maxlength="45" type="text"  class="form-control" name="First_Name" id="First_Name" Placeholder="Enter first name..." value="$i_First_Name">
                                      </div>
                                  </div>
                                  <div class="form-group" id="">
                                      <label class="col-sm-10 col-sm-offset-1 margin-top" for="Last_Name">Last Name :</label>
                                      <div class="col-sm-10 col-sm-offset-1">
                                          <input required maxlength="45" type="text"  class="form-control" name="Last_Name" id="Last_Name" Placeholder="Enter last name..." value="$i_Last_Name">
                                      </div>
                                  </div>
                                  <div class="form-group" id="">
                                      <label class="col-sm-10 col-sm-offset-1 margin-top" for="Info">Stakeholder Info :</label>
                                      <div class="col-sm-10 col-sm-offset-1">
                                          <textarea required class="form-control" name="Info" id="Info" Placeholder="Enter info about the Stakeholder...">$i_Info</textarea>
                                      </div>
                                  </div>
                                  <div class="form-group" id="">
                                      <label class="col-sm-10 col-sm-offset-1 margin-top" for="file_upload">Stakeholder Picture :</label>
                                      <div class="col-sm-10 col-sm-offset-1">
                                          <input required class="form-control btn btn-default $image_input_alert" type="file" name="file_upload" id="file_upload">
                                      </div>
                                      <p class="col-sm-10 col-sm-offset-1 margin-top">$image_fail</p>
                                  </div>
                                  $StakeholderImage
                                  <input type="hidden" value="$StakeholderID" name="StakeholderID">
                                  <div class="form-group">
                                      <div class="col-sm-4 col-sm-offset-1">
                                          <a href="Stakeholder_Details.php" class="form-control btn btn-default">Clear</a>
                                      </div>
                                      $DeleteButton
                                  </div>
                            </form>
                          </div>
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();