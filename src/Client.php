<?php
class Client {
    private $idClient;
    private $nomEntreprise;
    private $adresse;
    private $email;

    public function __construct($idClient, $nomEntreprise, $adresse, $email) {
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
