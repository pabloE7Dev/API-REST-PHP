<?php

    $request = $_SERVER['REQUEST_URI']; 

    $method = $_SERVER ['REQUEST_METHOD']; 


    if($method == "POST" || $method == "PUT"){
	    $bodyData = file_get_contents("php://input");
    }

    $request_uri = explode("/", $request);



    if (!empty($request_uri[3])) { // valida si existe un recurso

    	header ( 'Content-Type: application/json' );

      
        $controller = $request_uri[3]; // valor del recurso example: api/v1/usuarios 

        $controller_request = $controller . 'Controller'; // nombre del fichero y de la clase del controlador 

        $controller_directorio = 'controllers/' . $controller_request . '.php';

        if (file_exists($controller_directorio)) {

            include_once $controller_directorio;


            if ($method) {

	            $parameter_status = false;

	            if (!empty($request_uri[4])) { // valida si existen parametros example: usuarios/1

		            $parameter_status = true;
	 	            $resourcesData = $request_uri[4]; // parametro del recurso a utilizar example: usuarios/1
                }


	            switch ($method) {
		            case 'GET':

		                if (!$parameter_status) { 

		    	            $returnData = $controller_request::get_resource();

		    	            http_response_code(200);		    	    
		                }else{

                            http_response_code(200);
		    	            $returnData = $controller_request::get_resource_data($resourcesData);
		                }

			            break;

		            case 'POST':
			            echo "hello world";
			            break;
	            }
            }

        }else{ 

        	echo "error al cargar el recurso";
        	http_response_code(404);
        }

    }else{

        require_once 'metadata.php';
    }

?>
