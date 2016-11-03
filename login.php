<?php
require_once "CLASS_FILES/cClass_Connector.php";
$sIncorrectLogin = null;
if (isset($_SESSION['userID']))
{
    session_destroy();
    header("location:index.php");
}
if (($_SERVER['REQUEST_METHOD'] == 'POST')){
    $oFunction_Lib = new function_lib();
    $oUser_Account_Lib = new User_Account_Functions();
    $sUsername = $oFunction_Lib->checkValue("Username", "");
    $sPassword = $oFunction_Lib->checkValue("Password", "");
    $sGetSaltSQL = <<<SQL
                select fldPasswordSalt from tbl_user where fldUserName = '$sUsername'
SQL;
    $bSuccessfulLogin = $oUser_Account_Lib->login_test($sGetSaltSQL,$sUsername,$sPassword);
    if ($bSuccessfulLogin)
    {
        header("location:index.php");
    }else
    {
        $sIncorrectLogin = "<p class='margin-top'>Your username or password is incorrect</p>";
    }
}

$outgoing_HTML = <<< HTML
            <div class="col-sm-8 col-sm-offset-2">
                <h3>Login</h3>
            </div>  
            <form action="login.php" method="post" onload="">
                <div class="form-group" id="Username-group">
                    <label class="col-sm-8 col-sm-offset-2" for="Username">Username :</label>
                    <div class="col-sm-8 col-sm-offset-2">
                        <input required maxlength="45" type="text"  class="form-control" name="Username" id="Username" Placeholder="Enter your username...">
                    </div>
                </div>
                <div class="form-group" id="Password-group">
                    <label class="col-sm-8 col-sm-offset-2 margin-top" for="Password">Password :</label>
                    <div class="col-sm-8 col-sm-offset-2">
                        <input required maxlength="45" type="Password"  class="form-control" name="Password" id="Password" Placeholder="Enter your Password...">
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-7 margin-top">
                    <input  type="submit" name="submit" class="form-control btn btn-default text-center">
                </div>
                <div id="login_check_result" class="col-sm-8 col-sm-offset-2">
                    $sIncorrectLogin
                </div>
            </form>
        <script>
        if( document.getElementById("login_check_result").children.length == 0 )
        {
            document.getElementById("Username").classList.remove("input-alert");
            document.getElementById("Password").classList.remove("input-alert");
        }else
        { 
            document.getElementById("Username").classList.add("input-alert");
            document.getElementById("Password").classList.add("input-alert");
        }
        </script>
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();