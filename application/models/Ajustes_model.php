<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajustes_model extends CI_Model {
	public function getAjustes(){
		$this->db->where("id",1);
		$resultado = $this->db->get("ajustes");
		return $resultado->row();
	}

	public function getUsuario(){ 
		$resultados = $this->db->get("usuarios");
			return $resultados->result();
	}

	public function updateUsu($id,$datos){
		$this->db->where("id_usuario",$id);
		return $this->db->update("usuarios",$datos);
	}
	public function updateAjus($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("ajustes",$data);
	}

}
