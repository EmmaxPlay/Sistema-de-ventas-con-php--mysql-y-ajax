<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


class imprimirFactura1{

public $codigo;

public function traerImpresionFactura1(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);



//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------



$bloque1 = <<<EOF

	<table>
          
          <tr>
               
               <td style="background-color:white; width:200px"><img src="images/logo-blanco-bloque.png"></td>

               <td style="background-color:white; width:340px">
                    
                    <div style="font-size:10px; text-align:center; line-height:12px;">
                         
                     
                         <b>FERRETERIA LINGO300 C.A.</b>
                         <br>


                         <b>J-343432123</b>
                         <br>
Av. Rivas, Edif. Ruiz, Local 4-B, Caracas
<br>
+584121231223 / +582435672343
<br>
FLINGO300@GMAIL.COM
<br>
                         FLINGO300
                         <br>
                         
                         +584121231223
                         <br>
                    </div>

               </td>

          

               <td style="background-color:white; width:100px; text-align:center; color:red"><br><br> </td>

          </tr>

     </table>
EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$apellidocliente =null;
$nombrecliente = null;

$nombrecliente = mb_strtoupper($respuestaCliente["nombre"]);
$apellidocliente = mb_strtoupper($respuestaCliente["apellido"]);
$direccioncliente = mb_strtoupper($respuestaCliente["direccion"]);

$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid white; background-color:white;  width:270px">

				<b>Cliente:</b> $nombrecliente $apellidocliente

			</td>

			<td style="border: 1px solid white; background-color:white; width:270px; text-align:right">
			
				<b>Fecha / Hora:</b> $respuestaVenta[fecha]

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid white; background-color:white; width:270px">

				<b>Documento ID:</b> $respuestaCliente[documento]

			</td>

			<td style="border: 1px solid white; background-color:white; width:270px; text-align:right">
			
				<b>N. Factura:</b> $valorVenta

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid white; background-color:white; width:270px">

				<b>Dirección:</b> $direccioncliente

			</td>

			<td style="border: 1px solid white; background-color:white; width:270px; text-align:right">
			
				<b>Vendedor:</b> $respuestaVendedor[usuario]

			</td>

		</tr>
		<tr>
		
			<td style="border: 1px solid white; background-color:white; width:270px">

				<b>Telefóno:</b> $respuestaCliente[telefono]

			</td>

			<td style="border: 1px solid white; background-color:white; width:270px; text-align:right">
			
				

			</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:500px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:220px; text-align:center"><b>Producto</b></td>
		<td style="border: 1px solid #666; background-color:white; width:70px; text-align:center"><b>Cantidad</b></td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><b>Precio Unitario</b></td>
		<td style="border: 1px solid #666; background-color:white; width:140px; text-align:center"><b>Precio Total</b></td>
		

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($productos as $key => $item) {



$valorUnitario = number_format($item["precio"], 2);

$precioTotal = number_format($item["total"], 2);

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$auxproducto = mb_strtoupper($item["descripcion"]);



$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:220px; text-align:center">
				$auxproducto
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:70px; text-align:center">
				$item[cantidad]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			$valorUnitario
				
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:140px; text-align:center">
			$precioTotal 
				
			</td>


		



		


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 0px solid white; background-color:white; width:290px; text-align:rigth">MÉTODO DE PAGO: $respuestaVenta[metodo_pago]</td>
	
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Neto:</td>
		<td style="border: 1px solid #666; background-color:white; width:140px; text-align:center">$neto</td>
		

		</tr>
		<tr>
		
		<td style="border: 0px solid white; background-color:white; width:220px; text-align:center"></td>
		<td style="border: 0px solid white; background-color:white; width:70px; text-align:center"></td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">IVA:</td>
		<td style="border: 1px solid #666; background-color:white; width:140px; text-align:center">$impuesto</td>
		

		</tr>

		<tr>
		
		<td style="border: 0px solid white; background-color:white; width:220px; text-align:center"></td>
		<td style="border: 0px solid white; background-color:white; width:70px; text-align:center"></td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><b>Total:</b></td>
		<td style="border: 1px solid #666; background-color:white; width:140px; text-align:center"><b>$total</b></td>
		

		</tr>





	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('factura1.pdf');

}

}

$factura = new imprimirFactura1();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura1();

?>