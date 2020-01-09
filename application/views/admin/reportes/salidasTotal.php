<?php

//No pueden haber espacios en blanco despues del <<<"bloque"
//Ni tampoco espacios en blanco ni tabulador en en "bloque";
//este ultimo tiene que estar al inicio de la linea por fuerza
//Los estilos y atributos de html deben estar con doble comilla
//el html debe etar bien escrito y bien estructurado
//no lolee si falta una etiqueta
//Los acentos no los lee, por eso se codifica y decodifica en utf8 antes de mostrar
//El margen del header se especifica en el config de tcphp variable MARGIN_TOP

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
        $this->SetFont('helvetica', 'B', 14);
        $link2 = base_url();
        $html = <<<EOF
        
        <table width="100%">
            <tr>
                <td rowspan="3" style="width:10%;">
                <br><br>
                <img src="$link2/assets/images/ajuste/$this->link">
                </td>
                <td width="25%">
                    <br>
                    <br>
                    $this->nombre 
                    <br>
                    $this->giro
                </td>
                <td width="45%" style="background-color:white; text-align: center; color:red;">
                    <br>
                    <br>
                    Reporte de Ventas $this->estado
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
$pdf->setLogo($empresa->logo, $empresa->nombre, $empresa->giro, $estado);

$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->startPageGroup();

$pdf->AddPage();

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
                <th width="10%" align="center" bgcolor="lightgray">#</th>
                <th width="22%" align="center" bgcolor="lightgray">Fecha</th>
                <th width="22%" align="center" bgcolor="lightgray">Cliente</th>
                <th width="22%" align="center" bgcolor="lightgray">Encargado</th>
                <th width="22%" align="center" bgcolor="lightgray">Total</th>
            </tr>
EOF;
$cont = 0;
foreach($salidas as $sal){
    $cont++;
    $cliente = $sal->nombre." ".$sal->apellido;
    $total = number_format($sal->total, 2, ".", " ");
    $tabla .= <<<EOF
        <tr>
            <td align="center">$cont</td>
            <td align="center">$sal->fecha</td>
            <td>$cliente</td>
            <td>$sal->usuario</td>
            <td align="right">$ $total</td>
        </tr>
EOF;
}
$tabla .= <<<EOF
        </table>
EOF;
$tabla=utf8_encode($tabla);
$pdf->writeHTML(utf8_decode($tabla), true, false, false, false, '');

$tablaTotal = <<<EOF
    <table border="1" align="center" cellpadding="2" width="100%">
        <tr>
            <td>Total de Ventas: $ $totalVenta->totalTotal</td>
        </tr>
    </table>

EOF;
$tablaTotal=utf8_encode($tablaTotal);
$pdf->writeHTML(utf8_decode($tablaTotal), true, false, false, false, '');

$pdf->Output('reporteSalida'.$fecha.'.pdf', 'I');


