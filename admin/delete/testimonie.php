<?php 
require "../Database.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db=Database::connect();
    $sql =$db->query("DELETE FROM témoignages WHERE id ='$id' ");
    echo "Élément supprimé avec succès.";
  header("location: ../testimonies.php");
}


?>