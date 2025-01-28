<?php
include '../includes/db.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $supplier_id = $_POST['supplier_id'];

    $sql = "INSERT INTO products (name, description, price, stock, supplier_id) VALUES ('$name', '$description', '$price', '$stock', '$supplier_id')";
    if ($conn->query($sql) === TRUE) {
        echo "Produit ajouté avec succès.";
        header("Location: index.php");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$suppliers = $conn->query("SELECT * FROM suppliers");
?>

<h2>Ajouter un Produit</h2>
<form method="POST">
    <label for="name">Nom:</label>
    <input type="text" name="name" required>
    <label for="description">Description:</label>
    <textarea name="description"></textarea>
    <label for="price">Prix:</label>
    <input type="number" step="0.01" name="price" required>
    <label for="stock">Stock:</label>
    <input type="number" name="stock" required>
    <label for="supplier_id">Fournisseur:</label>
    <select name="supplier_id">
        <?php while ($row = $suppliers->fetch_assoc()): ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php endwhile; ?>
    </select>
    <button type="submit">Ajouter</button>
    <button onclick="history.back()" class="exit">Annuler</button>
</form>

<?php
include '../includes/footer.php';
$conn->close();
?>