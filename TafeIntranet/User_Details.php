<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$Function_lib = new function_lib();
$DBFunctions = new DB_Functions();
$UserFunctions = new User_Account_Functions();
$User_Full_Name = "Create a new User...";
$SessionUserID = $_SESSION['userID'];
$i_FirstName = "";
$i_LastName = "";
$i_Email = "";
$i_Username = "";
$DeleteThisButton = "";
$UserIDField = "";
$SubmitButtonClass = "col-sm-4 col-sm-offset-6 margin-top";
$SubmitButton = "Submit";
$UserCheck->userChecks(1);
$PrivilegeDropdownOptions = $Function_lib->getDropdown("select fldID, fldTitle from tbl_privilege", "fldID", "fldTitle");
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $UserID = $Function_lib->checkValue("UserIDField", "");
    $i_FirstName = $Function_lib->checkValue("First_Name", "");
    $i_LastName = $Function_lib->checkValue("Last_Name", "");
    $i_Email = $Function_lib->checkValue("User_Email", "");
    $i_Username = $Function_lib->checkValue("Username", "");
    $i_Password = $Function_lib->checkValue("User_Password", "");
    $i_PasswordConfirm = $Function_lib->checkValue("User_Password_Confirm", "");
    $i_Privilege = $Function_lib->checkValue("PrivilegeDropdown", "");
    $SubmitButtonClass = "col-sm-4 margin-top";
    $DeleteThisButton = <<<HTML
                            <div class="col-sm-4 col-sm-offset-2 margin-top">
                                <input type="submit" name="Submit" value="Delete" class="form-control btn btn-default">
                            </div>
HTML;
    switch ($_POST['Submit']) {
        case 'Submit':
            $UserID = $Function_lib->checkValue("UserIDField", "");
            $Salt = $UserFunctions->generateRandomSalt();
            $PasswordSalted = $UserFunctions->hashPassword($i_Password, $Salt);
            $sSQL = <<<SQL
                    insert into tbl_user 
                        (fldFirstName,fldLastName,fldEmail,fldUserName,fldPassword,fldPasswordSalt,fldFkPrivilegeId)
                    VALUES 
                        (:FirstName, :LastName, :Email, :Username, :Password, :PasswordSalt, :Privilege)
SQL;
            $Array = array(
                ":FirstName" => $i_FirstName,
                ":LastName" => $i_LastName,
                ":Email" => $i_Email,
                ":Username" => $i_Username,
                ":Password" => $PasswordSalted,
                ":PasswordSalt" => $Salt,
                ":Privilege" => $i_Privilege
            );
            $UserID = $DBFunctions->commitSQL($sSQL, $Array);
            $UserIDField = <<<HTML
                    <input type="hidden" value="$UserID" name="UserIDField">   
HTML;
            $SubmitButton = "Update";
            $User_Full_Name = '<b>Edit user: </b>' . $i_FirstName . ' ' . $i_LastName;
            break;
        case 'Update':
            $UserID = $Function_lib->checkValue("UserIDField", "");
            $Salt = $UserFunctions->generateRandomSalt();
            $PasswordSalted = $UserFunctions->hashPassword($i_Password, $Salt);
            $sSQL = <<<SQL
                    update
                        tbl_user
                    set
                        fldFirstName = :FirstName, fldLastName = :LastName, fldEmail = :Email, fldUserName = :Username, fldPassword = :Password, fldPasswordSalt = :PasswordSalt, fldFkPrivilegeId = :Privilege
                    where
                        fldID = $UserID
SQL;
            $Array = array(
                ":FirstName" => $i_FirstName,
                ":LastName" => $i_LastName,
                ":Email" => $i_Email,
                ":Username" => $i_Username,
                ":Password" => $PasswordSalted,
                ":PasswordSalt" => $Salt,
                ":Privilege" => $i_Privilege
            );
            $UserID = $DBFunctions->commitSQL($sSQL, $Array);
            $UserIDField = <<<HTML
                    <input type="hidden" value="$UserID" name="UserIDField">   
HTML;
            $SubmitButton = "Update";
            $User_Full_Name = '<b>Edit user: </b>' . $i_FirstName . ' ' . $i_LastName;
            break;
        case 'Delete':
            $UserID = $Function_lib->checkValue("UserIDField", "");
            $sSQL = <<<SQL
                    delete from tbl_user
                    where fldID = :UserID
SQL;
            $Array = array(
                ":UserID" => $UserID
            );
            $UserID = $DBFunctions->commitSQL($sSQL, $Array);
            header("location: View_Users.php");
            break;
        default:
            break;
    }
}
if (($UserID = $Function_lib->checkValue("UserID", "")) != "") {
    $SQL = <<<SQL
              select * from tbl_user where fldID = $UserID
SQL;
    foreach ($DBFunctions->getfromDB($SQL) as $BeppBopp) {
        $i_FirstName = $BeppBopp['fldFirstName'];
        $i_LastName = $BeppBopp['fldLastName'];
        $i_Email = $BeppBopp['fldEmail'];
        $i_Username = $BeppBopp['fldUserName'];
        $SubmitButton = "Update";
        $User_Full_Name = '<b>Edit user: </b>' . $i_FirstName . ' ' . $i_LastName;
        $UserIDField = <<<HTML
                    <input type="hidden" value="$UserID" name="UserIDField">   
HTML;
        $SubmitButtonClass = "col-sm-4 margin-top";
        $DeleteThisButton = <<<HTML
                            <div class="col-sm-4 col-sm-offset-2 margin-top">
                                <input type="submit" name="Submit" value="Delete" class="form-control btn btn-default">
                            </div>
HTML;
    }
}
if ($UserID == $SessionUserID)
{
    $SubmitButtonClass = "col-sm-4 col-sm-offset-6 margin-top";
    $DeleteThisButton = "";
}
$outgoing_HTML = <<<HTML
                    <form action="User_Details.php" method="post" class="form-horizontal margin-top" role="form">
                        <div class="form-group" id="">
                            <div class="col-sm-8 col-sm-offset-2"> 
                                <h3>$User_Full_Name</h3>
                            </div>
                        </div>
                        <div class="form-group" id="">
                            <label class="col-sm-8 col-sm-offset-2" for="First_Name">First Name :</label>
                            <div class="col-sm-8 col-sm-offset-2">
                                <input required maxlength="45" type="text"  class="form-control" name="First_Name" id="First_Name" Placeholder="Enter first name..." value="$i_FirstName">
                            </div>
                        </div>
                        <div class="form-group" id="">
                            <label class="col-sm-8 col-sm-offset-2" for="Last_Name">Last Name :</label>
                            <div class="col-sm-8 col-sm-offset-2">
                                <input required maxlength="45" type="text"  class="form-control" name="Last_Name" id="Last_Name" Placeholder="Enter last name..." value="$i_LastName">
                            </div>
                        </div>
                        <div class="form-group" id="">
                            <label class="col-sm-8 col-sm-offset-2" for="User_Email">User Email :</label>
                            <div class="col-sm-8 col-sm-offset-2">
                                <input required maxlength="45" type="email"  class="form-control" name="User_Email" id="Last_Name" Placeholder="Enter users email..." value="$i_Email">
                            </div>
                        </div>
                        <div class="form-group" id="">
                            <label class="col-sm-8 col-sm-offset-2" for="Username">Username :</label>
                            <div class="col-sm-8 col-sm-offset-2">
                                <input required maxlength="45" type="text"  class="form-control" name="Username" id="Username" Placeholder="Enter Username..." value="$i_Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-8 col-sm-offset-2" for="User_Password">Password :</label>
                            <div class="col-sm-8 col-sm-offset-2">
                                <input maxlength="30" minlength="12" required type="password" id="User_Password" class="form-control" name="User_Password" Placeholder="Enter a Password...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-8 col-sm-offset-2" for="User_Password_Confirm">Password Confirm :</label>
                            <div class="col-sm-8 col-sm-offset-2">
                                <input maxlength="30" minlength="12" id="User_Password_Confirm"  onkeyup="passwordcheck('User_Password', 'User_Password_Confirm')" required type="password" class="form-control" name="User_Password_Confirm" Placeholder="Confirm your Password...">
                                <p id="PasswordNotMatch" style="display:none;">Passwords Do Not Match</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-8 col-sm-offset-2" for="User_Password_Confirm">Password Confirm :</label>
                            <div class="col-sm-8 col-sm-offset-2">
                                <select name="PrivilegeDropdown" class="form-control">
                                    <option id="-99">Please Select a Prilege Level</option>
                                    $PrivilegeDropdownOptions
                                </select>  
                            </div>
                        </div>
                        $UserIDField
                        <div class="form-group">
                            $DeleteThisButton
                            <div class="$SubmitButtonClass">
                                <input type="submit" name="Submit" id="submit" value="$SubmitButton" class="form-control btn btn-default">
                            </div>
                            <div class="col-sm-4 col-sm-offset-6 margin-top">
                                <a href="User_Details.php" id="Reset" class="form-control btn btn-default">Clear</a>
                            </div>
                        </div>
                    </form>
                     <script>
                        function passwordcheck(Password, PasswordConfirm) {
                            var Pass = document.getElementById(Password).value;
                            var PassConfirm = document.getElementById(PasswordConfirm).value;
                            if (Pass !== PassConfirm)
                            {
                                document.getElementById('PasswordNotMatch').style.display = '';
                                document.getElementById('submit').disabled = true;
                            }
                            else
                            {
                                document.getElementById('PasswordNotMatch').style.display = 'none';
                                document.getElementById('submit').disabled = false;
                            }
                        }
                    </script>               
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();