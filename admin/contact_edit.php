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
$titre=$email=$date_debut=$date_fin=$region_id=$categorie_id=$montant="";

$nameError = $emailError = $message = $messageError = $imageError = $name = $email =$dateDebut=
$dateFin=$montant=$categorie_idError=$projectIdError=$datePublicationError=$dateDebutError=$montant = "";

if (!empty($_POST)) {
    $name               = checkInput($_POST["name"]);
    $email        = checkInput($_POST['email']);
    $message        = checkInput($_POST['message']);
    $isSuccess          = true;

  
    if (empty($name)) {
        $nameError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    if (empty($email)) {
        $emailError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    if (empty($message)) {
        $messageError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    if (($isSuccess)) {

        $db = Database::connect();
      
            $sql= $db->prepare("UPDATE contacts SET nom=?, email=?, message=? WHERE id=?");
            $stmt = $sql->execute(array($name,$email ,$message  , $id));
        $db = Database::disconnect();
        header("location: contact.php");
    } 
} else { // premiere connection , on reprend les valeur dans la base de donne
    $db = Database::connect();

    $statement = $db->prepare("SELECT*from contacts WHERE id=?");
    $statement->execute(array($id));
    $item = $statement->fetch();

    $name               = $item["nom"];
    $email               = $item["email"];
    $message               = $item["message"];

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
    <title>Edit contact- Administration AEPT</title>
</head>

<body>
    
    <div class="container">
        
            <h1><strong style="padding-top: 15px">Edit contact </strong> </a>
            </h1><br>
            <form class="form" action="<?php echo'contact_edit.php?id='.$id;?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?php echo $name ?>">
                    <span class="help-inline"><?php echo $nameError; ?></span>

                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $email ?>">
                    <span class="help-inline"><?php echo $emailError; ?></span>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <input type="text" class="form-control" name="message" id="message" placeholder="message" value="<?php echo $message ?>">
                    <span class="help-inline"><?php echo $messageError; ?></span>
                </div>
                
                
                <br>
                <div class="form-action">
                    <a class="btn btn-primary " href="contact.php"><span class="icon-arrow-left"></span> Back</a>
                    <button type="submit" class="btn btn-info "><span class="icon-pencil"></span> Edit</button>
                    

                </div>
            </form>
        
    </div>

</body>

</html>


</body>

</html>
