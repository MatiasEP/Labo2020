<?php
    require_once("app/db/db.php");


    class GoogleAuth{
        protected $client;
        
        public function __construct(Google_Client $googleClient = null){
            $this->client = $googleClient;
            if($this->client){
                $this->client->setClientId('551225167982-o60lgfjtranukq6grujqoh64figblk86.apps.googleusercontent.com');
                $this->client->setClientSecret('MQ0PTluu8ngMWSsaDMf09YNj');
                $this->client->setRedirectUri('http://localhost/Labo2020/index.php');         
                $this->client->setApprovalPrompt('force');
                //$this->client->setRedirectUri('http://localhost/Labo2020/paginas/mostrartodaslasrecetas.php');         
                
                $this->client->AddScope('email');
                $this->client->addScope('profile');
            }
        }

        public function getAuthUrl(){
            return $this->client->createAuthUrl();
        }
        public function checkRedirectCode(){
            if( isset($_GET['code']) ){
                $this->client->authenticate($_GET['code']);
                $token =  $this->client->getAccessToken();
                $this->setToken($token);
                $payload = $this->getPayload();
                if(!isset($_SESSION['id_sesion_google'])){

                    $result = $this->findGooleUser($payload);
                    if(isset($result)){
                        $_SESSION['id_sesion_google'] = $result->_id;
                    }else{
                        $result = $this->createUser($payload);
                        $_SESSION['id_sesion_google'] = $result->getInsertedId();
                    }
                }

                return true;
            }
            return false;
            
        }
        public function setToken($token)
        {
            $_SESSION['access_token'] = $token;
            $this->client->setAccessToken($token);
        }
        public function logout()
        {
            unset($_SESSION['access_token']);
            unset($_SESSION['id_sesion_google']);
            
        }
        public function getPayload()
        {
            if(!isset($payload)){
                $google_oauth = new Google_Service_Oauth2($this->client);
                $payload = $google_oauth->userinfo->get();
            }
            return $payload;
        }

        public function findGooleUser($payload){

            try{
                $db = new DB();
                $result = $db->findGooleUser($payload);
                return $result; 
           }catch(Exception $ex){

           }
        }

        
        public function createUser($payload)
        {
            try{
                $db = new DB();
                $result = $db->createUser($payload);
                return $result; 
           }catch(Exception $ex){

           }
        }
        
    }
?>