let validerMotdePass = (pw,tag) =>{

    let msgErrEnreg = "";
    let validem = true;
    if(!/[A-Z]/.test(pw)){
        validem = false;
        msgErrEnreg += "au moins un lettre majuscule<br>";
    }
    if(!/[a-z]/.test(pw)){
        validem = false;
        msgErrEnreg += "au moins un lettre minuscule<br>";
    }
    if(!/[0-9]/.test(pw)){
        validem = false;
        msgErrEnreg += "au moins un chiffre<br>";
    }
    if(!/[^A-Za-z0-9]/.test(pw)){
        validem = false;
        msgErrEnreg += "au moins un caractere special<br>";
    }
    if(pw.length < 8){
        validem = false;
        msgErrEnreg += "au moins 8 caracteres<br>";
    }      
    if(pw.length > 10){
        validem = false;
        msgErrEnreg += "au plus 10 caracteres<br>";
    }
    if(!validem){
        document.getElementById(tag).innerHTML = msgErrEnreg;
        setInterval(()=>{
            document.getElementById(tag).innerHTML = "";
        }, 8000);
    }
    return validem;
}

let comparerMotdePass = () =>{
    let pw = document.getElementById('motdepass').value;
    let pwc = document.getElementById('motdepassc').value;
    let msgErrEnregc = "";
    let validec = true;
    if(pw != pwc){
        validec = false;
        msgErrEnregc += "les mots de passe ne correspondent pas";
    }
    if(!validec){
        document.getElementById('msgErrEnregc').innerHTML=msgErrEnregc;
        setInterval(()=>{
            document.getElementById('msgErrEnregc').innerHTML="";
        }, 8000);
    }
    return validec;
}

let validerFormEnreg = () => {
    let pw = document.getElementById('motdepass').value;
    return validerMotdePass(pw,'msgErrEnregm') &&  comparerMotdePass();
}

let validerFormCon = () => {
    let pwcon = document.getElementById('motdepasscon').value;
    return validerMotdePass(pwcon,'msgErrCon');
}

let initialiser = (message) =>{
    let textToast = document.getElementById("textToast");
    let toastEl = document.getElementById('toast');
    let toast = new bootstrap.Toast(toastEl);
    // let toastElList = [].slice.call(document.querySelectorAll('.toast'))
    // let toastList = toastElList.map(function (toastEl) {
    //     return new bootstrap.Toast(toastEl)
    // })
    if(message.length > 0){
        textToast.innerHTML = message;
        // toastList[0].show();
        toast.show();
    }
}