<?php
include '../includes/db.php';
include '../includes/header.php';

$sql = "SELECT orders.*, customers.name AS customer_name FROM orders LEFT JOIN customers ON orders.customer_id = customers.id";
$result = $conn->query($sql);
?>

<h2>Liste des Commandes</h2>
<button><a href="ajouter.php">Ajouter une Commande</a></button>
<table>
    <tr>
        <th>ID</th>
        <th>Client</th>
        <th>Date</th>
        <th>Statut</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['customer_name']; ?></td>
        <td><?php echo $row['order_date']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td>
            <a href="modifier.php?id=<?php echo $row['id']; ?>"><img src="/Jouets/images/edit.png" alt="" srcset=""></a>
            <a href="supprimer.php?id=<?php echo $row['id']; ?>"><img src="/Jouets/images/delete.jpg" alt="" srcset=""></a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php
include '../includes/footer.php';
$conn->close();
?>