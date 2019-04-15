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

    public function getProductos(){
      $this->db->select("p.*,c.nombre as categoria_id,pr.nombre as id_proveedor,m.nombre as id_marca, pre.nombre as id_presentacion");
      $this->db->from("productos p");
      $this->db->join("categorias c","p.categoria_id = c.id");
      $this->db->join("marca m","p.id_marca = m.id_marca");
      $this->db->join("tipo_presentacion pre","p.id_presentacion = pre.id");
      $this->db->join("proveedor pr","p.id_proveedor = pr.id_proveedor");
      $this->db->where("p.estado","1");
      $resultados = $this->db->get();
      return $resultados->result();
    }
}