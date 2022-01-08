<html>

<head>
    <script src="js/bootstrap.bundle.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/cms.css" rel="stylesheet">
    <link href="css/nav.css" rel="stylesheet"/>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>

<?php

require_once('classes/user.php');
require_once("nav.php");

$userId = false;
if ($_COOKIE) {
    if (isset($_COOKIE["LoggedAccount"])) {
        $userId = $_COOKIE["LoggedAccount"];
    }
}
if (!$userId) header('Location: login.php');

if ($_POST) {
    if (isset($_POST['cardDel']) ) {
        $hub->cards->removeCard($_POST['cardDel']);
    }
}

$user = new user($userId);
$hub = $user->getHub();


if ($hub) { ?>
    <body>
        <?php 
       getNavbar(true, $hub, $user);
        ?>
        <div class=" col-3 p-4 ">
            <h1><?=$hub->name?></h1>
            <h3>ShareHub</h3>
        </div>
        <script>
            const hub = {
                name: "<?= $hub->name ?>",
                id: <?= $hub->id ?>
            }
        </script>

        <div class="pl-100 table-cont">
            <table class="table">
                <thead>
                    <tr >
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">URL</th>
                        <th scope="col"></th>
                        <th scope="col"><a class="btn btn-outline-primary" href="addCard.php">+ NEW</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hub->cards->getCards(0, 50) as $row) { ?>
                        <tr>
                            <td><img class="image" height="50px" src='<?= $row->imageUrl ?>'></img></td>
                            <td><?= $row->name ?></td>
                            <td><?= $row->url ?></td>
                            
                            <form action="./editcard.php" method="post">
                                    <input type="hidden" name="editId" value="<?= $row->id ?>">
                                    <input type="hidden" name="editIMG" value="<?= $row->imageUrl ?>">
                                    <input type="hidden" name="editName" value="<?= $row->name ?>">
                                    <input type="hidden" name="editLink" value="<?= $row->url ?>">
                                
                                <td><input type="submit" class="btn btn-secondary" id="supprbtn" value="edit"></input></td>
                                </form>
                            <!-- <td>edit</td> -->
                            <form action="./cms.php" method="post">
                                <input type="hidden" name="cardDel" value="<?= $row->index ?>">
                                <td><input type="submit" class="btn btn-danger" id="supprbtn" value="delete"></input></td>
                            </form>
                        </tr>
                    <?php } ?>


                </tbody>
        </div>
        </div>





        </table>




    </body>





<?php

} else {
?>

    <!-- creation nouveau hub -->
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

        <!-- <div class=" col-3 p-4 ">
                    <h1>New Card</h1>
                    <h3>ShareHub</h3>
                </div>-->
    </div>

    <body>
        <div id="loginform" class="container-sm col-4 border border-dark  " style=" border-radius:40px; ">
            <h3 class="text-center text-black pt-3">New Hub</h3>

            <form method="post" id="formNH" class="mb-3">
                <span id="errorsSpanSG"></span>
                <div class="form-outline mb-4 ">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" class="form-control" name="hubTitle" id="hubTitle">
                </div>
                <div class="form-outline mb-4">
                    <label for="exampleFormControlInput1" class="form-label">Description</label>
                    <input type="text" class="form-control" name="hubDescription" id="hubDescription">
                </div>

                <div class="d-flex justify-content-center align-items-center">
                    <input type="submit" class="btn btn-primary" id="creatbutt" value="create"></input>
                </div>
            </form>
        </div>

    </body>

    <?php
    // Code PHP Formulaire Connexion
    if ($_POST) {
        if (isset($_POST['hubTitle']) && isset($_POST['hubDescription'])) {
            if ($_POST['hubTitle'] != "" && $_POST['hubDescription'] != "") {
                // authentification 

                hub::createHub(array("LibHub" => $_POST['hubTitle'], "DescHub" => $_POST['hubDescription'], "IdUser" => $user->id));
                header('Location: cms.php');
            } else echo 'error login';
        }
    }
    ?>

<?php
}
?>


</html>