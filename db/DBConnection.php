<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBConnection
 *
 * @author asep
 */
class DBConnection {
    //put your code here
    public static function getConnection() {
        $usr="root";
        $pwd="";
        $database="sim_pesantren";
        $host="localhost";
        $connection=  mysql_connect($host, $usr, $pwd);
        mysql_select_db($database)or die("Database tidak ditemukan !");
        return $connection;
    }
    public function getKonnection(){
        return DBConnection::getConnection();
    }

    public static function closeConnection(){
        mysql_close();
    }
    public function startTransaction(){
        mysql_query("START TRANSACTION");
    }
    function begin(){
        mysql_query("BEGIN");
    }

    function commit(){
        mysql_query("COMMIT");
    }

    function rollback(){
        mysql_query("ROLLBACK");
    }
}

?>
