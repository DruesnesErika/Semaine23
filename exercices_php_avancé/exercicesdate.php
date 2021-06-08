 <!-- Exercices
Utilisez l'objet DateTime, sauf mention contraire. -->


<!-- Exercice 1
Affichez la date du jour au format mardi 2 juillet 2019. -->

<?php
$tab_jours = ["lundi", "mardi", "mercredi",
   "jeudi", "vendredi", "samedi",
    "dimanche"];
$tab_mois = ["janvier", "février", "mars", "avril", "mai",
   "juin", "juillet", "août", "septembre", "octobre",
   "novembre", "décembre"];
$aujourdhui = new DateTime();
$jour = $aujourdhui->format('N') - 1;
$mois = $aujourdhui->format('m') - 1;
 echo "Nous sommes le ".$tab_jours[$jour]." ".$aujourdhui->format('d')." ".$tab_mois[$mois]." ".$aujourdhui->format('Y').".";
?>
<br>


<!-- Exercice 2
Trouvez le numéro de semaine de la date suivante : 14/07/2019. -->

<?php
$jour1 = new DateTime('2019-07-14');;
$semaine1 =$jour1->format('W');
echo "Pour la date 14/07/2019, c'était la semaine numéro : "." ".$semaine1.".";
?>
<br>


<!-- Exercice 3
Combien reste-t-il de jours avant la fin de votre formation. -->

 <?php
 $date_fin= new DateTime('29-10-2021');
$aujourdhui2=new DateTime();
$jour_fin = $date_fin ->format('z');
$jour2 = $aujourdhui2->format('z');
$reste_jour=($jour_fin-$jour2)-1;
echo "Il reste "." ".$reste_jour."  jours avant la fin de la formation.";
 ?>
 
<br>

<!-- Exercice 4
Reprenez l'exercice 3, mais traitez le problème avec les fonctions de gestion du timestamp, time() et mktime(). -->

<?php
$aujourdhui4=time();
$jour_fin4 = intval(mktime(0, 0, 0, 10, 29, 2021));
$reste_jour4= $jour_fin4 - $aujourdhui4;
echo "Il reste " .floor($reste_jour4/(24*60*60)) . " jours avant la fin de la formation.";
?>

<br>

<!-- Exercice 5
Quelle sera la prochaine année bissextile ? -->

 <?php
$aujourdhui5 =new DateTime();
$annee5= $aujourdhui5->format('Y');
$bisextile=$annee5%4;
do {
    $annee5++;
    $bisextile=$annee5%4;
} while($bisextile!= 0);
echo "La prochaine année bissextile sera en ".$annee5.".";
?> 

<br>

<!-- Exercice 6
Montrez que la date du 17/17/2019 est erronée. -->

<?php
if(var_dump(checkdate(17, 17, 2019))){
    echo "Le 17/17/2019 est est une date valide.";
}
 else {
    echo "Le 17/17/2019 n'est pas une date valide.";
}
?>

<br>

<!-- Exercice 7
Affichez l'heure courante sous cette forme : 11h25. -->
<?php 
date_default_timezone_set('Europe/Paris');
$localtime = localtime();
$minute7 = $localtime[1];
$heure7 = $localtime[2];
echo"Il est ".$heure7."h".$minute7.".";

?>
<br>

<!-- Exercice 8
Ajoutez 1 mois à la date courante.  -->

<?php
$date_unmois = new DateTime();
$date_unmois->add(new DateInterval('P1M'));
echo "Dans un mois, nous serons le ".$date_unmois->format('d m Y').".";

?>











