
<!doctype html>
<html lang="en">

  <head>
    <title>A.E.P.T. &mdash; Paiement enligne</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">

  </head>

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    
    <div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>



      <header class="site-navbar site-navbar-target" role="banner">

        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row align-items-center position-relative">

        
        <div class="site-logo">
                <a href="index.php" class="btn btn-primary">  Retour</a>
              
        </div>

            
          </div>
        </div>
        
      </header>
      <div class="container mt-5">
        <h2 class="text-center mb-4">Confirm paiement</h2>
        <?php
         if (isset($_GET['success']) && $_GET['success'] == 1) {
             echo '<div class="alert alert-success" role="alert">
                     Votre paiement a été traité avec succès.
                 </div>';
         } else {
             echo '<div class="alert alert-danger" role="alert">
                     Une erreur est survenue lors du traitement de votre paiement. Veuillez réessayer plus tard.
                 </div>';
         }
      ?>
       <p class="text-center">
         <a href="faire_un_don" class="btn btn-info"><span class="icon-arrow-left"></span>Back on paiement page</a>
       </p>
     </div>
     </form>
        </div>
        <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/aos.js"></script>

    <script src="js/main.js"></script></body>
</html>
