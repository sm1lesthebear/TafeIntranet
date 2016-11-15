<?php
require_once "CLASS_FILES/cClass_Connector.php";
$DBFunctions = new DB_Functions();
$FunctionLibary = new function_lib();
$StakeholderHTML = "";
$UserCheck = new User_Account_Functions();
$UserCheck->userChecks(3);

$sSQL = <<<SQL
            select CONCAT(fldFirstName, ' ' , fldLastName) as Stakeholder, fldImageLocation, fldInfo 
            from tbl_stakeholders
SQL;
foreach ($DBFunctions->getfromDB($sSQL) as $row)
{
    $i_StakeholderName = $row['Stakeholder'];
    $i_ImageType = $row['fldImageLocation'];
    $i_Info = $row['fldInfo'];


    $StakeholderHTML .= <<<HTML
    <div class="stakeholder-container col-sm-12 margin-top">
        <div class="col-sm-4">
            <div class="stakeholder-img-fluid" style="background-image: url($i_ImageType);"></div>
        </div>
        <div class="col-sm-8">
            <h4 class="col-sm-offset-1">$i_StakeholderName</h4>
            <p class="col-sm-offset-1">$i_Info</p>
        </div>
    </div>
    
HTML;
}



$outgoing_HTML = <<<HTML
                <div class="col-sm-12">
                    <h3 class="col-centered">Tafe Intranet Stakeholders</h3>
                    $StakeholderHTML
                </div>
                
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();