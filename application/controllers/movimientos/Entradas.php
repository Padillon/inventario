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
        $this->load->library('toastr');

		$this->load->library("Pdf");
	}
	}

	public function index(){
        $fecha = date("Y-m-d");
        $data = array(
			'permisos' => $this->permisos,
			'entradas' => $this->Entradas_model->getEntradasDia($fecha),
			'proveedores' => $this->Entradas_model->getProveedoresTodos(),
        );
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/entradas/list",$data);
        $this->load->view("layouts/footer");
	}
    
    public function buscar(){
        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/entradas/buscar");
        $this->load->view("layouts/footer");
    }

    public function getResultados(){
        $fecha1 = $this->input->post("fecha_inicio");
        $fecha2 = $this->input->post("fecha_fin");
        $data = array(
            'entradas' => $this->Entradas_model->getEntradasFechas($fecha1, $fecha2),
            'fecha1' => $fecha1,
            'fecha2' => $fecha2,
        );

        $this->load->view("layouts/header");
        $this->load->view('layouts/aside');
        $this->load->view("admin/entradas/buscar", $data);
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
		$fecha_caducidad = $this->input->post('fechaCaducidad');
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
        $this->db->trans_start(); // ******************************************************** iniciamos transaccion **************************************
		
			$this->Entradas_model->save($data);
			$idEntrada = $this->Entradas_model->lastID(); 
			$this->save_detalle($idproductos, $nuevoPrecio, $precioSalida, $idEntrada, $cantidades, $importe, $fecha,$fecha_caducidad); //guardando el detalle de la venta
		
		$this->db ->trans_complete();// ******************************************************** completamos transaccion **************************************
			
		if($this->db->trans_status()){ // ******************************************************** Evaluamos estado **************************************
			$this->toastr->success('Registro guardado!');
            redirect(base_url()."movimientos/entradas"); //redirigiendo a la lista de ventas
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
			redirect(base_url()."movimientos/entradas/add");
        }
		
	}

	//funcion para guardar el detalle de la venta
	protected function save_detalle($productos, $nuevoPrecio, $precioSalida, $idEntrada, $cantidades, $importes,$fecha,$fecha_caducidad ){
		for ($i=0; $i < count($productos); $i++) { 
				$data = array(
					'id_entrada' => $idEntrada,
					'precio' => $nuevoPrecio[$i],
					'id_producto' => $productos[$i],
					'cantidad' => $cantidades[$i],
					'subtotal' => $importes[$i],
				);
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
        $this->db->trans_start(); // ******************************************************** iniciamos transaccion **************************************

		$this->Entradas_model->updateEntrada($id, $data);//eliminas la venta en kardex
		$this->Entradas_model->updateLote($id, $data);//eliminamos del lote si es necesario
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
        $this->db ->trans_complete();// ******************************************************** completamos transaccion **************************************

		if($this->db->trans_status()){ // ******************************************************** Evaluamos estado **************************************
            $this->toastr->success('Registro eliminado!');
			redirect(base_url()."movimientos/entradas"); //redirigiendo a la lista de ventas
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
            redirect(base_url()."movimientos/entradas"); //redirigiendo a la lista de ventas
        }
	
	}

	public function view(){
		$id = $this->input->post("id_entr");
		$data = array(
			'entrada' => $this->Entradas_model->getEntrada($id),
			'detalle_entrada' => $this->Entradas_model->getDetalleEntrada($id)
		);
		$this->load->view("admin/entradas/view", $data);
	}

    public function getReporteInactivos(){
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Entradas_model->getAjustes(),
            'nomUsuario' => $this->Entradas_model->getUsuario($idusuario),
            'entradas' => $this->Entradas_model->getEntradasInactivos(),
            'estado' => "Inactivos"
        );
        //generando el pdf
        $this->load->view("admin/reportes/entradas", $data);
    }

    public function getReporteFecha(){
        $fecha1 = $this->input->get("fecha1");
        $fecha2 = $this->input->get("fecha2");
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Entradas_model->getAjustes(),
            'nomUsuario' => $this->Entradas_model->getUsuario($idusuario),
			'entradas' => $this->Entradas_model->getEntradasFechas($fecha1, $fecha2),
			'totalCompras' => $this->Entradas_model->totalEntradasFechas($fecha1, $fecha2),
            'estado' => "Por Fechas"
		);
        //generando el pdf
        $this->load->view("admin/reportes/entradasTotal", $data);
	}
	
	public function getReporteProveedor(){
        $fecha1 = $this->input->get("fecha1");
		$fecha2 = $this->input->get("fecha2");
		$prov = $this->input->get("prov");
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Entradas_model->getAjustes(),
            'nomUsuario' => $this->Entradas_model->getUsuario($idusuario),
			'entradas' => $this->Entradas_model->getEntradasProveedor($fecha1, $fecha2, $prov),
            'estado' => "Por Proveedor"
		);
        //generando el pdf
        $this->load->view("admin/reportes/entradas", $data);
	}
	
	public function getResumen(){
        $fecha1 = $this->input->get("fecha1");
        $fecha2 = $this->input->get("fecha2");
        $idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Entradas_model->getAjustes(),
            'nomUsuario' => $this->Entradas_model->getUsuario($idusuario),
			'entradas' => $this->Entradas_model->getResumenDiario($fecha1, $fecha2),
			'totalCompras' => $this->Entradas_model->totalEntradasFechas($fecha1, $fecha2),
            'estado' => "Resumen Diario"
		);
        //generando el pdf
        $this->load->view("admin/reportes/entradasResumen", $data);
	}
	public function error(){

		$this->toastr->success('blablaba!');  
	}
}