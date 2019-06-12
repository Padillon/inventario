<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entradas extends CI_Controller {
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
        $data = array(
			'permisos' => $this->permisos,
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
		$producto = $this->Entradas_model->getProductos($valor);
		echo json_encode($producto);
    }
				//fncion para guardar las compras
    public function store(){
		$fecha = $this->input->post("fecha");
		$idproductos =$this->input->post("idProductos");
		$nuevoPrecio =$this->input->post("nuevoPrecio");
		$precioSalida =$this->input->post("precioSalida");
		$cantidades =$this->input->post("cantidades");
		$importe =$this->input->post("importes");
		$total = $this->input->post("total");
		$idProveedor = $this->input->post("idProveedor");
		$idusuario = $this->session->userdata('id');

		$data = array(
			'fecha' => $fecha,
			'total' => $total,
			'id_usuario' => $idusuario,
			'id_proveedor' => $idProveedor,
		);

		if ($this->Entradas_model->save($data)){
			$idEntrada = $this->Entradas_model->lastID(); 
			$this->save_detalle($idproductos, $nuevoPrecio, $precioSalida, $idEntrada, $cantidades, $importe, $fecha); //guardando el detalle de la venta
			redirect(base_url()."movimientos/entradas"); //redirigiendo a la lista de ventas
		} else {
			redirect(base_url()."movimientos/entradas/add");
		}
	}

	//funcion para guardar el detalle de la venta
	protected function save_detalle($productos, $nuevoPrecio, $precioSalida, $idEntrada, $cantidades, $importes,$fecha ){
		for ($i=0; $i < count($productos); $i++) { 
				$data = array(
					'id_entrada' => $idEntrada,
					'precio' => $nuevoPrecio[$i],
					'id_producto' => $productos[$i],
					'cantidad' => $cantidades[$i],
					'subtotal' => $importes[$i],
				);
	//kardex
				$saldo = $this->Kardex_model->get($productos[$i]) ;
				
				$kardex = array(
					'fecha' =>$fecha , 
					'id_movimiento' => 1,
					'descripcion'=> 'Compra de producto.',
					'id_producto' => $productos[$i],
					'cantidad' =>$cantidades[$i],
					'precio' =>$nuevoPrecio[$i],
					'total' =>$importes[$i],
					'saldo' => $saldo->saldo + $importes[$i],
					'id_entrada' => $idEntrada,
					'id_usuario' => $this->session->userdata('id'),					
				);
				$this->Kardex_model->add($kardex);
				$this->Entradas_model->save_detalle($data);
				$this->updateProducto($productos[$i], $nuevoPrecio[$i],$precioSalida[$i], $cantidades[$i], $fecha); //actualizamos el stock del producto
			
		}
	}

	protected function updateProducto($idProducto, $nuevoPecio,$precioSalida, $cantidad ,$fecha){
		$productoActual = $this->Productos_model->get($idProducto);
		$data_in = array(
			'precio_compra' => $nuevoPecio,
			'precio_venta' => $precioSalida,
		);
		$this->Entradas_model->updatep($idProducto,$data_in);
		$stock = $this->Productos_model->getStock($productoActual->id_stock);
		$data2 = array(
			'stock_actual' => $stock->stock_actual + $cantidad,
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

	public function edit_get(){
        $id = $this->input->post('id-entrada-edit');
        $entrada = $this->Entradas_model->get($id);
		$detalle = $this->Entradas_model->getDetalle($entrada->id_entrada);
		$proveedor = $this->Proveedores_model->get($entrada->id_proveedor);
		$productos = $this->Entradas_model->get_productosDetalle($entrada->id_entrada);
        $data = array(
            'entrada' => $entrada, 
			'detalles' => $detalle,
			'proveedor' => $proveedor,
			'productos' => $productos,
            
		);
		
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/entradas/edit",$data);
        $this->load->view("layouts/footer");
	}
	
	public function eliminar(){
		$id = $this->input->post('id-entrada-delete');
		$detalle = $this->Entradas_model->getDetalle($id);
		$data = array(
			'estado' =>0,
		);
		$this->Entradas_model->updateEntrada($id, $data);
		//eliminas la venta en kardex
		$entradas = $this->Kardex_model->get_compra($id);
		foreach($entradas as $entr){

			$kardex = array(
				'fecha' =>date('Y-m-d'),
				'id_movimiento' => 3,
				'descripcion'=> 'Compra anulada.',
				'id_producto' => $entr->id_producto,
				'cantidad' =>$entr->cantidad,
				'precio' =>$entr->precio,
				'total' =>$entr->total,
				'saldo' => $entr->saldo - $entr->total,
				'id_entrada' => $id,
				'id_usuario' => $this->session->userdata('id'),					
			);
			$this->Kardex_model->add($kardex);
		}
		

		foreach( $detalle as $det ):
			$productoActual = $this->Productos_model->get($det->id_producto);
			$stock = $this->Productos_model->getStock($productoActual->id_stock);
			$nuevoValor = $stock->stock_actual - $det->cantidad;
			print_r($nuevoValor);
			$data2 = array(
				'stock_actual' => $nuevoValor,
			);
			$this->Productos_model->updateStock($productoActual->id_stock, $data2);
		endforeach;
		redirect(base_url()."movimientos/entradas"); //redirigiendo a la lista de ventas
	}

	public function view(){
		$id = $this->input->post("id_entr");
		$data = array(
			'entrada' => $this->Entradas_model->getEntrada($id),
			'detalle_entrada' => $this->Entradas_model->getDetalleEntrada($id)
		);
		$this->load->view("admin/entradas/view", $data);
	}
}