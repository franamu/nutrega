<?php


require_once "Conexion.php";

/**
 * 
 */
class Datos extends Conexion
{
	
	#USUARIOS
	//----------------------------------------------------------------------------------

	public function createUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre , email, foto , password, perfil, estado) VALUES (:nombre , :email , :foto ,:password, :perfil, :estado)");

		

		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datosModel["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datosModel["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datosModel["estado"], PDO::PARAM_INT);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function readUsuariosModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, nombre , email, foto , password, perfil, estado FROM $tabla");
		$stmt->execute();
        $stmt->bindColumn("id", $id);
		$stmt->bindColumn("nombre", $nombre);
		$stmt->bindColumn("email", $email);
		$stmt->bindColumn("foto", $foto);
		$stmt->bindColumn("password", $password);
		$stmt->bindColumn("perfil", $perfil);
		$stmt->bindColumn("estado", $estado);

		$usuarios = array();

		while ($fila = $stmt->fetch(PDO::FETCH_BOUND)){
			$user = array();
			$user["id"] = utf8_encode($id);
			$user["nombre"] = utf8_encode($nombre);
			$user["email"] = utf8_encode($email);
			$user["foto"] = utf8_encode($foto);
			$user["password"] = utf8_encode($password);
			$user["perfil"] = utf8_encode($perfil);
			$user["estado"] = utf8_encode($estado);

			array_push($usuarios, $user);
		}

		return $usuarios;
	}

	public function loginUsuarioModel($datosModel, $tabla){


	$stmt = Conexion::conectar()->prepare("SELECT id, nombre, password, perfil, email FROM $tabla WHERE email = :email AND password = :password");

		$stmt->bindParam(":email", $datosModel["mail"]);
		$stmt->bindParam(":password", $datosModel["password"]);

		$stmt->execute();

		$stmt->bindColumn("id", $id);
		$stmt->bindColumn("nombre", $nombre);
		$stmt->bindColumn("password", $password);
		$stmt->bindColumn("perfil", $perfil);
		$stmt->bindColumn("email", $mail);

		while ($fila = $stmt->fetch(PDO::FETCH_BOUND)){
			$user = array();
			$user["id"] = utf8_encode($id);
			$user["nombre"] = utf8_encode($nombre);
			$user["password"] = utf8_encode($password);
			$user["perfil"] = utf8_encode($perfil);
			$user["mail"] = utf8_encode($mail);
		}

		if(!empty($user)){
			return $user;
		}else{
			return false;
		}

	


	}

	#CATEGORIAS
	//----------------------------------------------------------------------------------

	public function createCategoriaModel($titulo, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (titulo) VALUES (:titulo)");

		$stmt->bindParam(":titulo", $titulo, PDO::PARAM_STR);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function readCategoriaModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, titulo FROM $tabla");
		$stmt->execute();

		$stmt->bindColumn("id", $id);
		$stmt->bindColumn("titulo", $titulo);

		$categorias = array();

		while ($fila = $stmt->fetch(PDO::FETCH_BOUND)){
			$cat = array();
			$cat["id"] = utf8_encode($id);
			$cat["titulo"] = utf8_encode($titulo);

			array_push($categorias, $cat);
		}

		return $categorias;
	}

	public function updateCategoriaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set titulo = :titulo WHERE id = :id");

		$stmt->bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function deleteCategoriaModel($id, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	#VENTAS
	//----------------------------------------------------------------------------------

	public function createVentasModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, producto, imagen, costo, fecha) VALUES (:usuario, :producto, :imagen, :costo, :fecha)");

		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":producto", $datosModel["producto"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":costo", $datosModel["costo"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function readVentasModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT V.id, U.usuario, V.producto, V.imagen, V.costo, V.fecha FROM $tabla V INNER JOIN usuarios U ON V.usuario = U.id ORDER BY V.fecha");
		$stmt->execute();

		$stmt->bindColumn("id", $id);
		$stmt->bindColumn("usuario", $usuario);
		$stmt->bindColumn("producto", $producto);
		$stmt->bindColumn("imagen", $imagen);
		$stmt->bindColumn("costo", $costo);
		$stmt->bindColumn("fecha", $fecha);

		$ventas = array();

		while ($fila = $stmt->fetch(PDO::FETCH_BOUND)){
			$ven = array();
			$ven["id"] = utf8_encode($id);
			$ven["usuario"] = utf8_encode($usuario);
			$ven["producto"] = utf8_encode($producto);
			$ven["imagen"] = utf8_encode($imagen);
			$ven["costo"] = utf8_encode($costo);
			$ven["fecha"] = utf8_encode($fecha);

			array_push($ventas, $ven);
		}

		return $ventas;
	}

	public function readVentasEspecificasModel($usuario, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT V.id, U.usuario, V.producto, V.imagen, V.costo, V.fecha FROM $tabla V INNER JOIN usuarios U ON V.usuario = U.id WHERE U.id = $usuario ORDER BY V.fecha");
		$stmt->execute();

		$stmt->bindColumn("id", $id);
		$stmt->bindColumn("usuario", $usuario);
		$stmt->bindColumn("producto", $producto);
		$stmt->bindColumn("imagen", $imagen);
		$stmt->bindColumn("costo", $costo);
		$stmt->bindColumn("fecha", $fecha);

		$ventas = array();


		while ($fila = $stmt->fetch(PDO::FETCH_BOUND)){
			$ven = array();
			$ven["id"] = utf8_encode($id);
			$ven["usuario"] = utf8_encode($usuario);
			$ven["producto"] = utf8_encode($producto);
			$ven["imagen"] = utf8_encode($imagen);
			$ven["costo"] = utf8_encode($costo);
			$ven["fecha"] = utf8_encode($fecha);

			array_push($ventas, $ven);
		}

		return $ventas;
	}

	#PRODUCTOS
	//-----------------------

	public function readProductosModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id, titulo, descripcion, portada, precio, id_categoria FROM $tabla ORDER BY id DESC LIMIT 10");
		$stmt->execute();

		$stmt->bindColumn("id", $id);
		$stmt->bindColumn("titulo", $titulo);
		$stmt->bindColumn("descripcion", $descripcion);
		$stmt->bindColumn("portada", $portada);
		$stmt->bindColumn("precio", $precio);
		$stmt->bindColumn("id_categoria", $id_categoria);

		$productos = array();

		while($fila = $stmt->fetch(PDO::FETCH_BOUND)){
			$pro = array();
			$pro['id'] = utf8_encode($id);
			$pro['titulo'] = utf8_encode($titulo);
			$pro['descripcion'] = utf8_encode($descripcion);
			$pro['portada'] = utf8_encode($portada);
			$pro['precio'] = utf8_encode($precio);
			$pro['id_categoria'] = utf8_encode($id_categoria);

			array_push($productos, $pro);

		}

		return $productos;
	}

	public function deleteProductoModel($id, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return true;
		}else{
			return false;
		}
	}

}

?>