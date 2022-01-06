<html>

<head>
  <link href="css/index.css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"></script>
  <link href="css/bootstrap.min.css" rel="stylesheet" />


</head>

<body>
  <header>
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span><a class="navbar-brand" href="#"> Untilted</a>
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
              <span class="navbar-toggler-icon"></span><a class="navbar-brand" href="#"> Untilted</a>
            </button>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Share this hub</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Make your own hub</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
              </li>


            </ul>
            <div class="copyright">@Copyright</div>
          </div>

        </div>
      </div>

    </nav>
  </header>

  <div class="container" id="contain">
    <div class="row" id="row">

    </div>
  </div>
</body>

</html>


<script>
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
      //   var y = document.getElementById(idrow);
      //   for (i = 0; i < 10; i++) {

      //     y.innerHTML = y.innerHTML + `
      //     <div class='card'>
      //       <img class='card-img-top' src='...' alt='Card image cap'>
      //       <div class='card-body'>
      //         <h5 class='card-title'>Card title that wraps to a new line</h5>
      //         <p class='card-text'>This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      //       </div>
      //     </div>`
      //  ;
      //   }
    }
  }

  function appendCard() {

    var nbcols = getNbCols();
    
    var nbCards = 7;
      
    for(indexCard = 0; indexCard < nbCards; indexCard++) {
        idcol = `col${indexCard%nbcols}`;
        var y = document.getElementById(idcol);
        console.log(idcol, y);
      
        y.innerHTML = y.innerHTML + `
        <div class='card'>
          <img class='card-img' src='https://www.cdiscount.com/pdt2/6/9/0/1/700x700/ywe9498363441690/rw/21010-2-40x60cm-taie-d-oreiller-avec-dessin-anime.jpg' alt='Card image cap'>
          <div class=' text-bottom'>
            <h5 class='card-title'>Card title that wraps to a new line</h5>
            <p class='card-text'>t is a little bit longer.</p>
          </div>
        </div>`;
      }
    }

  

  function updateHUD(){
    createCols();
    appendCard();
  }



  window.onload = updateHUD;
  window.onresize = updateHUD;
</script>