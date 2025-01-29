<?php
include '../includes/db.php';
include '../includes/header.php';

$id = $_GET['id'];
$order = $conn->query("SELECT * FROM orders WHERE id = $id")->fetch_assoc();

// Récupérer les IDs des produits associés
$product_ids = json_decode($order['product_ids'], true);

// Mettre à jour la commande
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $status = $_POST['status'];
    $product_ids = $_POST['product_ids']; // Récupérer les nouveaux IDs des produits

    // Convertir les IDs des produits en format JSON
    $product_ids_json = json_encode($product_ids);

    // Mettre à jour la commande
    $sql = "UPDATE orders SET customer_id='$customer_id', product_ids='$product_ids_json', status='$status' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Commande modifiée avec succès.";
        header("Location: index.php");
        exit; // Assurez-vous d'utiliser exit après header
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

// Récupérer les clients
$customers = $conn->query("SELECT * FROM customers");

// Récupérer les produits
$products = $conn->query("SELECT * FROM products");
?>

<h2>Modifier la Commande</h2>
<form method="POST">
    <label for="customer_id">Client:</label>
    <select name="customer_id" required>
        <?php while ($row = $customers->fetch_assoc()): ?>
            <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $order['customer_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
        <?php endwhile; ?>
    </select>

    <label for="status">Statut:</label>
    <select name="status" required>
        <option value="en attente" <?php if ($order['status'] == 'en attente') echo 'selected'; ?>>En attente</option>
        <option value="expediee" <?php if ($order['status'] == 'expediee') echo 'selected'; ?>>Expédiée</option>
        <option value="annulee" <?php if ($order['status'] == 'annulee') echo 'selected'; ?>>Annulée</option>
    </select>

    <label for="product_ids">Produits:</label>
    <select name="product_ids[]" multiple required>
        <?php while ($row = $products->fetch_assoc()): ?>
            <option value="<?php echo $row['id']; ?>" <?php if (in_array($row['id'], $product_ids)) echo 'selected'; ?>><?php echo $row['name']; ?></option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Modifier</button>
    <button type="button" onclick="history.back()" class="exit">Annuler</button>
</form>

<?php
include '../includes/footer.php';
$conn->close();
?>