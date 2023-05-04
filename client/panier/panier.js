let panierNum = 0;
let sousTotal = 0;
let totalTaxes = 0;
let totalFacture = 0;
const GST = 0.05;
const QST = 0.0975;
let idMembre = "";

Storage.prototype.setObj = function(key, obj) {
    return this.setItem(key, JSON.stringify(obj))
}

Storage.prototype.getObj = function(key) {
    return JSON.parse(this.getItem(key))
}

localStorage.setObj("panier", [])
let panierliste = localStorage.getObj("panier");

let login = (idMbr) =>{
    idMembre = idMbr;
    $.ajax({
		type : "POST",
		url : "membreLogin.php",
		data : JSON.stringify({"idMbr":idMbr}), 
		dataType : "json", 
		async: false,
		cache: false,
		contentType : "application/json",
		processData : false
	}).done((reponse)  => {
        console.log(reponse.message);
        if(reponse.OK){
            if(reponse.panierliste!=null){
                initPanier(reponse.panierliste);
            }
        }
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
}

let initPanier = (listeP) =>{
    let length = listeP.produit.length;
    for(let i=0;i<length;i++){
        let newItem = {
            "produit": listeP.produit[i],
            "quantite": listeP.quantite[i],
        }
        panierliste.push(newItem);
        panierNum += listeP.quantite[i];
    }
    document.getElementById('panierNum').innerHTML = panierNum;
    localStorage.setObj("panier", panierliste);
}

let ajouterPanier = (unProduit, quantity) => {
    let chosenQuantity = 1;
    let input = document.getElementById('inputQuantity');
    if(input != null){
        chosenQuantity = parseInt(input.value);
    }
    if(quantity != null) {
        chosenQuantity = quantity;
    }

    let chosenItem = panierliste.find(item => item.produit.idp === unProduit.idp);
    
    if (!chosenItem) {
        let newItem = {
            "produit": unProduit,
            "quantite": chosenQuantity,
        }
        panierliste.push(newItem);
    } else {
        if (chosenItem.quantite + chosenQuantity < 1) {
            return;
        }
        chosenItem.quantite += chosenQuantity;
        panierliste.splice(panierliste.indexOf(chosenItem), 1, chosenItem); 
    }
    panierNum += chosenQuantity;
    document.getElementById('panierNum').innerHTML = panierNum;

    localStorage.setObj("panier", panierliste);
}


let listerPanier = () => {
    let resultat = construireEntetes();
    for(let item of panierliste){
        resultat += construireTR(item.produit, item.quantite);
    }
    resultat += `</tbody></table>
    <br><br><div class="text-end">
    <button type="button" class="btn btn-primary" onclick="facturation();">Confirmer</button>
    <button type="button" class="btn btn-warning" onclick="requeteProduitsServeur('listerCateg','','..');">Continuer Acheter Produits</button>
    </div></div>`;
    $('#contenuMain').html(resultat);
}

const construireEntetes = () => {
    const entete = `<div class="container">
    <h3>Panier</h3><br><br>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Pochette</th>
                <th scope="col">Nom</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantite</th>
                <th scope="col">Totale</th>
                <th scope="col">Supprimer</th>
                </tr>
            </thead>
            <tbody>
    `;
    return entete;
}

const construireTR = (produit, quantite) =>{
    let tr=`<tr id="${produit.idp}">
        <th>${produit.idp}</th>
        <th><img src="../pochettes/${produit.pochette}" class="img" alt="..."></th>
        <th>${produit.titre}</th>
        <td>${produit.prix}</td>
        <td>
        <div class="input-group">
        <span class="input-group-btn">
            <button class="btn btn-white btn-minuse" type="button" onClick="minus(${JSON.stringify(produit).split('"').join("&quot;")});">-</button>
        </span>
        <input class="form-control text-center" id="quantite" type="num" value="${quantite}" style="max-width: 3rem">
        <span class="input-group-btn">
            <button class="btn btn-red btn-pluss" type="button" onClick="add(${JSON.stringify(produit).split('"').join("&quot;")});">+</button>
        </span>
        </div>
        </td>
        <td id="price" ><div>${produit.prix * quantite}<div></td>
        <td><i type="button" class="bi bi-trash3" onclick="del(${JSON.stringify(produit).split('"').join("&quot;")});"></i></td>
    </tr>`;
    return tr;
}

let del = (produit) => {
    let chosenItem = panierliste.find(item => item.produit.idp === produit.idp);
    panierliste.splice(panierliste.indexOf(chosenItem), 1); 
    panierNum = panierNum - chosenItem.quantite;
    document.getElementById('panierNum').innerHTML = panierNum;
    listerPanier();
}

let minus = (produit) =>{
    ajouterPanier(produit, -1);
    updateRow(produit);
}

let add = (produit) =>{
    ajouterPanier(produit);
    updateRow(produit);
}

let updateRow = (produit) => {
    let row = document.getElementById(produit.idp);
    let quantityBox = row.getElementsByTagName("input")[0];
    let priceIndicator = row.querySelector("#price");
    let item = panierliste.find(item => item.produit.idp === produit.idp);
    quantityBox.value = item.quantite;
    priceIndicator.innerHTML = (item.produit.prix * item.quantite).toFixed(2);
}

let facturation = () =>{
    sousTotal = 0;
    for(let item of panierliste){
        sousTotal += item.produit.prix * item.quantite;
    }
    taxGST = sousTotal*GST;
    taxQST = sousTotal*QST;
    totalFacture = sousTotal + taxGST + taxQST;
    let resultat =`<br><br>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <div class="card-header text-center">Facturation</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" id="sousTotal">Sous-total = ${sousTotal.toFixed(2)} $</li>
                        <li class="list-group-item" id="gst">GST = ${taxGST.toFixed(2)} $</li>
                        <li class="list-group-item" id="qst">QST = ${taxQST.toFixed(2)} $</li>
                        <li class="list-group-item" id="total">Total = ${totalFacture.toFixed(2)} $</li>
                    </ul><br>
            <div class="text-center">
            <button type="button" class="btn btn-primary" onclick="$('#modalPaypal').modal('show')">Aller Payer</button>
            <button type="button" class="btn btn-warning" onclick="listerPanier()">Modifier Panier</button>
            </div><br>
            </div>
        </div>
    </div>
    `;
    $('#contenuMain').html(resultat);
}

let confirmerPayer = () => {
    localStorage.clear();
    document.getElementById('contenuMain').innerHTML = "<h3>Merci de votre Achat</h3><h3>Vous allez recevoir la confirmation d'achat et la facture par courriel.</h3>";
}

let logout = (idMbr) => {
	$.ajax({
		type : "POST",
		url : "membreLogout.php",
		data : JSON.stringify({"idMbr":idMbr, "panierliste":panierliste}), 
		dataType : "json", 
		async: false,
		cache: false,
		contentType : "application/json",
		processData : false
	}).done(()  => {
        localStorage.clear();
        window.location.href = "../../index.php";
	})
	.fail(function(xhr) {
    	alert(xhr.responseText);
  	})
    
}

