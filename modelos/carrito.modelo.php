<?php 

 require_once "conexion.php";

 class ModeloCarrito{


  /*=======================================
  =            MOSTRAR TARIFAS            =
  =======================================*/
  static public function mdlMostrarTarifas($tabla){
  $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

  $stmt -> execute();

  return $stmt -> fetch();

  $stmt->close();

  $stmt = null;
  
  }
  /*=====  End of MOSTRAR TARIFAS  ======*/
  
/*=============================================
  NUEVAS COMPRAS
  =============================================*/

  static public function mdlNuevasCompras($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_usuario, id_producto, metodo, email, direccion, pais, cantidad ,pago , ciudad, telefono, telefonoOffice, description) VALUES (:id_usuario, :id_producto, :metodo, :email, :direccion, :pais, :cantidad , :pago , :ciudad, :telefono, :telefonoOffice, :description)");

    $stmt->bindParam(":id_usuario", $datos["idUsuario"], PDO::PARAM_INT);
    $stmt->bindParam(":id_producto", $datos["idProducto"], PDO::PARAM_INT);
    $stmt->bindParam(":metodo", $datos["metodo"], PDO::PARAM_STR);
    $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
    $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
    $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
    $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
    $stmt->bindParam(":pago", $datos["pago"], PDO::PARAM_STR);
    $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
    $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
    $stmt->bindParam(":telefonoOffice", $datos["telefonoOffice"], PDO::PARAM_STR);
    $stmt->bindParam(":description", $datos["titulo"], PDO::PARAM_STR);
    

    if($stmt->execute()){ 

      return "ok"; 

    }else{ 

      return "error"; 

    }

    $stmt->close();

    $tmt =null;
  }

 
 /*=====  End of nuevas compras  ======*/



 /*====================================================
 =            VERIFICAR PRODUCTO ADQUIRIDO            =
 ====================================================*/
 
 static public function mdlVerificarProducto($tabla , $datos){

 $stmt =  Conexion::conectar()->prepare("SELECT * FROM  $tabla WHERE id_usuario = :id_usuario AND id_producto = :id_producto");

 $stmt->bindParam(":id_usuario" , $datos["idUsuario"] , PDO::PARAM_INT);
 $stmt->bindParam(":id_producto" , $datos["idProducto"] , PDO::PARAM_INT);
 
 $stmt -> execute();

 return $stmt -> fetch();

 $stmt->close();

 $stmt = null;

 }
 
 
 /*=====  End of VERIFICAR PRODUCTO ADQUIRIDO  ======*/
 
 
 }