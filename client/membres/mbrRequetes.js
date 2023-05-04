let reqListerMbr = (action) => {
    var formMbr = new FormData();
    formMbr.append('action',action);
	$.ajax({
		type : "POST",
		url : "../membres/mbrControleur.php",
        data: formMbr,
		dataType : "json", 
		async: false,
		cache: false,
		contentType : false,
		processData : false
	}).done((reponse)  => {
		listerMbr(reponse.listeMbr);
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
}

let reqActiver = (action, id) => {
    var formMbr = new FormData();
    formMbr.append('action',action);
	formMbr.append('id',id);
	$.ajax({
		type : "POST",
		url : "../membres/mbrControleur.php",
        data: formMbr,
		dataType : "json", 
		async: false,
		cache: false,
		contentType : false,
		processData : false
	}).done((reponse)  => {
		reponse['id'] = id;
		changeBtn(action,reponse);
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
}

let reqDesactiver = (action, id) => {
    var formMbr = new FormData();
    formMbr.append('action',action);
	formMbr.append('id',id);
	$.ajax({
		type : "POST",
		url : "../membres/mbrControleur.php",
        data: formMbr,
		dataType : "json", 
		async: false,
		cache: false,
		contentType : false,
		processData : false
	}).done((reponse)  => {
		reponse['id'] = id;
		changeBtn(action,reponse);
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
}

let requeteMbrServeur = (action, id) => {
    switch(action){
        case "lister":
            reqListerMbr(action);
        	break;
        case "activer":
            reqActiver(action,id);
        	break;
		case "desactiver":
            reqDesactiver(action,id);
        	break;
    }
}