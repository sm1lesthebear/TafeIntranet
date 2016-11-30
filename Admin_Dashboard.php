<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$Function_lib = new function_lib();
$DBFunctions = new DB_Functions();
$UserCheck->userChecks(1);
$TableRow = "";

$UserCountGet = $Function_lib->checkValue("UserCount", Null);


$sSQL =<<<SQL
        select count(fldID) as UserCount from tbl_user
SQL;
foreach($DBFunctions->getfromDB($sSQL) as $row)
{
  $UserCount = $row['UserCount'];
}

if($UserCount == $UserCountGet)
{
  echo "<script>alert('User creation failed');</script>";
}

$SQL =<<<SQL
        select 
            fldID, 
            CONCAT(fldFirstName, ' ', fldLastName) as Name, 
            fldEmail, 
            fldUserName, 
            (select fldTitle 
                from tbl_privilege 
                where fldID = fldFkPrivilegeId) 
        as Privilege 
        from tbl_user
SQL;
foreach ($DBFunctions->getfromDB($SQL) as $BeepBoop) {

    $UserID = $BeepBoop['fldID'];
    $UserRealName = $BeepBoop['Name'];
    $UserEmail = $BeepBoop['fldEmail'];
    $UserName = $BeepBoop['fldUserName'];
    $UserPrivilege = $BeepBoop['Privilege'];
    $TableRow .=<<<HTML
    
                <tr style="cursor:pointer" onclick="location.href='User_Details.php?UserID=$UserID&UserCount=$UserCount'">
                    <td class="col-sm-1">$UserID</td>
                    <td class="col-sm-3">$UserRealName</td>
                    <td class="col-sm-3">$UserEmail</td>
                    <td class="col-sm-3">$UserName</td>
                    <td class="col-sm-2">$UserPrivilege</td>
                </tr>
HTML;
}



if ($Function_lib->checkValue("InsertFail", "") == "0")
{
  echo "<script>alert('The user could not be added');</script>";
}
$outgoing_HTML =<<<HTML
                    <div class="col-sm-12">
                        <h3 class="h1-margin-bottom">Admin Page</h3>
                        <h3 class="h1-margin-bottom">User list</h3> <p>select a user to edit them</p>
                            <table class="table">
                                <!--generated table info-->
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>User Real Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>User Privlege</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    $TableRow
                                </tbody>
                        </table>
                    </div>
                    <div class="col-sm-5">
                        <a href="User_Details.php?UserCount=$UserCount" class="btn btn-default form-control margin-top">Create New User</a>
                    </div>
                    <div class="col-sm-5 col-sm-offset-2">
                        <a href="Stakeholder_List.php" class="btn btn-default form-control margin-top">View Stakeholders List</a>
                    </div>

HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();