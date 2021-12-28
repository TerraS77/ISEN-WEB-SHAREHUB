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
}

class cardManager{
    private $cards;
    public $parentId;
    function __construct($parentId)
    {
        $this->parentId = $parentId;
        $dbh = getBddPDO();
        $cards = $dbh->query(`SELECT * FROM cards WHERE idHubParent = $parentId`);
        $this->$cards = array();
        foreach($cards as $row) $this->addCard($row);
    }

    //MUST UPDATE INDEXES

    function addCard($cardData){
        $card = new card($this->parentId, intval($cardData['index']), $cardData['id'], $cardData['name'], $cardData['url'], $cardData['mediaUrl']);
        $this->cards[$card->id] = $card;
    }
    function createCard($cardData){
        $this->addCard($cardData);
        $dbh = getBddPDO();
    }
    function removeCard(){

    }

    function getCards($from, $to){

    }
}

class card{
    public $parentId;
    public $index;
    public $id;
    public $name;
    public $url;
    public $imageUrl;
    function __construct($parentId, $index, $id, $name, $url, $imageUrl)
    {
        $name = $data->name;
        $desc = $data->desc;
        $userId = $data->id;
    }
}

?>