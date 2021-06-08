<?php 

// Pour démarrer une session
session_start();
// Inclusion de la connexion à la base
require_once('connect.php');


// Comme les colonnes demandées dans l'exercice et le cahier des charges étaient différentes, j'ai donc décidé de faire un mélange des deux et donc d'inclure l'id, la référence, la catégorie, le libellé, le prix, le stock, la couleur, la date d'ajout et la date de modification
$sql = "SELECT pro_id, pro_ref, cat_nom, pro_libelle, pro_prix, pro_stock, pro_couleur, pro_d_ajout, pro_d_modif FROM produits, categories WHERE produits.pro_cat_id = categories.cat_id AND ISNULL(pro_bloque) ORDER BY pro_d_ajout DESC";

// Préparation à la requête

$query = $db->prepare($sql);

// Exécution de la requête
$query->execute();


// Le résultat est stocké dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('close.php');
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
        <div class="table-responsive m-auto col-12">
            <table class="table table-bordered">
            <?php 
                if(!empty($_SESSION['erreur'])){
                    echo '<div class="alert alert-success" role="alert"> '. $_SESSION['erreur'].'</div>';
                    $_SESSION['erreur'] = "";
                }
                ?>
                <?php 
                if(!empty($_SESSION['message'])){
                    echo '<div class="alert alert-danger" role="alert"> '. $_SESSION['message'].'</div>';
                    $_SESSION['message'] = "";
                }
                ?>
            <a href="add.php" class="btn btn-primary">Ajouter un produit</a>
                <thead>
                    <tr class="table-secondary table-responsive-sm">
                        <!-- <th class="h2" scope="col"><strong>Photo</strong></th> -->
                        <th class="h2" scope="col"><strong>ID</strong></th>
                        <th class="h2" scope="col"><strong>Référence</strong></th>
                        <th class="h2" scope="col"><strong>Cat&eacute;gorie</strong></th>
                        <th class="h2" scope="col"><strong>Libell&eacute;</strong></th>
                        <th class="h2" scope="col"><strong>Prix</strong></th>
                        <th class="h2" scope="col"><strong>Stock</strong></th>
                        <th class="h2" scope="col"><strong>Couleur</strong></th>
                        <th class="h2" scope="col"><strong>Date d&apos;ajout</strong></th>
                        <th class="h2" scope="col"><strong>Date de modification</strong></th>
                        <th class="h2" scope="col"><strong>Actions</strong></th>
                    </tr>
                </thead>
                <tbody>
                <!-- Le lien du détail du produit est cliquable sur le libellé du produit comme demandé -->
                <?php
                foreach($result as $produit) {
                    ?>
                    <tr>
                        <!-- <td scope="row"><img src="jarditou_photos/7.jpg" width="100" class="img-fluid" alt="Barbecues Aramis" title="Barbecues Aramis"></td> -->
                        <td><?= $produit['pro_id'] ?></td>
                        <td><?= $produit['pro_ref'] ?></td>
                        <td><?= $produit['cat_nom'] ?></td>
                        <td><a href="details.php?pro_id=<?= $produit ['pro_id'] ?>"><?= $produit['pro_libelle'] ?></a></td>
                        <td><?= $produit['pro_prix'] ?></td>
                        <td><?= $produit['pro_stock'] ?></td>
                        <td><?= $produit['pro_couleur'] ?></td>
                        <td><?= $produit['pro_d_ajout'] ?></td>
                        <td><?= $produit['pro_d_modif'] ?></td>
                        <td><a href="edit.php?pro_id=<?= $produit['pro_id'] ?>">Modifier</a>  <a href="delete.php?pro_id=<?= $produit['pro_id'] ?>">Supprimer </a></td>
                        
                    </tr>
                    <?php
                }
                ?>
                    <!-- <tr>
                        <td scope="row"><img src="jarditou_photos/8.jpg" width="100" class="img-fluid" alt="Barbecues Athos" title="Barbecues Athos"></td>
                        <td>8</td>
                        <td>Barbecues</td>
                        <td>Athos</td>
                        <td>249.99&euro;</td>
                        <td>Noir</td>
                    </tr> 
                    <tr class="table-warning">
                        <td scope="row"><img src="jarditou_photos/11.jpg" width="100" class="img-fluid" alt="Barbecues Clatronic" title="Barbecues Clatronic"></td>
                        <td>11</td>
                        <td>Barbecues</td>
                        <td>Clatronic</td>
                        <td>135.90&euro;</td>
                        <td>Chrome</td>
                    </tr>
                    <tr>
                        <td scope="row"><img src="jarditou_photos/12.jpg" width="100" class="img-fluid" alt="Barbecues Camping" title="Barbecues Camping"></td>
                        <td>12</td>
                        <td>Barbecues</td>
                        <td>Camping</td>
                        <td>88.00&euro;</td>
                        <td>Noir</td>
                    </tr>
                    <tr class="table-warning">
                        <td scope="row"><img src="jarditou_photos/13.jpg" width="100" class="img-fluid" alt="Brouette Green" title="Brouette Green"></td>
                        <td>13</td>
                        <td>Brouette</td>
                        <td>Green</td>
                        <td>49.00&euro;</td>
                        <td>Verte</td>
                    </tr> -->
                </tbody>
            </table>
        </div>
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