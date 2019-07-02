<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Registros_model extends CI_Model {
    
    public function getConsulta($valor, $slSeleccionar){
        if ($slSeleccionar == 1){
            $this->db->select("*");
            $this->db->from("proveedores");
            $this->db->where("estado = 1");

        } elseif ($slSeleccionar == 2){
            $this->db->select("*");
            $this->db->from("clientes");
            if($valor == ""){
                $this->db->where("estado = 1");
            } else {
                $this->db->where("estado = 1");
                $this->db->like("direccion", $valor);
            }

        } else{
            echo "error";
        }

        $resultado = $this->db->get();
        return $resultado->result();
    }
}