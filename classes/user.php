<?php

class user{
    public $id;
    private $mail;
    private $password;

    static function createUser($data){
        $dbh = getBddPDO();
        $request = $dbh->prepare('INSERT INTO users (`mail`, `password`) VALUES (:mail, :password);');
        $request->bindValue(':mail', $data['mail']);
        $request->bindValue(':password', $data['password']);
        $request->execute();
        $data["IdUser"] = intval($dbh->query('SELECT LAST_INSERT_ID()')->fetch()[0]);
        $dbh = null;
        return new user($data);
    }

    function __construct($data)
    {
        $this->id = $data["IdUser"];
        $this->mail = $data["mail"];;
        $this->password = $data["password"];
    }
}

?>