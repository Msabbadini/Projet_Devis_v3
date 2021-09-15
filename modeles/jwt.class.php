<?php
define ('secret','gmb#Qh8H7!XqXRN#');

class JWT{
    /** 
         * Génération JWT
         * @param array $header Header du token
         * @param array $payload Payload du token
         * @param string $secret Clé secrète
         * @param int $validity Durée de validité(en secondes)
         * @return string Token
         */ 
    private const HEADERS ='';

     function __construct(){
        $this->HEADERS=['typ'=>'JWT','alg'=>'HS256'];
     }


     public function generate( array $payload, int $validity = 86400): string
     {
        //  $test ='gmb#Qh8H7!XqXRN#';
        // on verifie la validation du token
        if($validity > 0){
            $now = new DateTime();
            $expiration = $now->getTimestamp()+ $validity;
            $payload['iat'] = $now->getTimestamp();
            $payload['exp'] = $expiration;
        }
        // on encode en base64
        $base64Header = base64_encode(json_encode(self::HEADERS));
        $base64Payload = base64_encode(json_encode($payload));

        // on "nettoie" les valeurs encodées
        // on retire les +, / et =
        $base64Header = str_replace(['+', '/', '='], ['-', '_', ''], $base64Header);
        $base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], $base64Payload);

        // on génère la signature

        $secret = base64_encode(secret);
        $signature = hash_hmac('sha256',$base64Header . '.' . $base64Payload, secret, true);
        $base64Signature = base64_encode($signature);

        // Nettoyage de la signature

        $signature = str_replace(['+', '/', '='], ['-', '_', ''], $base64Signature);

        // Création du token
        $jwt = $base64Header.'.'.$base64Payload.'.'.$signature;

        return $jwt;
     }

     /**
      * Vérification du token
      * @param string $token Token à vérifier
      * @param string $secret Clé secrète
      * @return bool Vérifié ou non
       */ 
    public function check(string $token): bool
    {
        // On récupère le header et le payload
        $header = $this->getHeader($token);
        $payload = $this->getPayload($token);

        // On génère un token de vérification
        $verifToken = $this->generate($payload, 0);

        return $token === $verifToken;
    }

        /**
     * Récupère le header
     * @param string $token Token
     * @return array Header
     */
    public function getHeader(string $token)
    {
        // Démontage token
        $array = explode('.', $token);

        // On décode le header
        $header = json_decode(base64_decode($array[0]), true);

        return $header;
    }

    /**
     * Retourne le payload
     * @param string $token Token
     * @return array Payload
     */
    public function getPayload(string $token)
    {
        // Démontage token
        $array = explode('.', $token);

        // On décode le payload
        $payload = json_decode(base64_decode($array[1]), true);

        return $payload;
    }

    /**
     * Vérification de l'expiration
     * @param string $token Token à vérifier
     * @return bool Vérifié ou non
     */
    public function isExpired(string $token): bool
    {
        $payload = $this->getPayload($token);

        $now = new DateTime();

        return $payload['exp'] < $now->getTimestamp();
    }

    /**
     * Vérification de la validité du token
     * @param string $token Token à vérifier
     * @return bool Vérifié ou non
     */
    public function isValid(string $token): bool
    {
        return preg_match(
            '/^[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+$/',
            $token
        ) === 1;
    }

 }
 ?>