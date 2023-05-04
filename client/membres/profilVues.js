let afficherMessage = (msg, num) => {
  document.getElementById(`msg${num}`).innerHTML = msg;
  setTimeout(
      () => {
           document.getElementById(`msg${num}`).innerHTML = "";
      }, 5000
  );
}

let listerProfil = (profil) => {
    let contenu = `<section style="background-color: #eee;">
    <div class="container py-5">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item active" aria-current="page">Membre Profile</li>
            </ol>
          </nav>
        </div>
      </div>
  
      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="photos/${profil.photo}" alt=""
                class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3">${profil.prenom} ${profil.nom}</h5>
              <div class="d-flex justify-content-center mb-2">

              <button type="button" class="btn btn-primary" onClick="injeterDonnees(${JSON.stringify(profil).split('"').join("&quot;")});">Edit Profil</button>

              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Nom:</p>
                </div>
                <div class="col-sm-6">
                  <p class="text-muted mb-0">${profil.prenom} ${profil.nom}</p>
                </div>

              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Courriel:</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">${profil.courriel}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Sexe:</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">${profil.sexe}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Date de Naissance:</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">${profil.datedenaissance}</p>
                </div>

              </div>
              <hr>
              <div class="row">
              <div class="col-sm-3">
                
              </div>
                <div class="col-sm-9">
                <div class="d-flex mb-2">
                  <button type="button" class="btn btn-secondary" onClick="modMotdepass(${profil.idm});">Changer Mot de Pass</button>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  `;
    document.getElementById('contenuMain').innerHTML = contenu;
}

let injeterDonnees = (profil) =>{
  $('#prenomP').val(profil.prenom);
  $('#nomP').val(profil.nom);
  $('#courrielP').val(profil.courriel);
  $('#sexeP').val(profil.sexe);
  $('#datenP').val(profil.datedenaissance);
  let imgP = `<img src="photos/${profil.photo}" class="img" alt="...">`;
  document.getElementById('imgP').innerHTML = imgP;
  let btnModifierP = `<button type="button" class="btn btn-primary" onClick="requeteProfilServeur('modifier', ${profil.idm});">Envoyer</button>`;
  document.getElementById('btnModifierP').innerHTML = btnModifierP;
  $('#modalProfil').modal('show');
}

let modMotdepass = (idm) => {
  let btnModMotdepass = `<button type="button" class="btn btn-primary" onClick="validReq(${idm})">Envoyer</button>`;
  document.getElementById('btnModMotdepass').innerHTML = btnModMotdepass;
  $('#modalMotdepass').modal('show');
}

let validReq = (idm) => {
  if(validerFormEnreg()){
    requeteProfilServeur("modMotdepass",idm);
  }
}