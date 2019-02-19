<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Presentacion_model extends CI_Model {
	
    public function getPresentaciones(){ 
		$resultados = $this->db->get("presentacion");
			return $resultados->result();
	}
	
	public function save($data){
		return $this->db->insert("proveedores",$data);
	}

	public function update($id,$data){
		$this->db->where("id_proveedor",$id);
		return $this->db->update("proveedores",$data);
	}
}