
a = document.getElementById("canves");
c = document.getElementById("cut");
a.onclick = function () {
    menu = document.getElementById("sidebar");
    menu.style.marginLeft = "0px";
}

c.onclick = function () {
    menu = document.getElementById("sidebar");
    menu.style.marginLeft = "calc(100% - 140%)";
}

























