<?php

class BDD{
    private $host = 'host';
    private $port = 'port';
    private $db = 'db';
    private $user = 'user';
    private $pwd = 'pwd';

    protected $co = false;

    public function __construct(){
        // Si la connexion n'a pas encore été établie
        if($this->co == false){
            // On essaie de se connecter à la base de données
            try{
                $this->co = new PDO("mysql:host=$this->host;
                port=$this->port;dbname=$this->db", $this->user, $this->pwd);
            }
            // Si la connexion a échouée
            catch(Exception $e){
                // On coupe le traitement et on affiche l'erreur
                die($e->getMessage());
            }
        }
    }
}
