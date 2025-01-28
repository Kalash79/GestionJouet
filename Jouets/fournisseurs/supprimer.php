<?php
include '../includes/db.php';

$id = $_GET['id'];
$sql = "DELETE FROM suppliers WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Fournisseur supprimé avec succès.";
    header("Location: index.php");
} else {
    echo "Erreur: " . $conn->error;
}
$conn->close();
?>