
<?php
require_once("classes/user.php");
// Code PHP Formulaire Connexion
if ($_POST) {
    if (isset($_POST['LGmail']) && isset($_POST['LGpass'])) {
        if ($_POST['LGmail'] != "" && $_POST['LGpass'] != "") {
            // authentification 
            if (user::login($_POST['LGmail'], $_POST['LGpass'])) {
               // header('Location: index.php');
               echo 'true';
            } 
        } else echo 'false';
    }
}

// code PHP REGISTER
if ($_POST) {
    if (isset($_POST['SGmail']) && isset($_POST['SGpass']) && isset($_POST['SGpass2'])) {
        if ($_POST['SGmail'] != "" && $_POST['SGpass'] != ""  && $_POST['SGpass2'] != "") {
            if ($_POST['SGpass'] == $_POST['SGpass2'] && !user::doesUserExist($_POST['SGmail'])) {
                // authentification 
                // user::createUser(array("mail" => $_POST['SGmail'], "password" => $_POST['SGpass']));
               // header('Location: login.php');

            echo 'true';
            }else if (user::doesUserExist($_POST['SGmail']))echo "utilisateur deja existant";
            else  echo 'false';
        }
    }
}
?>
