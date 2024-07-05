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
                <a href="index.php" class="btn btn-primary"> <span class="icon-arrow-left"></span> Retour</a>
              
        </div>

            
          </div>
        </div>
        
      </header>
      <?php
      $nameError = $operatorError = $message = $projectError = $project = $messageError = $amountError = $name = $operator =$dateDebut=$amount=$email=$emailError =$phoneError=$phone= "";
        
          
      require "admin/database.php";
     $db=Database::connect();
     if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = checkInput($_POST["name"]);
    $operator = checkInput($_POST["operator"]);
    $amount = checkInput($_POST["amount"]);
    $project = checkInput($_POST["project"]);
    $phone = checkInput($_POST["phone"]);
    $projectIdError ="";
    $isSuccess = true;
    if (empty($name)) {
        $nameError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    if (empty($operator)) {
        $operatorError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    if (empty($amount)) {
        $amountError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }if (empty($phone)) {
        $phoneError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    
    if ($isSuccess ) {
        
    $sql = $db->query("INSERT INTO paiements (name , operator, amount, project_id, phone) VALUES ('$name','$operator', '$amount', '$project', '$phone')");
    
    if ($sql) {
        header("Location: confirmation.php?success=1");
    } else {
        header("Location: confirmation.php?success=0");

    }

    }
    function checkInput($data)
    {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
    
        return $data;
    };
    
}
?>
<body>
    <div class="container mt-5">
     <h2 class="text-center mb-4">Paiement on ligne</h2>
     <form id="paymentForm" method="post" action="#">
        <div class="form-group">
             <label for="operator">Name:</label>
             <input type="text" class="form-control" id="name" name="name">
             <span class="comments"><?php echo $nameError;?></span>
         </div>
         <div class="row">
         <div class="col-md-6">
             <label for="operator">Operator:</label>
             <select class="form-control" id="operator" name="operator">
                 <option value="Orange">Orange</option>
                 <option value="MTN">MTN</option>
             </select>
             <span class="comments"><?php echo $operatorError;?></span>
         </div>
         <div class="col-md-6">
                    <label for="description">Project :</label>
                    <select class="form-control" id="project" name="project">
                        <?php
                        
                        foreach ($db->query('SELECT*FROM projets') as $row) {
                            echo '<option value="' . $row['id'] . '">' . $row['titre'] .
                                '</option>';
                        }
                        ?>
                    </select>
             <span class="comments"><?php echo $projectError;?></span>
        </div>
    </div>
         <div class="form-group">
             <label for="amount">Amount:</label>
             <input type="number" class="form-control" id="amount" name="amount" required>
             <span class="comments"><?php echo $amountError;?></span>
            </div>
         
         <div class="form-group">
             <label for="phone">Phone:</label>
             <input type="tel" class="form-control" id="phone" name="phone" required>
             <span class="comments"><?php echo $phoneError;?></span>
         </div>
         <div class="text-center">
             <button type="submit" class="btn btn-info">Valid</button>
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
