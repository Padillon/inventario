<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registros extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model("Registros_model");
        $this->load->library('toastr');
        $this->load->library("Pdf");
	}

	public function index(){
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/registros/list");
        $this->load->view("layouts/footer");
    }

    public function buscar(){
        // $slSeleccionar = $this->input->post("slSeleccionar");
        // if($slSeleccionar == 1){
        //     $data = array(
        //         'consulta' => $this->Registros_model->getConsultaProveedor()
        //     );
        // } elseif($slSeleccionar == 2){
        //     $data = array(
        //         'consulta' => $this->Registros_model->getConsultaCliente()
        //     );
        // }
        $this->create_pdf();

    }

    public function create_pdf() {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);    
        $pdf->startPageGroup();
        $pdf->AddPage();

        $bloque1 = <<<EOF
        <table>
            <tr>
                <td style = "width: 150px"><img src="localhost/inventario/assets/images/ajuste/logo1.jpeg"></td>
                <td style = "background-color: white; width: 140px">
                    <div style= "font-size: 8.5px; text-align: right line-heigth: 15px;">
                        <br>
                        Nombre: Konny
                        <br>
                        Direccion: SM
                    </div>
                </td>
                <td style = "background-color: white; width: 140px">
                    <div style= "font-size: 8.5px; text-align: right line-heigth: 15px;">
                        <br>
                        Nombre: io
                        <br>
                        Direccion: SM
                    </div>
                </td>
                <td style="background-color: white; width: 110px; text-align: center; color: red">
                    <br><br>no
                </td>
            </tr>
        </table>
EOF;
        
        $pdf->writeHTML($bloque1, false, false, false, false, '');
        $pdf->Output('example_001.pdf');    
      
        }
}