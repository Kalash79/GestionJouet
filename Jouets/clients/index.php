<?php
include '../includes/db.php';
include '../includes/header.php';

$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
?>

<h2>Liste des Clients</h2>
<button><a href="ajouter.php">Ajouter un Client</a></button>
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['phone']; ?></td>
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