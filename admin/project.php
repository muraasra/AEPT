<?php

session_start();
require "Database.php" ;
// Vérification de la connexion
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion des projets - Administration AEPT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" style="color: #5c2d05 ;">
    
<div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>



      <header class="site-navbar site-navbar-target" role="banner" style="background: url(../images/img_1.jpg); position: fixed;">

        <div class="container">
          <div class="row align-items-center position-relative">

            <div class="col-3 ">
              <div class="site-logo">
                <a href="dashbord.php"> <b> A.E.P.T. Admin  </b></a>
              </div>
            </div>

            <div class="col-9  text-right">
              

              <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>

              

              <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
              <ul class="site-menu main-menu js-clone-nav ml-auto ">
                  <li ><a href="dashboard.php" class="nav-link ">Home</a></li>
                  <li class="active"><a  href="project.php" class="nav-link ">Project</a></li>
                  <li><a href="actuality.php" class="nav-link ">Actuality</a></li>
                  <li><a href="contact.php" class="nav-link ">Contact</a></li>
                  <li><a href="partner.php" class="nav-link ">partner</a></li>
                  <li ><a href="testimonies.php" class="nav-link ">Testimonies</a></li>
                  <li ><a href="logout.php" class="nav-link ">Log-out</a></li>
                  </ul>
              </nav>
            </div>

            
          </div>
        </div>

      </header>
</div>
<div class="site-section">
<div class="row  mt-5 pl-4 pr-4 ">


        <h1>Gestion des projets</h1>
        <a href="projects_add.php" class="btn btn-info" style="position: absolute;right:0"><span class="icon-plus"></span> Add new    </a>
        <table class="table table-striped table-bordered table-borderless " style="justify-content: space-evenly;">
            <thead>
                <tr>
                <th class="col-lg-3  col-md-2">Nom</th>
                    <th class="col-lg-4  col-md-4">Description</th>
                    <th class="col-lg-2  col-md-2">Statut</th>
                    <th class="col-lg-3  col-md-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $db=new Database(); $projects = $db->get_projets();
                foreach ($projects as $project) { ?>
                    <tr>
                        <td><?php echo $project['titre']; ?></td>
                        <td><?php echo $project['description']; ?></td>
                        <td><?php echo $project['date_fin']; ?></td>
                        <td>
                            <a href="projects_edit.php?id=<?php echo $project['id']; ?>" class="btn btn-info"><span class="icon-edit"></span></a>
                            <a href="projects_view_admin.php?id=<?php echo $project['id']; ?>" class="btn btn-dark"> <span class="icon-eye"></span></a>
                            <?php echo "<button class='btn btn-danger' onclick=\"confirmDelete(" . $project["id"] . ")\"><span class='icon-trash-o'></span></button>"; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    
                    
        <script>
function confirmDelete(id) {
    if (confirm("Voulez-vous vraiment supprimer cet élément ?")) {
        // Exécuter la requête de suppression en PHP
        window.location.href = "delete/project.php?id=" + id;
    }
}
</script>





</div>

    





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

<script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>