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





<?php
var_dump($_POST);
if ($_POST) {
    if (isset($_POST['editId']) && isset($_POST['editIMG']) && isset($_POST['editName']) && isset($_POST['editLink'])) {
        if ($_POST['editId'] != "" && $_POST['editIMG'] != "" && $_POST['editName'] != "" && $_POST['editLink'] != "") {
?>

            <body>
                <div id="loginform" class="container-sm col-4 border border-dark  " style=" border-radius:40px; ">
                    <h3 class="text-center text-black pt-3">Edit Card</h3>

                    <form method="post" class="mb-3">
                    <input type="hidden" name="editId" value="<?= $_POST['editId'] ?>">
                        <span id="errorsSpanSG"></span>
                        <div class="form-outline mb-4 ">
                            <label for="exampleFormControlInput1" class="form-label">title</label>
                            <input type="text" class="form-control" name="updateTitle" id="hubTitle" placeholder="<?= $_POST['editName'] ?>">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="exampleFormControlInput1" class="form-label">link</label>
                            <input type="text" class="form-control" name="updateLink" id="hubDescription" placeholder="<?= $_POST['editLink'] ?>">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="exampleFormControlInput1" class="form-label">image URL: <img class="image" height="50px" src='<?= $_POST['editIMG'] ?>'></img></label>
                            <input type="text" class="form-control" name="updateURLpng" id="URLpng" placeholder="<?= $_POST['editIMG'] ?>">
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
<?php } else echo "baba1";
    }else echo "baba2";
}else echo "baba3";

if ($_POST) {
    if (isset($_POST['editId']) && isset($_POST['updateTitle']) && isset($_POST['updateLink']) && isset($_POST['updateURLpng'])) {
        if ($_POST['editId'] != "" && $_POST['updateTitle'] != "" && $_POST['updateLink'] != "" && $_POST['updateURLpng'] != "") { 
            
            $hub->cards->updateCard(array("id" => $_POST['editId'], "lib" => $_POST['updateTitle'], "url" => $_POST['updateLink'], "imageUrl" => $_POST['updateURLpng']));
            header('Location: cms.php');
            echo "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        }else echo "1";
    }else echo "2";
}else echo "3";
var_dump($_POST);

?>


<script>
    const hub = {
        name: "<?= $hub->name ?>",
        id: <?= $hub->id ?>
    }
</script>
<?php
require_once("classes/hub.php");







?>

</html>