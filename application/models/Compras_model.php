<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Compras_model extends CI_Model {
	
    public function getCompras(){ 
		$resultados = $this->db->get("compras");
			return $resultados->result();
    }
}