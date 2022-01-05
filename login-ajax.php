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
    }else if(isset($_POST['SGmail']) && isset($_POST['SGpass'])) {
        if ($_POST['SGmail'] != "" && $_POST['SGpass'] != "") {
            if (!user::doesUserExist($_POST['SGmail'])) echo 'true';
            else echo 'false';
        }
    }else echo "ERROR : no post parameters";
}else echo "ERROR : no post";
?>
