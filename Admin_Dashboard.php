<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$Function_lib = new function_lib();
$UserCheck->userChecks(1);
$outgoing_HTML = <<<HTML
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="col-sm-6 col-sm-offset-3">
                            <h3>Admin Page</h3>
                        </div>
                    </div>
                         
                    <div class="col-sm-8 col-sm-offset-2">
                        <a href="User_Details.php" class="btn btn-default col-sm-6 col-sm-offset-3 margin-top">Create New User</a>
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                        <a href="View_Users.php" class="btn btn-default col-sm-6 col-sm-offset-3 margin-top">View Existing Users</a>
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                        <a href="Stakeholder_Details.php" class="btn btn-default col-sm-6 col-sm-offset-3 margin-top">Edit Stakeholders</a>
                    </div>

HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();