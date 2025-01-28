<?php
include '../includes/db.php';
include '../includes/header.php';

$id = $_GET['id'];
$supplier = $conn->query("SELECT * FROM suppliers WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $sql = "UPDATE suppliers SET name='$name', contact='$contact', address='$address' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Fournisseur modifié avec succès.";
        header("Location: index.php");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h2>Modifier le Fournisseur</h2>
<form method="POST">
    <label for="name">Nom:</label>
    <input type="text" name="name" value="<?php echo $supplier['name']; ?>" required>
    <label for="contact">Contact:</label>
    <input type="text" name="contact" value="<?php echo $supplier['contact']; ?>" required>
    <label for="address">Adresse:</label>
    <textarea name="address"><?php echo $supplier['address']; ?></textarea>
    <button type="submit">Modifier</button>
    <button onclick="history.back()" class="exit">Annuler</button>
</form>

<?php
include '../includes/footer.php';
$conn->close();
?>