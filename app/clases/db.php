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
            

        $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
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


        public function reportes()
        {   
            

        $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));

            $command = new MongoDB\Driver\command([
                'aggregate' => 'reportes',
                'pipeline' => [['$lookup'=>[
                    
                        "from"=> 'recetas',
                        "localField"=> 'idReceta',
                        "foreignField"=> '_id',
                        "as"=> 'receta'
                    ] 
                    ]
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

        public function borrar_reporte($id)
        {   
            

            try{
                $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
                /*$bulk = new MongoDB\Driver\BulkWrite;
                $bulk->delete(['_id' => $id], ['limit' => 1]);
                $client->executeBulkWrite('proyecto.reportes', $bulk);*/
                /*$coleccion = $this->getConnection()->proyecto->reportes;
                $rows = $coleccion->remove(array('_id' => $id), array("justOne" => true)); // $mongo contains the connection object to MongoDB    */
                $coleccion = $this->getConnection()->proyecto->reportes;
                $coleccion->deleteOne(['_id' => $id],["justOne" => true]);
           }catch(Exception $ex){
            echo("pepe");
           }	
        }
	    
		public function findRecetaId($idReceta){
			 try{
                $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));

                $id = new MongoDB\BSON\ObjectId($idReceta);
                $filter = ["_id"=>$id];
                $options = ['sort' =>['_id'=>-1],];
                $query = new MongoDB\Driver\Query($filter,$options);
                $rows = $client->executeQuery("proyecto.recetas", $query); // $mongo contains the connection object to MongoDB    
        
                $array = array();
                foreach ($rows as $row) 
                {
                    array_push($array, $row);
                }
                return $array[0];
           }catch(Exception $ex){

           }	
        }
	public static function urlConn(){
            return 'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority';
		}
	        
    }
?>