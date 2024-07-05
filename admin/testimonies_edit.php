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

$nameError = $descriptionError = $montantError = $categoryError = $imageError = $name = $description =
$datePublication=$datePublicationError=$projectId=$projectIdError = "";

if (!empty($_POST)) {
    $name               = checkInput($_POST["name"]);
    $description        = checkInput($_POST['description']);
    $image              = checkInput($_FILES["image"]["name"]);
    $imagePath          = '../images/' . basename($image);
    $imageExtension     = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess          = true;
    

    
    if (empty($name)) {
        $nameError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    if (empty($description)) {
        $descriptionError = "Ce champ ne peut pas etre vide";
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

            $sql= $db->prepare("UPDATE témoignage SET nom=?, image=?, description=? WHERE id=?");
            $stmt = $sql->execute(array($name, $image, $description , $id));
        } else { // CAS OU LIMAGE NEST PAS MODIFIER 
            $sql= $db->prepare("UPDATE témoignage SET nom=?, image=?, description=?  WHERE id=?");
        $stmt = $sql->execute(array($name , $image, $description, $id));
        }
        Database::disconnect();
        header("location: testimonies.php");
    } else if ($isImageUpdated && $isUploadSuccess) {
        $db = Database::connect();

        $statement = $db->prepare("SELECT image from témoignage WHERE id=?");
        $statement->execute(array($id));
        $item = $statement->fetch();

        $image = $item["image"];

        Database::disconnect();
    }
} else { // premiere connection , on reprend les valeur dans la base de donne
    $db = Database::connect();

    $statement = $db->prepare("SELECT*from témoignage WHERE id=?");
    $statement->execute(array($id));
    $item = $statement->fetch();

    $name               = $item["nom"];
    $description        = $item['description'];
    $image             = $item["image"];

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
    <title>Edit testimonies- Administration AEPT</title>
</head>

<body>
    
    <div class="container">
        
            <h1><strong style="padding-top: 15px">Edit testimonies </strong> </a>
            </h1><br>
            <form class="form" action="<?php echo'testimonies_edit.php?id='.$id;?>" method="post" enctype="multipart/form-data">
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
                
                <div class="form-group">
                        <label> image: </label>
                        <p><?php 
                        $db = Database::connect();

                        $statement = $db->prepare("SELECT*from témoignage WHERE id=?");
                        $statement->execute(array($id));
                        $item = $statement->fetch();
                        $image             = $item["image"];
                    
                        Database::disconnect();
                        echo $image; ?></p>
                        <label for="image">Selection of image: </label>
                        <input type="file" id="image" name="image" value="<?php echo $image; ?>">
                        <span class="help-inline"><?php echo $imageError; ?></span>
                    </div>

                <br>
                <div class="form-action">
                <a class="btn btn-primary " href="testimonies.php"><span class="icon-arrow-left"></span> Back</a>
                <button type="submit" class="btn btn-info "><span class="icon-pencil"></span> Edit</button>

                </div>
            </form>
        
    </div>

</body>

</html>


</body>

</html>
