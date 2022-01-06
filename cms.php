<html>
    <head>
        <script src="js/bootstrap.bundle.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" />
    </head>

    <div class=" col-3 p-4 ">
    <h1>My Hub</h1>
    <h3>ShareHub</h3>
    </div>

    <div class="container border border-dark" style=" border-radius:40px; ">
        <div class="topline col-12 d-flex border border-dark" style=" border-radius:40px; ">
        <div class="col-1 pl-10"><p>image</p></div>
        <div class="col-2"><p>name</p></div>
        <div class="col-4"><p>link</p></div>
        <div class="col-3"><p>date of creation</p></div>
        <div class="col-1"><p></p></div>
        <div class="col-1"><p>+ NEW</p></div>
        </div>

        <div class="listOfTasks">
                    <?php
                    try {
                        $dbh = new PDO("mysql:host=localhost;dbname=tp2", $user, $pass);
                        $stmt = $dbh->prepare("SELECT * FROM tasks WHERE idu=? ORDER BY state, id DESC");
                        $stmt->bindParam(1, $_SESSION["idu"]);
                        $stmt->execute();
                        foreach ($stmt as $row) { ?>
                            <div style="border:1px black solid;<?= $row["state"]?"background-color:grey;":""; ?>" class="task1" name="task1" id="task1">
                                <form action="todo.php" method="post" id="changeState<?= $row["id"] ?>">
                                    <input type="hidden" name="taskToChange" value="<?= $row["id"] ?>">
                                    <input onchange="document.getElementById('changeState<?= $row["id"] ?>').submit();" type="checkbox" name="state" <?= $row["state"]?"checked":""; ?>>
                                </form>
                                <div class="taskDesc"><?= $row["description"] ?></div>
                                <form action="./todo.php" method="post">
                                    <input type="hidden" name="taskId" value="<?= $row["id"] ?>">
                                    <input type="submit" value="Del">
                                </form>
                            </div>
                    <?php }
                    } catch (PDOException $error) {
                    } finally {
                    }
                    ?>
                </div>


    </div>













<?php

require_once('classes/hub.php');

$userId = false; 
if($_COOKIE){
    if(isset($_COOKIE["LoggedAccount"])){
        $userId = $_COOKIE["LoggedAccount"];
    }
}
// if(!$userId) header('Location: login.php');

$user = new user($userId);
$hub = $user->getHub();

if($hub){ ?>

    <body>
    <body>

<?php
}else{
?>

  <!-- creation nouveau hub -->
<div class=" col-3 p-4 ">
    <h1>New Hub</h1>
    <h3>ShareHub</h3>
    </div>
    <body>
    <div id="loginform" class="container-sm col-4 border border-dark  " style=" border-radius:40px; ">
                        <h3 class="text-center text-black pt-3">new hub</h3>

                        <form method="post" id="formSG" class="mb-3">
                            <span id="errorsSpanSG"></span>
                            <div class="form-outline mb-4 ">
                                <label for="exampleFormControlInput1" class="form-label">title</label>
                                <input type="text" class="form-control" name="hubTitle" id="hubTitle">
                            </div>
                            <div class="form-outline mb-4">
                                <label for="exampleFormControlInput1" class="form-label">description</label>
                                <input type="password" class="form-control" name="hubDescription" id="hubDescription" >
                            </div>
                          
                            <div class="d-flex justify-content-center align-items-center">
                                <input type="submit" class="btn btn-primary" id="creatbutt" value="create"></input>

                            </div>
                        </form>
                    </div>
        
    <body>

    <?php
// Code PHP Formulaire Connexion
if ($_POST) {
    if (isset($_POST['hubTitle']) && isset($_POST['hubDescription'])) {
        if ($_POST['hubTitle'] != "" && $_POST['hubDescription'] != "") {
            // authentification 
            
             hub::createHub(array("LibHub"=>$_POST['hubTitle'],"DescHub"=>$_POST['hubDescription'],"IdUser"=>$user->id));
             header('Location: cms.php');
              
            
        } else echo 'error login';
    }
}
?>   
   
<?php
} 
?>























</html>