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

function appendCard() {
    var nbcols = getNbCols();
    var nbCards = 7;
    for (indexCard = 0; indexCard < nbCards; indexCard++) {
        idcol = `col${indexCard % nbcols}`;
        var y = document.getElementById(idcol);
        console.log(idcol, y);
        var urlcomplet = "www.youtube.com";
        urlaff= urlcomplet.slice(0,16);
        y.innerHTML = y.innerHTML + `
         <div class='card espace data-toggle="tooltip.show" text-center'>
         <img class='card-img' src='https://pbs.twimg.com/media/EKvrgoOX0AM1_oz.jpg' alt='Card image cap'>
          <div class=' text-bottom'>
            <p class='card-title text-center title'>Title of the link</p>
            <div class="d-flex justify-content-between align-items-center">
              <button class="btn btn-outline-light taille " type="button">${urlaff}</button>
            </div>
          </div>
        </div>`;
    }
}



function updateHUD() {
    createCols();
    appendCard();
    getCards(0,2, function(card){
        console.log(card);
    });
}



window.onload = updateHUD;
window.onresize = updateHUD;