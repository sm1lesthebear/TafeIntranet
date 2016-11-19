<?php
    require_once("cClass_Connector.php");
class User_Account_Functions extends DB_Functions
{
    public function checkPrivilege($i_SQL, $i_fld_privilege, $i_RequirePrivilege)
    {
        foreach (parent::getfromDB($i_SQL) as $row)
        {
          if($row["$i_fld_privilege"] == 1 && $i_RequirePrivilege != 1)
          {
            header("location:Admin_Dashboard.php");
          }
          elseif ($row["$i_fld_privilege"] > $i_RequirePrivilege)
          {
                
                return header("location:index.php?UserMessage=". urlencode("Incorrect User Permissions"));
          }
          elseif($i_RequirePrivilege == 1 && $row["$i_fld_privilege"] != 1)
          {
                return header("location:index.php?UserMessage=". urlencode("Incorrect User Permissions"));
          }
            return null;
        }
        return header("location:login.php");
    }
    public function login_test($i_getSaltSQL, $i_username, $i_password)
    {
        try
        {
            $salt = "";
            foreach (parent::getfromDB($i_getSaltSQL) as $row)
            {
                $salt = $row["fldPasswordSalt"];
            }
            $sql = 'select fldID from tbl_user where fldUserName = "'.$i_username .'" AND fldPassword = "' . $this->hashPassword($i_password, $salt) . '"';
            foreach (parent::getfromDB($sql) as $row)
            {
                $_SESSION['userID'] = $row['fldID'];
                return true;
            }
            return false;
        }
        catch (PDOException $oException) {
            return false;
        }
    }
    public function checkLogin(){
        if (!(isset($_SESSION['userID']))) {
         return header("location:login.php");
        }
        return false;
    }
    public function userChecks($i_required_Privilege)
    {
        $userID = $_SESSION['userID'];
        $oLoginCheck = new User_Account_Functions();
        echo $oLoginCheck->checkLogin();
        echo $oLoginCheck->checkPrivilege("select fldFKprivilegeID from tbl_user where fldID = $userID",'fldFKprivilegeID',$i_required_Privilege);
    }

    // Code used with Jake Bellotti's permission
    public function comparePassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function generateRandomCharacter()
    {
        $var = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1);
        return $var;
    }

    public function generateRandomString($size)
    {
        $returnString = "";
        $index = 0;
        while ($index < $size) {
            $returnString = ($returnString . self::generateRandomCharacter());
            $index++;
        }
        return $returnString;
    }
    public function generateRandomSalt()
    {
        //return mb_convert_encoding(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM), "UTF-8");
        return self::generateRandomString(22);
    }

    public function hashPassword($password, $salt)
    {
        try {
            $options = [
                'cost' => 12,
                'salt' => $salt,
            ];
            return password_hash($password, PASSWORD_BCRYPT, $options);
        }
        catch (Exception $e)
        {
            return null;
        }
    }
// Code used with Jake Bellotti's permission
}