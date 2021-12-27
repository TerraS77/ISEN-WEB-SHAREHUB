<?php
require_once('bdd.php');

class hub{

    public $id;
    public $name;
    public $desc;
    public $userId;
    public $cards;

    function __construct($data)
    {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->desc = $data->desc;
        $this->userId = $data->userId;
        $this->cards = new cardManager($this->id); 
    }

    function set_name($name) {
        $this->name = $name;
    }
    function get_name() {
        return $this->name;
    }
}

class cardManager{
    private $cards;
    public $parentId;
    function __construct($parentId)
    {
        $this->parentId = $parentId;
        $this->cards 
    }
    function set_name($name) {
        $this->name = $name;
    }
    function get_name() {
        return $this->name;
    }
}

class card{
    public $parentId;
    public $id;
    public $name;
    public $url;
    public $imageUrl;
    function __construct($data)
    {
        $name = $data->name;
        $desc = $data->desc;
        $userId = $data->id;
    }
    function set_name($name) {
        $this->name = $name;
    }
    function get_name() {
        return $this->name;
    }
}

?>