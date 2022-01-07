<html>

<head>
    <script src="js/bootstrap.bundle.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/cms.css" rel="stylesheet">
</head>

<?php

require_once('classes/user.php');

$userId = false;
if ($_COOKIE) {
    if (isset($_COOKIE["LoggedAccount"])) {
        $userId = $_COOKIE["LoggedAccount"];
    }
}
if (!$userId) header('Location: login.php');

$user = new user($userId);
$hub = $user->getHub();

if ($hub) { ?>

    <body>
        <div class=" col-3 p-4 ">
            <h1>My Hub</h1>
            <h3>ShareHub</h3>
        </div>


        <script>
            const hub = {
                name: "<?= $hub->name ?>",
                id: <?= $hub->id ?>
            }
        </script>



        <!-- <div class="container table border border-dark" style=" border-radius:40px; "> -->
            <div class="pl-100 sss" style="padding-left: 100px;padding-right: 100px;">
        <table class="table">
            <!-- TOP LINE -->
            <thead>
                <tr>
                    <th scope="col">image</th>
                    <th scope="col">name</th>
                    <th scope="col">link</th>
                    <th scope="col"></th>
                    <th scope="col"><a class="btn btn-outline-primary" href="addCard.php" style="">+ NEW</a></th>
                </tr>
            </thead>
           
            
            <tbody>
                <?php
                foreach ($hub->cards->getCards(0, 50) as $row) {

                ?>
                    <tr>
                        <th scope="row" class="col-3 ml-10 mt-2 d-flex "> <img class="image" height="50px" src='<?= $row->imageUrl ?>'></img></th>
                        <td><?= $row->name ?></td>
                        <td><?= $row->url ?></td>
                        <td>edit</td>
                        <td>delete</td>
                    </tr>

                   

                <?php
                }
                ?>


            </tbody>
        </div></div>




        
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
            <h3 class="text-center text-black pt-3">new hub</h3>

            <form method="post" id="formNH" class="mb-3">
                <span id="errorsSpanSG"></span>
                <div class="form-outline mb-4 ">
                    <label for="exampleFormControlInput1" class="form-label">title</label>
                    <input type="text" class="form-control" name="hubTitle" id="hubTitle">
                </div>
                <div class="form-outline mb-4">
                    <label for="exampleFormControlInput1" class="form-label">description</label>
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