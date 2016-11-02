<?php
require_once("cDatabase_Connection.php");
// Check for set post/get values from forms
function checkValue($i_sFldName, $i_DefaultVal)
{
    if(isset($_POST[$i_sFldName]))
    {
        return $_POST[$i_sFldName];
    }
    Else if(isset($_GET[$i_sFldName]))
    {
        return $_GET[$i_sFldName];
    }else
    {
        return $i_DefaultVal;
    }
}
// create a dropdown optionslist from custom sql and setting which field should be the title and which should be the id
function getDropdown($i_SQL, $i_ID, $i_Title) {
$oDBConnection = new cDatabase_Connection();
$sDropdownOptions = "";
foreach ($oDBConnection->getfromDB($i_SQL) as $row)
{
    $sOptionTitle = $row[$i_Title];
    $sOptionID = $row[$i_ID];
    $sDropdownOptions .= <<<HTML
                            <option value="$sOptionID">$sOptionTitle</option>
HTML;
}
    return $sDropdownOptions;
}
// Not currently working but should work to enable file uploads in a future version
function upload_file($i_file) {
    $oDBConnection = new cDatabase_Connection();
    if (isset($_FILES["file_upload"]))
    {
        $file_location = $i_file['tmp_name'];
        $file_type = $i_file['type'];
        $file_size = $i_file['size'];
        $NoImage = false;
        switch ($file_type)
        {
            case 'image/jpeg':
                $uploadOk = 1;
                break;
            case 'application/pdf':
                $uploadOk = 1;
                break;
            case 'application/x-pdf':
                $uploadOk = 1;
                break;
            case 'application/acrobat':
                $uploadOk = 1;
                break;
            case 'applications/vnd.pdf':
                $uploadOk = 1;
                break;
            case 'text/pdf':
                $uploadOk = 1;
                break;
            case 'text/x-pdf':
                $uploadOk = 1;
                break;
            case 'image/jpg':
                $uploadOk = 1;
                break;
            case "image/bmp":
                $uploadOk = 1;
                break;
            case "image/png":
                $uploadOk = 1;
                break;
            case "image/gif":
                $uploadOk = 1;
                break;
            case Null:
                $uploadOk = 1;
                $NoImage = True;
                break;
            default:
                $uploadOk = 0;
                echo "Unknown/not permitted file type <br>";
        }
        // limit file size to 5mb
        if ($file_size > 655360)
        {
            echo "sorry your upload is too large, there is a 5mb limit on uploads<br>";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0)
        {
            return null;
        }
        else
        {
            if (!$NoImage) {
                $fOpen = fopen($file_location, "r");
                $contents = fread($fOpen, $file_size);
                fclose($fOpen);
                $sSQL = <<<SQL
                      insert into tbl_attachment 
                        (fld_type, fld_data) 
                      values 
                        (:fld_type, :fld_data)
SQL;
                $Array = array(":fld_type" => $file_type,
                    ":fld_data" => $contents);
                return $oDBConnection->commitSQL($sSQL, $Array);
            }
        }
    }
}

// Code used with Jake Bellotti's permission
function comparePassword($password, $hash) {
    return password_verify($password, $hash);
}

function generateRandomCharacter() {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1);
}
	
function generateRandomString($size) {
    $returnString = "";
    $index = 0;
    while($index < $size) {
        $returnString = ($returnString . generateRandomCharacter());
        $index++;
    }
    return $returnString;
}
	
function generateRandomSalt() {
    return mb_convert_encoding(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM), "UTF-8");
}
	
function hashPassword($password, $salt) {
    $options = [
        'cost' => 12,
        'salt' => $salt,
    ];
    return password_hash($password, PASSWORD_BCRYPT, $options);
}
// Code used with Jake Bellotti's permission