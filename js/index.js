CARDS = []; 

function getNbCols() {
    var Lscreen = window.innerWidth;
    var NbCard = Math.floor(Lscreen / 255);
    return NbCard;
}

function createCols() {
    var NbCols = getNbCols();
    var x = document.getElementById("row");
    x.innerHTML = "";
    for (k = 0; k < NbCols; k++) {
        var idrow = "col";
        idrow = idrow.concat(k);
        x.innerHTML = x.innerHTML + `<div class='col' id="${idrow}"></div>`;
    }
}

function appendCard(card) {
    console.log(card);
    if(!card) return;
    if(document.getElementById('card'+card.index)) return;
    var nbcols = getNbCols();
    idcol = `col${card.index % nbcols}`;
    var y = document.getElementById(idcol);
    console.log(idcol, y);
    urlaff = card.url.slice(0,8) == "https://" ? card.url.substring(8) : card.url;
    if(urlaff.slice(0,7) == "http://") urlaff = urlaff.substring(7);
    if(urlaff.slice(0,4) == "www.") urlaff = urlaff.substring(4);
    urlaff = urlaff.slice(0,20);
    urlaff += "...";
    var affurl ="normal";
    if(!card.url){
        affurl="hiddenText";
        urlaff="";
    }
    y.innerHTML = y.innerHTML + `
        <div class='card espace data-toggle="tooltip.show" text-center' id="card${card.index}">
        <img class='card-img img-fluid' src='${card.media}' alt='Card image cap'> <div class=' text-bottom'>
        <p class='card-title text-center title affi'>${card.name}</p>
        <div class="d-flex justify-content-center align-items-center affi ${affurl}">
        <a class="btn btn-outline-light taille affi ${affurl}" href="${card.url}" target="_blank" role="button">${urlaff} <svg class="redim" xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
        <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg></a>
        </div></div></div>`;
}

async function loadCards(from, to){
    cards = await getCards(from, to);
    console.log(cards);
    for(i = from; i <= to; i++)
        if(cards[i]) CARDS[i] = cards[i];
}

function getLastCard(){
    cards = document.querySelectorAll(".card");
    if(!cards) return null;
    return cards[cards.length-1];
}

async function updateHUD(){
    wi = parseInt(getLastCard().id.substring(4))+1;
    while(await isCardVisible(getLastCard()) && wi < hub.size) {
        if(!CARDS[wi]) await loadCards(wi, wi+4);
        appendCard(CARDS[wi]);
        wi++;
    }
}

async function generateHUD() {
    createCols();
    wi = 0;
    while(await isCardVisible(getLastCard()) && wi < hub.size) {
        if(!CARDS[wi]) await loadCards(wi, wi+4);
        appendCard(CARDS[wi]);
        wi++;
    }
    console.log(CARDS);
}

window.onload = generateHUD;
window.onresize = generateHUD;
window.onscroll = updateHUD;