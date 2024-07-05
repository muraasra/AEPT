<?php 
require "../Database.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db=Database::connect();
    $sql =$db->query("DELETE FROM projets WHERE id ='$id' ");
    echo "Élément supprimé avec succès.";
  header("location: ../project.php");
}


?>