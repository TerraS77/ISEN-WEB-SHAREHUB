async function getCards(from, to, printCard) {
    var req = createInstance();
    req.onreadystatechange = function () {
        if (req.readyState == 4) {
            if (req.status == 200) {
                JSON.parse(req.responseText).map(x => JSON.parse(x)).forEach(card => {
                    printCard(card);
                });
            } 
        }
    }
    req.open("POST", "card-ajax.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    data = "h=" + hub.id + "&f=" + from + "&t=" + to;
    req.send(data);
    return false;
}

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