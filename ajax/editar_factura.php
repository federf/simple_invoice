<?php
    include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado

	$id_factura= $_SESSION['id_factura'];
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['id_cliente']) && $_POST['id_cliente'] != 0) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['id_vendedor'])) {
           $errors[] = "Selecciona el vendedor";
        } else if (empty($_POST['condiciones'])) {
			$errors[] = "Selecciona forma de pago";
		} else if ($_POST['estado_factura']=="") {
			$errors[] = "Selecciona el estado de la factura";
		} else if (
			(!empty($_POST['id_cliente']) || $_POST['id_cliente'] == 0) &&
			!empty($_POST['id_vendedor']) &&
            !empty($_POST['condiciones']) &&
            !empty($_POST['fecha']) &&
			$_POST['estado_factura']!=""
		) {
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
        // escaping, additionally removing everything that could be (html/javascript-) code
		$id_cliente     = intval($_POST['id_cliente']);
		$id_vendedor    = intval($_POST['id_vendedor']);
        $condiciones    = intval($_POST['condiciones']);
        $fecha_factura  = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $_POST['fecha'])));
		$estado_factura = intval($_POST['estado_factura']);
		$factura_activa = intval($_POST['factura_activa']);
        $sql="UPDATE facturas SET id_cliente='".$id_cliente."', id_vendedor='".$id_vendedor."', condiciones='".$condiciones."', estado_factura='".$estado_factura."', fecha_factura='".$fecha_factura."', factura_activa='".$factura_activa."'  WHERE id_factura='".$id_factura."'";

		$query_update = mysqli_query($con,$sql);
			if ($query_update) {
				$messages[] = "Factura ha sido actualizada satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}

		if (isset($errors)) {

			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong>
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)) {

				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>