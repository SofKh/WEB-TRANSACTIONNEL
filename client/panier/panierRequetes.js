
let reqEnregistrer = (action) => {	 
    var formProduit = new FormData(document.getElementById('formEnreg'));
	formProduit.append("action",action);
	$.ajax({
		type : "POST",
		url : "../../routes.php",
		data : formProduit, 
		dataType : "json", 
		async: false,
		cache: false,
		contentType : false,
		processData : false
	}).done((reponse)  => {
		creerVue('enregistrer',reponse);
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
}

let reqLister = (action) => {
	var formProduit = new FormData();
	formProduit.append("action",action);
	$.ajax({
		type : "POST",
		url : "../../routes.php",
		data : formProduit, 
		dataType : "json", 
		async: false,
		cache: false,
		contentType : false,
		processData : false
	}).done((reponse)  => {

		if(reponse.OK){
			listeProduits = reponse.listeProduits;
			creerVue('lister',listeProduits);
		}else{
			alert("Problème pour lister");
		}
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
}

let reqFiche = (action, id) => {	 
    var formProduit = new FormData();
	formProduit.append("action",action);
	formProduit.append("id", id);
	$.ajax({
		type : "POST",
		url : "../../routes.php",
		data : formProduit, 
		dataType : "json", 
		async: false,
		cache: false,
		contentType : false,
		processData : false
	}).done((reponse)  => {
		creerVue('fiche',reponse);
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
}

let reqModifier = (action, id) => { 
    var formProduit = new FormData(document.getElementById('formModifier'));
	formProduit.append("action",action);
	formProduit.append("id", id);
	$.ajax({
		type : "POST",
		url : "../../routes.php",
		data : formProduit, 
		dataType : "json", 
		async: false,
		cache: false,
		contentType : false,
		processData : false
	}).done((reponse)  => {
		reponse['idProduit'] = id;
		creerVue('modifier',reponse);
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
}

let reqEnlever = (action, id) => {	 
    var formProduit = new FormData();
	formProduit.append("action",action);
	formProduit.append("id", id);
	$.ajax({
		type : "POST",
		url : "../../routes.php",
		data : formProduit, 
		dataType : "json", 
		async: false,
		cache: false,
		contentType : false,
		processData : false
	}).done((reponse)  => {
		reponse['idProduit'] = id;
		creerVue('enlever',reponse);
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
}

let requetePanierServeur = (action, id) => {
    switch(action){
        case "enregistrer":
            reqEnregistrer(action);
        	break;
        case "lister":
            reqLister(action);
        	break;
		case "fiche":
			reqFiche(action, id);
			break;
		case "modifier":
            reqModifier(action, id);
        	break;
		case "enlever":
            reqEnlever(action, id);
        	break;
    }
}