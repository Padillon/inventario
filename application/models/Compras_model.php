<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Compras_model extends CI_Model {
	
    public function getCompras(){ 
		$resultados = $this->db->get("compras");
			return $resultados->result();
    }

    public function getProveedores($valor){
      $this->db->select("id_proveedor, empresa as label");
      $this->db->from("proveedores");
      $this->db->like("empresa", $valor);
      $resultados = $this->db->get();
      return $resultados->result_array();
    }
}