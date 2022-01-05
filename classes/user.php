<?php

require_once('bdd.php');

class user{
    public $id;
    private $mail;
    private $password;

    static function createUser($data){
        try{
            $dbh = getBddPDO();
            $request = $dbh->prepare('INSERT INTO users (`mail`, `password`) VALUES (:mail, :password)');
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
            $request = $dbh->prepare('SELECT * FROM users WHERE `mail` = :mail AND `password` = :password');
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
            $request = $dbh->prepare('SELECT * FROM users WHERE `mail` = :mail');
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
            $request = $dbh->prepare('SELECT * FROM users WHERE `IdUser` = :IdUser');
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
}

?>