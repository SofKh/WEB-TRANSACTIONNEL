let creerCard = (unProduit,src) => {
    return `
    <div class="col-lg-3 col-md-4 d-flex align-items-stretch mt-3">
        <div class="icon-box">
            <div class="card h-100 border-0">
                <img role="button" src="${src}/pochettes/${unProduit.pochette}" class="img-fluid" alt=""  onClick="showProduit(${JSON.stringify(unProduit).split('"').join("&quot;")},'${src}');">
                <div class="card-body p-0">
                        <h5>$ ${unProduit.prix}<h5>
                        <h6>${unProduit.titre}</h6>
                </div>
                <div role="button" class="card-footer ms-auto pt-2 pb-0 border-top-0 bg-transparent" onClick="ajouterPanier(${JSON.stringify(unProduit).split('"').join("&quot;")});">
                    <div class="icon"><i class="bi bi-cart"></i></div>
                </div>
            </div>
        </div>
  </div>
  `;
}



let listerCateg = (reponse,src) => {
    let n=0;
    listeProduits = reponse.listeProduits;
    categ = reponse.categorie;
    let contenu = `<section id="services" class="services"><div class="container">`
    if(categ == ""){
        contenu += `<br><h4>Tous Produits</h4><br>`;
    }
    else{
        contenu +=`<br><h4>${categ}</h4><br>`;
    }
    contenu += `<br><div class='row'>`
    for(let unProduit  of listeProduits){
        contenu += creerCard(unProduit,src);
    }
    contenu += `</div></div></section>`;
    document.getElementById('contenuMain').innerHTML = contenu;
}

let listerPop = (listeProduits,src) => {
    let n=0;
    let contenu =`<section id="services" class="services">
                    <div class="container">
                    <h4>Produits Populaires</h4><br>
                    <div class='row'>`;
    for(let unProduit  of listeProduits){
        contenu += creerCard(unProduit,src);
    }
    contenu += `</div></div></section>`;
    document.getElementById('contenuPop').innerHTML = contenu;
}

let showProduit = (unProduit,src) =>{
    let contenu = `<div class="container">
    <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-5">
            <img src="${src}/pochettes/${unProduit.pochette}" class="card-img-top mb-5 mb-md-0" alt="...">
        </div>

        <div class="col-md-5">
            <h3 class="display-7 fw-bolder">${unProduit.titre}</h3>
            <div class="fs-5 mb-5">Prix: $${unProduit.prix}</div>
            <p class="lead">Description: ${unProduit.description}</p>
            <div class="d-flex">
                <input class="form-control text-center me-3" id="inputQuantity" name="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                <button class="btn btn-outline-dark flex-shrink-0" type="button" onClick="ajouterPanier(${JSON.stringify(unProduit).split('"').join("&quot;")});">
                    <i class="bi-cart-fill me-1"></i>
                    Ajouter au panier
                </button>
            </div> 
        </div>
    </div>`
    if(src=='serveur'){
        contenu+=`<div type="button" class="text-end" onClick="requeteProduitsServeur('listerCateg','','serveur');"><img src="client/images/back.png" class="img" alt="...">Back</div>`
    }else{
        contenu+=`<div type="button" class="text-end" onClick="requeteProduitsServeur('listerCateg','','..');"><img src="../../client/images/back.png" class="img" alt="...">Back</div>`
    }
    contenu+=`</div>`;
    document.getElementById('contenuMain').innerHTML = contenu;
}
