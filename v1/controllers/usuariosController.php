<?php

require __DIR__ .'/../include/database.php';

/*
 
  no iniciar clases con mayusculas ya que son llamadas atraves de los parametros en las url

 */
class usuariosController
{
   
	
	function __construct()
	{
		# code...
	}
    

	function get_resource(){

       $nameTable = 'user';	
	   $result = DataBase::get($nameTable);
	   echo json_encode($result);

	}
	
	function get_resource_data(){
		echo "recurso con parametros";
	}

	function post_resource(){}

}



?>