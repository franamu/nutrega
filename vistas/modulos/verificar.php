<!--=====================================
=            VERIFICAR EMAIL            =
======================================-->

<?php 
$usuarioVerificado = false;
$item = "emailEncriptado";
$valor = $rutas[1];

$respuesta = ControladorUsuarios::ctrMostrarUsuario($item , $valor);

if($valor == $respuesta["emailEncriptado"]){

    $id = $respuesta["id"];
    $item2 = "verificacion";
    $valor2 = 0;

    $respuesta2 = ControladorUsuarios::ctrActualizarUsuario($id, $item2 , $valor2);

    if($respuesta2 == "ok"){

    	$usuarioVerificado = true;
    }

}

 ?>


<div class="container">
	<div class="row">
		<div class="col-xs-12 text-center verificar">
			<?php 

             
              if($usuarioVerificado){

              	echo '<h3>Gracias</h3>
                      <h2><small>Hemos verificado su correo electrónico, ya puede ingresar al sistema</small></h2>
                      <br>
                      <a href="#modalIngreso" data-toggle="modal"><button class="btn btn-default backColor btn-lg">Ingresar </button></a>

              	';

              }else{
                 
                 echo '<h3>Error</h3>
                      <h2><small>No se ah podido verificar el correo electrónico, vuelva a registrarse</small></h2>
                      <br>
                      <a href="#modalRegistro" data-dismiss="modal"><button class="btn btn-default backColor btn-lg">Registro</button></a>

              	';
                

              }

			 ?>
		</div>
	</div>

</div>

<!--====  End of VERIFICAR EMAIL  ====-->
