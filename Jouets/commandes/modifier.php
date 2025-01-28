<?php
include '../includes/db.php';
include '../includes/header.php';

$id = $_GET['id'];
$order = $conn->query("SELECT * FROM orders WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET customer_id='$customer_id', status='$status' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Commande modifiée avec succès.";
        header("Location: index.php");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$customers = $conn->query("SELECT * FROM customers");
?>

<h2>Modifier la Commande</h2>
<form method="POST">
    <label for="customer_id">Client:</label>
    <select name="customer_id">
        <?php while ($row = $customers->fetch_assoc()): ?>
            <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $order['customer_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
        <?php endwhile; ?>
    </select>
    <label for="status">Statut:</label>
    <select name="status">
        <option value="en attente" <?php if ($order['status'] == 'en attente') echo 'selected'; ?>>En attente</option>
        <option value="expediee" <?php if ($order['status'] == 'expediee') echo 'selected'; ?>>Expédiée</option>
        <option value="annulee" <?php if ($order['status'] == 'annulee') echo 'selected'; ?>>Annulée</option>
    </select>
    <button type="submit">Modifier</button>
    <button onclick="history.back()" class="exit">Annuler</button>
</form>

<?php
include '../includes/footer.php';
$conn->close();
?>