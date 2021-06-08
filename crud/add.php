<?php 

// Pour démarrer une session
session_start();
// Inclusion de la connexion à la base

require_once ("connect.php");


if($_POST){
    if(isset($_POST['pro_libelle']) && !empty($_POST['pro_libelle'])
    && isset($_POST['pro_ref']) && !empty($_POST['pro_ref'])
    && isset($_POST['cat_nom']) && !empty($_POST['cat_nom'])
    && isset($_POST['pro_description']) && !empty($_POST['pro_description'])
    && isset($_POST['pro_prix']) && !empty($_POST['pro_prix'])
    && isset($_POST['pro_stock']) && !empty($_POST['pro_stock'])
    && isset($_POST['pro_couleur']) && !empty($_POST['pro_couleur'])){



// Nettoyage des données envoyées
$pro_libelle = strip_tags($_POST['pro_libelle']);
$pro_ref = strip_tags($_POST['pro_ref']);
$cat_nom = strip_tags($_POST['cat_nom']);
$pro_description = strip_tags($_POST['pro_description']);
$pro_prix = strip_tags($_POST['pro_prix']);
$pro_stock = strip_tags($_POST['pro_stock']);
$pro_couleur = strip_tags($_POST['pro_couleur']);

$sql = "INSERT INTO 'produits' ('pro_libelle', 'pro_ref', 'pro_description', 'pro_prix', 'pro_stock', 'pro_couleur') VALUES (:pro_libelle, :pro_ref, :pro_description, :pro_prix, :pro_stock, :pro_couleur);
INSERT INTO 'categories' ('cat_nom') VALUES (:categories);";

        $query = $db->prepare($sql);

$query->bindValue(':pro_libelle', $pro_libelle, PDO::PARAM_STR);
$query->bindValue(':pro_ref', $pro_ref, PDO::PARAM_STR);
$query->bindValue(':cat_nom', $cat_nom, PDO::PARAM_STR);
$query->bindValue(':pro_description', $pro_description, PDO::PARAM_STR);
$query->bindValue(':pro_prix', $pro_prix, PDO::PARAM_STR);
$query->bindValue(':pro_stock', $pro_stock, PDO::PARAM_INT);
$query->bindValue(':pro_couleur', $pro_couleur, PDO::PARAM_STR);

$query->execute();

$_SESSION['message'] = "Produit ajouté";
require_once('close.php');

header('Location: tableau.php');

     }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
    
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
        <?php 
                if(!empty($_SESSION['erreur'])){
                    echo '<div class="alert alert-danger" role="alert"> '. $_SESSION['erreur'].'</div>';
                    $_SESSION['erreur'] = "";
                }
                ?>
        <form method="post">  
        <div class="form-group">
            <label for="pro_libelle">Produit (libellé)</label>
            <input type="text" id="pro_libelle" name="pro_libelle" class="form-control">
        </div>
        <div class="form-group">
            <label for="pro_ref">Référence du produit</label>
            <input type="text" id="pro_ref" name="pro_ref" class="form-control">
        </div>
        <div class="form-group">
            <label for="cat_nom">Catégorie</label>
            <input type="text" id="cat_nom" name="cat_nom" class="form-control">
        </div>
        <div class="form-group">
            <label for="pro_description">Description</label>
            <input type="text" id="pro_description" name="pro_description" class="form-control">
        </div>
        <div class="form-group">
            <label for="pro_prix">Prix</label>
            <input type="text" id="pro_prix" name="pro_prix" class="form-control">
        </div>
        <div class="form-group">
            <label for="pro_stock">Stock</label>
            <input type="number" id="pro_stock" name="pro_stock" class="form-control">
        </div>
        <div class="form-group">
            <label for="pro_couleur">Couleur</label>
            <input type="text" id="pro_couleur" name="pro_couleur" class="form-control">
        </div>
     
        <button class="btn btn-primary">Envoyer</button> 


</form>
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