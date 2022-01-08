async function getCards(from, to){
    //returning a promise 
    return new Promise((resolve, reject) => {
        var req = createInstance();
        req.onreadystatechange = function () {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    resolve(JSON.parse(req.responseText));
                } 
            }
        }
        req.open("POST", "card-ajax.php", true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        data = "h=" + hub.id + "&f=" + from + "&t=" + to;
        req.send(data);
    });
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

function isCardVisible(card){
    if(!card) return true;
    return new Promise((resolve, reject) => {
        var observer = new IntersectionObserver(function(entries) {
            if(entries[0]['isIntersecting'] === true) {
                resolve(true);
            }
            else {
                resolve(false);
            }
        }, { threshold: [0, 0.5, 1] });
        observer.observe(card);
    });
}