<?php 
require_once "conexion.php";


class JsonDatos{

  
static public function mdlCrearUsuario($tabla , $datos){



 $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, email,foto,password,perfil,estado) VALUES(:nombre, :email,:foto,:password,:perfil,:estado)");

 $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
 $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
 $stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
 $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
 $stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
 $stmt -> bindParam(":estado", $datos["estado"] , PDO::PARAM_INT);

 if($stmt -> execute()){

 	return true;
 }else{

 return false;
 }

 $stmt = null;

}


static function leerUsuarios($tabla){

	$stmt = Conexion::conectar()->prepare("SELECT id, nombre,email,foto,password,perfil,estado FROM $tabla");

	$stmt->execute();
    
    return $stmt -> fetchAll();
     
    $stmt = null;
}


	/*=============================================
	MOSTRAR TODOS LOS PRODUCTOS
	=============================================*/	

	static public function mdlMostrarTotalProductos($tabla, $orden){
	
		$stmt = Conexion::conectar()->prepare("SELECT id, titulo, descripcion, portada, precio, calificacion, categoria FROM $tabla");
		$stmt->execute();

		$stmt->bindColumn("id", $id);
		$stmt->bindColumn("titulo", $titulo);
		$stmt->bindColumn("descripcion", $descripcion);
		$stmt->bindColumn("portada", $imagen);
		$stmt->bindColumn("precio", $precio);
		$stmt->bindColumn("calificacion", $calificacion);
		$stmt->bindColumn("categoria", $categoria);

		$productos = array();

		while($fila = $stmt->fetch(PDO::FETCH_BOUND)){
			$pro = array();
			$pro['id'] = utf8_encode($id);
			$pro['titulo'] = utf8_encode($titulo);
			$pro['descripcion'] = utf8_encode($descripcion);
			$pro['imagen'] = utf8_encode($imagen);
			$pro['precio'] = utf8_encode($precio);
			$pro['calificacion'] = utf8_encode($calificacion);
			$pro['categoria'] = utf8_encode($categoria);

			array_push($productos, $pro);

		}

		return $productos;

	}


 }




 ?>