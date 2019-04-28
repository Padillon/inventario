<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entradas extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Entradas_model");
		$this->load->model("Productos_model");
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
		$idusuario = 1;

		$data = array(
			'fecha' => $fecha,
			'total' => $total,
			'id_usuario' => $idusuario,
			'id_tipo_entrada' =>1 ,
			'id_proveedor' => $idProveedor,
		);
		//operación para el saldo 
		/*$dat2= array(
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
		}*/
		//datos de cajas guardados-----

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
        $data = array(
            'entrada' => $entrada, 
            'detalle' => $detalle,
            
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/entradas/edit",$data);
        $this->load->view("layouts/footer");
    }

}