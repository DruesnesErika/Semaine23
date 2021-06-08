<!-- Téléchargez le fichier ListeLiens.zip contenant des adresses web et écrire un programme qui lit ce fichier pour construire une page web contenant une liste de liens hypertextes. -->
<?php
$fp = fopen("ListeLiens.txt", "r+"); 
$i=1;
while($i <= 100){
    $lien = fgets($fp);
    echo '<a href="'.$lien.'">'.$lien.'</a> <br>';
    $i++;
}
fclose($fp); 
?>