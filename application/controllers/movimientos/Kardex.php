<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kardex extends CI_Controller {
    private $permisos;
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('usuario_log')=="") {
			redirect(base_url());
	} else{
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Entradas_model");
		$this->load->model("Productos_model");
		$this->load->model("Proveedores_model");
		$this->load->model("Kardex_model");
	}
	}

    public function index(){
		$fecha = date("Y-m-d");
        $data = array(
			'permisos' => $this->permisos,
			'kardex' => $this->Kardex_model->getKardexDia($fecha),
			'movimientos' => $this->Kardex_model->getTipoMovimiento(),
		);
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/kardex/inicio", $data);
        $this->load->view("layouts/footer");
	}

	//funcion para mandar a traer los movimiento de un producto en concreto
	public function getKardexProducto(){
		$id = $this->input->post("id");
		$inicio = $this->input->post("fecha_inicio");
		$final = $this->input->post("fecha_final");
		$producto = $this->Kardex_model->getKardexProducto($id,$inicio,$final);
		echo json_encode($producto);
    }

	public function getProductos(){
        $valor = $this->input->post("autocompleteProducto");
		$producto = $this->Kardex_model->getProductos($valor);
		echo json_encode($producto);
	}
	
	public function addMovimiento(){
		$fecha = $this->input->post("fecha");
		$id_movimiento = $this->input->post("id_movimiento");
		$descripcion = $this->input->post("descripcion");
		$id_productos = $this->input->post("id_productos");
		$cantidades = $this->input->post("cantidades");
		$cantidades2 = $this->input->post("cantidades2");
		$precioCompra =	 $this->input->post("precioCompra");
		if ($cantidades2 != "0"){
			$cantidades2 = $cantidades;
		}else {
			$cantidades = $cantidades;
		}

		$tipoTransaccion = $this->Kardex_model->getTipoTransaccion($id_movimiento);

		for ($i=0; $i < count($id_productos); $i++) { 
			$saldo = $this->Kardex_model->get($id_productos[$i]);
			//condicones para saber que accion tomar en el saldo
			if ($tipoTransaccion=='1') { // tipo entrada, entonces suma
				$nuevoValor = $saldo->saldo + ($cantidades[$i]* $precioCompra[$i]);
				$data = array(
					'id_movimiento' => $id_movimiento,
					'fecha' => $fecha,
					'descripcion' => $descripcion,
					'id_producto' => $id_productos[$i],
					'cantidad' => $cantidades[$i],
					'precio' => $precioCompra[$i],
					'total' => $cantidades[$i]* $precioCompra[$i],
					'saldo' => $nuevoValor,
					'id_usuario' => $this->session->userdata('id'),
				); 
				//actualizamos el stock
				$stock = $this->Productos_model->getStock( $id_productos[$i]);
				$data2 = array(
				'stock_actual' => $stock->stock_actual + $cantidades[$i],
				);
				$this->Productos_model->updateStock( $id_productos[$i], $data2);

			}else if($tipoTransaccion=='2'){ //tipo salida, entonces resta 
				$nuevoValor = $saldo->saldo - ($cantidades[$i]* $precioCompra[$i]);
				$data = array(
					'id_movimiento' => $id_movimiento,
					'fecha' => $fecha,
					'descripcion' => $descripcion,
					'id_producto' => $id_productos[$i],
					'cantidad' => $cantidades[$i],
					'precio' => $precioCompra[$i],
					'total' => $cantidades[$i]* $precioCompra[$i],
					'saldo' => $nuevoValor,
					'id_usuario' => $this->session->userdata('id'),
				);
				//actualizamos el stock
				$stock = $this->Productos_model->getStock( $id_productos[$i]);
				$data2 = array(
				'stock_actual' => $stock->stock_actual - $cantidades[$i],
				);
				$this->Productos_model->updateStock( $id_productos[$i], $data2); 
			}else{
				$data = array(
					'id_movimiento' => $id_movimiento,
					'fecha' => $fecha,
					'descripcion' => $descripcion,
					'id_producto' => $id_productos[$i],
					'cantidad' => $cantidades[$i],
					'precio' => $precioCompra[$i],
					'id_usuario' => $this->session->userdata('id'),
				);
			}		
			
			$this->Kardex_model->save($data);
		}
		redirect(base_url()."movimientos/kardex"); //redirigiendo a la lista de ventas
	}

	public function getProductoKardex(){
		$valor = $this->input->post("id");
		$inicio = $this->input->post('fecha_inicio');
		$final = $this->input->post("fecha_final");
		$producto = $this->Kardex_model->getProductoKardex($valor,$inicio,$final);
		echo json_encode($producto);
	}
}
