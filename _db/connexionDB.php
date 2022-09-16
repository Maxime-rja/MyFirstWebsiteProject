<?php

  // Déclaration d'une nouvelle classe
    class connexionDB {
    private $host    = 'localhost';  // nom de l'host  
    private $name    = 'projet';    // nom de la base de donnée
    private $user    = 'pwnd';       // utilisateur 
    private $pass    = 'network';       // mot de passe (il faudra peut-être mettre '' sous Windows)
    private $connexion;
    
    function __construct($host = null, $name = null, $user = null, $pass = null)
    {
      if($host != null)
      {
        $this->host = $host;           
        $this->name = $name;           
        $this->user = $user;          
        $this->pass = $pass;
      }

      try
      {
        $this->connexion = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->name,
            $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8', 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
      }

      catch (PDOException $e)
      {
        echo 'Erreur : Impossible de se connecter  à la BDD !';
        die();
      }
    }

    public function DB()
    {
        return $this->connexion; 
    }
  }

  $BDD = new connexionDB(); 

  $DB = $BDD->DB(); 

  if(isset($_GET["logout"]) && $_GET["logout"] == 1)
    {
        unset($_SESSION["compte_id"]);
        header("Location: http://192.168.56.80/pwnd/Projet/connexion.php");
        $this->connexion = null;
    }
    
?>