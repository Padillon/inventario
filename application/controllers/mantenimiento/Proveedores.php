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

    public function generarPdf($fecha, $empresa){
        $link = base_url();
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->startPageGroup();
        $pdf->AddPage();
        $bloque1 = <<<EOF
	<table>
		<tr>
			<td class="col-md-3"><img src="$link/assets/images/ajuste/$empresa->logo"></td>
			<td style="background-color:white;" class="col-md-3">
				<div class="col-md-12 align-items-end">
                    <br>
                    <br>
                    <br>
					<label class="form-control">$empresa->nombre</label>
					<br>
					<label class="form-control">$empresa->giro</label>
				</div>
			</td>
			<td style="background-color:white;" class="col-md-3">
				<div class="col-md-12 align-items-end">
                    <br>
                    <br>
                    <br>
					<label class="form-control">Teléfono: $empresa->telefono</label>
					<br>
					<label class="form-control">$empresa->direccion</label>
				</div>
			</td>
            <td style="background-color:white; text-align:center; color:red" class="col-md-3">
            <br><br><label class="form-control">Reporte de <br>Proveedores</td></label>
		</tr>
	</table>
EOF;

        $pdf->writeHTML($bloque1, false, false, false, false, '');
        $pdf->Output('factura.pdf', 'I');
    }
}