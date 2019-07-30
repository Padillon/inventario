<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios_model extends CI_Model {

	public function getUsuarios(){ 
		$this->db->select("u.*, r.nombre as rol");
		$this->db->from("usuarios u");
		$this->db->join("roles r","r.id_rol = u.rol");
		$resultados = $this->db->get();
			return $resultados->result();
	}
	
	public function login($correo, $password){ 
		$this->db->where("correo", $correo); 
		$this->db->where("password", $password);

			$resultados = $this->db->get("usuarios");
			if ($resultados->num_rows() > 0) {
				return $resultados->row();
			}
			else{
				return false; 
			}
		}
		
		public function getRoles(){
			$resultados = $this->db->get('roles');
			return $resultados->result();
		}
	
	public function save($data){
		return $this->db->insert("usuarios",$data);
	}

	
	public function update($id,$data){
		$this->db->where("id_usuario",$id);
		return $this->db->update("usuarios",$data);
	}

}