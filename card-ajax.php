<?php

require_once("classes/hub.php");
function getJson($c){
    return json_decode($c->getJson());
}

if($_POST){
    $id = intval($_POST["h"]);
    if(hub::doesHubExist($id)){
        $hub = new hub($id);
        $cards = $hub->cards->getCards(intval($_POST["f"]), intval($_POST["t"]));
        echo json_encode(array_map('getJson', $cards));
    }
}

?>