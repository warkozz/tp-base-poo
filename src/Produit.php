<?php
class Produit {
    private $codeProduit;
    private $nom;
    private $prixHT;
    private $quantiteStock;

    public function __construct($codeProduit, $nom, $prixHT, $quantiteStock) {
        if ($prixHT <= 0 || $quantiteStock < 0) throw new Exception("Prix ou stock invalide");
        $this->codeProduit = $codeProduit;
        $this->nom = $nom;
        $this->prixHT = $prixHT;
        $this->quantiteStock = $quantiteStock;
    }
    public function getCodeProduit() { return $this->codeProduit; }
    public function getNom():string { return $this->nom; }
    public function getPrixHT() { return $this->prixHT; }
    public function getQuantiteStock() { return $this->quantiteStock; }
    public function afficherInfos() {
        echo "$this->codeProduit - $this->nom | $this->prixHT € | Stock: $this->quantiteStock\n";
    }
    public function ajusterStock($quantite) {
        if ($this->quantiteStock + $quantite < 0) throw new Exception("Stock insuffisant");
        $this->quantiteStock += $quantite;
    }
}
