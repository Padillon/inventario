<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entradas extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model("Entradas_model");
	}

	public function index(){
        $data = array(
            'entradas' => $this->Entradas_model->getEntradas(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/entradas/list",$data);
        $this->load->view("layouts/footer");
	}
	
	public function add(){
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/entradas/add");
        $this->load->view("layouts/footer");
    }

    public function getProveedores(){
        $valorProveedor = $this->input->post("valorProveedor");
		$prov = $this->Entradas_model->getProveedores($valorProveedor);
		echo json_encode($prov);
    }

    public function getProductos(){
        $valor = $this->input->post("autocompleteProducto");
        $proveedor = $this->input->post("id_proveedor");
		$producto = $this->Entradas_model->getProductos($valor,$proveedor);
		echo json_encode($producto);
    }
//fncion para guardar las compras
    public function store(){
		//$fecha = $this->input->post("fecha");
		$idproductos =$this->input->post("idProductos");
		$nuevoPrecio =$this->input->post("nuevoPrecio");
		$preciosSalida =$this->input->post("precioSalida");
		$cantidades =$this->input->post("cantidades");
		$importe =$this->input->post("importes");
		//$total = $this->input->post("total-reabastecer");
		//$idProveedor = $this->input->post("idproveedor");
		//$idusuario = $this->session->userdata('id'); 

		$data = array(
			'fecha' => $fecha,
			'total_abastecer' => $total,
			'usuario_id' => $idusuario,
			'proveedor_id' => $idProveedor,
		);
		//operación para el saldo 
		$dat2= array(
			'usuario' => $idusuario,
			'transaccion' => 2,
			'fecha' => $fecha,
			'monto' => $total,
			'saldo' => $total,
		);
		//guardamos el registro en caja
		if($this->Cajas_model->save($dat2)){
			$id_caja = $this->Cajas_model->lastID();
			$this->updateCaja($id_caja,$total,0);//se actualiza el saldo de la caja
		}
		//datos de cajas guardados-----

		if ($this->Reabastecer_model->save($data)){
			$idAbastecer = $this->Reabastecer_model->lastID(); 
			$this->save_detalle($idproductos, $nuevoPrecio, $precios, $idAbastecer, $cantidades, $importe, $fecha); //guardando el detalle de la venta
			redirect(base_url()."movimientos/reabastecer"); //redirigiendo a la lista de ventas
		} else {
			redirect(base_url()."movimientos/reabastecer/add");
		}
	}

	//funcion para actualizar caja
	protected function updateCaja($idcaja,$subtotal,$tipo){

		$saldoActual = $this->Cajas_model->getSaldo($idcaja-1);
		if ($tipo == 1) {
			# code...
			$data = array(
			'saldo' => $saldoActual->saldo + $subtotal,
		);
		}else{
			$data = array(
				'saldo' => $saldoActual->saldo - $subtotal,
			);
		}
		$this->Cajas_model->updateCaja($idcaja, $data);
	}

	protected function updateProducto($idProducto, $mediaPrecio, $cantidad ,$fecha){
		$productoActual = $this->Productos_model->getProducto($idProducto);
		$data = array(
			'stock' => $productoActual->stock + $cantidad,
			'precio_entrada' => $mediaPrecio,
			'fecha_i'=> $fecha
		);
		$this->Productos_model->update($idProducto, $data);
	}
}