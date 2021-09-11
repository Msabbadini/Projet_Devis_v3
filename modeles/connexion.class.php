<?php
define("LIMIT",5);
require_once '../Helpers/helper.php';
abstract class DB{
    
    // Transmission des infos de notre BDD
    private const HOST = 'localhost';
    private const DB = 'lionel';
    private const USER = 'root';
    private const PWD = '';

    // nomination table

    protected  $table_client;
    protected  $table_devis;
    protected  $table_fournisseur;
    protected  $table_reference;
    protected  $table_details;
    protected  $table_login;
    protected  $table_tentative;
    
    function __construct(){
        $this->table_client = 'clients';
        $this->table_devis =   'devis';
        $this->table_fournisseur = 'fournisseur';
        $this->table_reference = 'articles';
        $this->table_details = 'detail';
        $this->table_login = 'login';
        $this->table_tentative = 'tentative';
    }

    private static $database;
    // Ceci nous permet qu'il soit partagé avec les enfants de notre classe DB

    private static function initDatabase(){
        // On initialise notre connexion avec la BDD

        self::$database = new PDO('mysql:host='.self::HOST.';dbname='.self::DB,self::USER,self::PWD,[PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']);
        self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        self::$database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    // singleton
    protected function getDatabase()
        {
            if(self::$database === null){
                self::initDatabase();
            }

            return self::$database;
    }
    
}

?>