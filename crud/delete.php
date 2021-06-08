<?php
// Pour démarrer une session
session_start();
// Inclusion de la connexion à la base
require_once('connect.php');


// Pour vérifier que l'id existe
if(isset($_GET['pro_id']) && !empty($_GET['pro_id'])) {


    // Nettoyage de l'id envoyé
$pro_id = strip_tags($_GET['pro_id']);

$sql = "SELECT pro_id, pro_ref, cat_nom, pro_libelle, pro_description, pro_prix, pro_stock, pro_couleur, pro_d_ajout, pro_d_modif FROM produits, categories WHERE produits.pro_cat_id = categories.cat_id AND 'pro_id' = :pro_id;"; 

// Préparation de la requête
$query = $db->prepare($sql);


// On vérifie que l'id soit un nombre entier
 $query->bindValue(':pro_id', $pro_id, PDO::PARAM_INT); 

// Execution de la requête 
$query->execute();

// Récupération du produit
$produit = $query->fetch();

// Vérification de l'existence du produit
if(!$produit){
    $_SESSION['erreur'] = "Cet id n'existe pas";
    header('Location: tableau.php');
    die();
}


$sql = "DELETE FROM produits WHERE 'pro_id' = :pro_id;"; 

// Préparation de la requête
$query = $db->prepare($sql);


// On vérifie que l'id soit un nombre entier
 $query->bindValue(':pro_id', $pro_id, PDO::PARAM_INT); 

// Execution de la requête 
$query->execute();
$_SESSION['message'] = "Le produit a bien été supprimé";
    header('Location: tableau.php');



}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: tableau.php');
}
?>

