<?php 

require_once "../../controladores/Json.controlador.php";



function esCorrecto($params){
 
 
 $correcto = true;
 $faltanParametros = "El elemento de la/as posicion/es asignada se encuentran vacias: ";



 foreach ($params as $key => $value) {

 	if(isset($value) && $value != "" ){
      
       $correcto = true;
 	}else{
 		 $correcto = false;
 		echo "entro";
 		$faltanParametros .= " " .$key;
 	}
 	
 }

 //si faltan parametros
if(!$correcto){

	$respuesta = array();
	$respuesta["error"] = true;
	$respuesta["mensaje"] = $faltanParametros;

	echo json_encode($respuesta);

	//detener codigo
	die();
}

}

$respuesta = array();

if(isset($_GET["apicall"])){

	//empieza toda la api, aqui van todos los llamados

	switch ($_GET["apicall"]) {
		case 'crearusuario':
			
			//verificar que todos los parametros llegan con valor
		     esCorrecto(array("juan" , "juan@gmail.com" , "fotolink", "123456789" , "editor" , "1"));

		     $db = new JsonControlador();
		     $resp =  $db->ctrCrearUsuario($_POST["nombre"], $_POST["email"],$_POST["foto"],$_POST["password"],$_POST["perfil"], $_POST["estado"]);
             
             if($resp){
                
                //esto significa que no hay ningun error
             	$respuesta["error"] = false;
             	$respuesta["mensaje"] = "Se creo el usuario correctamente";
               
             }else{
                
                //ocurrio un error 
             	$respuesta["error"] = true;
             	$respuesta["mensaje"] = "ocurrio un error, intente nuevamente";

             }

			break;

			case "obtenerTodosLosProductos":

			 $db = new JsonControlador();
			 $resp = $db->ctrMostrarTotalProductos("id") ;


		      if($resp){
                
                //esto significa que no hay ningun error
             	$respuesta["error"] = false;
             	$respuesta["mensaje"] = "Se listaron los productos correctamente";
             	$respuesta["contenido"] = $resp;
               
             }else{
                
                //ocurrio un error 
             	$respuesta["error"] = true;
             	$respuesta["mensaje"] = "ocurrio un error, intente nuevamente";

             }

             break;



		
		default:
			# code...
			break;
	}




}else{

	$respuesta["error"] = true;
	$respuesta["mensaje"] = "Invalid API Call";
}

echo json_encode($respuesta);
 ?>