<!-- Exercice 2 : Requêtes de sélection 
Utilisez la base de données ecommerce créée dans la section précédente. 
1. Sélectionnez tous les produits avec leur nom, description, prix et le nom 
de leur catégorie. 
2. Sélectionnez tous les produits dont le prix est supérieur à 20 euros. 
3. Sélectionnez les produits en rupture de stock (stock = 0). 
4. Sélectionnez les trois produits les plus chers. 
5. Comptez combien de produits sont dans chaque catégorie. 
NB : Toutes les affichage se feront sous forme de tableau HTML  -->


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
//Je sélectionne tous les produits avec leur nom, description, prix et le nom de leur catégorie
$sql = 'SELECT nom,description,prix,categorie FROM produit';
$req = $bdd->query($sql);
echo ' <h1>Tous les produits avec leur nom, description, prix et le nom de leur catégorie.</h1>';
echo ' <table border=1>';
echo '<tr>';
echo '<th>nom</th>';
echo '<th>description</th>';
echo '<th>prix</th>';
echo '<th>categorie</th>';
echo '</tr>';
 while($rep = $req->fetch(PDO::FETCH_ASSOC)){
    echo '<tr>';
    echo '<td>'.$rep['nom'].'</td>';
    echo '<td>'.$rep['description'].'</td>';
    echo '<td>'.$rep['prix'].'</td>';
    echo '<td>'.$rep['categorie'].'</td>';
    echo '</tr>';
 }
echo ' </table>';
//Je sélectionne tous les produits dont le prix est supérieur à 20 euros
$sql = 'SELECT * FROM produit WHERE prix > 20';
$req = $bdd->query($sql);
echo ' <h1> Tous les produits dont le prix est supérieur à 20 euros :</h1>';
echo ' <table border=1>';
echo '<tr>';
echo '<th>id</th>';
echo '<th>nom</th>';
echo '<th>description</th>';
echo '<th>prix</th>';
echo '<th>categorie</th>';
echo '<th>image_url</th>';
echo '</tr>';
 while($rep = $req->fetch(PDO::FETCH_ASSOC)){
    echo '<tr>';
    echo '<td>'.$rep['id'].'</td>';
    echo '<td>'.$rep['nom'].'</td>';
    echo '<td>'.$rep['description'].'</td>';
    echo '<td>'.$rep['prix'].'</td>';
    echo '<td>'.$rep['categorie'].'</td>';
    echo '<td>'.$rep['image_url'].'</td>';
    echo '</tr>';
 }
echo ' </table>';
//Je sélectionne  les produits en rupture de stock
$sql = 'SELECT * FROM produit WHERE stock= 0';
$req = $bdd->query($sql);
echo ' <h1> Tous les produits en rupture de stock :</h1>';
echo ' <table border=1>';
echo '<tr>';
echo '<th>id</th>';
echo '<th>nom</th>';
echo '<th>description</th>';
echo '<th>prix</th>';
echo '<th>categorie</th>';
echo '<th>image_url</th>';
echo '</tr>';
 while($rep = $req->fetch(PDO::FETCH_ASSOC)){
    echo '<tr>';
    echo '<td>'.$rep['id'].'</td>';
    echo '<td>'.$rep['nom'].'</td>';
    echo '<td>'.$rep['description'].'</td>';
    echo '<td>'.$rep['prix'].'</td>';
    echo '<td>'.$rep['categorie'].'</td>';
    echo '<td>'.$rep['image_url'].'</td>';
    echo '</tr>';
 }
echo ' </table>';
//Je sélectionne  les 3 produits les plus chers
$sql = 'SELECT * FROM produit ORDER BY prix DESC LIMIT 3';
$req = $bdd->query($sql);
echo ' <h1> Les trois produits les plus chers :</h1>';
echo ' <table border=1>';
echo '<tr>';
echo '<th>id</th>';
echo '<th>nom</th>';
echo '<th>description</th>';
echo '<th>prix</th>';
echo '<th>categorie</th>';
echo '<th>image_url</th>';
echo '</tr>';
 while($rep = $req->fetch(PDO::FETCH_ASSOC)){
    echo '<tr>';
    echo '<td>'.$rep['id'].'</td>';
    echo '<td>'.$rep['nom'].'</td>';
    echo '<td>'.$rep['description'].'</td>';
    echo '<td>'.$rep['prix'].'</td>';
    echo '<td>'.$rep['categorie'].'</td>';
    echo '<td>'.$rep['image_url'].'</td>';
    echo '</tr>';
 }
echo ' </table>';
//Je compte combien de produits sont dans chaque catégorie
$sql = 'SELECT categorie,count(*) AS stock FROM produit GROUP BY categorie';
$req = $bdd->query($sql);
echo ' <h1> Le nombre de produits dans chaque catégorie :</h1>';
echo ' <table border=1>';
echo '<tr>';
echo '<th>categorie</th>';
echo '<th>stock</th>';
echo '</tr>';
 while($rep = $req->fetch(PDO::FETCH_ASSOC)){
    echo '<tr>';
    echo '<td>'.$rep['categorie'].'</td>';
    echo '<td>'.$rep['stock'].'</td>';
    echo '</tr>';
 }
echo ' </table>';




?>