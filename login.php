<html>

<head>
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>

<body>

    <div class=" row align-items-cente"></div>

    <div class="container-sm col-4 text-center pt-5 pb-5">
        <h1>UNTILTED</h1>
        <h3>shareHub</h3>
    </div>
    <div id="loginform" class="container-sm col-4 border border-dark  " style=" border-radius:40px;" >
        <h3 class="text-center text-black pt-3">Login form</h3>

        <form method="post" class="mb-3">
            <div class="form-outline mb-4 ">
                <label for="exampleFormControlInput1" class="form-label">name</label>
                <input type="text" class="form-control" id="name" placeholder="your name here">
            </div>
            <div class="form-outline mb-4">
                <label for="exampleFormControlInput1" class="form-label">password</label>
                <input type="text" class="form-control" id="pass" placeholder="your password here">
            </div>

            <div class="d-flex justify-content-between align-items-center">
                    <input type="submit" class="btn btn-primary" id="login" type="submit" value="Login"></input>
                    <p><button onclick="window.location.href='./ex3inscription.php'" class="btn btn-primary">sign in</button></p>
            </div>
       
        </form>
    </div>
    </div>
</body>

<?php
$user = 'root';
$pass = '';
$bdd = new PDO('mysql:host=localhost;dbname=tp2', $user, $pass);


// Code PHP Formulaire Connexion
if ($_POST) {
    if (isset($_POST['name']) && isset($_POST['pass'])) {
        if ($_POST['name'] != "" && $_POST['pass'] != "") {
            // authentification 
            $verif = verif_login($_POST['name'], $_POST['pass']);
            if ($verif == true) {
                $_SESSION["name"] = $_POST['name'];
                // header('Location: index.php');
                echo "CONNECTED!!!!!";
            } else $error .= "<p>Erreur lors de la connexion !</p>"; echo "BRUH";
        }
    }
}










function verif_login($username, $password)
{
    try {
        if (!$password || !$username) {
            return false;
        } else {

            $stmt = $GLOBALS["bdd"]->prepare("SELECT * FROM user WHERE name=:name AND password=:password");
            $stmt->bindParam(":name", $username);
            $stmt->bindParam(":password", $password);
        }
        $stmt->execute();
        if ($stmt->rowCount() >= 1) return true;
        else return false;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
    } finally {
        $stmt = null;
    }
}









?>
<!-- PARTI REGISTER AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA -->
<div class="container-sm col-4 text-center pt-5 pb-5">
        <h1>UNTILTED</h1>
        <h3>shareHub</h3>
    </div>
<div id="loginform" class="container-sm col-4 border border-dark  " style=" border-radius:40px;" >
        <h3 class="text-center text-black pt-3">sign in form</h3>

<form method="post" class="mb-3" onsubmit="return verif_password()">
            <div class="form-outline mb-4 ">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="your name here">
            </div>
            <div class="form-outline mb-4">
                <label for="exampleFormControlInput1" class="form-label">password</label>
                <input type="password" class="form-control" id="pass" required onblur="verif_password()" placeholder="your password here">
            </div>
            <div class="form-outline mb-4">
                <label for="exampleFormControlInput1" class="form-label">confirmation</label>
                <input type="password" class="form-control" id="pass2"  required onblur="verif_password()"placeholder="confirm your password">
            </div>

            <div class="d-flex justify-content-between align-items-center">
                    <input type="submit" class="btn btn-primary" id="login" type="submit" value="sign in "></input>
                    <p><button onclick="window.location.href='login.php'" class="btn btn-primary">log in</button></p>
            </div>
       
        </form>

</div>






</html>



      
      