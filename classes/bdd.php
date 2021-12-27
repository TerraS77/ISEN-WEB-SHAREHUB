<?php

class bdd{
    static public $DBH;
    function __construct($host, $dbname, $user, $pass){
        $this->dbh = new PDO(`mysql:host=$host;dbname=$dbname`, $user, $pass);
    }
    function getPDO(){
        return $this->dbh;
    }
}

?>