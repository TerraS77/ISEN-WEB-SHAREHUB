# HUB
> PROPRIETES
* $id : Id du hub
* $name : Nom du hub;
* $desc : Description du hub;
* $userId : Id du propriétaire;
* $cards : Card Manager du hub;
> METHODES
* _static_ createHub($data) : Créé un nouveau hub à partir d'un array() de paramètres. 

# CARD MANAGER
> PROPRIETES
* $parentId : Id du hub parent
> METHODES
* createCard($cardData) : Créé une nouvelle carte à partir d'un array() de paramètres. 
* removeCard($index) : Supprime une carte à partir de son index.
* getCards($from, $to) : Récupère un array() de cartes à partir de leurs index (getCards(0, 2) retourne les cartes d'index 0 à 2 existantes.)