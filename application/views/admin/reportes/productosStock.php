<?php
class Mypdf extends TCPDF {
    public $link;
    public $nombre;
    public $giro;
    public $estado;

    public function setLogo($link, $nombre, $giro, $estado){
        $this->link = $link;
        $this->nombre = $nombre;
        $this->giro = $giro;
        $this->estado = $estado;
    }

    public function Header() {
        // Set font
        $this->SetFont('helvetica', 'B', 15);
        $link2 = base_url();
        $html = <<<EOF
        
        <table width="100%">
            <tr>
                <td rowspan="3" style="width:10%;"><img src="$link2/assets/images/ajuste/$this->link"></td>
                <td width="20%">
                    <br>
                    <br>
                    $this->nombre 
                    <br>
                    $this->giro
                </td>
                <td width="45%" style="background-color:white; text-align: center; color:red;">
                    <br>
                    <br>
                    Reporte de Productos $this->estado
                </td>
            </tr>
        </table>
EOF;
        $thml=utf8_encode($html);
        $this->writeHTML(utf8_decode($html), false, false, false, false, '');
        //$this->Cell(0, 45, $html, 0, false, 'L', 0, '', 0, false, 'M', 'M');
    }

    public function Footer(){
        $this->SetY(-20);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 
        0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$cont = 0;
$pdf = new Mypdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setLogo($empresa->logo, $empresa->nombre, $empresa->giro, $estado);

$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->startPageGroup();

$pdf->AddPage('L');

$bloque2 = <<<EOF
	<table style="font-size:12px;">
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
                <th width="10%" align="center" bgcolor="lightgray">#</th>
                <th width="15%" align="center" bgcolor="lightgray">C&oacute;digo</th>
                <th width="15%" align="center" bgcolor="lightgray">Nombre</th>
                <th width="15%" align="center" bgcolor="lightgray">Marca</th>
                <th width="15%" align="center" bgcolor="lightgray">Categor&iacute;a</th>
                <th width="10%" align="center" bgcolor="lightgray">Presentaci&oacute;n Principal</th>
                <th width="10%" align="center" bgcolor="lightgray">Stock M&iacute;nimo</th>
                <th width="10%" align="center" bgcolor="lightgray">Stock Actual</th>
            </tr>
EOF;
$cont = 0;
foreach($productos as $pro){
    $cont++;
    $tabla .= <<<EOF
        <tr>
            <td>$cont</td>
            <td>$pro->codigo</td>
            <td>$pro->nombre</td>
            <td>$pro->marca</td>
            <td>$pro->categoria</td>
            <td>$pro->presentacion</td>
            <td>$pro->stock_minimo</td>
            <td>$pro->stock_actual</td>
        </tr>
EOF;
}
$tabla .= <<<EOF
        </table>
EOF;
$tabla=utf8_encode($tabla);
$pdf->writeHTML(utf8_decode($tabla), true, false, false, false, '');
$pdf->Output('reporteProductos'.$fecha.'.pdf', 'I');
