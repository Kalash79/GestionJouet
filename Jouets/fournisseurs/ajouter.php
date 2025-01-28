<?php
include '../includes/db.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $sql = "INSERT INTO suppliers (name, contact, address) VALUES ('$name', '$contact', '$address')";
    if ($conn->query($sql) === TRUE) {
        echo "Fournisseur ajouté avec succès.";
        header("Location: index.php");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h2>Ajouter un Fournisseur</h2>
<form method="POST">
    <label for="name">Nom:</label>
    <input type="text" name="name" required>
    <label for="contact">Contact:</label>
    <input type="text" name="contact" required>
    <label for="address">Adresse:</label>
    <textarea name="address"></textarea>
    <button type="submit">Ajouter</button>
    <button onclick="history.back()" class="exit">Annuler</button>
</form>

<?php
include '../includes/footer.php';
$conn->close();
?>