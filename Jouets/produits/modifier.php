<?php
include '../includes/db.php';
include '../includes/header.php';

$id = $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $supplier_id = $_POST['supplier_id'];

    $sql = "UPDATE products SET name='$name', description='$description', price='$price', stock='$stock', supplier_id='$supplier_id' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Produit modifié avec succès.";
        header("Location: index.php");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$suppliers = $conn->query("SELECT * FROM suppliers");
?>

<h2>Modifier le Produit</h2>
<form method="POST">
    <label for="name">Nom:</label>
    <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
    <label for="description">Description:</label>
    <textarea name="description"><?php echo $product['description']; ?></textarea>
    <label for="price">Prix:</label>
    <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>
    <label for="stock">Stock:</label>
    <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required>
    <label for="supplier_id">Fournisseur:</label>
    <select name="supplier_id">
        <?php while ($row = $suppliers->fetch_assoc()): ?>
            <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $product['supplier_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
        <?php endwhile; ?>
    </select>
    <button type="submit">Modifier</button>
    <button onclick="history.back()" class="exit">Annuler</button>
</form>

<?php
include '../includes/footer.php';
$conn->close();
?>