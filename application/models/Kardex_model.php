<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kardex_model extends CI_Model {
    public function add($data){
		$this->db->insert("kardex",$data);
		
	}

	public function get($id){
		$quey = "select  top 1 saldo from kardex where id_producti = ".$id." order by id_kardex desc;";
	//	$this->db->where("id_producto",$id);
		$resultado = $this->db->query($quey);
		return $resultado->row();
	}
}