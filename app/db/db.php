<?php 
use MongoDB\Client;
use \MongoDB\Driver\BulkWrite;
use \MongoDB\Driver\Query;
use \MongoDB\Driver\ReadPreference;
    class DB{
        private $conn;
        public function __construct(){
           //$this->conn = new Client("mongodb://localhost:27017");
            $this->conn = new Client("mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority");
            
        }
        public function getConnection()
        {
            return $this->conn;
        }
        public function createUser($payload)
        {
            $colecciong = $this->getConnection()->proyecto->google_users;
            $resultadog = $colecciong->insertOne($payload);
           

            $coleccionu = $this->getConnection()->proyecto->usuarios;
            $resultadou=$coleccionu->insertOne(array("googleID"=>$resultadog->getInsertedId(),"nombre"=>$payload->givenName,"visible"=>FALSE));

            $coleccionr = $this->getConnection()->proyecto->roles;
            $coleccionr->insertOne(array("googleID"=>$resultadog->getInsertedId(),"roles"=>array("crearReceta","eliminarPost","verReceta","comentarReceta")));

            $coleccionf = $this->getConnection()->proyecto->favoritos;
            $coleccionf->insertOne(array("_idUsuario"=>$resultadou->getInsertedId(),"Recetas"=>array()));


            return $resultadog;
        }

        public function findGooleUser($payload)
        {
            $colecciong = $this->getConnection()->proyecto->google_users;
            $resultadog = $colecciong->findOne(['email' => $payload->email]);
            
            return $resultadog;
        }
        
        public function findGoogleUserId($id)
        {
            $coleccion = $this->getConnection()->proyecto->google_users;
            $resultado = $coleccion->findOne(['_id' => $id]);
            return $resultado;
        }
        
        public function findUserId($id)
        {
            $coleccion = $this->getConnection()->proyecto->usuarios;
            $resultado = $coleccion->findOne(['googleID' => $id]);
            return $resultado;
        }

        public function findRoleUserId($id)
        {   
            $coleccion = $this->getConnection()->proyecto->roles;
            $resultado = $coleccion->findOne(['googleID' => $id]);
            return $resultado;
        }
        public function comentarios($idReceta)
        {   
            

        $client = new MongoDB\Driver\Manager(sprintf(
        'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority'));
            $id = new MongoDB\BSON\ObjectId($idReceta);

            $command = new MongoDB\Driver\command([
                'aggregate' => 'comentarios',
                'pipeline' => [['$lookup'=>[
                    
                        "from"=> 'usuarios',
                        "localField"=> 'idUsuario',
                        "foreignField"=> '_id',
                        "as"=> 'usuario'
                    ] 
                    ],
                        ['$match'=>["idReceta"=>$id]]
                    ],
                    'cursor' => new stdClass()
                ]);
            $rows = $client->executeCommand('proyecto', $command);
  
            $array = array();
            foreach ($rows as $row) 
            {
                array_push($array, $row);
            }
            return $array;
        }

        
    }
?>
