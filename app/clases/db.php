<?php 
use \MongoDB\Client;
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
            $resultadou=$coleccionu->insertOne(array("googleID"=>$resultadog->getInsertedId(),"nombre"=>$payload->givenName,"picture"=>$payload->picture,"rol"=>"usuario registrado","visible"=>TRUE));

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
        
        public function findRol($permiso)
        {   
            $coleccion = $this->getConnection()->proyecto->permisos;
            $resultado = $coleccion->findOne(['rol' => $permiso]);
            return $resultado;
        }
        
        public function comentarios($idReceta)
        {   
            
            try
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
            catch(Exception $ex)
            {
               echo($ex);
            }
        }


        public function reportes()
        {   
            try
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
                        ],
                            ['$match'=>["observado"=>false]]
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
            catch(Exception $ex)
            {
               echo($ex);
            }

        
        }

        public function comprobar_favorito($idUsuario, $idReceta)
        {     
             try
             {                  
                $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
                $idReceta = new MongoDB\BSON\ObjectId($idReceta);        
                $idUsuario = new MongoDB\BSON\ObjectId($idUsuario);
                $filter = ["_idUsuario"=>$idUsuario, "Recetas"=>$idReceta];
                $options = ['sort' =>['_id'=>-1],];
                $query = new MongoDB\Driver\Query($filter,$options);
                $rows = $client->executeQuery("proyecto.favoritos", $query);
                $array = array();
                foreach ($rows as $row) 
                {
                    array_push($array, $row);
                }
                return $array;
             } 
             catch(Exception $ex)
             {
                echo($ex);
             }
        }

        public function eliminar_favorito($idUsuario, $idReceta)
        {
            try
            {                
                $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
                $idReceta = new MongoDB\BSON\ObjectId($idReceta);        
                $idUsuario = new MongoDB\BSON\ObjectId($idUsuario);
                $filter = ["_idUsuario"=>$idUsuario, "Recetas"=>$idReceta];
                $options = ['sort' =>['_id'=>-1],];
                $query = new MongoDB\Driver\Query($filter,$options);
                $rows = $client->executeQuery("proyecto.favoritos", $query);
                $res = $rows->toArray();
                $count = count($res);
                if($count == 1)
                {            
                    $query2 = new BulkWrite();
                    $query2->update(['_idUsuario' => $idUsuario],
                    ['$pull' => ['Recetas' => $idReceta]]);
                    $client->executeBulkWrite("proyecto.favoritos",$query2);
                }
            }
            catch(Exception $ex)
            {
                echo($ex);
            }
        }

        public function agregar_favorito($idUsuario, $idReceta)
        {
            try
            {
                $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
                $idReceta = new MongoDB\BSON\ObjectId($idReceta);        
                $idUsuario = new MongoDB\BSON\ObjectId($idUsuario);
                $filter = ["_idUsuario"=>$idUsuario, "Recetas"=>$idReceta];
                $options = ['sort' =>['_id'=>-1],];
                $query = new MongoDB\Driver\Query($filter,$options);
                $rows = $client->executeQuery("proyecto.favoritos", $query);
                $res = $rows->toArray();
                $count = count($res);
                if($count == 0)
                {            
                    $query2 = new BulkWrite();
                    $query2->update(['_idUsuario' => $idUsuario],
                    ['$push' => ['Recetas' => $idReceta]]);
                    $client->executeBulkWrite("proyecto.favoritos",$query2);
                }
            }
            catch(Exception $ex)
            {
                echo($ex);
            }
        }

        public function comprobar_seguido($idUsuario, $idCreador)
        {     
             try
             {                  
                $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
                $idCreador = new MongoDB\BSON\ObjectId($idCreador);        
                $idUsuario = new MongoDB\BSON\ObjectId($idUsuario);
                $filter = ["idUsuario"=>$idUsuario, "seguidos"=>$idCreador];
                $options = ['sort' =>['_id'=>-1],];
                $query = new MongoDB\Driver\Query($filter,$options);
                $rows = $client->executeQuery("proyecto.seguidos", $query);
                $array = array();
                foreach ($rows as $row) 
                {
                    array_push($array, $row);
                }
                return $array;
             } 
             catch(Exception $ex)
             {
                echo($ex);
             }
        }

        public function dejar_de_seguir($idUsuario, $idCreador)
        {
            try
            {                
                $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
                $idCreador = new MongoDB\BSON\ObjectId($idCreador);        
                $idUsuario = new MongoDB\BSON\ObjectId($idUsuario);
                $filter = ["idUsuario"=>$idUsuario, "seguidos"=>$idCreador];
                $options = ['sort' =>['_id'=>-1],];
                $query = new MongoDB\Driver\Query($filter,$options);
                $rows = $client->executeQuery("proyecto.seguidos", $query);
                $res = $rows->toArray();
                $count = count($res);
                if($count == 1)
                {            
                    $query2 = new BulkWrite();
                    $query2->update(['idUsuario' => $idUsuario],
                    ['$pull' => ['seguidos' => $idCreador]]);
                    $client->executeBulkWrite("proyecto.seguidos",$query2);
                }
            }
            catch(Exception $ex)
            {
                echo($ex);
            }
        }

        public function seguir($idUsuario, $idCreador)
        {
            try
            {
                $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
                $idCreador = new MongoDB\BSON\ObjectId($idCreador);        
                $idUsuario = new MongoDB\BSON\ObjectId($idUsuario);
                $filter = ["idUsuario"=>$idUsuario, "seguidos"=>$idCreador];
                $options = ['sort' =>['_id'=>-1],];
                $query = new MongoDB\Driver\Query($filter,$options);
                $rows = $client->executeQuery("proyecto.seguidos", $query);
                $res = $rows->toArray();
                $count = count($res);
                if($count == 0)
                {            
                    $query2 = new BulkWrite();
                    $query2->update(['idUsuario' => $idUsuario],
                    ['$push' => ['seguidos' => $idCreador]]);
                    $client->executeBulkWrite("proyecto.seguidos",$query2);
                }
            }
            catch(Exception $ex)
            {
                echo($ex);
            }
        }

        public function ignorar_reporte($id)
        {   
            

            try{
                $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
                $firstKey = array_key_first($id);
                $id = new MongoDB\BSON\ObjectId($id[$firstKey]);
                $query = new BulkWrite();
                $query->update(['_id'=>$id],
                ['$set' => ['observado' => true]]);
                $client->executeBulkWrite("proyecto.reportes",$query);

                
           }catch(Exception $ex){
            echo($ex);
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
