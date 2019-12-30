<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kardex_model extends CI_Model {
    public function add($data){
		$this->db->insert("kardex",$data);
		
	}
 
	public function get_compra($id){
		$this->db->where('id_entrada',$id);
		$resultado = $this->db->get('kardex');
		return $resultado->result();
	}

	public function get_venta($id){
		$this->db->where('id_salida',$id);
		$resultado = $this->db->get('kardex');
		return $resultado->result();
	}

public function update($data,$id){
	$this->db->where('id_entrada',$id);
	$this->db->update('kardex',$data);
	return 0;
}

public function getKardexBuscar($id,$inicio,$fin){
	//$this->db->select("date_format(k.fecha, '%d-%m-%Y') as fecha, k.descripcion, k.cantidad, u.usuario, t.tipo_transaccion, if(t.tipo_transaccion = 1, 'Entrada', 'Salida') as movimiento, pre.codigo, p.nombre");
	$this->db->select("date_format(k.fecha, '%d-%m-%Y') as fecha, k.descripcion, k.cantidad, u.usuario, t.tipo_transaccion, t.nombre as movimiento, pre.codigo, p.nombre");
	
	$this->db->from("kardex k");
	$this->db->join("productos p" , "p.id_producto = k.id_producto");
	$this->db->join("stock s" , "p.id_stock = s.id_stock");
	$this->db->join("tipo_movimiento t", "k.id_movimiento = t.id_movimiento");
	$this->db->join("usuarios u" , "u.id_usuario = k.id_usuario");
	$this->db->join("presentaciones_producto pre", "k.id_presentacion_producto = pre.id_presentacion_producto");
	$this->db->where("k.id_producto",$id);
	$this->db->where("k.fecha >='".$inicio."' AND k.fecha <='".$fin."'");
	//$this->db->where("pre.id_presentacion_producto",$id_presentacion);
	$this ->db->order_by( 'k.id_kardex' , 'asc' );
	$resultados = $this->db->get();
	return $resultados->result();
}

	public function get($id){
		$quey = "select saldo from kardex where id_producto = ".$id." order by id_kardex desc limit 1";
	//	$this->db->where("id_producto",$id);
		if($resultado = $this->db->query($quey)){
			return $resultado->row();
		}else{
			return 0;
		}
	}

	public function getKardexDia($fecha){
		$this->db->select("k.*, t.nombre as movimiento, p.nombre, u.usuario, s.stock_actual,p.perecedero as perecedero");
		$this->db->from("kardex k");
		$this->db->join("productos p" , "p.id_producto = k.id_producto");
		//$this->db->join("presentaciones_producto pre", "p.id_producto = pre.id_producto");
		$this->db->join("stock s" , "p.id_stock = s.id_stock");
        $this->db->join("tipo_movimiento t", "k.id_movimiento = t.id_movimiento");
        $this->db->join("usuarios u" , "u.id_usuario = k.id_usuario");
		$this->db->where("k.fecha", $fecha); 
		$this ->db->order_by( 'k.fecha' , 'desc' );
		if($resultado = $this->db->get()){
			return $resultado->result();
		}else{
			return 0;
		}
	}

	public function getProductos($valor){
		$this->db->select("p.*,m.nombre as marca,pr.id_presentacion_producto as id_presentacion_producto, pr.precio_venta as precio_venta,pre.nombre as id_presentacion,pr.codigo as codigo,s.stock_actual as existencias,lt.fecha_caducidad caducidad,lt.cantidad cantidad,lt.id_lote lote, lt.cantidad as lt_cantidad");
        $this->db->from("productos p");
        $this->db->join("marcas m","p.id_marca = m.id_marca");
        $this->db->join("presentaciones_producto pr", "p.id_producto = pr.id_producto");
        $this->db->join("presentacion pre","pr.id_presentacion = pre.id_presentacion");
        $this->db->join("stock s","p.id_stock = s.id_stock");
        $this->db->join("lotes lt", "p.id_producto = lt.id_producto", 'left');
        $this->db->where("p.estado","1");
        $this->db->group_start();
          $this->db->where("lt.cantidad > 0");
          $this->db->or_where("lt.cantidad",null);
          $this->db->group_end();
          $this->db->group_start();
          $this->db->where("lt.estado = 1");
          $this->db->or_where("lt.estado ",null);
		  $this->db->group_end();
          $this->db->group_start();

          $this->db->like("p.nombre", $valor);
		  $this->db->or_like("pr.codigo", $valor);
		  $this->db->group_end();
		  
        $resultados = $this->db->get();
        return $resultados->result_array();
	}
	
    public function getProducto($valor,$pre){
    $this->db->select("pr.codigo, p.nombre, p.descripcion, if(p.estado = 0, 'Inactivo', 'Activo') as estado, m.nombre as marca, pre.nombre as presentacion");
	$this->db->from("productos p");
	$this->db->join("marcas m","p.id_marca = m.id_marca");
	$this->db->join("presentaciones_producto pr", "p.id_producto = pr.id_producto");
	$this->db->join("presentacion pre","pr.id_presentacion = pre.id_presentacion");
	  $this->db->where("p.id_producto", $valor);
      $this->db->where("pr.id_presentacion_producto", $pre);
	  
      $resultados = $this->db->get();
      return $resultados->row();
    }

	public function  getTipoMovimiento(){
		$resultados = $this->db->get("tipo_movimiento");
		return $resultados->result();
	}

	public function save($data){
      return $this->db->insert("kardex", $data);
	}

	public function getTipoTransaccion($id){
		$this->db->select("tipo_transaccion as tipo");
		$this->db->where("id_movimiento",$id);
		$resultado = $this->db->get("tipo_movimiento");
		return $resultado->row();
	}

	public function getProductoKardex($id,$inicio,$final,$pre){
		//$this->db->select("date_format(k.fecha, '%d-%m-%Y') as fecha, k.descripcion, k.cantidad, u.usuario, t.tipo_transaccion, if(t.tipo_transaccion = 1, 'Entrada', 'Salida') as movimiento, pre.codigo, p.nombre");
		$this->db->select("date_format(k.fecha, '%d-%m-%Y') as fecha, k.descripcion, k.cantidad, u.usuario, t.tipo_transaccion, t.nombre as movimiento, pre.codigo, p.nombre");
		
		$this->db->from("kardex k");
		$this->db->join("productos p" , "p.id_producto = k.id_producto");
		$this->db->join("stock s" , "p.id_stock = s.id_stock");
		$this->db->join("presentaciones_producto pre", "k.id_presentacion_producto = pre.id_presentacion_producto");
		$this->db->join("tipo_movimiento t", "k.id_movimiento = t.id_movimiento");
		$this->db->join("usuarios u" , "u.id_usuario = k.id_usuario");
		$this->db->where("pre.id_presentacion_producto",$pre);
		$this->db->where("k.id_producto",$id);
		$this->db->where("k.fecha >='".$inicio."' AND k.fecha <='".$final."'");
		$this ->db->order_by( 'k.id_kardex' , 'asc' );
		if($resultado = $this->db->get()){
			return $resultado->result();
		}else{
			return 0;
		}
	}

	public function getAjustes(){
    $resultado = $this->db->get("ajustes");
    return $resultado->row();
  }

  public function getUsuario($id){
  	$this->db->select("usuario");
    $this->db->where("id_usuario",$id);
    $resultado = $this->db->get("usuarios");
    return $resultado->row();
  }

}