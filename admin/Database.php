<?php
class Database
{
    private static $dbHost = "localhost";
    private static $dbName = "aept_db";
    private static $dbUser = "root";
    private static $dbUserPassword = "";
    private static $connection = null;

    public function __construct(){

    }

    public static function connect()
    {
        try {
            self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbUserPassword);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return self::$connection;
    }
    public static function disconnect()
    {
        self::$connection = null;
    }
    public function create_projet($titre,$image, $description, $date_debut, $date_fin, $region_id, $categorie_id, $montant) {

       $db = Database::connect();
       $sql = $db->prepare("INSERT INTO Projets (titre,image, description, date_debut, date_fin, region_id, categorie_id, montant) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
       $stmt = $sql->execute(array( $titre,$image, $description, $date_debut, $date_fin, $region_id, $categorie_id, $montant));
       $db = Database::disconnect();
       if ($stmt) return true; else return false;
    }
    public function get_projets() {

        $db = Database::connect();
        $sql=$db->query("SELECT * FROM Projets");
        return $sql;

    }
    public function get_projets_by_region($region_id) {

        $db = Database::connect();
        $sql=$db->query("SELECT * FROM Projets WHERE Region = '$region_id'");
        return $sql->fetch();

    }
    public function get_projets_by_categorie($categorie_id) {

        $db = Database::connect();
        $sql=$db->query("SELECT * FROM Projets WHERE categorie_id = '$categorie_id' ");
        return $sql->fetch();

    }
    public function update_projet($id, $titre,$image, $description, $date_debut, $date_fin, $region_id, $categorie_id, $montant) {
        $db = Database::connect();
        $sql= $db->prepare("UPDATE Projets SET titre=?,image=?, description=?, date_debut=?, date_fin=?, region_id=?, categorie_id=?, montant=? WHERE id=?");
        $stmt = $sql->execute(array($titre,$image, $description, $date_debut, $date_fin, $region_id, $categorie_id, $montant, $id));
        if ($stmt) return true; else return false;
    }
    public function delete_projet($id){
        $db = Database::connect();
        $sql= $db->prepare("DELETE FROM Projets WHERE id=?");
        $stmt = $sql->execute(array($id));
        if ($stmt) return true; else return false;
    }
    public function create_region($nom){
        $db = Database::connect();
        $sql=$db->prepare("INSERT INTO Regions (nom) VALUES (?)");
        $stmt = $sql->execute(array($nom));
        if ($stmt) return true; else return false;

    }
    public function get_regions() {

        $db = Database::connect();
        $sql=$db->query("SELECT * FROM Regions ");
        return $sql->fetch();

    }
    public function update_region($id, $nom){
        $db = Database::connect();
        $sql= $db->prepare("UPDATE regions SET nom? WHERE id=?");
        $stmt = $sql->execute(array($nom, $id));
        if ($stmt) return true; else return false;
    }
    public function delete_regions($id) {
        $db = Database::connect();
        $sql= $db->prepare("DELETE FROM categories WHERE id=?");
        $stmt = $sql->execute(array($id));
        if ($stmt) return true; else return false;

    }
    public function create_categorie($nom){
        $db = Database::connect();
        $sql=$db->prepare("INSERT INTO categories (nom) VALUES (?)");
        $stmt = $sql->execute(array($nom));
        if ($stmt) return true; else return false;

    }
    public function get_categorie() {

        $db = Database::connect();
        $sql=$db->query("SELECT * FROM categories ");
        return $sql->fetch();

    }
    public function update_categorie($id, $nom){
        $db = Database::connect();
        $sql= $db->prepare("UPDATE categories SET nom? WHERE id=?");
        $stmt = $sql->execute(array($nom, $id));
        if ($stmt) return true; else return false;
    }
    public function delete_categorie($id) {
        $db = Database::connect();
        $sql= $db->prepare("DELETE FROM categories WHERE id=?");
        $stmt = $sql->execute(array($id));
        if ($stmt) return true; else return false;

    }
    public function create_actualite($titre, $description, $date_publication, $image, $projet_id) {

        $db = Database::connect();
        $sql = $db->prepare("INSERT INTO actualites (titre, description, date_publication, image, projet_id) VALUES (?, ?, ?, ?, ?)");
        $stmt = $sql->execute(array( $titre, $description, $date_publication, $image, $projet_id));
        if ($stmt) return true; else return false;
     }
     public function get_actualite() {
 
         $db = Database::connect();
         $sql=$db->query("SELECT * FROM actualites");
         return $sql;
 
     }
     public function get_actualites_by_projet($projet_id) {
 
         $db = Database::connect();
         $sql=$db->query("SELECT * FROM actualites WHERE projet_id = '$projet_id'");
         return $sql->fetch();
 
     }
     public function update_actualite($id, $titre, $description, $date_publication, $image, $projet_id) {
         $db = Database::connect();
         $sql= $db->prepare("UPDATE actualites SET titre=?, description=?, date_publication=?, image=?, projet_id=? WHERE id=?");
         $stmt = $sql->execute(array($titre, $description, $date_publication, $image, $projet_id, $id));
         if ($stmt) return true; else return false;
     }
     public function delete_actualite($id){
         $db = Database::connect();
         $sql= $db->prepare("DELETE FROM actualites WHERE id=?");
         $stmt = $sql->execute(array($id));
         if ($stmt) return true; else return false;
     }
     public function create_partenaire($nom, $logo, $lien_site) {

        $db = Database::connect();
        $sql = $db->prepare("INSERT INTO partenaires (nom, logo, lien_site) VALUES (?, ?, ?)");
        $stmt = $sql->execute(array( $nom, $logo, $lien_site));
        if ($stmt) return true; else return false;
     }
     public function get_partenaire() {
 
         $db = Database::connect();
         $sql=$db->query("SELECT * FROM partenaires");
         return $sql;
 
     }
     public function update_partenaire($id, $nom, $logo, $lien_site) {
         $db = Database::connect();
         $sql= $db->prepare("UPDATE partenaires SET nom=?, logo=?, lien_site=?  WHERE id=?");
         $stmt = $sql->execute(array($nom, $logo, $lien_site, $id));
         if ($stmt) return true; else return false;
     }
     public function delete_partenaire($id){
         $db = Database::connect();
         $sql= $db->prepare("DELETE FROM partenaires WHERE id=?");
         $stmt = $sql->execute(array($id));
         if ($stmt) return true; else return false;
     }
     public function create_témoignage($nom, $description, $image) {

        $db = Database::connect();
        $sql = $db->prepare("INSERT INTO témoignage (nom, description, image) VALUES (?, ?, ?)");
        $stmt = $sql->execute(array( $nom, $description, $image));
        if ($stmt) return true; else return false;
     }
     public function get_témoignage() {
 
         $db = Database::connect();
         $sql=$db->query("SELECT * FROM témoignage");
         return $sql;
 
     }
     public function update_témoignage($id, $nom, $description, $image) {
         $db = Database::connect();
         $sql= $db->prepare("UPDATE témoignage SET nom=?, description=?, image=?  WHERE id=?");
         $stmt = $sql->execute(array($nom, $description, $image, $id));
         if ($stmt) return true; else return false;
     }
     public function delete_témoignage($id){
         $db = Database::connect();
         $sql= $db->prepare("DELETE FROM témoignage WHERE id=?");
         $stmt = $sql->execute(array($id));
         if ($stmt) return true; else return false;
     }
     public function create_contact($nom, $email, $message) {

        $db = Database::connect();
        $sql = $db->prepare("INSERT INTO contacts (nom, email, message, date_envoi) VALUES (?, ?, ?, NOW() )");
        $stmt = $sql->execute(array( $nom, $email, $message));
        if ($stmt) return true; else return false;
     }
     public function get_contact() {
         $db = Database::connect();
         $sql=$db->query("SELECT * FROM contacts");
         return $sql;
 
     }
     public function delete_contact($id){
         $db = Database::connect();
         $sql= $db->prepare("DELETE FROM contacts WHERE id=?");
         $stmt = $sql->execute(array($id));
         if ($stmt) return true; else return false;
     }


    
       






}
Database::connect();




?>
<br>