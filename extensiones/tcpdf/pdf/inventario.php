<?php



require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";



$item = null;
     $valor = null;
     $orden = "id";

          $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                         $total1 = null;

 foreach ($productos as $key1 => $value1) {

          

               $total1 = $total1 +  $value1["stock"];
  
           

}




date_default_timezone_set('America/La_Paz');

                              $fecha = date('d-m-Y');
                              $hora = date('H:i:s');








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



$bloque2 = <<<EOF

     <table >
          
          
             <tr>
               
               <td style="width:150px"><b>Fecha: $fecha</b></td>
             
          
          </tr>
          <tr>
               
               <td style="width:150px"><b>Hora: $hora</b></td>
             
          
          </tr>
          <tr>
               
               <td style="width:400px"><b>Productos existentes: $total1</b></td>
             
          
          </tr>
          <tr style="text-align:center">
               
               <td style="width:540px"><b>INVENTARIO</b><br></td>
          
          </tr>

     </table>

    

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

     <table style="font-size:10px; padding:5px 10px;">

           <tr>

          <td style="border: 1px solid #666; background-color:white; width:70px; text-align:center"><b>Lote</b></td>
          
          <td style="border: 1px solid #666; background-color:white; width:70px; text-align:center"><b>Código</b></td>
          <td style="border: 1px solid #666; background-color:white; width:250px; text-align:center"><b>Descripción</b></td>
          
          <td style="border: 1px solid #666; background-color:white; width:140px; text-align:center"><b>Stock</b></td>
          

          </tr>

     </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------



    foreach ($productos as $key => $value) {

     if ($value["stock"] > 0) {
          
    
    



$bloque4 = <<<EOF

     <table style="font-size:10px; padding:5px 10px;">

          <tr>

          <td style="border: 1px solid #666; background-color:white; width:70px; text-align:center">$value[lote]</td>
          
          <td style="border: 1px solid #666; background-color:white; width:70px; text-align:center">$value[codigo]</td>
          <td style="border: 1px solid #666; background-color:white; width:250px; text-align:center">$value[descripcion]</td>
          
          <td style="border: 1px solid #666; background-color:white; width:140px; text-align:center">$value[stock]</td>
          

          </tr>

     </table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}
}




// ---------------------------------------------------------



$bloque5 = <<<EOF

     <table style="font-size:15px; padding:5px 10px;">

        
          <tr>
          
          <td style="border: 0px solid white; background-color:white; width:140px; text-align:center"></td>
          <td style="border: 0px solid white; background-color:white; width:250px; text-align:center"></td>
          
          <td style="border: 1px solid #666; background-color:white; width:140px; text-align:rigth"><b>TOTAL: $total1</b></td>
          

          </tr>





     </table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('inventario.pdf');



?>