<?php
$cont = 0;
$link = base_url();
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->startPageGroup();
$pdf->AddPage();
$estilos = <<<EOF
    
EOF;

$pdf->writeHTML($estilos, false, false, false, false, '');

$bloque1 = <<<EOF
    <table>
        <tr>
            <td rowspan="3" style="width:150px; height=100px"><img src="$link/assets/images/ajuste/$empresa->logo"></td>
            <td colspan="1" style="font-size:14px; text-align:center;">
                $empresa->nombre 
                <br>
                $empresa->giro
            </td>
        </tr>
        <tr>
            <td style="font-size:10px; background-color:white; text-align:center;">
                    <br>
                    NIT: $empresa->registro
                    <br>
                    Dirección: $empresa->direccion
                    <br>
                    Teléfono: $empresa->telefono
                    <br>
                    $empresa->correo
            </td>
            <td style="background-color:white; width:150px; text-align: left; color:red;">
                Reporte de <br> Proveedores
            </td>
        </tr>
	</table>
EOF;
$bloque1=utf8_encode($bloque1);
$pdf->writeHTML($bloque1, false, false, false, false, '');

$bloque2 = <<<EOF
	<table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>
	</table>
	<table style="font-size:12px; padding:5px 10px;">
		<tr>
            <td style="background-color:white; width:50%">Encargado: $nomUsuario->usuario</td>
            <td style="background-color:white; width:50%; text-align:right">
				Fecha: $fecha
			</td>
		</tr>
		<tr>
		<td style="border-bottom: 1px solid #666; background-color:white; width:100%"></td>
		</tr>
	</table>
EOF;
$bloque2=utf8_encode($bloque2);
$pdf->writeHTML($bloque2, false, false, false, false, '');
        
$tabla =" 
    <table style='width: 100%; border: 1px;'>
        <thead>   
            <tr>
                <th style='width: 15%;'>#</th>
                <th style='width: 29%;'>Nombre</th>
                <th style='width: 28%;'>Empresa</th>
                <th style='width: 28%;'>Telefono</th>
            </tr>
        </thead>
        <tbody>";
$cont = 0;
foreach($proveedores as $prov){
    $tabla .="<tr>
            <td style='width: 15%;'>".$cont++."</td>
            <td style='width: 29%;'>".$prov->nombre."</td>
            <td style='width: 28%;'>".$prov->empresa."</td>
            <td style='width: 28%;'>".$prov->telefono."</td>
        </tr>";
}
$tabla .= "
        </tbody>
        </table>";
$tabla=utf8_encode($tabla);
$pdf->writeHTML($tabla, false, false, false, false, '');

$pdf->Output('factura.pdf', 'I');
