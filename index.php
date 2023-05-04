<?php
    session_start();
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
?>
<!DOCTYPE html>
<html lang="fr" scroll-behavior="smooth">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="480651585486-b891vhjihn565d3iss7rgrnj562qeage.apps.googleusercontent.com">
    <title>Deskmate</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="client/utilitaires/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="client/utilitaires/icons-1.8.1/bootstrap-icons.css">
    <link rel="stylesheet" href="client/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="client/vendor/animate.css/animate.min.css" rel="stylesheet">
    <!-- <link href="client/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="client/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> -->
    <link href="client/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="client/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="client/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <script src="client/utilitaires/jquery-3.6.3.min.js"></script>
    <script src="client/utilitaires/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="client/js/global.js"></script>
    <script src="client/pages/pageRequetes.js"></script>
    <script src="client/pages/pageVues.js"></script>
    <script src="client/pages/contact.js"></script>

    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '568465052092675',
          cookie     : true,
          xfbml      : true,
          version    : 'v16.0'
        });
          
        FB.AppEvents.logPageView();   
          
      };

      (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));

      function checkLoginState() {
        FB.getLoginStatus(function(response) {
          statusChangeCallback(response);
        });
      }
    </script>
    <script>
      function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
      }
    </script>

    <script>
        function init(){
            initialiser('<?php echo $msg ?>');
            requeteProduitsServeur('listerPop',0,'serveur');
        }
    </script>
</head>
<body onLoad="init();">

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_CA/sdk.js#xfbml=1&version=v16.0&appId=568465052092675&autoLogAppEvents=1" nonce="ZyCsCNRp"></script>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@deskmate.com">contact@deskmate.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1><a href="index.php">Deskmate</a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
            <li><a class="active" href="index.php">Accueil</a></li>
            <li class="dropdown"><a href="#"><span>Magasinez par Categorie</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                    <li><a href="javascript:requeteProduitsServeur('listerCateg','','serveur');">Magasinez Tous</a></li>
                    <li><a href="javascript:requeteProduitsServeur('listerCateg','Equipement affaires','serveur');">Équipement d'affaires</a></li>
                    <li><a href="javascript:requeteProduitsServeur('listerCateg','Fournitures de bureau','serveur');">Fournitures de bureau</a></li>
                    <li><a href="javascript:requeteProduitsServeur('listerCateg','Fournitures scolaires','serveur');">Fournitures scolaires</a></li>
                </ul>
            </li>
            <li><a class="nav-link link-dark" href="#" data-bs-toggle="modal" data-bs-target="#modalEnregistrer">Devenir Membre</a></li>
            <li><a class="nav-link link-dark" href="#" data-bs-toggle="modal" data-bs-target="#modalConnexion">Connexion</a></li>
            <li><a href="javascript:contact();">Contactez-nous</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->


<div id="contenuMain">

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active" style="background-image: url(client/images/slide/slide-1.jpg)">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Bienvenue à <span>Deskmate</span></h2>
                <p class="animate__animated animate__fadeInUp">Deskmate est un magasin unique</p>
                <a href="javascript:requeteProduitsServeur('listerCateg','','serveur');" class="btn-get-started animate__animated animate__fadeInUp">Magasinez</a>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item" style="background-image: url(client/images/slide/slide-2.jpg)">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated fanimate__adeInDown">Welcome to <span>Deskmate</span></h2>
                <p class="animate__animated animate__fadeInUp">Deskmate is an One Stop Shop</p>
                <a href="javascript:requeteProduitsServeur('listerCateg','','serveur');" class="btn-get-started animate__animated animate__fadeInUp">Shop now</a>
              </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="carousel-item" style="background-image: url(client/images/slide/slide-3.jpg)">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">欢迎来到 <span>Deskmate</span></h2>
                <p class="animate__animated animate__fadeInUp">Deskmate 是一站式购物中心</p>
                <a href="javascript:requeteProduitsServeur('listerCateg','','serveur');" class="btn-get-started animate__animated animate__fadeInUp">购买</a>
              </div>
            </div>
          </div>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>
    </div>
  </section><!-- End Hero -->

    <!-- ======= Featured Section ======= -->
    <section id="featured" class="featured">
      <div class="container">

        <div class="row">
          <div class="col-lg-4">
            <div class="icon-box" onClick="requeteProduitsServeur('listerCateg','Equipement affaires','serveur');">
            <img src="client/images/equipment.png" class="" alt="...">
              <h3><a href="">Équipement d'affaires</a></h3>
            </div>
          </div>
          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="icon-box" onClick="requeteProduitsServeur('listerCateg','Fournitures de bureau','serveur');">
            <img src="client/images/office.png" class="" alt="...">
              <h3><a href="">Fournitures de bureau</a></h3>
            </div>
          </div>
          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="icon-box" onClick="requeteProduitsServeur('listerCateg','Fournitures scolaires','serveur');">
            <img src="client/images/school.png" class="" alt="...">
              <h3><a href="">Fournitures scolaires</a></h3>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Featured Section -->

    <div id="contenuPop"></div>
</div><br><br>

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


<!-- Modal enregistrer -->       
        <!-- Modal -->
        <div class="modal fade" id="modalEnregistrer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Devenir Membre</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="serveur/membres/enregistrerMembre.php" method="POST" enctype="multipart/form-data" onSubmit="return validerFormEnreg();">
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control is-valid" id="prenom" name="prenom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control is-valid" id="nom" name="nom" required>
                            </div>
                            <div class="col-md-12">
                                <label for="courriel" class="form-label">Courriel</label>
                                <input type="email" class="form-control is-valid" id="courriel" name="courriel" required>
                            </div>
                            
                            <div class="col-md-12">
                                <label for="motdepass" class="form-label">Mot de pass<br><span class="fw-light">(entre 8 et 10 caractères 
                                    qui incluent des lettres minuscules, majuscules, des chiffres et les caractères specials)</span></label>
                                <input type="password" class="form-control is-valid" id="motdepass" name="motdepass" required>
                            </div>
                            <span id="msgErrEnregm"></span>

                            <div class="col-md-12">
                                <label for="motdepass" class="form-label">Confirmer Mot de pass</label>
                                <input type="password" class="form-control is-valid" id="motdepassc" name="motdepassc" required>
                            </div>
                            <span id="msgErrEnregc"></span>

                            <div class="col-md-12">
                                <label for="daten" class="form-label">Date de Naissance</label>
                                <input type="date" class="form-control" id="daten" name="daten">
                            </div>

                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexe" value="H" checked>
                            <label class="form-check-label" for="H">
                                Homme
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexe" value="F">
                            <label class="form-check-label" for="F">
                                Femme
                            </label>
                            </div>
                            <div class="col-md-12">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                            </div>
                            <br/>
                            <div class="col-6">
                                <button class="btn btn-primary" type="submit">Enregistrer</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-danger" type="reset">Vider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- Fin modal enregistrer -->

    <!-- Modal connexion -->       
        <!-- Modal -->
        <div class="modal fade" id="modalConnexion" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalLabel">Connexion</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="serveur/connexion/connexion.php" method="POST" onSubmit="return validerFormCon();">

                            <div class="col-md-12">
                                <label for="courrielcon" class="form-label">Courriel</label>
                                <input type="email" class="form-control is-valid" id="courrielcon" name="courrielcon" required>
                            </div>
                            
                            <div class="col-md-12">
                                <label for="motdepasscon" class="form-label">Mot de pass</label>
                                <input type="password" class="form-control is-valid" id="motdepasscon" name="motdepasscon" required>
                            </div>
                            <span id="msgErrCon"></span>

                            <br/>
                            <div class="col-6">
                                <button class="btn btn-primary" type="submit">Connecter</button>
                            </div>                    
                        </form>                        
                    </div>
                    <div class="modal-footer">
                        <div id="g_id_onload"
                          data-client_id="480651585486-b891vhjihn565d3iss7rgrnj562qeage.apps.googleusercontent.com"
                          data-context="signin"
                          data-ux_mode="popup"
                          data-callback="onSignIn"
                          data-auto_prompt="false">
                        </div>
                        <div class="g_id_signin"
                          data-type="standard"
                          data-shape="rectangular"
                          data-theme="outline"
                          data-text="signin_with"
                          data-size="medium"
                          data-logo_alignment="left">
                        </div>
                        <div class="fb-login-button" data-width="" data-size="large" data-button-type="" data-layout="" data-auto-logout-link="true" data-use-continue-as="false">
                          <fb:login-button 
                            scope="public_profile,email"
                            onlogin="checkLoginState();">
                          </fb:login-button>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    <!-- Fin modal connexion -->


<!-- Pour les toast de Bootstrap -->
<div class="toast-container posToast">
    <div id="toast" class="toast align-items-center text-white bg-danger border-0" data-bs-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="client/images/message.png" width=24 height=24 class="rounded me-2" alt="message">
            <strong class="me-auto">Messages</strong>
            <small class="text-muted"></small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div id="textToast" class="toast-body"></div>
    </div>
</div>

    <!-- Vendor JS Files -->
    <script src="client/vendor/purecounter/purecounter_vanilla.js"></script>
    <!-- <script src="client/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <script src="client/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="client/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="client/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="client/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="client/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="client/js/main.js"></script>
</body>
</html>