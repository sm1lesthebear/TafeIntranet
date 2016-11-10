<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$Function_lib = new function_lib();
$DBFunctions = new DB_Functions();
$UserCheck->userChecks(1);
$TableRow = "";
$SQL = <<<SQL
        select 
            fldID, 
            CONCAT(fldFirstName, ' ', fldLastName) as Name, 
            fldInfo
        from tbl_stakeholders
SQL;
foreach ($DBFunctions->getfromDB($SQL) as $BeepBoop) {

    $StakekholderID = $BeepBoop['fldID'];
    $StakeholderName = $BeepBoop['Name'];
    $StakeholderInfo = $BeepBoop['fldInfo'];
    $TableRow .= <<<HTML
    
                <tr style="cursor:pointer" onclick="location.href='Stakeholder_Details.php?StakeholderID=$StakekholderID'">
                    <td class="col-sm-2">$StakekholderID</td>
                    <td class="col-sm-4">$StakeholderName</td>
                    <td class="col-sm-6">$StakeholderInfo</td>
                </tr>
HTML;
}
$outgoing_HTML = <<<HTML
                    <div class="col-sm-12">
                        <h3 class="h1-margin-bottom">Admin Page</h3>
                        <h3 class="h1-margin-bottom">User list</h3> <p>select a user to edit them</p>
                            <table class="table">
                                <!--generated table info-->
                                <thead>
                                    <tr>
                                        <th>Stakholder ID</th>
                                        <th>Stkaholder Full Name</th>
                                        <th>Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    $TableRow
                                </tbody>
                        </table>
                    </div>
                    <div class="col-sm-5">
                        <a href="Stakeholder_Details.php" class="btn btn-default form-control margin-top">Create New Stakeholder</a>
                    </div>
                    <div class="col-sm-5 col-sm-offset-2">
                        <a href="Admin_Dashboard.php" class="btn btn-default form-control margin-top">Goto Admin Dashboard</a>
                    </div>

HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();