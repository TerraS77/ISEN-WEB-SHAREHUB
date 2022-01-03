<html>

<head>
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="js/bootstrap.bundle.min.js"></script>
    
</head>

<body>

    <div class=" row align-items-cente"></div>

    <div class="container-sm col-4 text-center pt-5 pb-5">

        <?php

        
        
        
        if($_POST){
        if(isset($_GET['hid']) && $_GET['hid']!="" ){
            $hub=new hub ($_GET['hid']);
            $hubname=$hub->name;
            echo "<h1>ShareHub</h1> <br> <h3>$hubname</h3>";
        }else {
            echo "<h1>ShareHub</h1>";
        }
    }else {
        echo "<h1>ShareHub</h1>";
    }
    ?>
    </div>
    <?php



    $isSign=false;
    if($_GET){
        if(isset($_GET['s'])){
            if($_GET['s']!=""){
                
               
               if($_GET['s']=="sg"){
                   $isSign=true;
                   ?>
                   <div id="loginform" class="container-sm col-4 border border-dark  " style=" border-radius:40px; ">
    <h3 class="text-center text-black pt-3">sign in form</h3>

    <form method="post" action="login.php?s=sg" class="mb-3" onsubmit="return verif_password()">
        <div class="form-outline mb-4 ">
            <label for="exampleFormControlInput1" class="form-label">mail</label>
            <input type="text" class="form-control" id="SGmail" placeholder="toto@tata.com">
        </div>
        <div class="form-outline mb-4">
            <label for="exampleFormControlInput1" class="form-label">password</label>
            <input type="password" class="form-control" id="SGpass" required onblur="verif_password()" placeholder="your password here">
        </div>
        <div class="form-outline mb-4">
            <label for="exampleFormControlInput1" class="form-label">confirmation</label>
            <input type="password" class="form-control" id="SGpass2" required onblur="verif_password()" placeholder="confirm your password">
        </div>

        <div class="d-flex justify-content-between align-items-center">
        <p><button onclick="window.location.href='login.php?s=lg'" type="button" class="btn btn-outline-primary">log in</button></p>
            <input type="submit" class="btn btn-primary" id="login" type="submit" value="sign in"></input>
            
        </div>

    </form>

</div>
                <?php
               }
               
            }

        }
    }if(!$isSign){
?>
  <div id="loginform" class="container-sm col-4 border border-dark  " style=" border-radius:40px;">
                    <h3 class="text-center text-black pt-3">Login form</h3>
            
                    <form method="post" class="mb-3">
                        <div class="form-outline mb-4 ">
                            <label for="exampleFormControlInput1" class="form-label">mail</label>
                            <input type="text" class="form-control" id="LGmail" placeholder="toto@tata.com">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="exampleFormControlInput1" class="form-label">password</label>
                            <input type="text" class="form-control" id="LGpass" placeholder="your password here">
                        </div>
            
                        <div class="d-flex justify-content-between align-items-center">
                        <p><button onclick="window.location.href='login.php?s=sg'" type="button" class="btn btn-outline-primary">sign in</button></p>
                            <input type="submit" class="btn btn-primary" id="login" type="submit" value="Login"></input>
                            
                        </div>
            
                    </form>
                </div>
                </div>
                
<?php

    }
        
    ?>
   </div>
               
</body>

<?php
require_once("./classes/user.php");




// Code PHP Formulaire Connexion
if ($_POST) {
    if (isset($_POST['LGmail']) && isset($_POST['LGpass'])) {
        if ($_POST['LGmail'] != "" && $_POST['LGpass'] != "") {
            // authentification 
            if (user::login($_POST['LGmail'], $_POST['LGpass'])) {
                echo "CONNECTED!!!!!";
                // header('Location: index.php');
            } else echo "FUUUUUCK";
        } else $error .= "<p>Erreur lors de la connexion !</p>";
        
    }
}




 ?>
                


<!-- PARTI REGISTER AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA -->
<!-- <div class="container-sm col-4 text-center pt-5 pb-5">
    <h1>UNTILTED</h1>
    <h3>shareHub</h3>
</div> -->





<?php
// code PHP REGISTER
var_dump($_POST);
if ($_POST) {
    if (isset($_POST['SGmail']) && isset($_POST['SGpass']) && isset($_POST['SGpass2'])) {
        if ($_POST['SGmail'] != "" && $_POST['SGpass'] != ""  && $_POST['SGpass2'] != "") {
            if ($_POST['SGpass'] == $_POST['SGpass2']) {
                // authentification 

                user::createUser(array("mail" => $_POST['SGmail'], "password" => $_POST['SGpass']));
                echo "REGISTERED!!!!!";

                // header('Location: login.php');

            } else $error .= "<p>Erreur lors de la connexion !</p>";
           
        }
      
    }
   
}


?>

<script type="text/javascript">
    // Vérification Mot de Passe
    function verif_password() {
        let passTab = [];
        passTab.push(document.getElementById('pass'));
        passTab.push(document.getElementById('pass2'));
        if (passTab[0].value == passTab[1].value && passTab[0].value == "") { // champs vides
            passTab[0].style.border = "solid black 1px";
            passTab[1].style.border = "solid black 1px";
            return false;
        } else if (passTab[0].value != passTab[1].value) { // champs different
            passTab[0].style.border = "solid black 1px";
            passTab[1].style.border = "solid red 1px";
            return false;
        } else if (passTab[0].value == passTab[1].value && passTab[0].value != "") { // champs egaux
            passTab[0].style.border = "solid green 1px";
            passTab[1].style.border = "solid green 1px";
            return true;
        }
    }
</script>


</html>