<?php
require_once 'Produit.php';
require_once 'Client.php';
require_once 'Commande.php';

// Script de test console

echo "===== Création des produits =====\n";
$produit1 = new Produit("P001", "Caillou Bien Dur", 4.5, 100);
$produit2 = new Produit("P002", "Stylo bleu", 1.2, 200);
$produit3 = new Produit("P003", "Clavier de vrai gameur", 2.8, 50);
$produit1->afficherInfos();
$produit2->afficherInfos();
$produit3->afficherInfos();

echo "\n===== Création des clients =====\n";
$client1 = new Client(1, "Rayane Hakim", "12 rue des Lilas, Paris", "test@test.fr");
$client2 = new Client(2, "Nicolas Legeay", "5 Rue de la Republique, Paris", "test@test.fr");
$client2->modifierAdresse("7 avenue Victor Hugo, Paris");
echo "Client 1 : {$client1->getNomEntreprise()}, {$client1->getAdresse()}\n";
echo "Client 2 : {$client2->getNomEntreprise()}, {$client2->getAdresse()}\n";

echo "\n===== Commande 1 (un seul produit) =====\n";
$commande1 = new Commande(1001, $client1);
$commande1->ajouterProduit($produit1, 10);
$commande1->afficherCommande();
echo "Stock restant produit 1 : {$produit1->getQuantiteStock()}\n";

echo "\n===== Commande 2 (plusieurs produits, tentative dépassement stock) =====\n";
$commande2 = new Commande(1002, $client2);
$commande2->ajouterProduit($produit2, 20);
$commande2->ajouterProduit($produit3, 10);
try {
    $commande2->ajouterProduit($produit3, 100);
} catch (Exception $e) {
    echo "Erreur attendue : " . $e->getMessage() . "\n";
}
$commande2->afficherCommande();
echo "Stock restant produit 2 : {$produit2->getQuantiteStock()}\n";
echo "Stock restant produit 3 : {$produit3->getQuantiteStock()}\n";

echo "\n===== Suppression d'un produit de la commande 2 =====\n";
$commande2->retirerProduit($produit3);
$commande2->afficherCommande();
echo "Stock après suppression produit 3 : {$produit3->getQuantiteStock()}\n";
