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
}

}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: tableau.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Jarditou" content="Jarditou" />
    <title>Jarditou</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <img src="images/jarditou_logo.jpg" class=img-fluid alt="Logo Jarditou" title="Logo Jarditou" width="200px">
            </div>
            <div class="col-lg-4 ">
                <p class="fs-2 text-center">Tout le jardin</p>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Jarditou.com</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="tableau.html">Tableau</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Votre promotion" aria-label="Votre promotion">
                    <button class="btn btn-outline-success" type="submit">Recherche</button>
                </form>
            </div>
        </nav>
        <img src="images/promotion.jpg" class=img-fluid alt="Promotion" title="Promotion" width="100%">
      
<main class="row">
    <div class="row">
        <section class="col-12">
            <h1>Détails du produit <?= $produit['pro_libelle'] ?></h1>
            <p>ID: <?= $produit['pro_id'] ?></p>
            <p>Référence: <?= $produit['pro_ref'] ?></p>
            <p>Catégorie: <?= $produit['cat_nom'] ?></p>
            <p>Libellé: <?= $produit['pro_libelle'] ?></p>
            <p>Description: <?= $produit['pro_description'] ?></p>
            <p>Prix: <?= $produit['pro_prix'] ?></p>
            <p>Stock: <?= $produit['pro_stock'] ?></p>
            <p>Couleur: <?= $produit['pro_couleur'] ?></p>
            <p>Date d&apos;ajout: <?= $produit['pro_d_ajout'] ?></p>
            <p>Date de modification: <? $produit['pro_d_modif'] ?></p>
            <p><a href="tableau.php">Retour</a> <a href="edit.php?pro_id=<?=$produit['pro_id'] ?>">Modifier</a></p>
        </section> 
    </div>
</main>


        <footer>
            <ul class="nav bg-dark" style="margin:auto">
                <li class="nav-item text-muted">
                    <a class="nav-link text-reset" href="#">mention légales</a>
                </li>
                <li class="nav-item text-muted">
                    <a class="nav-link text-reset" href="#">horaires</a>
                </li>
                <li class="nav-item text-muted">
                    <a class="nav-link text-reset" href="#">plan du site</a>
                </li>
            </ul>
        </footer>
    </div>
    <script type=" text/javascript " src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js%22%3E "></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js " integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js " integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG " crossorigin="anonymous "></script>
</body>

</html>