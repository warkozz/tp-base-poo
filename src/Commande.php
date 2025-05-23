<?php
require_once 'Produit.php';
require_once 'Client.php';
class Commande {
    private $numeroCommande;
    private $dateCreation;
    private $client;
    private $produitsCommandes = [];

    public function __construct($numeroCommande, $client) {
        $this->numeroCommande = $numeroCommande;
        $this->dateCreation = date('Y-m-d H:i:s');
        $this->client = $client;
    }
    public function ajouterProduit(Produit $p, $q) {
        if ($q <= 0) throw new Exception("Quantité invalide");
        if ($p->getQuantiteStock() < $q) throw new Exception("Stock insuffisant");
        $p->ajusterStock(-$q);
        $c = $p->getCodeProduit();
        if (isset($this->produitsCommandes[$c])) $this->produitsCommandes[$c]['quantite'] += $q;
        else $this->produitsCommandes[$c] = ['produit' => $p, 'quantite' => $q];
    }
    public function retirerProduit(Produit $p) {
        $c = $p->getCodeProduit();
        if (isset($this->produitsCommandes[$c])) {
            $p->ajusterStock($this->produitsCommandes[$c]['quantite']);
            unset($this->produitsCommandes[$c]);
        }
    }
    public function calculerTotal() {
        $t = 0;
        foreach ($this->produitsCommandes as $i) $t += $i['produit']->getPrixHT() * $i['quantite'];
        return $t;
    }
    public function afficherCommande() {
        echo "Commande #$this->numeroCommande du $this->dateCreation\n";
        echo "Client : {$this->client->getNomEntreprise()}\n";
        if (!$this->produitsCommandes) echo "Aucun produit.\n";
        else foreach ($this->produitsCommandes as $i) {
            $p = $i['produit'];
            echo "- {$p->getNom()} ({$p->getCodeProduit()}), Qté: {$i['quantite']}, Prix: {$p->getPrixHT()} €\n";
        }
        echo "Total HT : " . $this->calculerTotal() . " €\n";
    }
}
