<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categorias_model extends CI_Model {
	
public function getCategorias(){ 
	$this->db->where("estado",1);
		$resultados = $this->db->get("categoria");
			return $resultados->result();
	}
	
	public function save($data){
		return $this->db->insert("categoria",$data);
	}

	public function update($id,$data){
		$this->db->where("id_categoria",$id);
		return $this->db->update("categoria",$data);
	}

	public function getAjustes(){
		$resultado = $this->db->get("ajustes");
		return $resultado->row();
	}

	public function getUsuario($id){
		$this->db->where("id_usuario",$id);
		$resultado = $this->db->get("usuarios");
		return $resultado->row();
	}

	public function getCategoriasInactivos(){ 
		$this->db->where("estado",0);
		$resultados = $this->db->get("categoria");
		return $resultados->result();
	}
}