<?php

class Controladorproveedores{

	/*=============================================
	CREAR proveedores
	=============================================*/

	static public function ctrCrearproveedor(){

		if(isset($_POST["nuevoproveedor"])){

			if(preg_match('/^[ &.a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoproveedor"]) &&

			   
			
			   preg_match('/^[-a-zA-Z0-9]+$/', $_POST["nuevoregistro"])){

			   	$tabla = "proveedores";

			   	$datos = array("nombre"=>mb_strtoupper($_POST["nuevoproveedor"]),
					     
					           "email"=>mb_strtoupper($_POST["nuevoEmail"]),
					           "registro"=>mb_strtoupper($_POST["nuevoregistro"]),
					           "instagram"=>mb_strtoupper($_POST["nuevoinstagram"]),
					           "whatsapp"=>$_POST["nuevowhatsapp"],
					           "telefono"=>$_POST["nuevoTelefono"],
					           "telefono2"=>$_POST["nuevoTelefono2"],
					           "telefono3"=>$_POST["nuevoTelefono3"],
					           "direccion"=>mb_strtoupper($_POST["nuevaDireccion"]));

			   	$respuesta = Modeloproveedores::mdlIngresarproveedor($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El proveedor ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El proveedor no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "proveedores";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR proveedores
	=============================================*/

	static public function ctrMostrarproveedores($item, $valor){

		$tabla = "proveedores";

		$respuesta = Modeloproveedores::mdlMostrarproveedores($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR proveedor
	=============================================*/

	static public function ctrEditarproveedor(){


		if(isset($_POST["editarproveedor"])){

			if(preg_match('/^[ &.a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarproveedor"]) &&
			   

			   preg_match('/^[-a-zA-Z0-9]+$/', $_POST["editarregistro"])){

			   	$tabla = "proveedores";

			   	$datos = array("id"=>$_POST["idproveedor"],
			   				   "nombre"=>mb_strtoupper($_POST["editarproveedor"]),
			   				   "registro"=>mb_strtoupper($_POST["editarregistro"]),
			   				   "whatsapp"=>$_POST["editarwhatsapp"],
			   				   "instagram"=>mb_strtoupper($_POST["editarinstagram"]),
					   
					           "email"=>mb_strtoupper($_POST["editarEmail"]),
					           "telefono"=>$_POST["editarTelefono"],
					           "telefono2"=>$_POST["editarTelefono2"],
					           "telefono3"=>$_POST["editarTelefono3"],
					           "direccion"=>mb_strtoupper($_POST["editarDireccion"]));

			   	$respuesta = Modeloproveedores::mdlEditarproveedor($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El proveedor ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El proveedor no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "proveedores";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR proveedor
	=============================================*/

	static public function ctrEliminarproveedor(){

		if(isset($_GET["idproveedor"])){

			$tabla ="proveedores";
			$datos = $_GET["idproveedor"];

			$respuesta = Modeloproveedores::mdlEliminarproveedor($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El proveedor ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "proveedores";

								}
							})

				</script>';

			}		

		}

	}

}

