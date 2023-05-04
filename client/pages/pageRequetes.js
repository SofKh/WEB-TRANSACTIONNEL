let reqCategorie = (action, id, src) => {
	var formProduit = new FormData();
	formProduit.append("action", action);
	formProduit.append("categorie", id);
	$.ajax({
		type : "POST",
		url : src+"/public/publicControleur.php",
		data : formProduit, 
		dataType : "json", 
		async: false,
		cache: false,
		contentType : false,
		processData : false
	}).done((reponse)  => {
		if(reponse.OK){
			reponse['categorie'] = id;
			listerCateg(reponse,src);
		}else{
			alert("Problème pour lister");
		}
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
}

let reqPopProduit = (action,src) => {
	var formProduit = new FormData();
	formProduit.append("action",action);
	$.ajax({
		type : "POST",
		url : src+"/public/publicControleur.php",
		data : formProduit, 
		dataType : "json", 
		async: false,
		cache: false,
		contentType : false,
		processData : false
	}).done((reponse)  => {
		if(reponse.OK){
			listerPop(reponse.listeProduits,src);
		}else{
			alert("Problème pour lister");
		}
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
}

// Contrôleur de requêtes
let requeteProduitsServeur = (action, id, src) => {
    switch(action){
		case "listerCateg":
			reqCategorie(action, id, src);
			break;
		case "listerPop":
			reqPopProduit(action,src);
			break;
    }
}