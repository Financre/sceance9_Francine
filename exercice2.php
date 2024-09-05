<!-- 1. Mettez à jour le prix de tous les produits appartenant à la catégorie 
"Electronique" en augmentant le prix de 10%.  -->

<?php
$servername = 'localhost';
$username = 'root';
$password = '';

try{
    $bdd = new PDO("mysql:host=$servername;dbname=ecommerce",$username,$password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo "connexion réussi !";
}
catch(PDOException $e){
    echo "Erreur :".$e->getMessage();

}
 $sql = "UPDATE produit
 SET prix = prix * 1.1
 WHERE categorie = 'Electronique'";
 $req = $bdd->query($sql);





?>