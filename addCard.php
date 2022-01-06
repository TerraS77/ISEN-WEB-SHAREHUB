<html>

<head>
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- <script src="js/bootstrap.bundle.min.js"></script> -->

</head>
<?php

require_once('classes/hub.php');
require_once('classes/user.php');

$userId = false;
if ($_COOKIE) {
    if (isset($_COOKIE["LoggedAccount"])) {
        $userId = $_COOKIE["LoggedAccount"];
    }
}
// if(!$userId) header('Location: login.php');

$user = new user($userId);
$hub = $user->getHub();
?>

<div class=" col-3 p-4 ">
    <?php
    if ($_POST) {
        if (isset($_GET['hid']) && $_GET['hid'] != "") {
            $hub = new hub($_GET['hid']);
            $hubname = $hub->name;
            echo "<h1>$hubname</h1> <br> <h3>ShareHub</h3>";
        } else {
            echo "<h1>New Hub</h1>";
            echo "<h3>ShareHub</h3>";
        }
    } else {
        echo "<h1>New Hub</h1>";
        echo "<h3>ShareHub</h3>";
    }
    ?>

</div>

<body>
    <div id="loginform" class="container-sm col-4 border border-dark  " style=" border-radius:40px; ">
        <h3 class="text-center text-black pt-3">New Card</h3>

        <form method="post" id="formNC" class="mb-3">
            <span id="errorsSpanSG"></span>
            <div class="form-outline mb-4 ">
                <label for="exampleFormControlInput1" class="form-label">title</label>
                <input type="text" class="form-control" name="cardtitle" id="hubTitle">
            </div>
            <div class="form-outline mb-4">
                <label for="exampleFormControlInput1" class="form-label">link</label>
                <input type="text" class="form-control" name="link" id="hubDescription">
            </div>
            <div class="form-outline mb-4">
                <label for="exampleFormControlInput1" class="form-label">image URL</label>
                <input type="text" class="form-control" name="URLpng" id="URLpng">
            </div>

            <div class="d-flex justify-content-center align-items-center">
                <input type="submit" class="btn btn-primary" id="creatbutt" value="confirm"></input>

            </div>
        </form>
    </div>
    <div class="pl-4" style="padding-left:20!important">
        <a href="cms.php" class=" btn btn-outline-secondary">&laquo; back</a>
    </div>
</body>
<script>
                const hub = {
                    name: "<?= $hub->name ?>",
                    id: <?= $hub->id ?>
                }
            </script>
<?php
require_once("classes/hub.php");





var_dump($_POST);

if ($_POST) {
    if (isset($_POST['cardtitle']) && isset($_POST['link']) && isset($_POST['URLpng'])) {
        if ($_POST['cardtitle'] != "" && $_POST['link'] != "" && $_POST['URLpng'] != "") {
            // authentification 
            
            $hub->cards->createCard(array("Index" => $hub->cards->getNumberOfCards(), "lib" => $_POST['cardtitle'], "url" => $_POST['link'], "imageUrl" => $_POST['URLpng']));
            header('Location: cms.php');
        } else echo 'error ';
    } else echo 'error';
}

var_dump($_POST);
?>

</html>