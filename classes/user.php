<?php

require_once('bdd.php');
require_once('hub.php');

class user{
    public $id;
    private $mail;
    private $password;

    static function createUser($data){
        try{
            $dbh = getBddPDO();
            $request = $dbh->prepare('INSERT INTO Users (`mail`, `password`) VALUES (:mail, :password)');
            $request->bindValue(':mail', $data['mail']);
            $request->bindValue(':password', $data['password']);
            $request->execute();
            $id = intval($dbh->query('SELECT LAST_INSERT_ID()')->fetch()[0]);
            $dbh = null;
            return new user($id);
        }catch( PDOException $e){
            echo $e->getMessage()."<br/>";
        }
    }

    static function login($mail, $password){
        try{
            $dbh = getBddPDO();
            $request = $dbh->prepare('SELECT * FROM Users WHERE `mail` = :mail AND `password` = :password');
            $request->bindValue(':mail', $mail);
            $request->bindValue(':password', $password);
            $request->execute();
            $data = $request->fetch();
            $dbh = null;
            if($data){
                setcookie("LoggedAccount", $data["IdUser"]);
                return true;
            } else return false;
        }catch( PDOException $e){
            echo $e->getMessage()."<br/>";
        }
    }

    static function doesUserExist($mail){
        try{
            $dbh = getBddPDO();
            $request = $dbh->prepare('SELECT * FROM Users WHERE `mail` = :mail');
            $request->bindValue(':mail', $mail);
            $request->execute();
            $data = $request->fetch();
            $dbh = null;
            if($data) return true;
            else return false;
        }catch( PDOException $e){
            echo $e->getMessage()."<br/>";
        }
    }

    function __construct($id)
    {
        try{
            $dbh = getBddPDO();
            $request = $dbh->prepare('SELECT * FROM Users WHERE `IdUser` = :IdUser');
            $request->bindValue(':IdUser', $id);
            $request->execute();
            $data = $request->fetch();
            $this->id = $data["IdUser"];
            $this->mail = $data['mail'];
            $this->password = $data['password'];
        }catch( PDOException $e){
            echo $e->getMessage()."<br/>";
        }
    }

    function getHub(){
        try{
            $dbh = getBddPDO();
            $request = $dbh->prepare('SELECT IdHub FROM Hubs WHERE `IdUser` = :IdUser');
            $request->bindValue(':IdUser', $this->id);
            $request->execute();
            $data = $request->fetch();
            if($data)
                return new hub($data["IdHub"]);
            else
                return false;
        }catch( PDOException $e){
            echo $e->getMessage()."<br/>";
        }
    }
}

?>