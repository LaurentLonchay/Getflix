<?php
include 'dbreq.php';

 //* requete +creation variable
//$req = $bdd->query('SELECT * FROM games ORDER BY nom DESC');
if(isset($_GET['search']) AND !empty($_GET['search'])) {
   $q = htmlspecialchars($_GET['search']);
   $req = $bdd->query('SELECT * FROM games WHERE nom LIKE "%'.$q.'%" ORDER BY nom DESC');

}
//requête du droit de l'user
$droit = $bdd->prepare("SELECT * FROM user WHERE pseudo = ?");
$droit->execute(array($_SESSION['pseudo']));
$droituser = $droit-> fetch();
?>
<?php 
include 'intro.php';
include 'menu.php';
?>
<div class="container-fluid">
<div class="row">
 <!-- renvoie la page dynamique en fonction de la recherche -->

<?php 
if (isset($req)){


while($donnees = $req->fetch()) { ?>

<!-- <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 text-center"> -->
<a href='jeu.php?id=
<?php //add id to get the rigth jeu.php 
        echo htmlspecialchars($donnees['id']);
?>'>
<img class= "m-2 border border-white rounded-lg" src="
        <?php
                //img from db
                echo htmlspecialchars('data:image/jpeg;base64,'.base64_encode( $donnees['cover'] )); 
        ?>
        " alt="
        <?php
                //nom from db
                echo htmlspecialchars($donnees['nom']); 
        ?>
        "></a>     
   <?php } 
}
else {
        echo '<font color="red">"You didn\'t write anything to search"</font>';
}
      ?>
      </div>
      </div>
      <?php
include 'outro.php';
?> 