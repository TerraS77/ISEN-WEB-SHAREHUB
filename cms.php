<html>

<head>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/cms.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/cms.css" rel="stylesheet" />
    <link href="css/nav.css" rel="stylesheet" />
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>

<?php

require_once('classes/user.php');
require_once("nav.php");

$userId = false;
if ($_COOKIE)
    if (isset($_COOKIE["LoggedAccount"]))
        $userId = $_COOKIE["LoggedAccount"];
if (!$userId) header('Location: login.php');

$user = new user($userId);
$hub = $user->getHub();

if ($_POST) {
    if (isset($_POST['cardDel'])) {
        $hub->cards->removeCard($_POST['cardDel']);
    }
    if (isset($_POST['modalAction'])) {
        if ($_POST['modalAction'] == "edit")
            $hub->cards->updateCard(array("id" => $_POST['modalId'], "lib" => $_POST['modalName'], "url" => $_POST['modalURL'], "imageUrl" => $_POST['modalMedia']));
        if ($_POST['modalAction'] == "create")
            $hub->cards->createCard(array("Index" => $hub->cards->getNumberOfCards(), "lib" => $_POST['modalName'], "url" => $_POST['modalURL'], "imageUrl" => $_POST['modalMedia']));
        header("Refresh:0");
    }
}

if ($hub) { ?>

    <body>
        <?php getNavbar(true, $hub, $user); ?>
        <script>
            const hub = {
                name: "<?= $hub->name ?>",
                id: <?= $hub->id ?>
            }
        </script>
        <?php require_once("cms-cardmanager.php"); ?>
        <div class="container">
            <div class="pl-100 table-cont">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">URL</th>
                            <th scope="col"></th>
                            <th scope="col"><button type="button" class="btn btn-outline-primary" onclick="spawnModal(true, null, null, null, null)">NEW</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($hub->cards->getCards(0, $hub->cards->getNumberOfCards()) as $row) { ?>
                            <tr>
                                <td><img class="image" height="50px" src='<?= $row->imageUrl ?>'></img></td>
                                <td><?= $row->name ?></td>
                                <td><?= $row->url ?></td>
                                <td><button type="button" class="btn btn-outline-secondary" onclick="spawnModal(false, '<?= $row->id ?>', '<?= $row->name ?>', '<?= $row->url ?>', '<?= $row->imageUrl ?>')">edit</button></td>
                                <form action="./cms.php" method="post">
                                    <input type="hidden" name="cardDel" value="<?= $row->index ?>">
                                    <td><input type="submit" class="btn btn-danger" id="supprbtn" value="delete"></input></td>
                                </form>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
<?php

} else {
?>

    <!-- creation nouveau hub -->
    <div class=" col-3 p-4 ">
        <?php
        $isAHubInit = false;
        if ($_POST) {
            if (isset($_GET['hid']) && $_GET['hid'] != "") {
                $hub = new hub($_GET['hid']);
                $hubname = $hub->name;
                echo "<h1>$hubname</h1> <br> <h3>ShareHub</h3>";
                $isAHubInit = true;
            }
        }
        if (!$isAHubInit) {
            echo "<h1>New Hub</h1>";
            echo "<h3>ShareHub</h3>";
        }
        ?>
    </div>

    <body>
        <div id="loginform" class="container-sm col-4 border border-dark" style="border-radius:40px;">
            <h3 class="text-center text-black pt-3">New Hub</h3>
            <form method="post" id="formNH" class="mb-3" onsubmit="return submitFormNH();">
                <span id="errorsSpanNH"></span>
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
    if ($_POST) {
        if (isset($_POST['hubTitle']) && isset($_POST['hubDescription'])) {
            if ($_POST['hubTitle'] != "" && $_POST['hubDescription'] != "") {
                hub::createHub(array("LibHub" => $_POST['hubTitle'], "DescHub" => $_POST['hubDescription'], "IdUser" => $user->id));
                header('Location: cms.php');
            } else echo 'error login';
        }
    }
}
?>
<script>

function submitFormNH() {
    
       
        form = document.getElementById("formNH");
        
                    if (verif_NH== 'true') {
                        form.submit();
                    }else document.getElementById("errorsSpanSG").innerHTML = `<div class="alert alert-danger" role="alert"> fill the title and the description </div>`; //ERROR   
}

function verif_NH() {
    let passTab = [];
    passTab.push(document.getElementById('hubTitle'));
    passTab.push(document.getElementById('hubDescription'));
    if (passTab[0].value == passTab[1].value && passTab[0].value == "") { // champs vides
        return false;
    } else return true;
}

</script>

</html>