<?php
require_once("classes/user.php");
require_once("nav.php");
$hub = null;
if ($_GET) {
  if (isset($_GET["h"])) {
    $id = intval($_GET["h"]);
    if (hub::doesHubExist($id)) {
      $hub = new hub($id);
    }
  }
} else header('Location: login.php');

$userId = false;
$user = null;
if ($_COOKIE) {
    if (isset($_COOKIE["LoggedAccount"])) {
        $userId = $_COOKIE["LoggedAccount"];
    }
}
if($userId) $user = new user($userId);

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
  <link href="css/nav.css" rel="stylesheet"/>
</head>
<body>
  <header>
    <?php getNavbar(false, $hub, $user)?>
  </header>
  <div class="container" id="contain">
    <div class="row g-1" id="row">
    </div>
  </div>
</body>

</html>