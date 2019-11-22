<?php  
require_once "../extensiones/paypal.controlador.php";

// Controladores
require_once "../controladores/carrito.controlador.php";
require_once "../controladores/notificaciones.controlador.php";
require_once "../controladores/productos.controlador.php";
require_once "../controladores/usuarios.controlador.php";

// modelos
require_once "../modelos/notificaciones.modelo.php";
require_once "../modelos/carrito.modelo.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../modelos/productos.modelo.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxCarrito{


/*=====================================
=            MÈTODO PAYPAL            =
=====================================*/

public $divisa;
public $total;
public $impuesto;
public $envio;
public $subtotal;
public $tituloArray;
public $cantidadArray;
public $valorItemArray;
public $idProductoArray;


public function ajaxEnviarPaypal(){

   $datos = array(
      "divisa"=>$this->divisa,
      "total"=>$this->total,
      "impuesto"=>$this->impuesto,
      "envio"=>$this->envio,
      "subtotal"=>$this->subtotal,
      "tituloArray"=>$this->tituloArray,
      "cantidadArray"=>$this->cantidadArray,
      "valorItemArray"=>$this->valorItemArray,
      "idProductoArray"=>$this->idProductoArray,
   );

   $respuesta = Paypal::mdlPagoPaypal($datos);

   echo $respuesta;

   }


   /*=====  End of MÈTODO PAYPAL  ======*/


   /*===================================
   =            METODO PAYU            =
   ===================================*/

   public function ajaxTraerComercioPayu(){

   $respuesta = ControladorCarrito::ctrMostrarTarifas();

   echo json_encode($respuesta);

   }

   /*=====  End of METODO PAYU  ======*/


   /*====================================================================
   =            verificar que no tenga el producto adquirido            =
   ====================================================================*/

   public $idUsuario;
   public $idProducto;

   public function ajaxVerificarProducto(){

   $datos = array(
      "idUsuario"=>$this->idUsuario,
      "idProducto"=>$this->idProducto    
   );

   $respuesta = ControladorCarrito::ctrVerificarProducto($datos);
   if($respuesta == false){
   	$resp = false;
   }else{
   	$resp = true;
   }
   echo $resp; 
   }


/*=====  End of verificar que no tenga el producto adquirido  ======*/


/*====================================
=            PAGO EN CASA            =
====================================*/

	public $calle;
	public $numeroPEC;
	public $barrioPEC;
	public $paisPEC;
	public $ciudadPEC;
	public $codigoPostalPEC;
	public $emailPEC;
	public $celularPEC;
	public $metodoPagoCasa;

	public function ajaxEnviarPagoEncasa() {

	  $datos = array(
	  	'idUsuario' => $this->idUsuario,
			"divisa"=> $this->divisa,
			"total"=> $this->total,
			"impuesto"=> $this->impuesto,
			"envio"=> $this->envio,
			"subtotal"=> $this->subtotal,
			"tituloArray"=> $this->tituloArray,
			"cantidadArray"=> $this->cantidadArray,
			"valorItemArray"=> $this->valorItemArray,
			"idProductoArray"=> $this->idProductoArray,
			'calle' => $this->calle,
			'numeroPEC' => $this->numeroPEC,
			'barrioPEC' => $this->barrioPEC,
			'paisPEC' => $this->paisPEC,
			'ciudadPEC' => $this->ciudadPEC,
			'codigoPostalPEC' => $this->codigoPostalPEC,
			'emailPEC' => $this->emailPEC,
			'celularPEC' => $this->celularPEC,
			'metodoPagoCasa' => $this->metodoPagoCasa
	  );

	  // Agregar a la base de datos
	 
	  $productos = explode("-", $datos["idProductoArray"]);
		$cantidad = explode(",", $datos["cantidadArray"]);
		$titulo = explode("," , $datos["tituloArray"]);
		$pago = $datos['total'];
		$idUsuario = $datos["idUsuario"];

		// Actualizamos la base de datos
		for($i = 0; $i < count($productos); $i++) {

	  	$datosDB = array("idUsuario"=>$idUsuario,
		                 "idProducto"=>$productos[$i],
		                 "metodo"=> $datos["metodoPagoCasa"],
		                 "email"=> $datos["emailPEC"],
		                 "titulo"=> $titulo[$i],
		                 "direccion"=> $datos["calle"] 
		                 	. " " . $datos["numeroPEC"]
		                 	. " " . $datos["barrioPEC"]
		                 	. " " . $datos["codigoPostalPEC"],
		                 "pais"=> $datos["paisPEC"],
		                 "ciudad"=> $datos["ciudadPEC"],
		                 "telefono"=> $datos["celularPEC"],
		                 "telefonoOffice" => "",
		                 "cantidad"=> $cantidad[$i],
		                 "pago"=> $pago);

		  $respuesta = ControladorCarrito::ctrNuevasCompras($datosDB);

		  $ordenar = "id";
		  $item = "id";
		  $valor = $productos[$i];

		  $productosCompra = ControladorProductos::ctrListarProductos($ordenar, $item, $valor);

	  	foreach ($productosCompra as $key => $value) {

	      $item1 = "ventas";
				$valor1 = $value["ventas"] + $cantidad[$i];
				$item2 = "id";
				$valor2 =$value["id"];

				$actualizarCompra = ControladorProductos::ctrActualizarProducto($item1, $valor1, $item2, $valor2);

				$item1 = "stock";
				$valor1 = $value["stock"] -  $cantidad[$i];
				if($valor1 < 0){$valor1 = 0;}
				$item2 = "id";
				$valor2 = $value["id"];

				$respuesta2 = ControladorProductos::ctrActualizarProducto($item1 , $valor1 , $item2 , $valor2);

	    
	     
	    	$datos2 = array( "idUsuario"=>$idUsuario,
				  "idProducto"=>$value["id"],
				  "comentario"=>"",
				  "calificacion" => 0.0
				);

				$insertarNuevoComentario = ControladorUsuarios::ctrInsertarComentarioNuevaCompra($datos2);     
	  	}
		}
	  

	  if ($respuesta === false) {
	     $resp = false;
	  } else {
	     $resp = true;
	  }

	  echo $resp; 
	}



/*=====  End of PAGO EN CASA  ======*/



}


/*if(isset($_POST["divisa"])){

$paypal = new AjaxCarrito();
$paypal->divisa = $_POST["divisa"];
$paypal->total = $_POST["total"];
$paypal->impuesto = $_POST["impuesto"];
$paypal->envio = $_POST["envio"];
$paypal->subtotal = $_POST["subtotal"];
$paypal->tituloArray = $_POST["tituloArray"];
$paypal->cantidadArray = $_POST["cantidadArray"];
$paypal->valorItemArray = $_POST["valorItemArray"];
$paypal->idProductoArray = $_POST["idProductoArray"];
$paypal-> ajaxEnviarPaypal();


}*/

if(isset($_POST["metodoPago"]) && $_POST["metodoPago"] == "payu"){
 
 $payu = new AjaxCarrito();
 $payu-> ajaxTraerComercioPayu();	
}


/*====================================================================
=            VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO            =
====================================================================*/

if(isset($_POST["idProducto"])){
 
 $producto = new AjaxCarrito();	
 $producto ->idUsuario = $_POST["idUsuario"];
 $producto ->idProducto = $_POST["idProducto"];
 $producto -> ajaxVerificarProducto();
}

/*=====  End of VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO  ======*/

if(isset($_POST['metodoPagoCasa'])) {
   $producto = new AjaxCarrito();
   $producto->idUsuario = $_POST["idUsuario"];
   $producto->divisa = $_POST["divisa"];
   $producto->total = $_POST["total"];
   $producto->impuesto = $_POST["impuesto"];
   $producto->envio = $_POST["envio"];
   $producto->subtotal = $_POST["subtotal"];
   $producto->tituloArray = $_POST["tituloArray"];
   $producto->cantidadArray = $_POST["cantidadArray"];
   $producto->valorItemArray = $_POST["valorItemArray"];
   $producto->idProductoArray = $_POST["idProductoArray"];
   $producto->idUsuario = $_POST["idUsuario"];
   $producto->calle = $_POST["calle"];
   $producto->numeroPEC = $_POST["numeroPEC"];
   $producto->barrioPEC = $_POST["barrioPEC"];
   $producto->paisPEC = $_POST["paisPEC"];
   $producto->ciudadPEC = $_POST["ciudadPEC"];
   $producto->codigoPostalPEC = $_POST["codigoPostalPEC"];
   $producto->emailPEC = $_POST["emailPEC"];
   $producto->celularPEC = $_POST["celularPEC"];
   $producto->metodoPagoCasa = $_POST["metodoPagoCasa"];
   $producto->ajaxEnviarPagoEncasa();

}



