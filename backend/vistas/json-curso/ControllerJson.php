<?php

require_once "ModeloJson.php";

/**
 * 
 */
class ControllerJson
{
	
	#usuarios
	public function createUsuarioController($nombre, $email, $foto, $password , $perfil , $estado){

		$datosController = array("nombre"=>$nombre,
			"email"=>$email,
			"foto"=>$foto,
			"password"=>$password,
			"perfil"=>$perfil,
			"estado"=>$estado
		);

		$respuesta = Datos::createUsuarioModel($datosController, "administradores");
		return $respuesta;
	}

	public function readUsuariosController(){

		$respuesta = Datos::readUsuariosModel("administradores");
		return $respuesta;
	}

	public function loginUsuarioController($mail, $password){
      
		$datosController = array("mail" => $mail,
			"password"=>$password);

		$respuesta = Datos::loginUsuarioModel($datosController, "administradores");
		return $respuesta;
	}

	#categoria

	public function createCategoriaController($titulo){
		$respuesta = Datos::createCategoriaModel($titulo, "categorias");
		return $respuesta;
	}

	public function readCategoriasController(){
		$respuesta = Datos::readCategoriaModel("categorias");
		return $respuesta;
	}

	public function updateCategoriaController($id, $titulo){

		$datosController = array("id"=>$id,
			"titulo"=>$titulo);

		$respuesta = Datos::updateCategoriaModel($datosController, "categorias");
		return $respuesta;
	}

	public function deleteCategoriaController($id){
		$respuesta = Datos::deleteCategoriaModel($id, "categorias");
		return $respuesta;
	}

	#ventas

	public function createVentaController($usuario, $producto, $imagen, $costo, $fecha){
		$datosController = array("usuario"=>$usuario,
		"producto"=>$producto,
		"imagen"=>$imagen,
		"costo"=>$costo,
		"fecha"=>$fecha);

		$respuesta = Datos::createVentasModel($datosController, "ventas");
		return $respuesta;
	}

	public function readVentasController(){
		$respuesta = Datos::readVentasModel("ventas");
		return $respuesta;
	}

	public function readVentasEspecificasController($usuario){
		$respuesta = Datos::readVentasEspecificasModel($usuario, "ventas");
		return $respuesta;
	}

	#productos
	public function readProductosController(){
		$respuesta = Datos::readProductosModel("productos");
		return $respuesta;
	}

	public function deleteProductoController($id){
		$respuesta = Datos::deleteProductoModel($id, "productos");
		return $respuesta;
	}






}

?>