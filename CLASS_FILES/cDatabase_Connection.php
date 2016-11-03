<?php

    class cDB_Conn
    {
        private static $oConn = null;
        public function __construct()
        {
            $this->oConn();
        }
        public static function oConn()
        {
            if (!isset(self::$oConn)) {
                self::$oConn = new PDO('mysql:host=localhost; dbname=ticketdb; charset=utf8', 'root', 'Password1');
            }
            return self::$oConn;
        }

        // commit/update to the database with fail prevention
        public function commitSQL($sSQL,$Array)
        {
            try {
                $this->oConn()->beginTransaction();
                $oStmt = $this->oConn()->prepare($sSQL);
                $oStmt->execute($Array);
                $iInsertID = $this->oConn()->lastInsertId();
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
            Return $this->oConn()->query($i_sql);
        }
    }
