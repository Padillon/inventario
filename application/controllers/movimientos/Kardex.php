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
		$this->load->model("Salidas_model");
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
		$id_presentacion = $this->input->post("id_presentacion");
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
		$id_movimiento = explode('*',$this->input->post("id_movimiento"));
		$descripcion = $this->input->post("descripcion");
		$id_productos = $this->input->post("idProductos");
		//$cantidades = $this->input->post("cantidades");
		//$precio =	 $this->input->post("nuevoPrecio");
		$fecha_caducidad = $this->input->post('fechaCaducidad');


		$idCliente = $this->input->post("idCliente");
		$idProveedor = $this->input->post("idProveedor");
		$estados = $this->input->post('estados'); //perecederos
		$lotes = $this->input->post('lotes');

		if ($idCliente == null) {
			$idCliente = 1;
		}

		$precio =$this->input->post("precio");
		$cantidades =$this->input->post("cantidades");
		$importe =$this->input->post("importes");
		$total = $this->input->post("total");
		$idusuario = $this->session->userdata('id');
		$infoPresentacion =  $this->input->post('tipo_presentacion');
		$codigos = $this->input->post('codigos');

        $this->db->trans_start(); // ******************************************************** iniciamos transaccion **************************************
		if ($id_movimiento[1] == 1) {
			for ($i=0; $i < count($id_productos); $i++) { 
				$infoPre = explode('*',$infoPresentacion[$i]);
					if ($fecha_caducidad[$i]!=0) {
						$lote = array(
							'id_entrada' => $idEntrada,
							'id_producto' => $productos[$i],
							'cantidad' => $cantidades[$i]*$infoPre[3],
							'fecha_entrada' => $fecha,
							'fecha_caducidad' => $fecha_caducidad[$i] 
						);
						$this->Entradas_model->save_lote($lote);
					}		
		//kardex	
					$kardex = array(
						'fecha' =>$fecha , 
						'id_movimiento' => $id_movimiento[0],
						'descripcion'=> $descripcion,
						'id_producto' => $id_productos[$i],
						'cantidad' =>$cantidades[$i],
						'precio' =>$precio[$i],
						'total' =>$importe[$i],
						'id_usuario' =>$idusuario,
						'id_presentacion_producto' => $infoPre[0],				
					);
					$this->Kardex_model->add($kardex);
					$this->updateProductoEntrada($id_productos[$i],$precio[$i], $cantidades[$i], $fecha,$infoPre[3]); //actualizamos el stock del producto
				
			}
		}else{
			for ($i=0; $i < count($id_productos); $i++) { 
				$infoPre = explode('*',$infoPresentacion[$i]);
				$id_lote=0; //variable que contendera el id del estado si es necesario
				if ($estados[$i] == 1) {
						$loteActual = $this->Salidas_model->getLote($lotes[$i]);
						if ($loteActual->cantidad == ($cantidades[$i]*$infoPre[3])) {
							$data2 = array(
								'estado' => 0,
								'cantidad' => 0,
							);							
						}else{
							$data2 = array(
								'cantidad' => $loteActual->cantidad - ($cantidades[$i]*$infoPre[3]),
							);
						}
						$this->Salidas_model->updateLote($lotes[$i], $data2);
					}
				$kardex = array(
					'fecha' =>$fecha , 
					'id_movimiento' => $id_movimiento[0],
					'descripcion'=> $descripcion,
					'id_producto' => $id_productos[$i],
					'cantidad' =>$cantidades[$i],
					'precio' =>$precio[$i],
					'total' =>$importe[$i],
					'id_presentacion_producto' => $infoPre[0],
					'id_usuario' => $this->session->userdata('id'),					
				);
				$this->Kardex_model->add($kardex);
				$this->updateProductoSalida($id_productos[$i], $cantidades[$i],$infoPre[3]); //actualizamos el stock del producto
			}
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

	}

	public function getProductoKardex(){
		$valor = $this->input->get("prod");
		$inicio = $this->input->get('fecha1');
		$final = $this->input->get("fecha2");
		$pres = $this->input->get("pres");
		$idusuario = $this->session->userdata('id');
        //trayendo informacion
        $data = array(
            'fecha' => date("d-m-Y"),
            'empresa' => $this->Kardex_model->getAjustes(),
            'nomUsuario' => $this->Kardex_model->getUsuario($idusuario),
			'kardex' => $this->Kardex_model->getProductoKardex($valor, $inicio, $final, $pres),
            'producto' => $this->Kardex_model->getProducto($valor,$pres),
		);

		//generando pdf
		$this->load->view("admin/reportes/kardex", $data);
	}


	protected function updateProductoEntrada($idProducto,$precioSalida, $cantidad ,$fecha,$ValorCantidades){
		$productoActual = $this->Productos_model->get2($idProducto);
		$stock = $this->Productos_model->getStock($productoActual->id_stock);
		$cantidad = $cantidad * $ValorCantidades;// valor cantidades representa la cantidad numerica por presentación
		$data2 = array(
			'stock_actual' => $stock->stock_actual + $cantidad,
		);
		$this->Productos_model->updateStock($productoActual->id_stock, $data2);
	}

	protected function updateProductoSalida($idProducto,$cantidad,$infoPre){
		$productoActual = $this->Productos_model->get2($idProducto);
		$stock = $this->Productos_model->getStock($productoActual->id_stock);
		$cantidad = $cantidad * $infoPre;// valor cantidades representa la cantidad numerica por presentación
		$data2 = array(
			'stock_actual' => $stock->stock_actual - $cantidad,
		);
		$this->Productos_model->updateStock($productoActual->id_stock, $data2);
	}

	public function addConversion(){
		$fecha = $this->input->post('fechaT');
		$origen =  explode('*',$this->input->post('autcocomplete_origenValue'));
		$destino =  explode('*',$this->input->post('autocomplete_destinoValue'));
		$cant_origen = $this->input->post('can_origen');
		$cant_destino = $this->input->post('can_destino');
		$can_convert = $this->input->post('cant_convert');
		$canTotalOrigen = ($cant_origen) * ($can_convert) * ($origen[12]);
		$canTotalDestino = ($cant_destino) * ($destino[12]);

		$dataOrigen = array(
			'id_movimiento' =>9,
			'fecha' => $fecha,
			'descripcion' =>'Transformación de '.$origen[1].' a '.$destino[1],
			'id_producto' =>$origen[4],
			'cantidad' =>$can_convert * $cant_origen,
			'id_presentacion_producto' =>$origen[10],
			'id_usuario' => $this->session->userdata('id'),
		);
		
		$dataDestino = array(
			'id_movimiento' =>9,
			'fecha' => $fecha,
			'descripcion' =>'Transformación de '.$origen[1].' a '.$destino[1],
			'id_producto' => $destino[4],
			'cantidad' =>$cant_destino *$can_convert,
			'id_presentacion_producto' =>$destino[10],
			'id_usuario' => $this->session->userdata('id'),
		);

	
        $this->db->trans_start(); // ******************************************************** iniciamos transaccion **************************************

		$this->Kardex_model->add($dataOrigen);
		$this->Kardex_model->add($dataDestino);
		/// actualizamos el stock del producto origen
		if ($destino[7] == 1) {
			$loteActual = $this->Salidas_model->getLote($origen[9]);
			if ($loteActual->cantidad == $canTotalOrigen) {
				$data2 = array(
					'estado' => 0,
					'cantidad' => 0,
				);							
			}else{
				$data2 = array(
					'cantidad' => $loteActual->cantidad - $canTotalOrigen,
				);
			}
			$this->Salidas_model->updateLote($data[9], $data2);
		}
		/// actualizamos el stock del producto destino
		if ($origen[7] == 1) {
			$loteActual = $this->Salidas_model->getLote($destino[9]);
			if ($loteActual->cantidad == $canTotalDestino) {
				$data2 = array(
					'estado' => 0,
					'cantidad' => 0,
				);							
			}else{
				$data2 = array(
					'cantidad' => $loteActual->cantidad + $canTotalDestino,
				);
			}
			$this->Salidas_model->updateLote($lotes[$i], $data2);
		}

		//actualizamos el stock del producto origen

		$stock = $this->Productos_model->getStock($origen[13]);
		$cantidad = $canTotalOrigen;// valor cantidades representa la cantidad numerica por presentación
		$data2 = array(
			'stock_actual' => $stock->stock_actual - $cantidad,
		//	'stock_actual' => 100,

		);
		$this->Productos_model->updateStock($origen[13], $data2);
		//actualizamos el stock del producto destino

		$stock = $this->Productos_model->getStock($destino[13]);
		$cantidad = $canTotalDestino;// valor cantidades representa la cantidad numerica por presentación
		$data2 = array(
			'stock_actual' => $stock->stock_actual + $cantidad,
		//	'stock_actual' => 200,

		);
		$this->Productos_model->updateStock($destino[13], $data2);
		

        $this->db ->trans_complete();// ******************************************************** icompletamos transaccion **************************************
		$this->db ->trans_complete();// ******************************************************** icompletamos transaccion **************************************
		if($this->db->trans_status()){ // ******************************************************** iniciamos transaccion **************************************
            $this->toastr->success('Registro guardado!');
			redirect(base_url()."movimientos/kardex"); //redirigiendo a la lista de ventas      
        }
        else{
            $this->toastr->error('No se pudo completar la operación.');
		redirect(base_url()."movimientos/kardex"); //redirigiendo a la lista de ventas
          
        }

	}
}
