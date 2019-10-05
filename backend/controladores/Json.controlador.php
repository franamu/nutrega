<?php 

require_once "../../modelos/Json.modelo.php";


class JsonControlador{

   
   static public function ctrCrearUsuario($nombre, $email,$foto,$password,$perfil,$estado){

      
      $datos = array("nombre"=> $nombre,
      	             "email"=> $email,
      	             "foto"=>$foto,
      	             "password"=>$password,
      	             "perfil"=>$perfil,
      	             "estado"=>$estado
                    );

      $tabla = "administradores";
      
      $respuesta = JsonDatos::mdlCrearUsuario($tabla , $datos); 

      

   }


   /*=============================================
	MOSTRAR TOTAL PRODUCTOS
	=============================================*/

	static public function ctrMostrarTotalProductos($orden){

		$tabla = "productos";

		$respuesta = JsonDatos::mdlMostrarTotalProductos($tabla, $orden);

		return $respuesta;

	}





}

   /*$test = new JsonControlador();
   $test->ctrCrearUsuario("juan" , "juan@gmail.com" , "linkfoto", "123456789" , "editor" , "1");*/

 ?>