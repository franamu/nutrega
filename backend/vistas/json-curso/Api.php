<?php

require_once 'ControllerJson.php';

//función validando todos los parametros disponibles
//pasaremos los parámetros requeridos a esta función

function isTheseParametersAvailable($params){
	//suponiendo que todos los parametros estan disponibles
	$available = true;
	$missingparams = "";

	foreach ($params as $param) {
		if(!isset($_POST[$param]) || strlen($_POST[$param]) <= 0){
			$available = false;
			$missingparams = $missingparams . ", " . $param;
		}
	}

	//si faltan parametros
	if(!$available){
		$response = array();
		$response['error'] = true;
		$response['message'] = 'Parametro' . substr($missingparams, 1, strlen($missingparams)) . ' vacio';

		//error de visualización
		echo json_encode($response);

		//detener la ejecición adicional
		die();
	}
}

//una matriza para mostrar las respuestas de nuestro api
$response = array();

//si se trata de una llamada api
//que significa que un parametro get llamado se establece un la URL
//y con estos parametros estamos concluyendo que es una llamada api

if(isset($_GET['apicall'])){

	//Aqui iran todos los llamados de nuestra api
	switch ($_GET['apicall']) {

		//opreacion createUsuarios
		case 'createusuario':
			
			//primero haremos la verificación de parametros.
		isTheseParametersAvailable(array('nombre', 'email', 'foto', 'password' , 'perfil' , 'estado'));

		$db = new ControllerJson();

		$result = $db->createUsuarioController($_POST['nombre'],
			$_POST['email'],
			$_POST['foto'],
			$_POST['password'],
			$_POST['perfil'],
			$_POST['estado']
		     );

		if($result){

			//esto significa que no hay ningun error
			$response['error'] = false;
			//mensaje que se ejecuto correctamente
			$response['message'] = 'usuario agregado correctamente';

			$response['contenido'] = $db->readUsuariosController();
		}else{
			$response['error'] = true;
			$response['message'] = 'ocurrio un error, intenta nuevamente';
		}
			break;

		case 'readusuarios':
		$db = new ControllerJson();
		$response['error'] = false;
		$response['message'] = 'solicitud completada correctamente';
		$response['contenido'] = $db->readUsuariosController();
		break;

		case 'loginusuario':

		isTheseParametersAvailable(array('mail', 'password'));
    
		$db = new ControllerJson();

		$encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

		$result = $db->loginUsuarioController($_POST['mail'],
			$encriptar);

		if(!$result){
			$response['error'] = true;
			$response['message'] = 'credenciales no validas, email: ' . $_POST['mail'] . ' pass: ' .$_POST["password"] ;
		}else{

			$response['error'] = false;
			$response['message'] = 'Bienvenido';

			$response['contenido'] = $result;
		}

     
		break;

		case 'createcategoria':

			//primero haremos la verificación de parametros.
		isTheseParametersAvailable(array('titulo'));

		$db = new ControllerJson();

		$result = $db->createCategoriaController($_POST['titulo']);

		if($result){

			//esto significa que no hay ningun error
			$response['error'] = false;
			//mensaje que se ejecuto correctamente
			$response['message'] = 'categoria agregada correctamente';

			$response['contenido'] = $db->readCategoriasController();
		}else{
			$response['error'] = true;
			$response['message'] = 'ocurrio un error, intenta nuevamente';
		}

		break;

		case 'readcategorias':

		$db = new ControllerJson();
		$response['error'] = false;
		$response['message'] = 'solicitud completada correctamente';
		$response['contenido'] = $db->readCategoriasController();

		break;

		case 'updatecategoria':

			//primero haremos la verificación de parametros.
		isTheseParametersAvailable(array('id','titulo'));

		$db = new ControllerJson();

		$result = $db->updateCategoriaController($_POST['id'],$_POST['titulo']);

		if($result){

			//esto significa que no hay ningun error
			$response['error'] = false;
			//mensaje que se ejecuto correctamente
			$response['message'] = 'categoria editada correctamente';

			$response['contenido'] = $db->readCategoriasController();
		}else{
			$response['error'] = true;
			$response['message'] = 'ocurrio un error, intenta nuevamente';
		}

		break;

		case 'deletecategoria':

		if(isset($_GET['id']) && !empty($_GET['id'])){

			$db = new ControllerJson();
			if($db->deleteCategoriaController($_GET['id'])){
				$response['error'] = false;
				$response['message'] = 'categoria eliminada';
				$response['contenido'] = $db->readCategoriasController();
			}else{
				$response['error'] = true;
				$response['message'] = 'la categoria no fue eliminada';
			}
		}

		break;

		#VENTAS

		case 'createventa':

		isTheseParametersAvailable(array($_POST['usuario'], $_POST['producto'], $_POST['imagen'], 'costos', 'fecha'));

		$db = new ControllerJson();
		$result = $db->createVentaController($_POST['usuario'],
		$_POST['producto'],
		$_POST['imagen'],
		$_POST['costos'],
		$_POST['fecha']);

		if($result){
			$response['error'] = false;
			$response['message'] = 'venta realizada correctamente';
			$response['contenido'] = $db->readVentasController();
		}else{
			$response['error'] = true;
			$response['message'] = 'la venta no pudo ser concretada';
		}

		break;

		case 'readventas':

		$db = new ControllerJson();
		$response['error'] = false;
		$response['message'] = 'solicitud completada correctamente';
		$response['contenido'] = $db->readVentasController();

		break;

		case 'readventasespecificas':

		if(isset($_GET['usuario']) && !empty($_GET['usuario'])){
			$db = new ControllerJson();
			$response['error'] = false;
			$response['message'] = 'solicitud completada correctamente';
			$response['contenido'] = $db->readVentasEspecificasController($_GET['usuario']);
		}else{
			$response['error'] = true;
			$response['message'] = 'la solicitud no pudo realizarse';
		}

		break;

		case 'readproductos':

		$db = new ControllerJson();
		$response['error'] = false;
		$response['message'] = 'solicitud completada correctamente';
		$response['contenido'] = $db->readProductosController();

		break;

		case 'deleteproducto':

		if(isset($_GET['id']) && !empty($_GET['id'])){

			$db = new ControllerJson();
			if($db->deleteProductoController($_GET['id'])){
				$response['error'] = false;
				$response['message'] = 'producto eliminado';
				$response['contenido'] = $db->readProductosController();
			}else{
				$response['error'] = true;
				$response['message'] = 'el producto no fue eliminado';
			}
		}

		break;

	}

}else{
	//si no es un api el que se esta invocando
	//empujar los valores apropiados en la estructura json
	$response['error'] = true;
	$response['message'] = 'Invalid API Call';
}

echo json_encode($response);

?>