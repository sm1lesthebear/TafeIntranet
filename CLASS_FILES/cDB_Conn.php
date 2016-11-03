<?php
require_once "cClass_Connector.php";
    class DB_Conn extends Class_Lib
    {
        private static $oConn = null;
        public function __construct()
        {
            $this->oConn();
        }
        public static function oConn()
        {
            if (!isset(self::$oConn)) {
                self::$oConn = new PDO('mysql:host=localhost; dbname=intranetdb; charset=utf8', 'root', '');
            }
            return self::$oConn;
        }
    }
