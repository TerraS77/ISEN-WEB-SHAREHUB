<?php
require_once("classes/user.php");
require_once("nav.php");
$hub = null;
$userId = false;
$user = null;

if ($_COOKIE) {
  if (isset($_COOKIE["LoggedAccount"])) {
    $userId = $_COOKIE["LoggedAccount"];
  }
}
if ($userId) $user = new user($userId);

if ($_GET) {
  if (isset($_GET["h"])) {
    $id = intval($_GET["h"]);
    if (hub::doesHubExist($id)) {
      $hub = new hub($id);
    }
  }
} else {
  if (!$user) header('Location: login.php');
  else {
    $userHub = $user->getHub();
    if (!$userHub) header('Location: cms.php');
    else header('Location: ?h=' . $userHub->id);
  }
}

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
  <link href="css/nav.css" rel="stylesheet" />
</head>

<body>
  <header>
    <?php getNavbar(false, $hub, $user) ?>
  </header>
  <div class="container" id="contain">
    <div class="row g-1" id="row">
    </div>
  </div>
</body>

</html>