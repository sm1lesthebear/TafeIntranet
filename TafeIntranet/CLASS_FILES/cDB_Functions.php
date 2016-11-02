<?php
require_once "cDB_Conn.php";
class DB_Functions extends DB_Conn
{
    // commit/update to the database with fail prevention
    public function commitSQL($sSQL,$Array)
    {
        try {
            parent::oConn()->beginTransaction();
            $oStmt = parent::oConn()->prepare($sSQL);
            $oStmt->execute($Array);
            $iInsertID = parent::oConn()->lastInsertId();
            $this->oConn()->commit();
            return $iInsertID;
        } Catch (\Exception $oE) {
            $this->oConn()->rollBack();
            echo $oE->getMessage();
            return null;
        }
    }
    public function getfromDB($i_sql)
    {
        Return parent::oConn()->query($i_sql);
    }
}