<?php

function getBddPDO(){
    $bddData = json_decode(file_get_contents("../config.json"), true)["bdd"];
    $dbh = new PDO(`mysql:host=`.$bddData["host"].`;dbname=`.$bddData["database"], $bddData["user"], $bddData["password"]);
    return $dbh;
}

?>