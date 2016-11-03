<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$Function_lib = new function_lib();
$UserCheck->userchecks(3);
$outgoing_HTML = <<<HTML
<div class="col-sm-10 col-sm-offset-1">
  <h3>Upload A Document</h3>
</div>
  

HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();