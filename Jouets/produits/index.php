<?php
include '../includes/db.php';
include '../includes/header.php';

$sql = "SELECT products.*, suppliers.name AS supplier_name FROM products LEFT JOIN suppliers ON products.supplier_id = suppliers.id";
$result = $conn->query($sql);
?>

<h2>Liste des Produits</h2>
<button><a href="ajouter.php">Ajouter un Produit</a></button>
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Stock</th>
        <th>Fournisseur</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['price']; ?> €</td>
        <td><?php echo $row['stock']; ?></td>
        <td><?php echo $row['supplier_name']; ?></td>
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