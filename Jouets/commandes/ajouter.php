<?php
include '../includes/db.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $status = $_POST['status'];

    $sql = "INSERT INTO orders (customer_id, status) VALUES ('$customer_id', '$status')";
    if ($conn->query($sql) === TRUE) {
        echo "Commande ajoutée avec succès.";
        header("Location: index.php");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$customers = $conn->query("SELECT * FROM customers");
?>

<h2>Ajouter une Commande</h2>
<form method="POST">
    <label for="customer_id">Client:</label>
    <select name="customer_id">
        <?php while ($row = $customers->fetch_assoc()): ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php endwhile; ?>
    </select>
    <label for="status">Statut:</label>
    <select name="status">
        <option value="en attente">En attente</option>
        <option value="expediee">Expediee</option>
        <option value="annulee">Annulee</option>
    </select>
    <button type="submit">Ajouter</button>
    <button onclick="history.back()" class="exit">Annuler</button>
</form>

<?php
include '../includes/footer.php';
$conn->close();
?>