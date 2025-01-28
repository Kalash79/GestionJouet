CREATE DATABASE magasin_jouets;
USE magasin_jouets;

-- Table des fournisseurs
CREATE TABLE fournisseurs (
    id_fournisseur INT AUTO_INCREMENT PRIMARY KEY,
    nomF VARCHAR(255) NOT NULL,
    contactF VARCHAR(255),
    adresseF VARCHAR(255)
);

-- Table des clients
CREATE TABLE clients (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    nomC VARCHAR(255) NOT NULL,
    emailC VARCHAR(255) NOT NULL,
    telephoneC VARCHAR(20)
);

-- Table des produits
CREATE TABLE produits (
    id_produit INT AUTO_INCREMENT PRIMARY KEY,
    nomP VARCHAR(255) NOT NULL,
    description TEXT,
    prix DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    id_fournisseur INT,
    FOREIGN KEY (id_fournisseur) REFERENCES fournisseurs(id_fournisseur)
);

-- Table des commandes
CREATE TABLE commandes (
    id_commande INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT,
    date_commande DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('en attente', 'expédiée', 'annulée') DEFAULT 'en attente',
    FOREIGN KEY (id_client) REFERENCES clients(id_client)
);

-- Insertion des fournisseurs
INSERT INTO fournisseurs (nomF, contactF, adresseF) VALUES
('Fournisseur A', 'contact@fournisseura.com', '123 Rue des Jouets, Paris'),
('Fournisseur B', 'contact@fournisseurb.com', '456 Avenue des Enfants, Lyon'),
('Fournisseur C', 'contact@fournisseurl.com', '789 Boulevard des Rêves, Marseille');

-- Insertion des clients
INSERT INTO clients (nomC, emailC, telephoneC) VALUES
('Alice Dupont', 'alice.dupont@example.com', '0123456789'),
('Bob Martin', 'bob.martin@example.com', '0987654321'),
('Chloé Bernard', 'chloe.bernard@example.com', '0147258369');

-- Insertion des produits
INSERT INTO produits (nomP, description, prix, stock, id_fournisseur) VALUES
('Poupée en peluche', 'Une adorable poupée en peluche pour les enfants.', 19.99, 50, 1),
('Voiture télécommandée', 'Voiture rapide avec télécommande.', 29.99, 30, 2),
('Jeu de société', 'Un jeu de société amusant pour toute la famille.', 24.99, 20, 3),
('Puzzle 1000 pièces', 'Un puzzle de 1000 pièces avec une belle image.', 15.99, 15, 1),
('Balle rebondissante', 'Balle colorée qui rebondit très haut.', 5.99, 100, 2);

-- Insertion des commandes
INSERT INTO commandes (id_client, statut) VALUES
(1, 'en attente'),
(2, 'expédiée'),
(3, 'annulée'),
(1, 'expédiée'),
(2, 'en attente');
