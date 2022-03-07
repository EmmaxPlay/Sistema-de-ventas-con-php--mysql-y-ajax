<?php

include "../fpdf/fpdf.php";

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";



class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

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



//---------------------------------------------------------
$pdf = new FPDF($orientation='P',$unit='mm', array(45,350));
$pdf->AddPage();



$pdf->SetFont('Arial','',5);    //Letra Arial, negrita (Bold), tam. 20
$textypos = 5;
$pdf->setY(2);
$pdf->setX(14);
$pdf->Cell(5,$textypos,"RIF: J-343432123");

$pdf->SetFont('Arial','B',5);    //Letra Arial, negrita (Bold), tam. 

$textypos+=6;
$pdf->setX(10);
$pdf->Cell(5,$textypos,"FERRETERIA LINGO300 C.A.");

$pdf->SetFont('Arial','',5);    //Letra Arial, negrita (Bold), tam. 

$textypos+=6;
$pdf->setX(5);
$pdf->Cell(5,$textypos,"Av. Rivas, Edif. Ruiz, Local 4-B, Caracas");
$pdf->SetFont('Arial','',5);    //Letra Arial, negrita (Bold), tam. 

$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,"Cliente: ".mb_strtoupper($respuestaCliente['nombre'])." ".mb_strtoupper($respuestaCliente['apellido']));

$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,"Id: ".$respuestaCliente['documento']);



$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,utf8_decode("Telefóno: ").$respuestaCliente['telefono']);

$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,"Vendedor: ".$respuestaVendedor['usuario']);

$textypos+=6;
$pdf->setX(17);
$pdf->Cell(5,$textypos,"FACTURA");

$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,utf8_decode("FACTURA: N° ").$valorVenta);

$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,utf8_decode("Fecha / Hora: ").$respuestaVenta['fecha']);








$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,'-------------------------------------------------------------------');



foreach ($productos as $key => $item) {

$valorUnitario = number_format($item["precio"], 2);

$precioTotal = number_format($item["total"], 2);

$textypos+=6;
$pdf->setX(2);

$pdf->Cell(5,$textypos,$item['cantidad']. " X $ " .$valorUnitario);

$textypos+=6;
$pdf->setX(2);

$pdf->Cell(5,$textypos,mb_strtoupper($item['descripcion']));

$textypos+=6;
$pdf->setX(28);

$pdf->Cell(5,$textypos,"$ ".$precioTotal);




}
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,'-------------------------------------------------------------------');





$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,"NETO:                                         $ ". $neto );
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,"IMPUESTO:                                     $ ". $impuesto );

$pdf->SetFont('Arial','B',6);    //Letra Arial, negrita (Bold), tam. 

$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,"TOTAL:                           $ ". $total );

$pdf->SetFont('Arial','',5);    //Letra Arial, negrita (Bold), tam. 

$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,$respuestaVenta['metodo_pago']."                                        $ ". $total );


$pdf->setX(10);
$pdf->Cell(5,$textypos+6,'GRACIAS POR TU COMPRA ');

//$pdf->output();

$pdf->Output('factura.pdf','I');

// ---------------------------------------------------------


}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>