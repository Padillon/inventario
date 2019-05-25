<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Proveedores_model extends CI_Model {
	
    public function getProveedores(){ 
		$this->db->where("estado",1);
		$resultados = $this->db->get("proveedores");
			return $resultados->result();
	}
	
	public function save($data){
		return $this->db->insert("proveedores",$data);
	}

	public function update($id,$data){
		$this->db->where("id_proveedor",$id);
		return $this->db->update("proveedores",$data);
	}

	public function get($id){
		$this->db->where("id_proveedor",$id);
		$resultado = $this->db->get("proveedores");
		return $resultado->row();
	}
}