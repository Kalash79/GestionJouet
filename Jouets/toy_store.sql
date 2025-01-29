CREATE DATABASE toy_store;

USE toy_store;

CREATE TABLE suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    contact VARCHAR(255),
    address VARCHAR(255)
);

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20)
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    supplier_id INT,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    product_ids JSON,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('en attente', 'expediee', 'annulee') DEFAULT 'en attente',
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

INSERT INTO suppliers (name, contact, address) VALUES
('Fournisseur A', 'contact@fournisseura.com', '123 Rue des Jouets, Paris'),
('Fournisseur B', 'contact@fournisseurb.com', '456 Avenue des Enfants, Lyon'),
('Fournisseur C', 'contact@fournisseurl.com', '789 Boulevard des Rêves, Marseille');

INSERT INTO customers (name, email, phone) VALUES
('Alice Dupont', 'alice.dupont@example.com', '0123456789'),
('Bob Martin', 'bob.martin@example.com', '0987654321'),
('Chloé Bernard', 'chloe.bernard@example.com', '0147258369');

INSERT INTO products (name, description, price, stock, supplier_id) VALUES
('Poupée en peluche', 'Une adorable poupée en peluche pour les enfants.', 19.99, 50, 1),
('Voiture télécommandée', 'Voiture rapide avec télécommande.', 29.99, 30, 2),
('Jeu de société', 'Un jeu de société amusant pour toute la famille.', 24.99, 20, 3),
('Puzzle 1000 pièces', 'Un puzzle de 1000 pièces avec une belle image.', 15.99, 15, 1),
('Balle rebondissante', 'Balle colorée qui rebondit très haut.', 5.99, 100, 2);

INSERT INTO orders (customer_id, product_ids, status) VALUES
(1, '[1, 2]', 'en attente'),
(2, '[3]', 'expediee'),
(3, '[1, 2]', 'annulee'),
(1, '[2]', 'expediee'),
(2, '[1, 3]', 'en attente');