<?php

function getBddPDO(){
    try{
        $bddData = json_decode(file_get_contents("./config.json"), true)["bdd"];
        $dbh = new PDO('mysql:host='.$bddData["host"].';dbname='.$bddData["database"], $bddData["user"], $bddData["password"]);
        return $dbh;
    } catch( PDOException $e){
        echo $e->getMessage()."<br/>";
        return null;
    }
}

try{
    $dbh = getBddPDO();
    $dbh->query("
        CREATE TABLE IF NOT EXISTS `Users`(
            `IdUser` int AUTO_INCREMENT PRIMARY KEY,
            `mail` VARCHAR(100) character set utf8 NOT NULL,
            `password` VARCHAR(200) character set utf8 NOT NULL
        );
        
        CREATE TABLE IF NOT EXISTS `Hubs`(
            IdHub int AUTO_INCREMENT PRIMARY KEY,
            LibHub VARCHAR(50) character set utf8,
            DescHub VARCHAR(500) character set utf8,
            IdUser INT NOT NULL,
            FOREIGN KEY (IdUser) REFERENCES Users(IdUser)
        );
        
        CREATE TABLE IF NOT EXISTS `Cards`(
            IdCard bigint AUTO_INCREMENT PRIMARY KEY,
            `Index` INT NOT NULL,
            lib VARCHAR(100) character set utf8 NULL,
            url VARCHAR(500) character set utf8 NULL,
            imageUrl VARCHAR(500) character set utf8 NOT NULL,
            IdHub INT NOT NULL,
            FOREIGN KEY (IdHub) REFERENCES Hubs(IdHub)
        );
    ");
    $dbh = null;
} catch( PDOException $e){
    echo $e->getMessage()."<br/>";
}

?>