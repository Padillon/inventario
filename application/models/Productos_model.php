<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Productos_model extends CI_Model {
	
public function getProductos(){ 
		$resultados = $this->db->get("productos");
			return $resultados->result();
	}
	
	public function save($data){
		return $this->db->insert("categoria",$data);
	}

	public function update($id,$data){
		$this->db->where("id_categoria",$id);
		return $this->db->update("categoria",$data);
	}
}