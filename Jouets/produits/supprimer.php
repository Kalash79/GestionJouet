<?php
include '../includes/db.php';

$id = $_GET['id'];
$sql = "DELETE FROM products WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "produit supprimée avec succès.";
    header("Location: index.php");
} else {
    echo "Erreur: " . $conn->error;
}

$conn->close();
?>