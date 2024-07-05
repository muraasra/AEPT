<!doctype html>
<html lang="en">

  <head>
    <title>A.E.P.T. &mdash;</title>
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

        <div class="container">
          <div class="row align-items-center position-relative">

            <div class="col-3 ">
              <div class="site-logo">
                <a href="actuality.php" class="btn btn-info"> <span class="b icon-angle-left"></span> Retour</a>
              </div>
            </div>

            <div class="col-9  text-right">
              

              <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>

              
            </div>

            
          </div>
        </div>
        <?php 
              require "admin/database.php";
              if (!empty($_GET['id'])) {

                $id = $_GET['id'];
              }else header("location: project.php");
              $db=Database::connect();
              $stmtAc=$db->query("SELECT * FROM actualites WHERE id=".$id." ;"); 
              $item=$stmtAc->fetch();
              $stmt=$db->query("SELECT * FROM projets WHERE id=".$item['projet_id']." ;");
              
              $stmtPro=$stmt->fetch();

        ?>
      </header>

    <div class="ftco-blocks-cover-1">
      <div class="site-section-cover overlay" data-stellar-background-ratio="0.5" style="background-image: url('images/<?php echo $item['image'];?>')">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7">
              <h1 class="mb-3"><?php echo $item['titre'];?></h1>
              <p><?php echo $item['description'];?></p>
              <p><a href="#site-section" class="btn btn-info" data-aos="fade-up" data-aos-delay="100">Learn More</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

      
        
        
        <div class="container-fluid pl-5 pr-5 projectHeader" id="site-section" data-aos="fade-up" data-aos-delay="100">
          
              <div class="projectTitle bigTitle ">
                <b><?php echo $item['titre'];?></b>

              </div>
              <div class="contentTitle projectHeader">
              <h3 class="date_article projectHeader">Date de debut: <b><?php echo $item['date_publication'];?></b></h3>
              <?php echo'<a href="project_view.php?id='.$stmtPro['id'].'">'; ?>
              <h3 class="date_article projectHeader" data-aos="fade-up" data-aos-delay="100">Du projet: <b> <?php echo $stmtPro['titre'] ?></b></h3>
              <?php echo'</a>'; ?>
              <br>
              <p class="capitalize"><?php echo '|       '.$item['description'];?></p>
              </div>
              <br>
              <div class="container " style="text-align: center; color: aliceblue;">
                <a href="faire_un_don.php"><h1 class="text-center btn btn-info" data-aos="fade-up" data-aos-delay="100"> Je fais un don </h1></a>
                 </div>
              <br>
        </div>
        

        
      </div>
      </div>
      </div>

  



    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <img src="images/img_1.jpg" alt="Image" class="img-fluid mb-5">
            <h2 class="footer-heading mb-3">About Us</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
          </div>
          <div class="col-lg-8 ml-auto">
            <div class="row">
              <div class="col-lg-6 ml-auto">
                <h2 class="footer-heading mb-4">Quick Links</h2>
                <ul class="list-unstyled">
             <li><a href=""><span class="icon-whatsapp"></span></a> <a href=""><span class="icon-send"></span></a> <a href=""><span class="icon-facebook-official"></span></a> <a href=""><span class="icon-instagram"></span></a>  
            </li>
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Projects</a></li>
                  <li><a href="#">Project</a></li>
                  <li><a href="#">Our Personnal number </a></li>
                  <li><a href="#">Contact Us </a></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <h2 class="footer-heading mb-4">Newsletter</h2>
                <form action="#" class="d-flex" class="subscribe">
                  <input type="text" class="form-control mr-3" placeholder="Email">
                  <input type="submit" value="Send" class="btn btn-info">
                </form>
              </div>
              
            </div>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
              <p>
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved |  By <a href="https:wa.me/658934147" target="_blank" >Wilfried Tayou</a>
            </p>
            </div>
          </div>

        </div>
      </div>
    </footer>

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

    <script src="js/main.js"></script>

  </body>

</html>

