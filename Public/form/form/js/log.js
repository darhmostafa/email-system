// User

function valuser(msg, msgloc) {
    
    "use strict";
    
    document.getElementById(msgloc).innerHTML = msg;
    
}

function userf() {
    
    "use strict";
    
    var user = document.getElementById("user").value;
    
    if (user.length === 0) {
        valuser("UserName Is Required", "lauser");
        return false;
    } else if (user === "sayed") {
        valuser("OK", "lauser");
        return true;
    } else {
        valuser("Pleas Enter User Name = sayed", "lauser");
        return false;
    }
    
}

// Password

function valpassword(msg, msgloc) {
    
    "use strict";
    
    document.getElementById(msgloc).innerHTML = msg;
    
}

function passwordf() {
    
    "use strict";
    
    var password = document.getElementById("password").value;
    
    if (password.length === 0) {
        valpassword("Password Is Required", "lapassword");
        return false;
    } else if (password === "123456789") {
        valpassword("OK", "lapassword");
        return true;
    } else {
        valuser("Pleas Enter User Name = 1-9", "lapassword");
        return false;
    }
    
}

// button 

function btnf() {
    
    "use strict";
    
    if (!userf() || !passwordf()) {
        document.getElementById("btn").innerHTML = "Pleas Complete All";
    } else {
        document.getElementById("btn").innerHTML = "Send Succesful";
    }

}