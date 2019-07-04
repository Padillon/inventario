<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Registros_model extends CI_Model {
    
    public function getConsultaProveedor(){
        $this->db->from("proveedores");
        $this->db->where("estado", 1);
        $resultado = $this->db->get();
        return $resultado->result();
    }

    public function getConsultaCliente(){
        $this->db->from("clientes");
        $this->db->where("estado", 1);
        $resultado = $this->db->get();
        return $resultado->result();
    }
}