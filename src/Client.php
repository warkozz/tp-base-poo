<?php
class Client {
    private int $idClient;
    private string $nomEntreprise;
    private string $adresse;
    private string $email;

    public function __construct(int $idClient, string $nomEntreprise, string $adresse, string $email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new Exception("Email invalide");
        $this->idClient = $idClient;
        $this->nomEntreprise = $nomEntreprise;
        $this->adresse = $adresse;
        $this->email = $email;
    }
    public function getNomEntreprise() { return $this->nomEntreprise; }
    public function getAdresse() { return $this->adresse; }
    public function modifierAdresse($a) {
        if (trim($a) == "") throw new Exception("Adresse vide");
        $this->adresse = $a;
    }
}
