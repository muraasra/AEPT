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
    $datePublication          = checkInput($_POST['datePublication']);
    $projectId          = checkInput($_POST['projectId']);
    $image              = checkInput($_FILES["image"]["name"]);
    $imagePath          = '../images/' . basename($image);
    $imageExtension     = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess          = true;
    

    if(empty($datePublication)) {
        $region_idError= "Ce champ ne peut pas etre vide";
        $isSuccess=false;
    }
    if(empty($projectId)) {
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

            $sql= $db->prepare("UPDATE actualites SET titre=?, image=?, description=?, date_publication=?, projet_id=?  WHERE id=?");
            $stmt = $sql->execute(array($name, $image, $description , $datePublication,$projectId, $id));
        } else { // CAS OU LIMAGE NEST PAS MODIFIER 
            $sql= $db->prepare("UPDATE actualites SET titre=?, image=?, description=?,  date_publication=?, projet_id=?  WHERE id=?");
        $stmt = $sql->execute(array($name , $image, $description,  $datePublication,$projectId, $id));
        }
        Database::disconnect();
        header("location: actuality.php");
    } else if ($isImageUpdated && $isUploadSuccess) {
        $db = Database::connect();

        $statement = $db->prepare("SELECT image from actualites WHERE id=?");
        $statement->execute(array($id));
        $item = $statement->fetch();

        $image = $item["image"];

        Database::disconnect();
    }
} else { // premiere connection , on reprend les valeur dans la base de donne
    $db = Database::connect();

    $statement = $db->prepare("SELECT*from actualites WHERE id=?");
    $statement->execute(array($id));
    $item = $statement->fetch();

    $name               = $item["titre"];
    $description        = $item['description'];
    $datePublication          = $item['date_publication'];
    $projectId          = $item['projet_id'];
    $image             = $item["image"];

    Database::disconnect();
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
    <title>Edit Actuality- Administration AEPT</title>
</head>

<body>
    
    <div class="container">
        
            <h1><strong style="padding-top: 15px">Edit Actuality </strong> </a>
            </h1><br>
            <form class="form" action="<?php echo'actuality_edit.php?id='.$id;?>" method="post" enctype="multipart/form-data">
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
                      <label for="description">Date Publication :</label>
                    <input type="date" class="form-control" name="datePublication" id="datePublication" placeholder="datePublication" value="<?php echo $datePublication ?>">
                    <span class="help-inline"><?php echo $datePublicationError; ?></span>
                  
                    </div>
                   
                <div class="col-md-6">
                    <select class="form-control" id="projectId" name="projectId">
                        <?php
                        $db = Database::connect();
                        foreach ($db->query('SELECT*FROM projets') as $row) {
                            if ($row['id'] == $projectId)
                                echo '<option selected="selected" value="' . $row['id'] . '">' . $row['titre'] .
                                    '</option>';
                            else
                                echo '<option  value="' . $row['id'] . '">' . $row['titre'] .
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
                        <p><?php 
                        $db = Database::connect();

                        $statement = $db->prepare("SELECT*from actualites WHERE id=?");
                        $statement->execute(array($id));
                        $item = $statement->fetch();
                        $image             = $item["image"];
                    
                        Database::disconnect();
                        echo $image; ?></p>
                        <label for="image">Selectionner une image: </label>
                        <input type="file" id="image" name="image" value="<?php echo $image; ?>">
                        <span class="help-inline"><?php echo $imageError; ?></span>
                    </div>

                <br>
                <div class="form-action">
                    <button type="submit" class="btn btn-success "><span class="glyphicon 
                    glyphicon-pencil"></span> Ajouter</button>
                    <button class="btn btn-login" type="submit">Se connecter</button>
                    <a class="btn btn-primary " href="project.php"><span class="glyphicon 
                    glyphicon-arrow-left"></span> Retour</a>

                </div>
            </form>
        
    </div>

</body>

</html>


</body>

</html>
