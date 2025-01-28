<?php
include '../includes/db.php';

$id = $_GET['id'];
$sql = "DELETE FROM orders WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Commande supprimée avec succès.";
    header("Location: index.php");
} else {
    echo "Erreur: " . $conn->error;
}

$conn->close();
?>