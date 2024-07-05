<!doctype html>
<html lang="en">

  <head>
    <title>A.E.P.T. &mdash; Access a l'Education Pour Tous </title>
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

            <div class="col-3 ">
              <div class="site-logo">
                <a href="index.php">A.E.P.T.</a>
              </div>
            </div>

            <div class="col-9  text-right">
              

              <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>

              

              <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                <ul class="site-menu main-menu js-clone-nav ml-auto ">
                  <li ><a href="index.php" class="nav-link">Home</a></li>
                  <li><a href="actuality.php" class="nav-link">Our Actuality</a></li>
                  <li><a  href="project.php" class="nav-link">Our Achievement</a></li>
                  <li class="active"><a href="contact.php" class="nav-link">Contact us</a></li>
                  <li><a href="about.php" class="nav-link">About Us</a></li>

                </ul>
              </nav>
            </div>

            
          </div>
        </div>

      </header>

    <div class="ftco-blocks-cover-1" >
      <div class="site-section-cover overlay" data-stellar-background-ratio="0.5" style="background-image: url('images/img_1.jpg')">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7">
              <h1 class="mb-3">Contact Us</h1>
              <p>We are available for all your request</p>
              <p><a href="#contact-section" class="btn btn-info" data-aos="fade-up" data-aos-delay="100">Learn More</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light" id="contact-section">
      <div class="container">
        <div class="row justify-content-center text-center">
        <div class="col-7 text-center mb-5">
          <h2>Contact Us Or Use This Form To Rent A Car</h2>
          <p>We are available for all your requestWe are available for all your requestWe are available for all your request</p>
        </div>
      </div>
        <div class="row">
          
            <?php
            require "admin/Database.php";
$send="";
$array = array("firstname" => "", "name" => "", "email" => "", "message" => "", "firstnameError" => "", "nameError" => "", "emailError" => "", "messageError" => "", "isSuccess" => false);
$emailTo = "info@aept.uno";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $array["firstname"] = verifyInput($_POST["firstname"]);
    $array["name"] = verifyInput($_POST["name"]);
    $array["email"] = verifyInput($_POST["email"]);
    $array["message"] = verifyInput($_POST["message"]);
    $array["isSuccess"] = true;
    $emailText = "";
    if (empty($array["firstname"])) {
        $array["firstnameError"] = "Entrer votre prenom !";
        $array["isSuccess"] = false;
    } else
        $emailText .= "Prenom: {$array['firstname']}\n";
    if (empty($array["name"])) {
        $array["nameError"] = "Entrer votre nom !";
        $array["isSuccess"] = false;
    } else
        $emailText .= "Nom: {$array["name"]}\n";

    if (!isEmail($array["email"])) {
        $array["emailError"] = "Verifier votre email ! ";
        $array["isSuccess"] = false;
    } else
        $emailText .= "Email: {$array["email"]}\n";
    if (empty($array["message"])) {
        $array["messageError"] = " le message est obligatoire !";
        $array["isSuccess"] = false;
    } else
        $emailText .= "Message: {$array["message"]}\n";
    if ($array["isSuccess"]) {
        $headers =  " From: {$array["name"]} {$array["firstname"]}  <{$array["email"]}>\r\nReply-To: {$array["email"]}  ";
        mail($emailTo, "Un message de votre site", "$emailText \n \n $headers");
        $db= new Database();
        $db->create_contact($array["name"],$array["email"],$array["message"]);
        $send="<p class='thank-you'> Votre message a bien été envoyé merci de nous avoir contactez :) </p> ";
    }
     json_encode($array);
}
function isEmail($var)
{
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}



function verifyInput($var)
{

    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);

    return $var;
}
?>
              <div class="col-lg-8 mb-5" >
              <form action="#" method="post" data-aos="fade-up" data-aos-delay="100">
              <div class="form-group row">
                <div class="col-md-6 mb-4 mb-lg-0">
                  <input type="text" class="form-control" placeholder="First name" name="firstname">
                  <p class="comments"><?php echo $array["firstnameError"]; ?> </p>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="name" name="name">
                  <p class="comments"><?php echo $array["nameError"]; ?> </p>
                  </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Email address" name="email">
                  <p class="comments"><?php echo $array["emailError"]; ?> </p>
                  </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <textarea name="message" id="" class="form-control" placeholder="Write your message." cols="30" rows="10"></textarea>
                  <p class="comments"><?php echo $array["messageError"]; ?> </p>
                  </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6 mr-auto">
                  <input type="submit" class="btn btn-block btn-info text-white py-3 px-5" value="Send Message">
                </div>
                
              </div>
            </form>
          </div>
          <div class="col-lg-4 ml-auto">
            <div class="bg-white p-3 p-md-5" data-aos="fade-up" data-aos-delay="100">
              <h3 class="text-black mb-4">Contact Info</h3>
              <ul class="list-unstyled footer-link">
                <li class="d-block mb-3">
                  <span class="d-block text-black">Address:</span>
                  <span>Djeleng, Bafoussam Ouest, ameroun</span></li>
                <li class="d-block mb-3"><span class="d-block text-black">Phone:</span><span>+237 694 262 090</span></li>
                <li class="d-block mb-3"><span class="d-block text-black">Email:</span><span>info@aept.uno</span></li>
              </ul>
            </div>
          </div><?php echo $send; ?>
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
        <div class="row pt-5 mt-5 text-center" data-aos="fade-up" data-aos-delay="100">
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

