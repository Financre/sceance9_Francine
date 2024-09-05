<!-- 2. Passez en paramètre d’une URL un id d’un produit  
1. Récupérer le produit afin de l’afficher dans un formulaire 
2. Ajouter un bouton modifier en bas du formulaire 
3. Au clique bouton, modifier le produit récupéré avec les données 
présentes dans les champs du formulaire. 
4. Affichez de nouveau le produit -->

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
$id=$_GET['id'];
 // Prépare la requête SQL
$stmt = $bdd->prepare('SELECT * FROM produit WHERE id = :id');

// Lier la variable à la requête
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

// Exécute la requête
$stmt->execute();

// Récupère les résultats
$result = $stmt->fetch();
$nom = $_POST['nom'];
$sql = "UPDATE produit
 SET nom = $nom ;
 WHERE id = :id";
 $req = $bdd->query($sql);


?>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $id?>">
    <label>Nom: <input type="text" name="nom" value="<?php echo $result['nom']?>"></label>
    <label>Description: <input type="text" name="description" value="<?php echo $result['description']?>"></label>
    <label>Prix: <input type="number" name="prix" value="<?php echo $result['prix']?>"></label>
    <label>Stock: <input type="number" name="stock" value="<?php echo $result['stock']?>"></label>
    <button type="submit">Modifier</button>
</form>
