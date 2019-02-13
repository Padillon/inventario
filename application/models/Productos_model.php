<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Productos_model extends CI_Model {
	
public function getProductos(){ 
		$resultados = $this->db->get("productos");
			return $resultados->result();
	}
	
	public function add($data){
		$this->db->insert("productos",$data);
		return $insert_id = $this->db->insert_id();
	}

	public function get($id){
		$this->db->where("id_producto",$id);
		$resultado = $this->db->get("productos");
		return $resultado->row();
	}

	public function update($id,$data){
		$this->db->where("id_producto",$id);		
		return $this->db->update("productos",$data);
	}
}