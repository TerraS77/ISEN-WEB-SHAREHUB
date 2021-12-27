<html>

<head>
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <!--  SOURCE== https://bootsnipp.com/snippets/bxzmb  -->
    <!------ Include the above in your HEAD tag ---------->
</head>

<body>
    <h1>truc</h1>
    <p> trucazer</p>
    <div id="login" class="container">
        <h3 class="text-center text-white pt-5">Login form</h3>
       
            <!-- <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">username</label>
                <input type="text" class="form-control" id="username" placeholder="your username here">
    </div>
    <?php
    // Code PHP Formulaire Connexion
    if ($_POST) {
        if (isset($_POST['name']) && isset($_POST['pass'])) {
            if ($_POST['name'] != "" && $_POST['pass'] != "") {
                // authentification 
                $verif = verif_login($_POST['name'], $_POST['pass']);
                if ($verif == true) {
                    $_SESSION["name"] = $_POST['name'];
                    header('Location: login.php');
                } else $error .= "<p>Erreur lors de la connexion !</p>";
            }
        }
    }
    ?>
</body>

</html>