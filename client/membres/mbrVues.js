let afficherMsg = (donnees, num) => {
    document.getElementById(`msg${num}`).innerHTML = donnees.message;
    setTimeout(
        () => {
             document.getElementById(`msg${num}`).innerHTML = "";
        }, 5000
    );
}

let creerRowMbr = (unMbr) => {
    let contenu = `
        <tr>
            <th scope="row">${unMbr.idm}</th>
            <td><img src="../membres/photos/${unMbr.photo}" class="img" alt="..."></td>
            <td>${unMbr.prenom}</td>
            <td>${unMbr.nom}</td>
            <td>${unMbr.courriel}</td>
            <td>${unMbr.sexe}</td>
            <td>${unMbr.datedenaissance}</td>
            `;
    if(unMbr.statut=="I"){
        contenu +=`
        <td id="${unMbr.idm}"><button id="btActiver" class="btn btn-warning" onClick="requeteMbrServeur('activer', ${unMbr.idm});">Activer</button></td>
        </tr>`;
    }
    else{
        contenu +=`
        <td id="${unMbr.idm}"><button id="btDesactiver" class="btn btn-danger" onClick="requeteMbrServeur('desactiver', ${unMbr.idm});">Désactiver</button></td>
        </tr>`;
    }
    return contenu;
}

let listerMbr = (listeMbr) => {
    let contenu = `<table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Courriel</th>
                        <th scope="col">Sexe</th>
                        <th scope="col">Date de Naissance</th>
                        <th scope="col">Activer/Désactiver</th>
                    </tr>
                    </thead>
                    <tbody>`;
    for(let unMbr of listeMbr){
        contenu += creerRowMbr(unMbr);
    }
    contenu += `</tbody>
            </table>`;
    document.getElementById('contenu').innerHTML = contenu;
    document.getElementById('title').innerHTML = "<h3>GESTION DES MEMBRES</h3>";
}

let changeBtn = (action, reponse) =>{
    afficherMsg(reponse,3);
    let btn = "";
    if(action == "activer"){
        btn = `<button id="btDesactiver" class="btn btn-danger" onClick="requeteMbrServeur('desactiver', ${reponse.id});">Désactiver</button>`;
    }
    else{
        btn = `<button id="btActiver" class="btn btn-warning" onClick="requeteMbrServeur('activer', ${reponse.id});">Activer</button>`;
    }
    document.getElementById(reponse.id).innerHTML = btn;
}