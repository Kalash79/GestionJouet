<?php
include '../includes/db.php';
include '../includes/header.php';

// Requête pour récupérer les commandes, les noms des clients et les noms des produits
$sql = "SELECT orders.*, customers.name AS customer_name 
        FROM orders 
        LEFT JOIN customers ON orders.customer_id = customers.id";
$result = $conn->query($sql);

$orders = [];
while ($row = $result->fetch_assoc()) {
    // Décoder les IDs des produits au format JSON
    $product_ids = json_decode($row['product_ids'], true);
    
    // Récupérer les noms des produits
    if (!empty($product_ids)) {
        $product_names = [];
        foreach ($product_ids as $product_id) {
            $product_id = intval($product_id); // Convertir en entier
            $product_sql = "SELECT name FROM products WHERE id = $product_id";
            $product_result = $conn->query($product_sql);
            if ($product_result && $product_row = $product_result->fetch_assoc()) {
                $product_names[] = $product_row['name'];
            }
        }
        $row['product_names'] = implode(', ', $product_names); // Joindre les noms des produits
    } else {
        $row['product_names'] = 'Aucun produit'; // Message si aucun produit
    }
    
    $orders[] = $row; // Ajouter la commande à la liste
}
?>

<h2>Liste des Commandes</h2>
<button><a href="ajouter.php">Ajouter une Commande</a></button>
<table>
    <tr>
        <th>ID</th>
        <th>Client</th>
        <th>Date</th>
        <th>Produits</th>
        <th>Statut</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($orders as $order): ?>
    <tr>
        <td><?php echo $order['id']; ?></td>
        <td><?php echo $order['customer_name']; ?></td>
        <td><?php echo $order['order_date']; ?></td>
        <td><?php echo $order['product_names']; ?></td>
        <td><?php echo $order['status']; ?></td>
        <td>
            <a href="modifier.php?id=<?php echo $order['id']; ?>"><img src="/Jouets/images/edit.png" alt="Modifier"></a>
            <a href="supprimer.php?id=<?php echo $order['id']; ?>"><img src="/Jouets/images/delete.jpg" alt="Supprimer"></a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php
include '../includes/footer.php';
$conn->close();
?>