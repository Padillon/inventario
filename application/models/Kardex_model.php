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

public function getKardexProducto($id,$inicio,$fin){
	//$query="select * from kardex where between '".$inicio."' and '".$fin."' and id_producto =".$id;
	$this->db->select("k.*,u.usuario as usuario, t.nombre as movimiento,p.nombre as producto");
				$this->db->from("kardex k");
				$this->db->join("usuarios u", "k.id_usuario = u.id_usuario");
				$this->db->join("productos p" , "p.id_producto = k.id_producto");
				$this->db->join("tipo_movimiento t", "k.id_movimiento = t.id_movimiento");
//	$this->db->where("k.fecha between '".$inicio."' and '".$fin."' and id_producto =".$id);
	$start_date=$inicio;
	$end_date=$fin;
	
	$this->db->where('k.fecha BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
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

	public function getKardex(){
		//$quey = "select * from kardex where month(fecha) = ".date('m');
			//	if($resultado = $this->db->query($quey)){
				$this->db->select("k.*,u.usuario as usuario, t.nombre as movimiento");
				$this->db->from("kardex k");
				$this->db->join("usuarios u", "k.id_usuario = u.id_usuario");
				$this->db->join("productos p" , "p.id_producto = k.id_producto");
				$this->db->join("tipo_movimiento t", "k.id_movimiento = t.id_movimiento");
				$this->db->where('month(k.fecha)',date('m'));
				$this->db->group_by(array("id_entrada", "id_salida"));  
				$this ->db->order_by( 'id_kardex' , 'asc' );
		if($resultado = $this->db->get()){
			return $resultado->result();
		}else{
			return 0;
		}
	}

	public function getProductos($valor){
    $this->db->select("p.*,m.nombre as id_marca, pre.nombre as id_presentacion,s.stock_actual as existencias");
      $this->db->from("productos p");
      $this->db->join("marcas m","p.id_marca = m.id_marca");
      $this->db->join("presentacion pre","p.id_presentacion = pre.id_presentacion");
      $this->db->join("stock s","p.id_stock = s.id_stock");
      $this->db->where("p.estado","1");
      $this->db->like("p.nombre", $valor);
      $this->db->or_like("p.codigo", $valor);
      $resultados = $this->db->get();
      return $resultados->result_array();
    }

	public function  getTipoMovimiento(){
		$resultados = $this->db->get("tipo_movimiento");
		return $resultados->result();
	}

	public function save($data){
      return $this->db->insert("kardex", $data);
	}

	public function getTipoTransaccion($id){
		$this->db->select("tipo_transaccion");
		$this->db->where("id_movimiento",$id);
		$resultado = $this->db->get("tipo_movimiento");
		return $resultado->row();
	}

	public function getProductoKardex($id,$inicio,$final){
		$this->db->select("k.*,u.usuario as usuario, t.nombre as movimiento");
		$this->db->from("kardex k");
		$this->db->join("usuarios u", "k.id_usuario = u.id_usuario");
		$this->db->join("productos p" , "p.id_producto = k.id_producto");
		$this->db->join("tipo_movimiento t", "k.id_movimiento = t.id_movimiento");
		$this->db->where("k.id_producto",$id);
		$this->db->where(" fecha >='".$inicio."' AND fecha <='".$final."'");
		$this ->db->order_by( 'k.id_kardex' , 'desc' );

		/*$this->db->where('month(k.fecha)',date('m'));
		$this->db->group_by(array("id_entrada", "id_salida"));  
		$this ->db->order_by( 'id_kardex' , 'asc' );*/
if($resultado = $this->db->get()){
	return $resultado->result();
}else{
	return 0;
}
	}

}