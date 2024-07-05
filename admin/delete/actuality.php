<?php 
require "../Database.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db=Database::connect();
    $stmt = $db->query("SELECT * FROM actualites WHERE id='$id';");
    $stmt = $stmt->fetch();
    unlink("../../images/".$stmt['image']);
    $sql =$db->query("DELETE FROM actualites WHERE id ='$id' ");
    echo "Élément supprimé avec succès.";
  header("location: ../actuality.php?action=".$stmt['titre']."'");
}


?>