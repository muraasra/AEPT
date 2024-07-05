<?php
session_start();
// Vérification de la connexion

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
require 'database.php';
$titre=$lienSite=$date_debut=$date_fin=$region_id=$categorie_id=$montant="";

$nameError = $lienSiteError = $montantError = $categoryError = $imageError = $name = $lienSite =$dateDebut=
$dateFin=$montant=$categorie_idError=$projectIdError=$datePublicationError=$dateDebutError=$montant = "";

if (!empty($_POST)) {
    $name               = checkInput($_POST["name"]);
    $lienSite        = checkInput($_POST['lienSite']);
    $image              = checkInput($_FILES["image"]["name"]);
    $imagePath          = '../images/' . basename($image);
    $imageExtension     = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess          = true;
    $isUploadSuccess    = false;

  
    if (empty($name)) {
        $nameError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    if (empty($lienSite)) {
        $lienSiteError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    if (empty($image)) {
        $imageError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    } else {
        $isUploadSuccess = true;
        if (
            $imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" &&
            $imageExtension != "gif"
        ) {
            $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .gif, .png";
            $isSuccess = false;
        }
        if (file_exists($imagePath)) {
            $imageError = "Le fichier existe déja";
            $isSuccess = false;
        }
        // if ($_FILES["image"]["size"] > 300000) {
            
        //     $imageError = "Le fichier ne doit pas depasser les 1Mo";
        //     $isSuccess = false;
        // }
        if ($isUploadSuccess) {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
                $imageError = "il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
            }
        }
    }
    if ($isSuccess && $isUploadSuccess) {

        $db = new database();
        $db->create_partenaire($name, $image, $lienSite);
        header("location:partner.php");
    }
}
function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
};




?>







<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <title>add partner- Administration AEPT</title>
</head>

<body>
    
    <div class="container">
            <h1><strong style="padding-top: 15px">Add partner </strong> </a>
            </h1><br>
            <form class="form" action="partner_add.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?php echo $name ?>">
                    <span class="help-inline"><?php echo $nameError; ?></span>

                </div>
                <div class="form-group">
                    <label for="lienSite">Adress web:</label>
                    <input type="text" class="form-control" name="lienSite" id="lienSite" placeholder="lienSite" value="<?php echo $lienSite ?>">
                    <span class="help-inline"><?php echo $lienSiteError; ?></span>
                </div>
                
                <div class="form-group">
                    <label for="image">Selection of image: </label>
                    <input type="file" id="image" name="image">
                    <span class="help-inline"><?php echo $imageError; ?></span>
                </div>

                <br>
                <div class="form-action">
                <a class="btn btn-primary " href="partner.php"><span class="icon-arrow-left"></span> Back</a>
                <button type="submit" class="btn btn-info "><span class="icon-plus"></span> Add</button>

                </div>
            </form>
        
    </div>

</body>

</html>


</body>

</html>