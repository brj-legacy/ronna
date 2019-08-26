// JavaScript Document
function vyska() {
    document.getElementById("sloupec").style.height = (document.body.clientHeight) - 170;
    document.getElementById("obsah").style.height = pocatek+"px";
    
    var sloupec = document.getElementById("sloupec").scrollHeight;
    var obsah = document.getElementById("obsah").scrollHeight;

    
    if (sloupec > obsah) {
//        document.getElementById("sloupec").style.height = sloupec+"px";
        document.getElementById("obsah").style.height = sloupec+"px";
    } else {
//        document.getElementById("obsah").style.height = obsah+"px";
        document.getElementById("sloupec").style.height = obsah+"px";
    }
}

function fotka() {
	pocatek = document.getElementById("obsah").scrollHeight;
    vyska();
}

$(document).ready(function () {
    pocatek = document.getElementById("obsah").scrollHeight;
    vyska();
});

$(window).resize(function () {
    vyska();
});
