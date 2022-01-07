<html>

<head>
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- <script src="js/bootstrap.bundle.min.js"></script> -->

</head>

<body>
    <div class=" row align-items-cente"></div>

    <div class="container-sm col-4 text-center pt-5 pb-5">

        <?php

require_once("classes/user.php");
// Code PHP login
if ($_POST) {
    if (isset($_POST['LGmail']) && isset($_POST['LGpass'])) {
        if ($_POST['LGmail'] != "" && $_POST['LGpass'] != "") {
            // authentification 
            if (user::login($_POST['LGmail'], $_POST['LGpass'])) {
                header('Location: cms.php');
            }
        } else echo 'error login';
    }
    // code PHP register
    else if (isset($_POST['SGmail']) && isset($_POST['SGpass']) && isset($_POST['SGpass2'])) {
        if ($_POST['SGmail'] != "" && $_POST['SGpass'] != ""  && $_POST['SGpass2'] != "") {
            if ($_POST['SGpass'] == $_POST['SGpass2'] && !user::doesUserExist($_POST['SGmail'])) {
                // authentification 
                user::createUser(array("mail" => $_POST['SGmail'], "password" => $_POST['SGpass']));
                header('Location: login.php?s=lg');
            } else  echo 'error register'; var_dump($_POST);
        }
    }
}




        if ($_POST) {
            if (isset($_GET['hid']) && $_GET['hid'] != "") {
                $hub = new hub($_GET['hid']);
                $hubname = $hub->name;
                echo "<h1>ShareHub</h1> <br> <h3>$hubname</h3>";
            } else {
                echo "<h1>ShareHub</h1>";
            }
        } else {
            echo "<h1>ShareHub</h1>";
        }
        ?>
    </div>
    <?php



    $isSign = false;
    if ($_GET) {
        if (isset($_GET['s'])) {
            if ($_GET['s'] != "") {


                if ($_GET['s'] == "sg") {
                    $isSign = true;
    ?>
    <!-- REGISTER -->
                    <div id="loginform" class="container-sm col-4 border border-dark  " style=" border-radius:40px; ">
                        <h3 class="text-center text-black pt-3">sign in form</h3>

                        <form method="post" id="formSG" class="mb-3" onsubmit="return submitFormSG();">
                            <span id="errorsSpanSG"></span>
                            <div class="form-outline mb-4 ">
                                <label for="exampleFormControlInput1" class="form-label">mail</label>
                                <input type="text" class="form-control" name="SGmail" id="SGmail" placeholder="toto@tata.com">
                            </div>
                            <div class="form-outline mb-4">
                                <label for="exampleFormControlInput1" class="form-label">password</label>
                                <input type="password" class="form-control" name="SGpass" id="SGpass" required onblur="verif_password()" placeholder="your password here">
                            </div>
                            <div class="form-outline mb-4">
                                <label for="exampleFormControlInput1" class="form-label">confirmation</label>
                                <input type="password" class="form-control" name="SGpass2" id="SGpass2" required onblur="verif_password()" placeholder="confirm your password">
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <p><button onclick="window.location.href='login.php?s=lg'" type="button" class="btn btn-outline-primary">log in</button></p>
                                <input type="submit" class="btn btn-primary" id="signin" value="sign in"></input>

                            </div>
                        </form>
                    </div>
                    <script type="text/javascript">
                        // Vérification Mot de Passe
                        function verif_password() {
                            let passTab = [];
                            passTab.push(document.getElementById('SGpass'));
                            passTab.push(document.getElementById('SGpass2'));
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

                        // commande ajax
                        function createInstance() {
                            var req = null;
                            if (window.XMLHttpRequest) {
                                req = new XMLHttpRequest();
                            } else if (window.ActiveXObject) {
                                try {
                                    req = new ActiveXObject("Msxml2.XMLHTTP.6.0");
                                } catch (e) {
                                    try {
                                        req = new ActiveXObject("Microsoft.XMLHTTP");
                                    } catch (e) {
                                        alert("XHR not created");
                                    }
                                }
                            }
                            return req;
                        };

                        function submitFormSG() {
                            if (verif_password()) {
                                var req = createInstance();

                                req.onreadystatechange = function() {
                                    if (req.readyState == 4) {
                                        if (req.status == 200) {
                                            console.log(req.responseText);
                                            if (req.responseText == 'true') {
                                                document.getElementById("formSG").submit();
                                            }
                                        }
                                    }
                                }
                                req.open("POST", "login-ajax.php", true);
                                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                data = "SGmail=" + document.getElementById("formSG").SGmail.value + "&SGpass=" + document.getElementById("formSG").SGpass.value;
                                req.send(data);
                                console.log(req);
                            }
                            return false;
                        }
                    </script>
        <?php
                }
            }
        }
    }
    if (!$isSign) {
        ?>
        <!-- LOGIN -->
        <div id="loginform" class="container-sm col-4 border border-dark  " style=" border-radius:40px;">
            <h3 class="text-center text-black pt-3">Login form</h3>
            <form method="post" class="mb-3" action="login.php">
                <span id="errorsSpan"></span>
                <div class="form-outline mb-4 ">
                    <label for="exampleFormControlInput1" class="form-label">mail</label>
                    <input type="text" class="form-control" name="LGmail" id="LGmail" placeholder="toto@tata.com">
                </div>
                <div class="form-outline mb-4">
                    <label for="exampleFormControlInput1" class="form-label">password</label>
                    <input type="text" class="form-control" name="LGpass" id="LGpass" placeholder="your password here">
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <p><button onclick="window.location.href='login.php?s=sg'" type="button" class="btn btn-outline-primary">sign in</button></p>
                    <input type="submit" class="btn btn-primary" id="login" type="submit" value="Login"></input>
                </div>

            </form>
        </div>
        </div>
        <script>
             // commande ajax
             function createInstance() {
                            var req = null;
                            if (window.XMLHttpRequest) {
                                req = new XMLHttpRequest();
                            } else if (window.ActiveXObject) {
                                try {
                                    req = new ActiveXObject("Msxml2.XMLHTTP.6.0");
                                } catch (e) {
                                    try {
                                        req = new ActiveXObject("Microsoft.XMLHTTP");
                                    } catch (e) {
                                        alert("XHR not created");
                                    }
                                }
                            }
                            return req;
                        };

                        function submitFormLG() {
                            if (verif_password()) {
                                var req = createInstance();

                                req.onreadystatechange = function() {
                                    if (req.readyState == 4) {
                                        if (req.status == 200) {
                                            console.log(req.responseText);
                                            if (req.responseText == 'true') {
                                                document.getElementById("formLG").submit();
                                            }
                                        }
                                    }
                                }
                                req.open("POST", "login-ajax.php", true);
                                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                data = "LGmail=" + document.getElementById("formLG").LGmail.value + "&LGpass=" + document.getElementById("formLG").LGpass.value;
                                req.send(data);
                                console.log(req);
                            }
                            return false;
                        }
                    </script>
        </script>
    <?php
    }

    ?>
    </div>

</body>

</html>