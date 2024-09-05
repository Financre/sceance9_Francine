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
$dbname = 'ecommerce';

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur :" . $e->getMessage();
}

$id = $_GET['id'];

// Vérifiez si l'ID est un entier valide
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("ID invalide.");
}

// Prépare la requête SQL pour récupérer les informations du produit
$stmt = $bdd->prepare('SELECT * FROM produit WHERE id = :id');
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch();

// Vérifiez que le produit a été trouvé
if (!$result) {
    die("Produit introuvable.");
}

// Si le formulaire a été soumis, procédez à la mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];

    // Préparer la requête SQL pour mettre à jour le produit
    $sql = "UPDATE produit SET nom = :nom, description = :description, prix = :prix, stock = :stock WHERE id = :id";
    $stmt = $bdd->prepare($sql);

    // Lier les paramètres
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':prix', $prix, PDO::PARAM_INT);
    $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Exécutez la mise à jour
    if ($stmt->execute()) {
        echo "Produit mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du produit.";
    }
    //$stmt = $bdd->prepare('SELECT * FROM produit WHERE id = :id');
}
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id, ENT_QUOTES); ?>">
    <label>Nom: <input type="text" name="nom" value="<?php echo htmlspecialchars($result['nom'], ENT_QUOTES); ?>"></label>
    <label>Description: <input type="text" name="description" value="<?php echo htmlspecialchars($result['description'], ENT_QUOTES); ?>"></label>
    <label>Prix: <input type="number" name="prix" value="<?php echo htmlspecialchars($result['prix'], ENT_QUOTES); ?>"></label>
    <label>Stock: <input type="number" name="stock" value="<?php echo htmlspecialchars($result['stock'], ENT_QUOTES); ?>"></label>
    <button type="submit">Modifier</button>
</form>  
</body>
</html>

 
