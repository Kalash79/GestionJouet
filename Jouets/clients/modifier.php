<?php
include '../includes/db.php';
include '../includes/header.php';

$id = $_GET['id'];
$customer = $conn->query("SELECT * FROM customers WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE customers SET name='$name', email='$email', phone='$phone' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Client modifié avec succès.";
        header("Location: index.php");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h2>Modifier le Client</h2>
<form method="POST">
    <label for="name">Nom:</label>
    <input type="text" name="name" value="<?php echo $customer['name']; ?>" required>
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $customer['email']; ?>" required>
    <label for="phone">Téléphone:</label>
    <input type="text" name="phone" value="<?php echo $customer['phone']; ?>" required>
    <button type="submit">Modifier</button>
    <button onclick="history.back()" class="exit">Annuler</button>
</form>

<?php
include '../includes/footer.php';
$conn->close();
?>