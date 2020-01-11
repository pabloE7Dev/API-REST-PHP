<?php

require __DIR__ .'/../conf/config.php';


/**
 * 
 */

class DataBase 
{



    public function __construct(){

    }



    function connect(){

        try{
            $connection = "mysql:host=" . HOST . ";dbname=" . db . ";charset=" . charset;

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            
            $pdo = new PDO($connection, user, password, $options);
            return $pdo;
            
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }

    }



    function get($nameTable){

      $sql = 'SELECT * FROM ' . $nameTable;
      $get_db = self::connect();
      $result = $get_db->prepare($sql);
      $result->execute();

      $array = [];

      while ( $row = $result->fetch(PDO::FETCH_ASSOC) ) {

       $data['id'] = $row['iduser'];
       $data['user'] = $row['user'];
       $data['password'] = $row['password'];

       array_push($array, $data);
      }
      return $array;
    }
    
    function get_data($nameTable){

      $sql = 'SELECT * FROM ' . $nameTable;
      $get_db = self::connect();
      $result = $get_db->prepare($sql);
      $result->execute();

      $array = [];

      while ( $row = $result->fetch(PDO::FETCH_ASSOC) ) {

       $data['user'] = $row['user'];
       $data['password'] = $row['password'];

       array_push($array, $data);
      }
      return $array;
    }

    // cierra la conexión
    function __destruct() {
      $this->conextion->close();
    }
    

}


?>

