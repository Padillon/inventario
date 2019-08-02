<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salidas extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('usuario_log')=="") {
			redirect(base_url());
	} else{
		$this->permisos = $this->backend_lib->control();		
		$this->load->model("Salidas_model");
		$this->load->model("Productos_model");
		$this->load->model("Kardex_model");
		$this->load->library("Pdf");
	}
	}

	public function index(){
        $data = array(
			'permisos' => $this->permisos,
			'salidas' => $this->Salidas_model->getSalidas(),
			'clientes' => $this->Salidas_model->getClientesTodos(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/salidas/list",$data);
        $this->load->view("layouts/footer");
	}
	
	public function add(){
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/salidas/add");
        $this->load->view("layouts/footer");
    }


    public function getProductos(){
        $valor = $this->input->post("autocompleteProducto");
		$producto = $this->Salidas_model->getProductos($valor);
		echo json_encode($producto);
    }
//fncion para guardar las compras
    public function store(){
		$fecha = $this->input->post("fecha");
		$idproductos =$this->input->post("idProductos");
		$idCliente = $this->input->post("idCliente");
		$estados = $this->input->post('estados');
		$lotes = $this->input->post('lotes');
		if ($idCliente == null) {
			$idCliente = 1;
		}
		$precioVenta =$this->input->post("precioVenta");
		$cantidades =$this->input->post("cantidades");
		$importe =$this->input->post("importes");
		$total = $this->input->post("total");
		$idusuario = $this->session->userdata('id');
		$descripcion = 'venta de producto';
		$data = array(
			'id_usuario' => $idusuario,
			'id_cliente' => $idCliente,
			'fecha' => $fecha,
			'total' => $total,
			'descripcion' => $descripcion,
		);

		if ($this->Salidas_model->save($data)){
			$idSalida = $this->Salidas_model->lastID(); 
			$this->save_detalle($idproductos, $precioVenta, $idSalida, $cantidades, $importe,$fecha,$estados,$lotes); //guardando el detalle de la venta
            $this->toastr->success('Registro guardado!');
            redirect(base_url()."movimientos/salidas"); //redirigiendo a la lista de ventas
		} else {
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."movimientos/entradas/add");
		}
	}

	//funcion para guardar el detalle de la venta
	protected function save_detalle($productos, $precioVentas, $idSalida, $cantidades, $importes,$fecha,$estados,$lotes){
		for ($i=0; $i < count($productos); $i++) { 
			$id_lote=0; //variable que contendera el id del estado si es necesario
				if ($estados[$i] == 1) {
						$loteActual = $this->Salidas_model->getLote($lotes[$i]);
						if ($loteActual->cantidad == $cantidades[$i]) {
							$data2 = array(
								'estado' => 0,
								'cantidad' => $loteActual->cantidad - $cantidades[$i],
							);
							
						}else{
							$data2 = array(
								'cantidad' => $loteActual->cantidad - $cantidades[$i],
							);
						}
						$this->Salidas_model->updateLote($lotes[$i], $data2);
						$id_lote = $lotes[$i];
					}
				$data = array(
					'id_salida' => $idSalida,
					'precio_venta' => $precioVentas[$i],
					'id_producto' => $productos[$i],
					'cantidad' => $cantidades[$i],
					'subtotal' => $importes[$i],
					'id_lote' => $id_lote,
				);
				$saldo = $this->Kardex_model->get($productos[$i]) ;
				$kardex = array(
					'fecha' =>$fecha , 
					'id_movimiento' => 2,
					'descripcion'=> 'Salida',
					'id_producto' => $productos[$i],
					'cantidad' =>$cantidades[$i],
					'precio' =>$precioVentas[$i],
					'total' =>$importes[$i],
					'saldo' => $saldo->saldo - $importes[$i],
					'id_salida' => $idSalida,
					'id_usuario' => $this->session->userdata('id'),					
				);
				$this->Kardex_model->add($kardex);
				$this->Salidas_model->save_detalle($data);
				$this->updateProducto($productos[$i], $cantidades[$i]); //actualizamos el stock del producto
			
		}
	}

	protected function updateProducto($idProducto,$cantidad){
		$productoActual = $this->Productos_model->get($idProducto);
		$stock = $this->Productos_model->getStock($productoActual->id_stock);
		$data2 = array(
			'stock_actual' => $stock->stock_actual - $cantidad,
		);
		$this->Productos_model->updateStock($productoActual->id_stock, $data2);
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

	public function view(){
		$id = $this->input->post("id");
		$data = array(
			'salida' => $this->Salidas_model->getSalida($id),
			'detalle_salida' => $this->Salidas_model->getDetalleSalida($id)
		);
		$this->load->view("admin/salidas/view", $data);
	}

	public function eliminar(){
		$id = $this->input->post('id-salida-delete');
		//$entrada = $this->Entradas_model->get($id);
		$detalle = $this->Salidas_model->getDetalle($id);
		$data = array(
			'estado' =>0,
		);
		$this->Salidas_model->updateSalida($id, $data);
		$lote  = $this->Salidas_model->getLote($id);
		//eliminas la venta en kardex
		$salidas = $this->Kardex_model->get_venta($id);
		foreach($salidas as $sa){

			$kardex = array(
				'fecha' =>date('Y-m-d'),
				'id_movimiento' => 4,
				'descripcion'=> 'Venta anulada.',
				'id_producto' => $sa->id_producto,
				'cantidad' =>$sa->cantidad,
				'precio' =>$sa->precio,
				'total' =>$sa->total,
				'saldo' => $sa->saldo - $sa->total,
				'id_salida' => $id,
				'id_usuario' => $this->session->userdata('id'),					
			);
			$this->Kardex_model->add($kardex);
		}

		foreach( $detalle as $det ):
			$productoActual = $this->Productos_model->get($det->id_producto);
			$stock = $this->Productos_model->getStock($productoActual->id_stock);
			$nuevoValor = $stock->stock_actual + $det->cantidad;
			$data2 = array(
				'stock_actual' => $nuevoValor,
			);
			$this->Productos_model->updateStock($productoActual->id_stock, $data2);
			if ($det->id_lote != 0) {
				$loteActual = $this->Salidas_model->getLote($det->id_lote);
				$data = array(
					'cantidad' => $loteActual->cantidad + $det->cantidad,
					'estado' =>1,
				);
				$this->Salidas_model->updateLote($det->id_lote, $data);
			}
		endforeach;
		redirect(base_url()."movimientos/salidas"); //redirigiendo a la lista de ventas
	}

	public function getClientes(){
		$valorCliente = $this->input->post("valorCliente");
		$cli = $this->Salidas_model->getClientes($valorCliente);
		echo json_encode($cli);
	}

	public function getReporteInactivos(){
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Salidas_model->getAjustes(),
            'nomUsuario' => $this->Salidas_model->getUsuario($idusuario),
            'salidas' => $this->Salidas_model->getSalidasInactivos(),
            'estado' => "Inactivos"
        );
        //generando el pdf
        $this->load->view("admin/reportes/salidas", $data);
    }

    public function getReporteFecha(){
        $fecha1 = $this->input->get("fecha1");
        $fecha2 = $this->input->get("fecha2");
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Salidas_model->getAjustes(),
            'nomUsuario' => $this->Salidas_model->getUsuario($idusuario),
			'salidas' => $this->Salidas_model->getSalidasFechas($fecha1, $fecha2),
			'totalVenta' => $this->Salidas_model->totalSalidasFechas($fecha1, $fecha2),
            'estado' => "Por Fechas"
		);
        //generando el pdf
        $this->load->view("admin/reportes/salidasTotal", $data);
    }

	public function getReporteCliente(){
        $fecha1 = $this->input->get("fecha1");
		$fecha2 = $this->input->get("fecha2");
		$cli = $this->input->get("cli");
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Salidas_model->getAjustes(),
            'nomUsuario' => $this->Salidas_model->getUsuario($idusuario),
			'salidas' => $this->Salidas_model->getSalidasCliente($fecha1, $fecha2, $cli),
            'estado' => "Por Cliente"
		);
		//generando el pdf
        $this->load->view("admin/reportes/salidas", $data);
	}
	
	public function getResumen(){
        $fecha1 = $this->input->get("fecha1");
		$fecha2 = $this->input->get("fecha2");
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Salidas_model->getAjustes(),
            'nomUsuario' => $this->Salidas_model->getUsuario($idusuario),
			'salidas' => $this->Salidas_model->resumenDiario($fecha1, $fecha2),
			'totalVenta' => $this->Salidas_model->totalSalidasFechas($fecha1, $fecha2),
            'estado' => "Resumen Diario"
		);
		//generando el pdf
        $this->load->view("admin/reportes/salidasResumen", $data);
    }
}