<?php
require_once('bdd.php');

class hub{
    public $id;
    public $name;
    public $desc;
    public $userId;
    public $cards;

    static function doesHubExist($id){
        try{
            $dbh = getBddPDO();
            $request = $dbh->prepare('SELECT * FROM Hubs WHERE `IdHub` = :IdHub');
            $request->bindValue(':IdHub', $id);
            $request->execute();
            $data = $request->fetch();
            $dbh = null;
            if($data) return true;
            else return false;
        }catch( PDOException $e){
            echo $e->getMessage()."<br/>";
        }
    }

    static function createHub($data){
        try{
            $dbh = getBddPDO();
            $request = $dbh->prepare('INSERT INTO Hubs (`LibHub`, `DescHub`, `IdUser`) VALUES (:LibHub, :DescHub, :IdUser)');
            $request->bindValue(':LibHub', $data['LibHub']);
            $request->bindValue(':DescHub', $data['DescHub']);
            $request->bindValue(':IdUser', $data['IdUser']);
            $request->execute();
            $data["IdHub"] = intval($dbh->query('SELECT LAST_INSERT_ID()')->fetch()[0]);
            $dbh = null;
            return new hub($data);
        } catch( PDOException $e){
            echo $e->getMessage()."<br/>";
        }
    }

    function __construct($data)
    {
        if(!is_array($data)){
            try{
                $dbh = getBddPDO();
                $data = intval($data);
                $data = $dbh->query('SELECT * FROM Hubs WHERE IdHub = '.$data);
                $data = $data->fetch();
                $dbh = null;
                if(!$data) echo "ERROR : No hub with this ID. <br/>";
            } catch( PDOException $e){
                echo $e->getMessage()."<br/>";
            }
        }
        $this->id = $data["IdHub"];
        $this->name = $data['LibHub'];
        $this->desc = $data['DescHub'];
        $this->userId = $data['IdUser'];
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
            $cards = $dbh->query('SELECT * FROM Cards WHERE IdHub = '.$parentId)->fetchAll();
            $this->cards = array();
            if($cards) foreach($cards as $row) $this->addCard($row);
            $dbh = null;
        } catch( PDOException $e){
            echo $e->getMessage()."<br/>";
        }
    }
    private function addCard($cardData){
        $card = new card(
            $this->parentId, 
            intval($cardData['Index']), 
            $cardData['IdCard'], 
            isset($cardData['lib']) ? $cardData['lib'] : null, 
            isset($cardData['url']) ? $cardData['url'] : null,
            $cardData['imageUrl']
        );
        $this->cards[$card->index] = $card;
    }
    function createCard($cardData){
        try{
            $dbh = getBddPDO();
            $request = $dbh->prepare('INSERT INTO Cards (`Index`, `lib`, `url`, `imageUrl`, `IdHub`) VALUES (:index, :lib, :url, :imageUrl, :IdHub);');
            $request->bindValue(':index', intval($cardData['Index']));
            if(isset($cardData['lib'])) $request->bindValue(':lib', $cardData['lib']);
            else $request->bindValue(':lib', null);
            if(isset($cardData['url'])) $request->bindValue(':url', $cardData['url']);
            else $request->bindValue(':url', null);
            $request->bindValue(':imageUrl', $cardData['imageUrl']);
            $request->bindValue(':IdHub', $this->parentId);
            $request->execute();
            $cardData["IdCard"] = intval($dbh->query('SELECT LAST_INSERT_ID()')->fetch()[0]);
            $dbh = null;
            $this->addCard($cardData);
        }catch( PDOException $e){
            echo $e->getMessage()."<br/>";
        }
    }
    function updateCard($cardData){
        try{
            $dbh = getBddPDO();
            $request = $dbh->prepare('UPDATE Cards SET `lib` = :lib, `url` = :url, `imageUrl` = :media WHERE IdCard = :id');
            $request->bindValue(':id', $cardData['id']);
            $request->bindValue(':lib', $cardData['lib']);
            $request->bindValue(':url', $cardData['url']);
            $request->bindValue(':media', $cardData['imageUrl']);
            $request->execute();
            $dbh = null;
        }catch( PDOException $e){
            echo $e->getMessage()."<br/>";
        }
    }
    function removeCard($index){
        try{
            $dbh = getBddPDO();
            foreach($this->cards as $card){
                if($card->index == $index) {
                    $dbh->query('DELETE FROM `Cards` WHERE IdCard = '.$card->id);
                } else if($card->index > $index) {
                    $card->index--;
                    $dbh->query('UPDATE Cards SET `index` = '.$card->index.' WHERE IdCard = '.$card->id);
                }
            }
            $index;
            $cards = $dbh->query('SELECT * FROM Cards WHERE IdHub = '.$this->parentId)->fetchAll();
            $this->cards = array();
            if($cards) foreach($cards as $row) $this->addCard($row);
        }catch( PDOException $e){
            echo $e->getMessage()."<br/>";
        }
    }

    function getCards($from, $to){
        $result = array();
        for($i = $from; $i <= $to; $i++){
            if(isset($this->cards[$i])) if($this->cards[$i])
                $result[$i] = $this->cards[$i];
        }
        return $result;
    }

    function getNumberOfCards(){
        return sizeof($this->cards);
    }
}

class card{
    public $id;
    public $parentId;
    public $index;
    public $name;
    public $url;
    public $imageUrl;
    function __construct($parentId, $index, $id, $name, $url, $imageUrl) {
        $this->parentId = $parentId;
        $this->index = $index;
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
        $this->imageUrl = $imageUrl;
    }
    function getJson(){
        $data = array("id" => $this->id, "index" => $this->index, "name" => $this->name, "url" => $this->url, "media" => $this->imageUrl);
        return json_encode($data);
    }
}

?>