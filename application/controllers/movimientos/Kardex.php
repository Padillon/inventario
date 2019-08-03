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
		$this->load->library('toastr');
		$this->load->library("Pdf");
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

	public function buscar(){
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/kardex/list");
        $this->load->view("layouts/footer");
    }

	//funcion para mandar a traer los movimiento de un producto en concreto
	public function getKardexBuscar(){
		$id = $this->input->post("id");
		$inicio = $this->input->post("fecha_inicio");
		$final = $this->input->post("fecha_final");
		$producto = $this->Kardex_model->getKardexBuscar($id,$inicio,$final);
		echo json_encode($producto);
		//print_r(json_encode($producto));
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
		$id_productos = $this->input->post("idProductos");
		$cantidades = $this->input->post("cantidades");
		$precio =	 $this->input->post("nuevoPrecio");
		$fecha_caducidad = $this->input->post('fechaCaducidad');
        $this->db->trans_start(); // ******************************************************** iniciamos transaccion **************************************

		$tipoTransaccion = $this->Kardex_model->getTipoTransaccion($id_movimiento);

		for ($i=0; $i < count($id_productos); $i++) { 
			$saldo = $this->Kardex_model->get($id_productos[$i]);
			//condicones para saber que accion tomar en el saldo
			if ($tipoTransaccion->tipo=='1') { // tipo entrada, entonces suma
				//$nuevoValor = $saldo->saldo + ($cantidades[$i]* $precio[$i]);
				$data = array(
					'id_movimiento' => $id_movimiento,
					'fecha' => $fecha,
					'descripcion' => $descripcion,
					'id_producto' => $id_productos[$i],
					'cantidad' => $cantidades[$i],
					'precio' => $precio[$i],
					'total' => $cantidades[$i]* $precio[$i],
				//	'saldo' => $nuevoValor,
					'id_usuario' => $this->session->userdata('id'),
				); 
				//actualizamos el stock
				$stock = $this->Productos_model->getStock( $id_productos[$i]);
				$data2 = array(
				'stock_actual' => $stock->stock_actual + $cantidades[$i],
				);
				$this->Productos_model->updateStock( $id_productos[$i], $data2);
				if ($fecha_caducidad[$i]!=0) {
					$lote = array(
						'id_entrada' => $idEntrada,
						'id_producto' => $productos[$i],
						'cantidad' => $cantidades[$i],
						'fecha_entrada' => $fecha,
						'fecha_caducidad' => $fecha_caducidad[$i] 
					);
					$this->Entradas_model->save_lote($lote);
				}
			}else if($tipoTransaccion->tipo=='2'){ //tipo salida, entonces resta 
				$nuevoValor = $saldo->saldo - ($cantidades[$i]* $precioCompra[$i]);
				$data = array(
					'id_movimiento' => $id_movimiento,
					'fecha' => $fecha,
					'descripcion' => $descripcion,
					'id_producto' => $id_productos[$i],
					'cantidad' => $cantidades[$i],
					'precio' => $precio[$i],
					'total' => $cantidades[$i]* $precio[$i],
					'saldo' => $nuevoValor,
					'id_usuario' => $this->session->userdata('id'),
				);
				//actualizamos el stock
				$stock = $this->Productos_model->getStock( $id_productos[$i]);
				$data2 = array(
				'stock_actual' => $stock->stock_actual - $cantidades[$i],
				);
				$this->Productos_model->updateStock( $id_productos[$i], $data2); 
			}	
			
			$this->Kardex_model->save($data);
		}
        $this->db ->trans_complete();// ******************************************************** icompletamos transaccion **************************************
		if($this->db->trans_status()){ // ******************************************************** iniciamos transaccion **************************************
            $this->toastr->success('Registro guardado!');
		redirect(base_url()."movimientos/kardex"); //redirigiendo a la lista de ventas
           
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
		redirect(base_url()."movimientos/kardex"); //redirigiendo a la lista de ventas
          
        }
	//	redirect(base_url()."movimientos/kardex"); //redirigiendo a la lista de ventas
	}

	public function getProductoKardex(){
		$valor = $this->input->get("prod");
		$inicio = $this->input->get('fecha1');
		$final = $this->input->get("fecha2");
		$idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Kardex_model->getAjustes(),
            'nomUsuario' => $this->Kardex_model->getUsuario($idusuario),
			'kardex' => $this->Kardex_model->getProductoKardex($valor, $inicio, $final),
            'producto' => $this->Kardex_model->getProducto($valor),
		);

		//generando pdf
		$this->load->view("admin/reportes/kardex", $data);
	}


}
