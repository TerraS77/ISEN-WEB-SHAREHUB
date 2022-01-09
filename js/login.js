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
        form = document.getElementById("form-signin");
        req.onreadystatechange = function () {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    if (req.responseText == 'true') {
                        form.submit();
                    }else document.getElementById("errorsSpanSG").innerHTML = `<div class="alert alert-danger" role="alert"> This mail is already linked to an existing account.</div>`; //ERROR
                }
            }
        }
        req.open("POST", "login-ajax.php", true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        data = "SGmail=" + form.querySelector("#SGmail").value + "&SGpass=" + form.querySelector("#SGpass").value;
        req.send(data);
    }
    return false;
}

function submitFormLG() {
    var req = createInstance();
    form = document.getElementById("form-login");
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            if (req.status == 200) {
                if (req.responseText == 'true') {
                    form.submit();
                }else document.getElementById("errorsSpanLG").innerHTML = `<div class="alert alert-danger" role="alert"> Incorrect mail or password.</div>`;//ERROR
            }
        }
    }
    req.open("POST", "login-ajax.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    data = "LGmail=" + form.querySelector("#LGmail").value + "&LGpass=" + form.querySelector("#LGpass").value;
    req.send(data);
    return false;
}