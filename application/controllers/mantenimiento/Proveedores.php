<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends CI_Controller {
    private $permisos;
	public function __construct(){
        parent::__construct();
        if($this->session->userdata('usuario_log')=="") {
            redirect(base_url());
    } else{
        $this->permisos = $this->backend_lib->control();
        $this->load->model("Proveedores_model");
        $this->load->library('toastr');
        $this->load->library("Pdf");
}
    }

    public function index(){
        $data = array(
            'permisos' => $this->permisos,
            'proveedores' => $this->Proveedores_model->getProveedores(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/proveedores/list",$data);
        $this->load->view("layouts/footer");
    }

    public function store(){
        $nombre  = $this->input->post("nombre");
        $empresa  = $this->input->post("empresa");
        $telefono  = $this->input->post("telefono");
        
        $data  = array(
            'nombre' => $nombre,
            'empresa' => $empresa,
            'telefono' => $telefono,
            'estado' => 1,
        );
 
        if($result = $this->Proveedores_model->save($data)){
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/proveedores");
        }else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/proveedores");
        }
    }

    public function update(){
        $id = $this->input->post("idProveedor");
        $nombre  = $this->input->post("nombre");
        $empresa  = $this->input->post("empresa");
        $telefono  = $this->input->post("telefono");

        $data = array(
            'nombre' => $nombre,
            'empresa' => $empresa,
            'telefono' => $telefono,
        );
        if($this->Proveedores_model->update($id, $data)){
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."mantenimiento/proveedores");
        }else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/proveedores");
        }
    }

    public function delete(){
        $id = $this->input->post("idProveedorDelete");
        $data = array(
            'estado' =>0, 
        );
        if($this->Proveedores_model->update($id, $data)){
            $this->toastr->success('Registro borrado!');
            redirect(base_url()."mantenimiento/proveedores");
        }else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."mantenimiento/proveedores");
        } 
    }

    public function getReporte(){
        //trayendo informacion
        $fecha = date("d-m-Y");
        $empresa = $this->Proveedores_model->getAjustes();
        
        $idusuario = $this->session->userdata('id');
        $nomUsuario = $this->Proveedores_model->getUsuario($idusuario);
        //generando el pdf
        $this->generarPdf($fecha, $empresa, $nomUsuario);
    }

    public function generarPdf($fecha, $empresa, $nomUsuario){
        $link = base_url();
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->startPageGroup();
        $pdf->AddPage();
        $bloque1 = <<<EOF
        <table>
        <tr>
            <td rowspan="3" style="width:130px"><img src="$link/assets/images/ajuste/$empresa->logo"></td>
            <td colspan="1" style="font-size:14px; text-align:center;">
                $empresa->nombre 
                <br>
                $empresa->giro
                
            </td>
        </tr>
        <tr>
            <td style="background-color:white; width:140px">
                <div style="font-size:10px; text-align:right; line-height:15px;">
                    <br>
                    NIT: $empresa->registro
                    <br>
                    Dirección: $empresa->direccion
                </div>
            </td>
            <td style="background-color:white; width:140px">
                <div style="font-size:10px; text-align:right; line-height:15px;">
                    <br>
                    Teléfono: $empresa->telefono
                    <br>
                    $empresa->correo
                </div>
            </td>
        </tr>
	</table>
EOF;
        $pdf->writeHTML($bloque1, false, false, false, false, '');

        $bloque2 = <<<EOF
	<table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>
	</table>
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
            <td style="background-color:white; width:150px; text-align: left; color:red;">
                Reporte de Proveedores
            </td>
			<td style="background-color:white; width:150px; text-align:right">
				Fecha: $fecha
			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:540px">Encargado: $nomUsuario->usuario</td>
		</tr>
		<tr>
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>
		</tr>
	</table>
EOF;

        $pdf->writeHTML($bloque2, false, false, false, false, '');
        $pdf->Output('factura.pdf', 'I');
    }
}