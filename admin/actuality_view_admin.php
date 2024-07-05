<!doctype html>
<html lang="en">

  <head>
    <title>A.E.P.T. &mdash;</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="../css/aos.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">

  </head>

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    



      <header class="site-navbar site-navbar-target" role="banner">

        <div class="container" data-target=".site-navbar-target" data-offset="300">
          <div class="row align-items-center position-relative">

            <div class="site-logo">
             <a href="actuality.php" class="btn btn-info"> <span class="icon-arrow-left"></span> Retour</a>
            </div>

            
          </div>
        </div>
        <?php 
              require "database.php";
              if (!empty($_GET['id'])) {

                $id = $_GET['id'];
              }else header("location: project.php");
              $db=Database::connect();
              $stmtAc=$db->query("SELECT * FROM actualites WHERE id=".$id." ;"); 
              $item=$stmtAc->fetch();
              $stmt=$db->query("SELECT * FROM projets WHERE id=".$item['id']." ;");
              
              $stmtPro=$stmt->fetch();

        ?>
      </header>

    <div class="ftco-blocks-cover-1">
      <div class="site-section-cover overlay" data-stellar-background-ratio="0.5" style="background-image: url('../images/<?php echo $item['image'];?>')">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7">
              <h1 class="mb-3"><?php echo $item['titre'];?></h1>
              <p><?php echo $item['description'];?></p>
              <p><a href="#site-section" class="btn btn-info">Learn More</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

      
        
        
        <div class="container-fluid pl-5 pr-5 projectHeader" id="site-section">
          
              <div class="projectTitle bigTitle ">
                <b><?php echo $item['titre'];?></b>

              </div>
              <div class="contentTitle projectHeader">
              <h3 class="date_article projectHeader">Date de debut: <b><?php echo $item['date_publication'];?></b></h3>
              <h3 class="date_article projectHeader">Du projet: <b> <?php echo $stmtPro['titre'] ?></b></h3>
              
              <br>
              <p class="capitalize"><?php echo '|       '.$item['description'];?></p>
              </div>
              
              <br>
        </div>
        

        <div class="row">  
              


              

              

              
            
          
        </div>

        
      </div>
      </div>
      </div>

  



   

    </div>

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery-migrate-3.0.0.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.sticky.js"></script>
    <script src="../js/jquery.waypoints.min.js"></script>
    <script src="../js/jquery.animateNumber.min.js"></script>
    <script src="../js/jquery.fancybox.min.js"></script>
    <script src="../js/jquery.stellar.min.js"></script>
    <script src="../js/jquery.easing.1.3.js"></script>
    <script src="../js/bootstrap-datepicker.min.js"></script>
    <script src="../js/aos.js"></script>
   
    <script src="../js/main.js"></script>

  </body>

</html>

