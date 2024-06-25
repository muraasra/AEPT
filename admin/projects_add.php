<?php
session_start();
// Vérification de la connexion

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
require 'database.php';
$titre=$description=$date_debut=$date_fin=$region_id=$categorie_id=$montant="";

$nameError = $descriptionError = $montantError = $categoryError = $imageError = $name = $description =$dateDebut=
$dateFin=$montant=$categorie_idError=$region_idError=$montanError=$dateFinError=$dateDebutError=$montant = "";

if (!empty($_POST)) {
    $name               = checkInput($_POST["name"]);
    $description        = checkInput($_POST['description']);
    $dateDebut          = checkInput($_POST['dateDebut']);
    $dateFin            = checkInput($_POST['dateFin']);
    $montant            = checkInput($_POST['montant']);
    $region_id          = checkInput($_POST['region']);
    $categorie_id           = checkInput($_POST['categorie']);
    $image              = checkInput($_FILES["image"]["name"]);
    $imagePath          = '../images/' . basename($image);
    $imageExtension     = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess          = true;
    $isUploadSuccess    = false;

    if(empty($dateDebut   )) {
        $$dateDebutError= "Ce champ ne peut pas etre vide";
        $isSuccess=false;
    }
    
    if(empty($region_id   )) {
        $region_idError= "Ce champ ne peut pas etre vide";
        $isSuccess=false;
    }
    if(empty($categorie_id)) {
        $categorie_idError= "Ce champ ne peut pas etre vide";
        $isSuccess=false;
    }

    if (empty($name)) {
        $nameError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    if (empty($description)) {
        $descriptionError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    if (empty($montant)) {
        $montantError = "Ce champ ne peut pas etre vide";
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
        $db->create_projet($name,$image, $description, $dateDebut, $dateFin, $region_id, $categorie_id, $montant);
        header("location:project.php");
    }
}
function checkInput($data)
{
    // $data = trim($data);
    // $data = stripslashes($data);
    // $data = htmlspecialchars($data);

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
    <title>add project- Administration AEPT</title>
</head>

<body>
    
    <div class="container">
            <h1><strong style="padding-top: 15px">Add project </strong> </a>
            </h1><br>
            <form class="form" action="projects_add.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?php echo $name ?>">
                    <span class="help-inline"><?php echo $nameError; ?></span>

                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $description ?>">
                    <span class="help-inline"><?php echo $descriptionError; ?></span>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                      <label for="description">Date debut :</label>
                    <input type="date" class="form-control" name="dateDebut" id="dateDebut" placeholder="dateDebut" value="<?php echo $dateDebut ?>">
                    <span class="help-inline"><?php echo $dateDebutError; ?></span>
                  
                    </div>
                   
                    <div class="col-md-6">
                    <label for="description">Date fin :</label>
                    <input type="date" class="form-control" name="dateFin" id="dateFin" placeholder="dateFin" value="<?php echo $dateFin ?>">
                    <span class="help-inline"><?php echo $dateFinError; ?></span>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                    <input type="number" step="100" class="form-control" name="montant" id="montant" placeholder="Prix (en F) :" value="<?php echo $montant ?>">
                    <span class="help-inline"><?php echo $montantError; ?></span>
                </div>
                <div class="col-md-4">
                    <select class="form-control" id="categorie" name="categorie">
                        <?php
                        $db = Database::connect();
                        foreach ($db->query('SELECT*FROM categories') as $row) {
                            echo '<option value="' . $row['id'] . '">' . $row['nom'] .
                                '</option>';
                        }
                        ?>
                    </select>
                    <span class="help-inline"><?php echo $categoryError; ?></span>
                </div>
                <div class="col-md-4">
                    <select class="form-control" id="region" name="region">
                        <?php
                        $db = Database::connect();
                        foreach ($db->query('SELECT*FROM regions') as $row) {
                            echo '<option value="' . $row['id'] . '">' . $row['nom'] .
                                '</option>';
                        }
                        ?>
                    </select>
                    <span class="help-inline"><?php echo $categoryError; ?></span>
                </div>
                </div>
                <div class="form-group">
                    <label for="image">Selectionner une image: </label>
                    <input type="file" id="image" name="image">
                    <span class="help-inline"><?php echo $imageError; ?></span>
                </div>

                <br>
                    <button  type="submit">Se connecter</button>
                    <input type="submit" name="submit" value="valid">
                <div class="form-action">
                    <button type="submit" class="btn btn-success "><span class="glyphicon 
                    glyphicon-pencil"></span> Ajouter</button>
                    <a class="btn btn-primary " href="project.php"><span class="glyphicon 
                    glyphicon-arrow-left"></span> Retour</a>

                </div>
            </form>
        
    </div>

</body>

</html>


</body>

</html>