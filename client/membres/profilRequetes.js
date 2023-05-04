
let reqProfil = (action,id) => {
    var formMbr = new FormData();
    formMbr.append('action',action);
	formMbr.append('id',id);
	$.ajax({
		type : "POST",
		url : "profilControleur.php",
        data: formMbr,
		dataType : "json", 
		async: false,
		cache: false,
		contentType : false,
		processData : false
	}).done((reponse)  => {
		listerProfil(reponse.profil);
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
}

let reqModProfil = (action,id) => {
    var formMbr = new FormData(document.getElementById('modProfil'));
    formMbr.append('action',action);
	formMbr.append('id',id);
	$.ajax({
		type : "POST",
		url : "profilControleur.php",
        data: formMbr,
		dataType : "json", 
		async: false,
		cache: false,
		contentType : false,
		processData : false
	}).done((reponse)  => {
		afficherMessage(reponse.message, 1);
		listerProfil(reponse.profilModifie);
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
}

let reqModMotdepass = (action,id) => {
    var formMbr = new FormData(document.getElementById('modMotdepass'));
    formMbr.append('action',action);
	formMbr.append('id',id);
	$.ajax({
		type : "POST",
		url : "profilControleur.php",
        data: formMbr,
		dataType : "json", 
		async: false,
		cache: false,
		contentType : false,
		processData : false
	}).done((reponse)  => {
		afficherMessage(reponse.message,2);
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
}

let requeteProfilServeur = (action, id) => {
    switch(action){
		case "lister":
			reqProfil(action,id);
			break;
		case "modifier":
			reqModProfil(action,id);
			break;
		case "modMotdepass":
			reqModMotdepass(action,id);
			break;
    }
}