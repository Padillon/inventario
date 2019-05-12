<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Permisos_model extends CI_Model {
	
    public function getPermisos(){ 
			$this->db->select("p.*, m.nombre as menu, r.nombre as rol");
			$this->db->from ("permisos p");
			$this->db->join("roles r","r.id_rol = p.rol_id");
			$this->db->join("menu m","m.id_menu = p.menu_id");
			$resultados = $this->db->get();
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
	public function insertar($data,$id)
	{
		$this->db->where("id_permiso",$id);
		return $this->db->update("permisos",$data);
	}
}