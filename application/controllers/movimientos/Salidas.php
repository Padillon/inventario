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
	}
	}

	public function index(){
        $data = array(
			'permisos' => $this->permisos,
            'salidas' => $this->Salidas_model->getSalidas(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/salidas/list",$data);
        $this->load->view("layouts/footer");
	}
	
	public function add(){
		$data = array(
			'comprobante' => $this->Salidas_model->getComprobantes(),
		);
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/salidas/add",$data);
        $this->load->view("layouts/footer");
    }


    public function getProductos(){
        $valor = $this->input->post("autocompleteProducto");
		$producto = $this->Entradas_model->getProductos($valor);
		echo json_encode($producto);
    }
//fncion para guardar las compras
    public function store(){
		//$tipo_comprobante = $this->input->post('id_conprobante');
	//	$numero =$this->input->post('numero');
		$fecha = $this->input->post("fecha");
		$idproductos =$this->input->post("idProductos");
		$precioVenta =$this->input->post("precioVenta");
		$cantidades =$this->input->post("cantidades");
		$importe =$this->input->post("importes");
		$total = $this->input->post("total");
		$idusuario = $this->session->userdata('id');
		$descripcion = 'venta de producto';
		/*$aumento= array(
			'cantidad' => $numero+1,
		);*/
		$data = array(
			'id_usuario' => $idusuario,
			'fecha' => $fecha,
			'total' => $total,
			'descripcion' => $descripcion,
			'id_tipo_salida' =>1 ,
		);

		if ($this->Salidas_model->save($data)){
			$idSalida = $this->Salidas_model->lastID(); 
			$this->save_detalle($idproductos, $precioVenta, $idSalida, $cantidades, $importe,$fecha); //guardando el detalle de la venta
			//$this->Salidas_model->update_correlativo($tipo_comprobante,$aumento);
			redirect(base_url()."movimientos/salidas"); //redirigiendo a la lista de ventas
		} else {
			redirect(base_url()."movimientos/entradas/add");
		}
	}

	//funcion para guardar el detalle de la venta
	protected function save_detalle($productos, $precioVentas, $idSalida, $cantidades, $importes,$fecha){
		for ($i=0; $i < count($productos); $i++) { 
				$data = array(
					'id_salida' => $idSalida,
					'precio_venta' => $precioVentas[$i],
					'id_producto' => $productos[$i],
					'cantidad' => $cantidades[$i],
					'subtotal' => $importes[$i],
				);
				$saldo = $this->Kardex_model->get($productos[$i]) ;
				
				$kardex = array(
					'fecha' =>$fecha , 
					'descripcion'=> 'Salida',
					'id_producto' => $productos[$i],
					'cantidad' =>$cantidades[$i],
					'precio' =>$precioVentas[$i],
					'total' =>$importes[$i],
					'saldo' => $saldo->saldo + $importes[$i],
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
		//eliminas la venta en kardex
		$salidas = $this->Kardex_model->get_venta($id);
		foreach($salidas as $sa){

			$kardex = array(
				'fecha' =>date('Y-m-d'),
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
			$data2 = array(
				'stock_actual' => $stock->stock_actual - $det->cantidad,
			);
			$this->Productos_model->updateStock($productoActual->id_stock, $data2);
		endforeach;
		redirect(base_url()."movimientos/salidas"); //redirigiendo a la lista de ventas
	}

}