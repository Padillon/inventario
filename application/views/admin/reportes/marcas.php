<?php
class Mypdf extends TCPDF {
    public function Footer(){
        $this->SetY(-20);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 
        0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$cont = 0;
$link = base_url();
$pdf = new Mypdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->startPageGroup();

$pdf->AddPage();

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
                    Direcci&oacute;n: $empresa->direccion
                    <br>
                    Tel&eacute;fono: $empresa->telefono
                    <br>
                    $empresa->correo
            </td>
        </tr>
        <tr>
            <br>
            <td style="background-color:white; text-align: center; color:red;">
                Reporte de Marcas $estado
            </td>
        </tr>
	</table>
EOF;
$bloque1=utf8_encode($bloque1);
$pdf->writeHTML(utf8_decode($bloque1), false, false, false, false, '');

$bloque2 = <<<EOF
	<table style="font-size:12px; padding:5px 10px;">
		<tr>
            <td style="background-color:white; width:50%">Encargado: $nomUsuario->usuario</td>
            <td style="background-color:white; width:50%; text-align:right">
				Fecha: $fecha
			</td>
		</tr>
    </table>
    <table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>
	</table>
EOF;
$bloque2=utf8_encode($bloque2);
$pdf->writeHTML(utf8_decode($bloque2), false, false, false, false, '');
        
$tabla = <<<EOF
    <br>
    <table border="1" cellpadding="2" width="100%">   
            <tr>
                <th width="20%" align="center" bgcolor="lightgray">#</th>
                <th width="80%" align="center" bgcolor="lightgray">Nombre</th>
            </tr>
EOF;
$cont = 0;
foreach($marcas as $mar){
    $cont++;
    $tabla .= <<<EOF
        <tr>
            <td>$cont</td>
            <td>$mar->nombre</td>
        </tr>
EOF;
}
$tabla .= <<<EOF
        </table>
EOF;
$tabla=utf8_encode($tabla);
$pdf->writeHTML(utf8_decode($tabla), true, false, false, false, '');
$pdf->Output('reporteMarcas'.$estado.$fecha.'.pdf', 'I');
