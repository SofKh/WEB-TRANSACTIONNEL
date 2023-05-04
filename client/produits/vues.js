let afficherMessage = (donnees, num) => {
    document.getElementById(`msg${num}`).innerHTML = donnees.message;
    setTimeout(
        () => {
             document.getElementById(`msg${num}`).innerHTML = "";
        }, 5000
    );
}

let triggerToast = (idp) =>{
    toastEl = document.getElementById("toastEnlever");
    toast = new bootstrap.Toast(toastEl);
    document.getElementById("produitToast").innerHTML = `
    <div id="textToast" class="toast-body">Êtes-vous sûr de vouloir supprimer cet article ?
    <div class="mt-2 pt-2 border-top">
        <button type="button" class="btn btn-primary btn-sm" onClick="requeteProduitsServeur('enlever', ${idp});toast.hide();">Oui</button>
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Annuler</button>
    </div>
    </div>`;
    toast.show();
}

let creerRow = (unProduit) => {
    return `
        <tr id="${unProduit.idp}">
            <th scope="row">${unProduit.idp}</th>
            <td><img src="../pochettes/${unProduit.pochette}" class="img" alt="..."></td>
            <td>${unProduit.titre}</td>
            <td>${unProduit.categorie}</td>
            <td>${unProduit.description}</td>
            <td>${unProduit.prix}</td>
            <td>${unProduit.quantite}</td>
            <td>${unProduit.date}</td>
            <td><i class="bi bi-pencil" role='button' onClick="requeteProduitsServeur('fiche',${unProduit.idp})"></i></td>
            <td><i class="bi bi-trash" role='button' onClick="triggerToast(${unProduit.idp});"></i></td>
        </tr>
    `;
}

let afficherFiche = (donnees) =>{
    if(donnees.OK){
        uneFiche=donnees.unProduit;
        // $('#idpM').val(uneFiche.idp);
        $('#titreM').val(uneFiche.titre);
        $('#categorieM').val(uneFiche.categorie);
        $('#descriptionM').val(uneFiche.description);
        $('#prixM').val(uneFiche.prix);
        $('#quantiteM').val(uneFiche.quantite);
        let imgM = `<img src="../pochettes/${uneFiche.pochette}" class="img" alt="...">`;
        document.getElementById('imgM').innerHTML = imgM;
        let btnModifier = `<button type="button" class="btn btn-primary" onClick="requeteProduitsServeur('modifier', ${uneFiche.idp});">Envoyer</button>
        <button type="reset" class="btn btn-secondary">Vider</button>`;
        document.getElementById('btnModifier').innerHTML = btnModifier;
        $('#modifierModal').modal('show');
      }else{
        afficherMessage(donnees.message, 3);
      }
}

let lister = (listeProduits) => {
    let contenu = `<table id="tableProduits" class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Pochette</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Categorie</th>
                        <th scope="col">Description</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Quantite</th>
                        <th scope="col">Date d'ajout</th>
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>`;
    for(let unProduit  of listeProduits){
        contenu += creerRow(unProduit);
    }
    contenu += `</tbody>
            </table>`;
    document.getElementById('contenu').innerHTML = contenu;
    document.getElementById('title').innerHTML = "<h3>GESTION DES PRODUITS</h3>";
}

let reponseEnregistrer = (donnees) => {
    afficherMessage(donnees,1);
    if(donnees.OK){
        let cardNouveauProduit = creerRow(donnees.produitInsere);
        document.getElementById('tableProduits').firstElementChild.innerHTML += cardNouveauProduit;
    }
}

let reponseEnlever = (donnees) => {
    afficherMessage(donnees,3);
    if(donnees.OK){
        let cardEnlever = document.getElementById(donnees.idProduit);
        cardEnlever.parentNode.removeChild(cardEnlever);
    }
}

let reponseModifier = (donnees) => {
    afficherMessage(donnees,2);
    if(donnees.OK){
        unProduit = donnees.produitModifie;
        let cardModifier = document.getElementById(donnees.idProduit);
        cardModifier.innerHTML = `<th scope="row">${unProduit.idp}</th>
        <td><img src="../pochettes/${unProduit.pochette}" class="img" alt="..."></td>
        <td>${unProduit.titre}</td>
        <td>${unProduit.categorie}</td>
        <td>${unProduit.description}</td>
        <td>${unProduit.prix}</td>
        <td>${unProduit.quantite}</td>
        <td>${unProduit.date}</td>
        <td><button class="btn btn-warning" onClick="requeteProduitsServeur('fiche',${unProduit.idp})">Modifier</button></td>
        <td><button class="btn btn-danger" onClick="triggerToast(${unProduit.idp});">Enlever</button></td>`;
    }
}


let creerVue = (action, donnees) => {
    switch(action) {
        case "enregistrer": reponseEnregistrer(donnees);break;
        case "fiche":    afficherFiche(donnees);break;
        case "modifier":    reponseModifier(donnees);break;
        case "enlever" :    reponseEnlever(donnees);break;
        case "lister" :     lister(donnees);break;
    }
}