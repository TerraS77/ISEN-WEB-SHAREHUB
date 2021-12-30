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
        try{
            $dbh = getBddPDO();
            $cards = $dbh->query(`SELECT * FROM cards WHERE idHubParent = $parentId`);
            $this->$cards = array();
            foreach($cards as $row) $this->addCard($row);
        } catch( PDOException $e){
            echo $e->getMessage()."<br/>";
        }
    }

    function addCard($cardData){
        $card = new card($this->parentId, intval($cardData['index']), $cardData['id'], $cardData['name'], $cardData['url'], $cardData['mediaUrl']);
        $this->cards[$card->id] = $card;
    }
    function createCard($cardData){
        $this->addCard($cardData);
        $dbh = getBddPDO();
    }

    //MUST UPDATE INDEXES
    function removeCard(){

    }

    function getCards($from, $to){

    }
}

class card{
    public $id;
    public $parentId;
    public $index;
    public $name;
    public $url;
    public $imageUrl;
    function __construct($parentId, $index, $id, $name, $url, $imageUrl)
    {
        $this->parentId = $parentId;
        $this->index = $index;
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
        $this->imageUrl = $imageUrl;
    }
}

?>