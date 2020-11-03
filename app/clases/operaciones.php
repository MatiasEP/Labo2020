<?php

require_once("app/db/db.php");
    class Operaciones{
        public function __construct(){
        
        }

        public function accion($accion)
        {
            header('Content-type: application/json');
            if($accion=="isLoggedIn"){
                return json_encode($this->isLoggedIn(), JSON_PRETTY_PRINT);
            }
            if(!isset($_SESSION['id_sesion_google']) ){
                return json_encode("por favor inicie sesion en google.", JSON_PRETTY_PRINT);
            }

            if($accion=="usuarioGoogle"){
                return json_encode($this->getGoogleUserInfo(), JSON_PRETTY_PRINT);
            }
            if($accion=="usuario"){
                return json_encode($this->getUserInfo(), JSON_PRETTY_PRINT);
            }
            if($accion=="email"){
                return json_encode($this->getGoogleUserInfo()->email, JSON_PRETTY_PRINT);
            }
            if($accion=="roles"){
                return  json_encode($this->roleUsers(), JSON_PRETTY_PRINT);
            }
            
            if($accion=="logout"){
                return   json_encode($this->logout(), JSON_PRETTY_PRINT);
            }
            return json_encode("no data", JSON_PRETTY_PRINT);

        }
        
        public function getGoogleUserInfo()
        {
            try{
                $db = new DB();
                $result = $db->findGoogleUserId($_SESSION['id_sesion_google']);
                return $result;
           }catch(Exception $ex){

           }

        }
        public function getUserInfo()
        {
            try{
                $db = new DB();
                $result = $db->findUserId($_SESSION['id_sesion_google']);
                return $result;
           }catch(Exception $ex){

           }

        }

        public function roleUsers()
        {
            try{
                $db = new DB();
                $result = $db->findRoleUserId($_SESSION['id_sesion_google']);
                return $result;
           }catch(Exception $ex){

           }
        }
        public function logout()
        {
            unset($_SESSION['access_token']);
            unset($_SESSION['id_sesion_google']);
            return "sin sesion";
        }
        public function isLoggedIn(){
            return isset($_SESSION['access_token']);
        }

        
    }
?>