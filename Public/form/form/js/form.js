// User Name

function valusername(msg, msgloc) {
    
    "use strict";
    
    document.getElementById(msgloc).innerHTML = msg;
    
}

function usernamef() {
    
    "use strict";
    
    var username = document.getElementById("username").value;
    
    if (username.length === 0) {
        valusername("User Name Is Required", "lausername");
        return false;
    } else {
        valusername("OK", "lausername");
        return true;
    }
    
}



// Password

function valpas(msg, msgloc) {
    
    "use strict";
    
    document.getElementById(msgloc).innerHTML = msg;
    
}

function pasf() {
    
    "use strict";
    
    var pas = document.getElementById("pas").value;
    
    if (pas.length === 0) {
        valpas("Password Is Required", "lapas");
        return false;
    } else if (pas.length < 5 || pas.length > 12) {
        valpas("Pleas Enter 5-12 Charactar", "lapas");
        return false;
    } else {
        valpas("OK", "lapas");
        return true;
    }
    
}

// Password2

function valpas2(msg, msgloc) {
    
    "use strict";
    
    document.getElementById(msgloc).innerHTML = msg;
    
}

function pas2f() {
    
    "use strict";
    
    var pas = document.getElementById("pas").value,
        pas2 = document.getElementById("pas2").value;
    
    if (pas2 === pas) {
        valpas2("OK", "lapas2");
        return true;
    } else {
        valpas2("Passwords Don't Match", "lapas2");
        return false;
    }
    
}

// E-Mail

function valemail(msg, msgloc) {
    
    "use strict";
    
    document.getElementById(msgloc).innerHTML = msg;
    
}

function emailf() {
    
    "use strict";
    
    var email = document.getElementById("email").value;
    
    if (email.length === 0) {
        valemail("E-Mail Is Required", "laemail");
        return false;
    } else {
        valemail("OK", "laemail");
        return true;
    }
    
}

// name

function valname(msg, msgloc) {
    
    "use strict";
    
    document.getElementById(msgloc).innerHTML = msg;
    
}

function namef() {
    
    "use strict";

    var name = document.getElementById("name").value;
    
    if (name.length === 0) {
        valname("Name Is Required", "laname");
        return false;
    } else {
        valname("OK", "laname");
        return true;
    }
    
}

// Code

var x = Math.random();

document.getElementById("code").innerHTML = Math.round(x * 80000);

function valincode(msg, msgloc) {
    
    "use strict";
    
    document.getElementById(msgloc).innerHTML = msg;
    
}

function incodef() {
    
    "use strict";

    var code = document.getElementById("code").innerHTML,
        incode = document.getElementById("incode").value;
    

    
    if (incode === code) {
        valname("OK", "laincode");
        return true;
    } else {
        valname("Code Isn't Correct", "laincode");
        return false;
    }
    
}


// button 

function btnf() {
    
    "use strict";
    
    if (!usernamef() || !pasf() || !pas2f() || !emailf() || !namef() || !incodef()) {
        document.getElementById("btn").innerHTML = "Pleas Complete All";
    } else {
        document.getElementById("btn").innerHTML = "Send Succesful";
    }

}