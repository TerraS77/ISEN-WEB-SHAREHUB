<?php
require_once("classes/hub.php");
$hub = null;
if ($_GET) {
  if (isset($_GET["h"])) {
    $id = intval($_GET["h"]);
    if (hub::doesHubExist($id)) {
      $hub = new hub($id);
    }
  }
} else header('Location: login.php');
?>

<script>
  const hub = {
    name: "<?= $hub->name ?>",
    id: <?= $hub->id ?>,
    size: <?= $hub->cards->getNumberOfCards() ?>
  }
</script>

<html>

<head>
  <link href="css/index.css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/getCards.js"></script>
  <script src="js/index.js"></script>
  <link href="css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <header>
    <nav class="navbar navbar-light bg-light">
      <div class="nav ">
        <button class="navbar-toggler navaff" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon "></span>
        </button><div class="navaff menutaille"><?= $hub->name ?></div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <div class="d-flex align-items-center justify-content-center"> 
          <div class="menutaille"><?= $hub->name ?></div></div>
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
    <div class="row g-1" id="row">
    </div>
  </div>
</body>

</html>