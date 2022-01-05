<html>

<head>
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <script language="JavaScript">
        function createInstance() {
            var req = null;
            if (window.XMLHttpRequest) {
                req = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                try {
                    req = new ActiveXObject("Msxml2.XMLHTTP");
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
    </script>

    <div class=" row align-items-cente"></div>

    <div class="container-sm col-4 text-center pt-5 pb-5">

        <?php




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
                    <div id="loginform" class="container-sm col-4 border border-dark  " style=" border-radius:40px; ">
                        <h3 class="text-center text-black pt-3">sign in form</h3>

                        <form method="post" id="formSG" class="mb-3" onsubmit="submitFormSG();">
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
                                <input type="submit" class="btn btn-primary" id="login" type="submit" value="sign in"></input>

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





                        function submitFormSG() {
                            if (verif_password()) {
                                var req = createInstance();

                                req.onreadystatechange = function() {
                                    if (req.readyState == 4) {
                                        if (req.status == 200) {
                                            if (req.responseText == 'true') {

                                                // user::createUser(array("mail" => $_POST['SGmail'], "password" => $_POST['SGpass']));
                                                // // header('Location: login.php?s=lg');
                                                // echo "YOUHOUUUUU";
                                                document.getElementById("formSG").submit();
                                            }

                                        } else {
                                            document.getElementById("errorsSpanSG").innerHTML = "Il y a eu une erreur! < br > "
                                        }
                                    } else {
                                        alert("Error: returned status code " + req.status + " " + req.statusText);
                                    }
                                }
                                req.open("POST", "login-ajax.php", true);
                                req.setRequestHeader("Content-type", "application/x-www-formurlencoded");
                                req.send("SGmail=" + form.SGmail.value + "&SGpass=" + form.SGpass.value);
                            }

                            // req.open("GET", "ajax-get.php", true);
                            // req.send(null);
                            alert("send");
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
            let xhr = initXHR();

            function connexion(form, callBack) {
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        callBack(this.responseText);
                    }
                };
                xhr.open("POST", "login-ajax.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-formurlencoded");
                xhr.send("LGmail=" + form.LGmail.value + "&LGpass=" +
                    form.LGpass.value);
                return false;
            }
        </script>
    <?php
    }

    ?>
    </div>

</body>



<!-- user::createUser(array("mail" => $_POST['SGmail'], "password" => $_POST['SGpass'])); -->




</html>