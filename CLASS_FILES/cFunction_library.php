<?php
require_once "cClass_Connector.php";
class function_lib extends Class_Lib
{
    // Check for set post/get values from forms
    public function checkValue($i_sFldName, $i_DefaultVal)
    {
        if (isset($_POST[$i_sFldName])) {
            return $_POST[$i_sFldName];
        } Else if (isset($_GET[$i_sFldName])) {
            return $_GET[$i_sFldName];
        } else {
            return $i_DefaultVal;
        }
    }

// create a dropdown optionslist from custom sql and setting which field should be the title and which should be the id
    public function getDropdown($i_SQL, $i_ID, $i_Title)
    {
        $oDBConnection = new DB_Functions();
        $sDropdownOptions = "";
        foreach ($oDBConnection->getfromDB($i_SQL) as $row) {
            $sOptionTitle = $row[$i_Title];
            $sOptionID = $row[$i_ID];
            $sDropdownOptions .= <<<HTML
                            <option value="$sOptionID">$sOptionTitle</option>
HTML;
        }
        return $sDropdownOptions;
    }
    public function image_handler($i_file)
    {
        if (isset($i_file)) {
            $file_type = $i_file['type'];
            $file_size = $i_file['size'];
            switch ($file_type) {
                case 'image/jpeg':
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
                case "image/tiff":
                    $uploadOk = 1;
                    break;
                case "image/webp":
                    $uploadOk = 1;
                    break;
                case Null:
                    $uploadOk = 0;
                    break;
                default:
                    $uploadOk = 0;
            }
            // limit file size to 5mb
            if ($file_size > 5242880) {
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                return Null;
            }
                return $i_file;
        }
        return null;
    }
    public function Document_Handler($i_file)
    {
        if (isset($i_file)) {
            $file_type = $i_file['type'];
            $file_size = $i_file['size'];
            switch ($file_type) {
                case 'application/pdf':
                    $uploadOk = 1;
                    break;
                case 'application/msword':
                    $uploadOk = 1;
                    break;
                case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                    $uploadOk = 1;
                    break;
                case 'application/vnd.ms-excel':
                    $uploadOk = 1;
                    break;
                case 'application/vnd.ms-powerpoint':
                    $uploadOk = 1;
                    break;
                case Null:
                die("no File");
                    $uploadOk = 0;
                    break;
                default:
                die("default?");
                    $uploadOk = 0;
            }
            // limit file size to 5mb
            if ($file_size > 5242880) {
                die("file size");
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                die("Upload OK?");
                return Null;
            }
                return $i_file;
        }
        die("file not isset");
        return null;
    }
}