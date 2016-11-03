<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserID = $_SESSION['userID'];
$UserCheck = new User_Account_Functions();
$Function_lib = new function_lib();
$DBFunctions = new DB_Functions();
$UserCheck->userChecks(1);
$TableRow = "";
$SQL = <<<SQL
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
    $TableRow .= <<<HTML
    
                <tr style="cursor:pointer" onclick="location.href='User_Details.php?UserID=$UserID'">
                    <td class="col-sm-1">$UserID</td>
                    <td class="col-sm-3">$UserRealName</td>
                    <td class="col-sm-3">$UserEmail</td>
                    <td class="col-sm-3">$UserName</td>
                    <td class="col-sm-2">$UserPrivilege</td>
                </tr>
HTML;
}
$outgoing_HTML = <<<HTML
                    
                    <div class="col-sm-12">
                        <h3 class="h1-margin-bottom">User list - </h3> <p>select a user to edit them</p>
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
                    
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();