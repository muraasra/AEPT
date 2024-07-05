<!doctype html>
<html lang="en">

  <head>
    <title>A.E.P.T. &mdash; Acces a l'Education Pour Tous</title>
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
                <a href="index.php" data-aos="fade-up" data-aos-delay="100"> <b> A.E.P.T. </b></a>
              </div>
            </div>

            <div class="col-9  text-right">
              

              <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>

              

              <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                <ul class="site-menu main-menu js-clone-nav ml-auto " data-aos="fade-up" data-aos-delay="100">
                  <li class="active"><a href="index.php" class="nav-link">Home</a></li>
                  <li><a href="actuality.php" class="nav-link">Our Actuality</a></li>
                  <li><a  href="project.php" class="nav-link">Our Achievement</a></li>
                  <li><a href="contact.php" class="nav-link">Contact us</a></li>
                  <li ><a href="about.php" class="nav-link">About Us</a></li>
                </ul>
              </nav>
            </div>

          </div>
        </div>

      </header>

    <div class="ftco-blocks-cover-1">
      <div class="site-section-cover overlay" data-stellar-background-ratio="0.5" style="background:linear-gradient(#0059ff,#04f1f9);">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7">
              <h1 class="mb-3" ><b>The Main Title Title </b></h1>
              <p >Description of the main title on this page Description of the main title on this page Description of the main title on this page Description of the main title on this page Description of the main title on this page</p>
              <p><a href="#site-section" class="btn btn-info" data-aos="fade-up" data-aos-delay="100">Learn More</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light" id="site-section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <h3 class="bigTitle  text-center" >Our Mission</h3>
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="img-years">
              <img src="images/img_1.jpg" alt="Image" class="img-fluid">
              
            </div>

          </div>
          <div class="col-lg-5 ml-auto pl-lg-5 text-center">
           
            <p class="mb-5 lead">This organisation content many mission who is describe on this image </p>
            
          </div>
        </div>

      </div>
    </div>
    
    <div class="site-section">
      <div class="container" data-aos="fade-up" data-aos-delay="100" >
        <h3 class="bigTitle  text-center">Project of Land d'A.E.P.T. !</h3>
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="img-years">
              <img src="images/img_1.jpg" alt="Image" class="img-fluid">
              <div class="year">
                <span>X <span>years in <br>excellent service</span></span>
              </div>
            </div>

          </div>
          <div class="col-lg-5 ml-auto pl-lg-5 text-center">
          
            <p class="mb-5 lead">Click on the region to display it's projects </p>
            <table class="table table-striped">
              <tbody>
              <?php
require "admin/Database.php";
$db=Database::connect();
$stmtAc=$db->query("SELECT * FROM actualites  LIMIT 3;");
$stmtPa=$db->query("SELECT * FROM partenaires ;");
$stmtCo=$db->query("SELECT * FROM contacts  ;");
$stmtTes=$db->query("SELECT * FROM témoignage  ;");
$stmtPro=$db->query("SELECT * FROM projets ;");
$date=date("Y-m-d");
$stmtTime=$db->query("SELECT * FROM projets Where date_fin>='".$date."';");
$array=[0];
$amount=0;
foreach($stmtPro as $row){
  $amount += $row['montant'];
  if(!in_array($row['region_id'],$array)){
    $region=$db->query("SELECT * FROM regions WHERE id ='". $row['region_id']."'");
    $regionS=$region->fetch();
    echo '<tr><td><a class="regionLink" href="regions.php?id='.$row['region_id'].'">'.$regionS["nom"].' </a></td></tr> ';
    array_push($array,$row["region_id"]);
  }
  
}

?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    
    <div class="site-section section-3" data-stellar-background-ratio="0.5" style="background-image: url('images/img_1.jpg');">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center text-center">
          <div class="col-7 text-center mb-5">
            <h2 class="text-white bigTitle  primary-color-icon text-center">Our Personnal Numbers</h2>
            <p class="lead text-white"> Here is a brief summary of numbers ours project </p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-1" data-aos="fade-up" data-aos-delay="100">
              <span class="service-1-icon">
                <span class="icon-group"></span>
              </span>
              <div class="service-1-contents">
               
                <h3><b><?php echo $stmtCo->rowCount(); ?> </b> <br> Participant</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-1" data-aos="fade-up" data-aos-delay="100">
              <span class="service-1-icon">
                <span class="icon-supervisor_account"></span>
              </span>
              <div class="service-1-contents">
                <h3> <b><?php echo $stmtPa->rowCount(); ?>  </b> <br>Partners</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-1" data-aos="fade-up" data-aos-delay="100">
              <span class="service-1-icon">
                <span class="icon-hourglass-half "></span>
              </span>
              <div class="service-1-contents">
                <h3> <b><?php echo $stmtTime->rowCount(); ?>  </b> <br> Incomming projects </h3>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-1" data-aos="fade-up" data-aos-delay="100">
              <span class="service-1-icon">
                <span class="icon-hourglass-end"></span>
              </span>
              <div class="service-1-contents">
                <h3> <b><?php echo $stmtPro->rowCount()-$stmtTime->rowCount(); ?>  </b> <br> Projects finish</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-1" data-aos="fade-up" data-aos-delay="100">
              <span class="service-1-icon">
                <span class="icon-monetization_on"></span>
              </span>
              <div class="service-1-contents">
                <h3> <b> <?php echo $amount." Fcfa"; ?></b> <br> Total amount of all the projects</h3>
              </div>
            </div>
          </div>
          

        </div>
      </div>
    </div>
    
    <div class="site-section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center  mb-5">
          <div class="col-md-7 text-center">
            <h3 class="bigTitle  text-center">Our actuality </h3>
          </div>
        </div>
        <div class="row">
          

       

              <?php  
              foreach($stmtAc as $item) {
                ?>
              <div class="item-1 h actu col-lg-4 col-md-6 mb-2" data-aos="fade-up" data-aos-delay="100">
              <?php echo'<a href="actuality_view.php?id='.$item["id"].'">'; ?>
                <img src="images/<?php echo $item['image'];?>" alt="<?php echo $item['titre'];?>"  width="500px" height="500px" class="img-fluid">
                <div class="item-1-contents">
                <h4 class="date_article">Date de publication : <b><?php echo $item['date_publication'];?></b></h4>

                <?php echo '</a>'; ?>
                  <h3><?php echo $item['titre'];?></h3>
                  <p><?php echo $item['description'];?></p>
                  <div class="container " style="text-align: center; color: aliceblue;">
                  <a href="faire_un_don.php"><h1 class="text-center btn btn-info" > Je fais un don </h1></a>
                  </div>
                </div>
              </div>
              <?php }?>

              <div class="item-1 h actu col-lg-4 col-md-6 mb-2" data-aos="fade-up" data-aos-delay="100">
                <img src="images/img_1.jpg" alt="Image" class="img-fluid">
                <div class="item-1-contents">
                  <h4 class="date_article">Date de publication : <b>Date</b></h4>
                  <h3>Title</h3>
                  <p>Description of this article here place intDescription of this article here placeDescription of this article here placeDescription of this article here placeDescription of this article here place </p>
                </div>
              </div>
              <div class="item-1 h actu col-lg-4 col-md-6 mb-2" data-aos="fade-up" data-aos-delay="100">
                <img src="images/img_1.jpg" alt="Image" class="img-fluid">
                <div class="item-1-contents">
                  <h3>Title</h3>
                  <h4 class="date_article">Date</h4>
                  <p>Description of this article here place intDescription of this article here placeDescription of this article here placeDescription of this article here placeDescription of this article here place </p>
                </div>
              </div>

              

              <div class="container " style="text-align: center; color: aliceblue;">
                <h1 class="text-center btn btn-info" > Je fais un don </h1>
                 </div>
            
          
        </div>

        
      </div>
    </div>


    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center  mb-5">
          <div class="col-md-7 text-center">
            <h3 class="bigTitle  text-center">Testimonials</h3>

            <p class="text-center">
              
            </p>
          </div>

        </div>
        <div class="row testimonial" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-8 col-md-8 col-sm-12">
          
              
            <div class="nonloop-block-13 owl-carousel d-flex">
              <?php  foreach($stmtTes as $item) {?>
              <div class="item-1 h card-img">
                <img src="images/<?php echo $item['image'];?>" alt="<?php echo $item['nom'];?>" width="600px" height="600px" class=" image">
                <div class="card-img-overlay"> 
                  <h4 class="card-title text-white"> <b> <?php echo $item['nom'];?></b></h4>
                   <p class="card-text "> <?php echo $item['description'];?></p>
                </div>
              </div>
              <?php }?>
              <div class="item-1 h card-img">
                <img src="images/img_1.jpg" alt="Image" class="img-fluid image">
                <div class="card-img-overlay"> 
                  <h4 class="card-title text-white"> <b> Rsdfdsjsbdb dsbibsdubi</b></h4>
                   <p class="card-text "> .lkjhg njhdfj jhsdfjkh sjhdfkh sfdjk dsbibsdubi .lkjhg njhdfj jhsdfjkh sjhdfkh sfdjk dsbibsdubi .lkjhg njhdfj jhsdfjkh sjhdfkh sfdjk dsbibsdubi 1 </p>
                </div>
              </div>
              <div class="item-1 h card-img">
                <img src="images/img_1.jpg" alt="Image" class="img-fluid image">
                <div class="card-img-overlay"> 
                  <h4 class="card-title text-white"> <b> Rsdfdsjsbdb dsbibsdubi</b></h4>
                   <p class="card-text "> .lkjhg njhdfj jhsdfjkh sjhdfkh sfdjk dsbibsdubi .lkjhg njhdfj jhsdfjkh sjhdfkh sfdjk dsbibsdubi .lkjhg njhdfj jhsdfjkh sjhdfkh sfdjk dsbibsdubi 1 </p>
                </div>
              </div>

              
                
                
             

              
            </div>
            <span  class=" custom-prev"><span class="icon-arrow-left"></span></span>
              <span  class=" custom-next"><span class="icon-arrow-right"></span></span>

          </div>
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container " data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            <h3 class="bigTitle  text-center">Our partners </h3>
            <p class="mb-5 lead">List of all partners in A.E.P.T. </p>
          </div>
        </div>
        <div class="row partners " >
          <div class="partner">

          
            <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="100">
              <a href="#" class="">
                <img src="images/img_1.jpg" width="200px " height="150px" alt="Image placeholder">
                <h2>Name of partner</h2>
              </a>
            </div>
            <?php  foreach($stmtPa as $item) {?>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <a href="<?php echo $item['lien_site'];?>" class="">
                <img src="images/<?php echo $item['logo'];?>" width="200px " height="150px" alt="Image placeholder">
                <h2><?php echo $item['nom'];?></h2>
              </a>
            </div>
          <?php  } ?>

            <div class="col-lg-4 col-md-6 col-sm-12">
              <a href="#" class="">
                <img src="images/img_1.jpg" width="200px " height="150px" alt="Image placeholder">
                <h2>Name of partner</h2>
              </a>
            </div>
            
          </div>  
        </div>
      </div>
    </div>
    <!-- END section -->


    
    
    <div class="site-section bg-light">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-7 text-center mb-5">
            <h2 class="bigTitle  text-center">About Us</h2>
            <h3 class="lead text-info"> <b><u> Histoire </u></b> </h3>
            <p class="lead"> Page détaillée présentant l'organisation AEPT, son histoire, ses valeurs, ses missions et ses objectifs.  </p>
            <h3 class="lead text-info"> <b><u> Valeurs </u></b> </h3>
            <p class="lead"> Page détaillée présentant l'organisation AEPT, son histoire, ses valeurs, ses missions et ses objectifs.  </p>
            <h3 class="lead text-info"> <b><u> Mission et objectifs </u></b> </h3>
            <p class="lead"> Page détaillée présentant l'organisation AEPT, son histoire, ses valeurs, ses missions et ses objectifs.  </p>
            <h3 class="lead text-info"> <b><u> Siege social </u></b> </h3>
            <p class="lead"> Page détaillée présentant l'organisation AEPT, son histoire, ses valeurs, ses missions et ses objectifs.  </p>
          </div>
        </div>
        <div class="row">
          
          
          
        </div>
      </div>
    </div>


    


    <div class="site-section section-3" data-stellar-background-ratio="0.5" style="background-image: url('images/img_1.jpg');">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center text-center">
          <div class="col-7 text-center mb-5">
            <h2 class="text-white bigTitle  primary-color-icon text-center">Contact Us</h2>
            <p class="lead text-white mb-5">We are available for all your request</p>
            <p><a href="contact.php" class="btn btn-info">Contact Us Now</a></p>
          </div>
        </div>
      </div>
    </div>

    

    <footer class="site-footer">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
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
                  <li><a href="#">actuality</a></li>
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
            <div class="border-top pt-5" data-aos="fade-up" data-aos-delay="100">
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

