//cookies
function getCookie(cname, val) {
    var cookieName = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var cookies = decodedCookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        cookie = cookie.trimStart();

        if (cookie.indexOf(cookieName) === 0) {
            var userData = cookie.split(',');
            if (userData[0].charAt(3) === '=') {
                userData[0] = userData[0].substring(4);
            }
            return userData[val];
        }
    }
    return "";
}

function setCookie() {
    var u_login = document.getElementById("login").value;
    var u_email = document.getElementById("email").value;
    var curDate = new Date();
    curDate.setTime(curDate.getTime() + (1 * 60 * 60 * 1000));
    var expires = curDate.toUTCString();
    document.cookie = "log=" + u_login + "," + u_email + ";expires=" + expires + ";path=/";
}

function unsetCookie() {
    document.cookie = "log=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
}

function callFromCookie() {

    if (document.cookie) {
        document.getElementById("login").value = getCookie("log", 0);
        document.getElementById("email").value = getCookie("log", 1);
    }
}