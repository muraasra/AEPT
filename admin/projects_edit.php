<?php
session_start();
// Vérification de la connexion
if (!empty($_GET['id'])) {

    $id = checkInput($_GET['id']);
}
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
    

    if(empty($dateDebut   )) {
        $$dateDebutError= "Ce champ ne peut pas etre vide";
        $isSuccess=false;
    }
    if(empty($dateFin     )) {
        $dateFinError= "Ce champ ne peut pas etre vide";
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
        $isImageUpdated = false; 
    } else {
        $isImageUpdated = true;
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
        // if ($_FILES["image"]["size"] > 1000) {
        //     $imageError = "Le fichier ne doit pas depasser les 1Mo";
        //     $isSuccess = false;
        // }
        if ($isImageUpdated) {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
                $imageError = "il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
            }
        }
    }
    if (($isSuccess && $isImageUpdated &&  $isUploadSuccess) || ($isSuccess && !$isImageUpdated)) {

        $db = Database::connect();
        if ($isImageUpdated) { // CAS OU L'IMAGE EST MODIFIER 

            $sql= $db->prepare("UPDATE Projets SET titre=?,image=?, description=?, date_debut=?, date_fin=?, region_id=?, categorie_id=?, montant=? WHERE id=?");
            $stmt = $sql->execute(array($name,$image, $description, $dateDebut, $datefin, $region_id, $categorie_id, $montant, $id));
        } else { // CAS OU LIMAGE NEST PAS MODIFIER 
            $sql= $db->prepare("UPDATE Projets SET titre=?,image=?, description=?, date_debut=?, date_fin=?, region_id=?, categorie_id=?, montant=? WHERE id=?");
        $stmt = $sql->execute(array($name,$image , $description, $dateDebut, $dateFin, $region_id, $categorie_id, $montant, $id));
        }
        Database::disconnect();
        header("location:project.php");
    } else if ($isImageUpdated && $isUploadSuccess) {
        $db = Database::connect();

        $statement = $db->prepare("SELECT image from projets WHERE id=?");
        $statement->execute(array($id));
        $item = $statement->fetch();

        $image = $item["image"];

        Database::disconnect();
    }
} else { // premiere connection , on reprend les valeur dans la base de donne
    $db = Database::connect();

    $statement = $db->prepare("SELECT*from projets WHERE id=?");
    $statement->execute(array($id));
    $item = $statement->fetch();

    $name               = $item["titre"];
    $description        = $item['description'];
    $montant              = $item['montant'];
    $dateDebut             = $item['date_debut'];
    $dateFin             = $item['date_fin'];
    $categorie_id           = $item['categorie_id'];
    $region_id           = $item['region_id'];
    $image              = $item["image"];

    Database::disconnect();
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
    <title>add project- Administration AEPT</title>
</head>

<body>
    
    <div class="container">
        
            <h1><strong style="padding-top: 15px">Edit project </strong> </a>
            </h1><br>
            <form class="form" action="<?php echo'projects_edit.php?id='.$id;?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:</label>
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
                      <label for="description">Date begining :</label>
                    <input type="date" class="form-control" name="dateDebut" id="dateDebut" placeholder="dateDebut" value="<?php echo $dateDebut ?>">
                    <span class="help-inline"><?php echo $dateDebutError; ?></span>
                  
                    </div>
                   
                    <div class="col-md-6">
                    <label for="description">Date of end :</label>
                    <input type="date" class="form-control" name="dateFin" id="dateFin" placeholder="dateFin" value="<?php echo $dateFin ?>">
                    <span class="help-inline"><?php echo $dateFinError; ?></span>
                    </div> 
                </div>
            <div class="form-group row">
                <div class="col-md-4">
                <label for="name">Price:</label>
                    <input type="number" step="100" class="form-control" name="montant" id="montant" placeholder="Prix (en F) :" value="<?php echo $montant ?>">
                    <span class="help-inline"><?php echo $montantError; ?></span>
                </div>
                <div class="col-md-4">
                <label for="name">Category:</label>
                    <select class="form-control" id="categorie" name="categorie">
                        <?php
                        $db = Database::connect();
                        foreach ($db->query('SELECT*FROM categories') as $row) {
                            if ($row['id'] == $categorie_id)
                                echo '<option selected="selected" value="' . $row['id'] . '">' . $row['nom'] .
                                    '</option>';
                            else
                                echo '<option  value="' . $row['id'] . '">' . $row['nom'] .
                                    '</option>';
                        }
                        $db = Database::disconnect();
                        ?>
                    </select>
                    <span class="help-inline"><?php echo $categoryError; ?></span>
                </div>
                <div class="col-md-4">
                <label for="name">Region:</label>
                        <select class="form-control" id="region" name="region">
                            <?php
                            $db = Database::connect();
                            foreach ($db->query('SELECT*FROM regions') as $row) {
                                if ($row['id'] == $categorie_id)
                                    echo '<option selected="selected" value="' . $row['id'] . '">' . $row['nom'] .
                                        '</option>';
                                else
                                    echo '<option  value="' . $row['id'] . '">' . $row['nom'] .
                                        '</option>';
                            }
                            $db = Database::disconnect();
                            ?>
                        </select>
                        <span class="help-inline"><?php echo $categoryError; ?></span>
                </div>
                </div>
                <div class="form-group">
                        <label> image: </label>
                        <p><?php echo $image; ?></p>
                        <label for="image">Selection of image: </label>
                        <input type="file" id="image" name="image">
                        <span class="help-inline"><?php echo $imageError; ?></span>
                    </div>

                <br>
                <div class="form-action">
                <a class="btn btn-primary " href="project.php"><span class="icon-arrow-left"></span> Back</a>
                <button type="submit" class="btn btn-info "><span class="icon-pencil"></span> Edit</button>

                </div>
            </form>
        
    </div>

</body>

</html>


</body>

</html>
