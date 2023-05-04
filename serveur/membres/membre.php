<?php
    session_start();
    $id = $_SESSION['id'];
    $nom = $_SESSION['nom'];
    $photo = $_SESSION['photo'];
?>
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
    <script src="../../client/pages/pageRequetes.js"></script>
    <script src="../../client/pages/pageVues.js"></script>
    <script src="../../client/membres/profilRequetes.js"></script>
    <script src="../../client/membres/profilVues.js"></script>
    <script src="../../client/panier/panier.js"></script>
    <script>
      function mbrOnload(){
        requeteProduitsServeur('listerPop',0,'..');
        login(<?php echo $id ?>);
      }
    </script>

</head>
<body onLoad="mbrOnload()">

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1>Deskmate</h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
            <li class="dropdown"><a href="#"><span>Magasinez par Categorie</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                    <li><a href="javascript:requeteProduitsServeur('listerCateg','','..');">Magasinez Tous</a></li>
                    <li><a href="javascript:requeteProduitsServeur('listerCateg','Equipement affaires','..');">Équipement d'affaires</a></li>
                    <li><a href="javascript:requeteProduitsServeur('listerCateg','Fournitures de bureau','..');">Fournitures de bureau</a></li>
                    <li><a href="javascript:requeteProduitsServeur('listerCateg','Fournitures scolaires','..');">Fournitures scolaires</a></li>
                </ul>
            </li>
            <li role="button" onClick="requeteProfilServeur('lister',<?php echo $id ?>)">Profil</li>
            <li>
                <a class="nav-link link-dark" href="#">
                <form class="d-flex">
                    <button type="button" class="btn btn-outline-dark border-0" onClick="listerPanier();">
                        <i class="bi-cart-fill me-1"></i>
                        Panier
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><span id="panierNum">0</span></span>
                    </button>
                </form>
                </a>
            </li>
            <li><?php echo $nom ?></li>
            <li><img src="photos/<?php echo $photo ?>" class="img" alt=""></li>
            <li><i class="bi bi-box-arrow-right navIcon" role="button" onClick="logout(<?php echo $id ?>)"></i></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

    <div id="contenuMain"><br>  
      <div id="contenuPop"></div>
    </div><br><br>

<!-- Replace "test" with your own sandbox Business account app client ID -->
<script src="https://www.paypal.com/sdk/js?client-id=AXb0LrW8QGz5saESgskiuKdnAO9XSE5nCnOEY_1vFRGHWd8ArJrXxSuFUShRtPq7SKP4XE69ibaYXQA7&currency=CAD"></script>

<!-- Set up a container element for the button -->
    <!-- Modal paypal -->       
    <div class="modal fade" id="modalPaypal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Mode de Paiment</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>
<!-- fin de Modal paypal -->   
<script>
  paypal.Buttons({
    // Order is created on the server and the order id is returned
    createOrder() {
      return fetch("/MA/Labo3/serveur/createOrder.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        // use the "body" param to optionally pass additional order information
        // like product skus and quantities
        body: JSON.stringify(panierliste),
      })
      .then((response) => response.json())
      .then((order) => order.id);
    },
    // Finalize the transaction on the server after payer approval
    onApprove(data) {
      return fetch("/my-server/capture-paypal-order", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          orderID: data.orderID
        })
      })
      .then((response) => response.json())
      .then((orderData) => {
        // Successful capture! For dev/demo purposes:
        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
        const transaction = orderData.purchase_units[0].payments.captures[0];
        alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
        // When ready to go live, remove the alert and show a success message within this page. For example:
        // const element = document.getElementById('paypal-button-container');
        // element.innerHTML = '<h3>Thank you for your payment!</h3>';
        // Or go to another URL:  window.location.href = 'thank_you.html';
      });
    }
  }).render('#paypal-button-container');
</script>




<!-- ======= Footer ======= -->
<footer id="footer">

<div class="footer-top">
  <div class="container">
    <div class="row">

      <div class="col-lg-3 col-md-6 footer-links">
        <h4>Liens utiles</h4>
        <ul>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Accueil</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">À propos</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 footer-links">
        <h4>Nos Produits</h4>
        <ul>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Équipement d'affaires</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Fournitures de bureau</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Fournitures scolaires</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 footer-contact">
        <h4>Contactez Nous</h4>
        <p>
          A108 Adam Street <br>
          Montreal, Quebec<br>
          Canada <br><br>
          <strong>Téléphone:</strong> +1 5589 55488 55<br>
          <strong>Courriel:</strong> info@deskmate.com<br>
        </p>

      </div>

      <div class="col-lg-3 col-md-6 footer-info">
        <h3>À Propos de Deskmate</h3>
        <p>Deskmate est un magasin unique sur ligne</p>
        <div class="social-links mt-3">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="container">
  <div class="copyright">
    &copy; Copyright <strong><span>Deskmate</span></strong>. All Rights Reserved
  </div>
</div>
</footer><!-- End Footer -->

<!-- Modal Profil -->       
        <div class="modal fade" id="modalProfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier Profil</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" id="modProfil">
                            <div class="col-md-6">
                                <label for="prenomP" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenomP" name="prenomP">
                            </div>
                            <div class="col-md-6">
                                <label for="nomP" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nomP" name="nomP">
                            </div>
                            <div class="col-md-12 invisible">
                                <label for="courrielP" class="form-label">Courriel</label>
                                <input type="email" class="form-control" id="courrielP" name="courrielP">
                            </div>
                            <div class="col-md-12">
                                <label for="datenP" class="form-label">Date de Naissance</label>
                                <input type="date" class="form-control" id="datenP" name="datenP">
                            </div>

                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexeP" value="H" checked>
                            <label class="form-check-label" for="H">
                                Homme
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexeP" value="F">
                            <label class="form-check-label" for="F">
                                Femme
                            </label>
                            </div>
                            <div class="col-md-12">
                            <label for="photoP" class="form-label">Photo</label>
                            <span id="imgP"></span>
                            <input type="file" class="form-control" id="photoP" name="photoP">
                            </div>
                            <br/>
                            <div id="btnModifierP" class="col-6">
                                <button class="btn btn-primary" type="submit">Envoyer</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-secondary" type="reset">Vider</button>
                            </div>
                            <span id="msg1" class="msg"></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Fin modal profil -->

    <!-- Modal Motdepass -->       
    <div class="modal fade" id="modalMotdepass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Changer Mot de Pass</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" id="modMotdepass" onSubmit="return validerFormEnreg();">
                            <div class="col-md-12">
                                <label for="motdepass" class="form-label">Mot de pass<br><span class="fw-light">(entre 8 et 10 caractères 
                                    qui incluent des lettres minuscules, majuscules, des chiffres et les caractères specials)</span></label>
                                <input type="password" class="form-control is-valid" id="motdepass" name="motdepass" required>
                            </div>
                            <span id="msgErrEnregm"></span>

                            <div class="col-md-12">
                                <label for="motdepassc" class="form-label">Confirmer Mot de pass</label>
                                <input type="password" class="form-control is-valid" id="motdepassc" name="motdepassc" required>
                            </div>
                            <span id="msgErrEnregc"></span>
                            
                            <div id="btnModMotdepass" class="col-6">
                                <button class="btn btn-primary" type="button">Envoyer</button>
                            </div>
                            <span id="msg2" class="msg"></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Fin modal Motdepass -->


    <!-- Vendor JS Files -->
    <script src="../../client/vendor/purecounter/purecounter_vanilla.js"></script>
    <!-- <script src="client/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <script src="../../client/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../client/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../../client/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../../client/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../../client/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="../../client/js/main.js"></script>


</body>
</html>