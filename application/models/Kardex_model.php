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

	public function get($id){
		$quey = "select saldo from kardex where id_producto = ".$id." order by id_kardex desc limit 1";
	//	$this->db->where("id_producto",$id);
		if($resultado = $this->db->query($quey)){
			return $resultado->row();
		}else{
			return 0;
		}
	}
}