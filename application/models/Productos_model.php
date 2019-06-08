<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Productos_model extends CI_Model {

	public function add($data){
		$this->db->insert("productos",$data);
		return $insert_id = $this->db->insert_id();
	}
	public function addStok($minimo){
		$this->db->insert("stock",$minimo);
		return $insert_id = $this->db->insert_id();
	}
	public function getStock($id){
		$this->db->where("id_stock",$id);
		$resultado = $this->db->get("stock");
		return $resultado->row();
	}
	public function get($id){
		$this->db->where("id_producto",$id);
		$resultado = $this->db->get("productos");
		return $resultado->row();
	}

	public function update($id,$data){
		$this->db->where("id_producto",$id);		
		return $this->db->update("productos",$data);
	}
	public function updateStock($id,$data){
		$this->db->where("id_stock",$id);		
		return $this->db->update("stock",$data);
	}

	public function getProductos(){
		$this->db->select("p.*, m.nombre as marca, c.nombre as categoria, s.stock_minimo as stock_minimo, s.stock_actual as stock_actual, pre.nombre as presentacion");
		$this->db->from("productos p");
		$this->db->join("marcas m", "p.id_marca = m.id_marca");
		$this->db->join("categoria c", "p.id_categoria = c.id_categoria");
		$this->db->join("stock s", "p.id_stock = s.id_stock");
		$this->db->join("presentacion pre", "p.id_presentacion = pre.id_presentacion");
		$this->db->where("p.estado",1);
		$resultados = $this->db->get();
		return $resultados->result();
	}
}