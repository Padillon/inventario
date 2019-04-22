<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Entradas_model extends CI_Model {
	
    public function getEntradas(){ 
		$resultados = $this->db->get("entradas");
			return $resultados->result();
    }

    public function getProveedores($valor){
      $this->db->select("id_proveedor, empresa as label");
      $this->db->from("proveedores");
      $this->db->like("empresa", $valor);
      $resultados = $this->db->get();
      return $resultados->result_array();
    }

    public function getProductos($valor){
    $this->db->select("p.*,c.nombre as id_categoria, pre.nombre as id_presentacion");
      $this->db->from("productos p");
      $this->db->join("categoria c","p.id_categoria = c.id_categoria");
      //$this->db->join("marcas m","p.id_marca = m.id_marca");
      $this->db->join("presentacion pre","p.id_presentacion = pre.id_presentacion");
     // $this->db->join("proveedores pr","p.id_proveedor = pr.id_proveedor");
      $this->db->where("p.estado","1");
      $this->db->like("p.nombre", $valor);
      //$this->db->from("productos");
     // $this->db->like("nombre", $valor);
      $resultados = $this->db->get();
      return $resultados->result_array();
    }
}