<?php
class Mypdf extends TCPDF {
    public $link;
    public $nombre;
    public $giro;
    public $estado;

     public function setLogo($link, $nombre, $giro, $codigo, $nombreProd){
        $this->link = $link;
        $this->nombre = $nombre;
        $this->giro = $giro;
        $this->codigo = $codigo;
        $this->nombreProd = $nombreProd;
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
                    Kardex <br> $this->codigo $this->nombreProd
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
$link = base_url();
$pdf = new Mypdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setLogo($empresa->logo, $empresa->nombre, $empresa->giro, $producto->codigo, $producto->nombre);

$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->startPageGroup();

$pdf->AddPage('L');

$bloque2 = <<<EOF
    <table style="font-size:12px; padding:5px 10px;">
        <tr>
            <td style="background-color:white; width:50%">Encargado: $nomUsuario->usuario</td>
            <td style="background-color:white; width:50%; text-align:right"> Fecha Generado: $fecha</td>
        </tr>
        <tr>
            <td align="center" width="100%">
                <b>Informacion del Producto</b>
                <br>
                <table border="1">
                    <tr>
                        <td bgcolor="Gold"><b>C&oacute;digo</b></td>
                        <td bgcolor="Gold"><b>Nombre</b></td>
                        <td bgcolor="Gold"><b>Marca</b></td>
                        <td bgcolor="Gold"><b>Presentaci&oacute;n</b></td>
                        <td bgcolor="Gold"><b>Descripci&oacute;n</b></td>
                        <td bgcolor="Gold"><b>Estado</b></td>
                    </tr>
                    <tr>
                        <td>$producto->codigo</td>
                        <td>$producto->nombre</td>
                        <td>$producto->marca</td>
                        <td>$producto->presentacion</td>
                        <td>$producto->descripcion</td>
                        <td>$producto->estado</td>
                    </tr>
                </table>
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
                <th width="10%" align="center" bgcolor="lightgray">Fecha</th>
                <th width="10%" align="center" bgcolor="lightgray">Tipo</th>
                <th width="20%" align="center" bgcolor="lightgray">Descripci&oacute;n</th>
                <th width="20%" align="center" bgcolor="lightgray">Encargado</th>
                <th width="15%" align="center" bgcolor="lightgray">Cantidad</th>
                <th width="15%" align="center" bgcolor="lightgray">Saldo</th>
            </tr>
EOF;
$cont = 0;
$saldoK = 0;
foreach($kardex as $kar){
    $cont++;
    if($kar->tipo_transaccion == 1){
        $saldoK += $kar->cantidad;
    } else {
        $saldoK -= $kar->cantidad;
    }

    $tabla .= <<<EOF
        <tr>
            <td align="center">$cont</td>
            <td align="center">$kar->fecha</td>
            <td align="center">$kar->movimiento</td>
            <td>$kar->descripcion</td>
            <td>$kar->usuario</td>
            <td align="center">$kar->cantidad</td>
            <td align="center">$saldoK</td>
        </tr>
EOF;
}
$tabla .= <<<EOF
        </table>
EOF;
$tabla=utf8_encode($tabla);
$pdf->writeHTML(utf8_decode($tabla), true, false, false, false, '');

$pdf->Output('reporteKardex'.$fecha.'.pdf', 'I');
