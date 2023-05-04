<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deskmate</title>
    <link rel="stylesheet" href="../../client/utilitaires/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../client/utilitaires/icons-1.8.1/bootstrap-icons.css">
    <link rel="stylesheet" href="../../client/css/style.css">

    <script src="../../client/utilitaires/jquery-3.6.3.min.js"></script>
    <script src="../../client/utilitaires/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="../../client/js/global.js"></script>
    <script src="../../client/produits/requetes.js"></script>
    <script src="../../client/produits/vues.js"></script>
    <script src="../../client/membres/mbrRequetes.js"></script>
    <script src="../../client/membres/mbrVues.js"></script>
</head>
<body onLoad="javascript:requeteProduitsServeur('lister', 0);">

<header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1><a href="../../index.php">Deskmate</a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
        <li><a class="nav-link link-dark" href="javascript:requeteProduitsServeur('lister', 0);">LISTER PRODUITS</a></li>
        <li><a class="nav-link link-dark" data-bs-toggle="modal" data-bs-target="#enregModal" href="#">AJOUTER UN PRODUIT</a></li>
        <li><a class="nav-link link-dark" href="javascript:requeteMbrServeur('lister', 0);">LISTER MEMBRES</a></li>
        <li><i class="bi bi-box-arrow-right" style="font-size:25px" role="button" onClick="location.href='../../index.php';"></i></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->


    <div class="container">
    <br>
        <div id="title"></div>
        <div id="msg3"></div>
        <div id="contenu"></div>
    </div>

    <!-- ======= Footer ======= -->
<footer id="footer">
<div class="container">
  <div class="copyright">
    &copy; Copyright <strong><span>Deskmate</span></strong>. All Rights Reserved
  </div>
</div>
</footer><!-- End Footer -->

    <!-- Modal pour enregistrer produit -->
    <div class="modal fade" id="enregModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enregistrer Produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEnreg">
                    <div class="col-md-12">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control is-valid" id="titre" name="titre" required>
                    </div>
                    <div class="col-md-12">
                        <label for="categorie" class="form-label">Categorie</label>
                        <select id="categorie" name="categorie" class="form-select border-success" aria-label="Default select example" required>
                            <option value="Equipement affaires">Équipement d'affaires</option>
                            <option value="Fournitures de bureau">Fournitures de bureau</option>
                            <option value="Fournitures scolaires">Fournitures scolaires</option>
                            </select>
                    </div>
                    <div class="col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control is-valid" id="description" name="description" required>
                    </div>
                    <div class="col-md-12">
                        <label for="prix" class="form-label">Prix($)</label>
                        <input type="text" class="form-control is-valid" id="prix" name="prix" required>
                    </div>
                    <div class="col-md-12">
                        <label for="quantite" class="form-label">Quantite</label>
                        <input type="text" class="form-control is-valid" id="quantite" name="quantite" required>
                    </div>
                    <div class="col-md-12">
                        <label for="pochette" class="form-label">Pochette</label>
                        <input type="file" class="form-control border-success" id="pochette" name="pochette">
                    </div>
                    <br/>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" onClick="requeteProduitsServeur('enregistrer', 0);">Enregistrer</button>
                        <button type="reset" class="btn btn-secondary">Vider</button>
                    </div>
                    <span id="msg1" class="msg"></span>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
    </div>
    <!-- Fin du modal pour enregistrer produit -->

    <!-- Modal pour modifier produit -->
    <div class="modal fade" id="modifierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modifier Produit</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form id="formModifier">
                      <div class="col-md-12">
                          <label for="titreM" class="form-label">Titre</label>
                          <input type="text" class="form-control is-valid" id="titreM" name="titreM" required>
                      </div>
                      <div class="col-md-12">
                          <label for="categorieM" class="form-label">Categorie</label>
                          <select id="categorieM" name="categorieM" class="form-select border-success" aria-label="Default select example" required>
                              <option value="Equipement affaires">Équipement d'affaires</option>
                              <option value="Fournitures de bureau">Fournitures de bureau</option>
                              <option value="Fournitures scolaires">Fournitures scolaires</option>
                              </select>
                      </div>
                      <div class="col-md-12">
                          <label for="descriptionM" class="form-label">Description</label>
                          <input type="text" class="form-control is-valid" id="descriptionM" name="descriptionM" required>
                      </div>
                      <div class="col-md-12">
                          <label for="prixM" class="form-label">Prix($)</label>
                          <input type="text" class="form-control is-valid" id="prixM" name="prixM" required>
                      </div>
                      <div class="col-md-12">
                          <label for="quantiteM" class="form-label">Quantite</label>
                          <input type="text" class="form-control is-valid" id="quantiteM" name="quantiteM" required>
                      </div>
                      <div class="col-md-12">
                          <label for="pochetteM" class="form-label">Pochette</label>
                          <span id="imgM"></span>
                          <input type="file" class="form-control border-success" id="pochetteM" name="pochetteM">
                      </div>
                      <br/>
                      <div id="btnModifier" class="col-12">
                          <button type="button" class="btn btn-primary">Envoyer</button>
                          <button type="reset" class="btn btn-secondary">Vider</button>
                      </div>
                      <span id="msg2" class="msg"></span>
                  </form>
              </div>
              <div class="modal-footer">
              </div>
          </div>
      </div>
      </div>
      <!-- Fin du modal pour modifier produit -->;

    <div class="toast-container posToast">
    <div id="toastEnlever" class="toast align-items-center text-white bg-danger border-0" data-bs-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="../../client/images/message.png" width=24 height=24 class="rounded me-2" alt="message">
            <strong class="me-auto">Messages</strong>
            <small class="text-muted"></small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div id="produitToast"></div>
    </div>
    </div>

    <!-- Template Main JS File -->
    <script src="../../client/js/main.js"></script>

</body>
</html>