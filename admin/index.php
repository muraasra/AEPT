<?php

session_start();

// Vérification des informations de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des informations de connexion (code de connexion ici)
    if ($username === 'admin' && $password === 'password') {
        $_SESSION['user'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $error_message = 'Identifiants incorrects.';
    }
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Administration AEPT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    
        <div class="login-container">
            <h1>Connexion</h1>
            
            <form method="post" action="" class="form-group">
                <?php if (isset($error_message)) { ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php } ?>
            <br>
                <input class="form-control" type="text" id="username" name="username" placeholder="Nom d'utilisateur ">
                <br>
                <input class="form-control" type="password" id="password" name="password" placeholder="Mot de passe">
                <br>
                <button class="btn btn-login" type="submit">Se connecter</button>
            </form>
        </div>
   





<script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>