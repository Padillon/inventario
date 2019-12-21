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
	public function get($id,$presen){
		$this->db->select("p.*, pre.valor as valor");
		$this->db->from("productos p");
		$this->db->join("presentaciones_producto pre", "p.id_producto = pre.id_producto");
		$this->db->where("p.id_producto",$id);
		$this->db->where("pre.id_presentacion_producto",$presen);
		$resultado = $this->db->get();
		return $resultado->row();
	}
	public function get2($id){
		$this->db->select("p.*");
		$this->db->from("productos p");
		$this->db->where("p.id_producto",$id);
		$resultado = $this->db->get();
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
	public function getPresentacion_productos($id){
		$this->db->select("pre.*, p.nombre as nombre, s.stock_minimo as minimo");
		$this->db->from("presentaciones_producto pre");
		$this->db->join("presentacion p", "p.id_presentacion = pre.id_presentacion");
		$this->db->join("productos pro", "pro.id_producto = pre.id_producto");
		$this->db->join("stock s", "s.id_stock = pro.id_stock");
		$this->db->where("pre.estado",1);
		$this->db->where("pre.id_producto",$id);
		$resultado = $this->db->get();
		return $resultado->result();
	}
	public function updatePresentacio_producto($id,$data){
		$this->db->where("id_presentacion_producto",$id);		
		return $this->db->update("presentaciones_producto",$data);
	}
	public function getProductos(){
		//$this->db->select("p.*, m.nombre as marca, c.nombre as categoria, s.stock_minimo as stock_minimo, s.stock_actual as stock_actual, pre.nombre as presentacion, pre.equi_unidad as equivalencia");
		$this->db->select("p.*, m.nombre as marca, c.nombre as categoria,s.id_stock as id_stock, s.stock_minimo as stock_minimo, s.stock_actual as stock_actual ,pre.valor as valor,pre.codigo as codigo, pr.nombre as presentacion, pre.precio_compra as compra,pre.precio_venta as venta");
		$this->db->from("productos p");
		$this->db->join("marcas m", "p.id_marca = m.id_marca");
		$this->db->join("categoria c", "p.id_categoria = c.id_categoria");
		$this->db->join("stock s", "p.id_stock = s.id_stock");
		$this->db->join("presentaciones_producto pre", "p.id_producto = pre.id_producto");
		$this->db->join("presentacion pr", "pr.id_presentacion = pre.id_presentacion");
		$this->db->where("p.estado",1);
		$this->db->where("pre.equivalencia",1);
		$this->db->order_by("categoria");
		$resultados = $this->db->get();
		return $resultados->result();
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
	public function getSerie($marca,$categoria){
		$select = "select count(*) as cuenta from productos where id_categoria = $categoria and id_marca = $marca";

		$resultado = $this->db->query($select);
		return $resultado->result();
	}
	public function getProductosInactivos(){
		$this->db->select("p.*, m.nombre as marca, c.nombre as categoria, s.stock_minimo as stock_minimo, s.stock_actual as stock_actual, pre.valor as valor,pre.codigo as codigo, pr.nombre as presentacion");
		$this->db->from("productos p");
		$this->db->join("marcas m", "p.id_marca = m.id_marca");
		$this->db->join("categoria c", "p.id_categoria = c.id_categoria");
		$this->db->join("stock s", "p.id_stock = s.id_stock");
        $this->db->join("presentaciones_producto pre", "p.id_producto = pre.id_producto");
        $this->db->join("presentacion pr", "pr.id_presentacion = pre.id_presentacion");
		$this->db->where("p.estado",0);
		$this->db->order_by("categoria");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getProductosMarca($valor){
		$this->db->select("p.*, m.nombre as marca, c.nombre as categoria, s.stock_minimo as stock_minimo, s.stock_actual as stock_actual, pre.valor as valor,pre.codigo as codigo, pr.nombre as presentacion");
		$this->db->from("productos p");
		$this->db->join("marcas m", "p.id_marca = m.id_marca");
		$this->db->join("categoria c", "p.id_categoria = c.id_categoria");
		$this->db->join("stock s", "p.id_stock = s.id_stock");
		$this->db->join("presentaciones_producto pre", "p.id_producto = pre.id_producto");
        $this->db->join("presentacion pr", "pr.id_presentacion = pre.id_presentacion");
		$this->db->where("p.estado",1);
		$this->db->where("m.id_marca",$valor);
		$this->db->order_by("categoria");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getProductosCategoria($valor){
		$this->db->select("p.*, m.nombre as marca, c.nombre as categoria, s.stock_minimo as stock_minimo, s.stock_actual as stock_actual, pre.valor as valor,pre.codigo as codigo, pr.nombre as presentacion");
		$this->db->from("productos p");
		$this->db->join("marcas m", "p.id_marca = m.id_marca");
		$this->db->join("categoria c", "p.id_categoria = c.id_categoria");
		$this->db->join("stock s", "p.id_stock = s.id_stock");
		$this->db->join("presentaciones_producto pre", "p.id_producto = pre.id_producto");
        $this->db->join("presentacion pr", "pr.id_presentacion = pre.id_presentacion");
		$this->db->where("p.estado",1);
		$this->db->where("c.id_categoria",$valor);
		$this->db->order_by("marca");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getProductosCategoriaMarca($valor1, $valor2){
		$this->db->select("p.*, m.nombre as marca, c.nombre as categoria, s.stock_minimo as stock_minimo, s.stock_actual as stock_actual, pre.nombre as presentacion");
		$this->db->from("productos p");
		$this->db->join("marcas m", "p.id_marca = m.id_marca");
		$this->db->join("categoria c", "p.id_categoria = c.id_categoria");
		$this->db->join("stock s", "p.id_stock = s.id_stock");
		$this->db->join("presentacion pre", "p.id_presentacion = pre.id_presentacion");
		$this->db->where("p.estado",1);
		$this->db->where("c.id_categoria",$valor1);
		$this->db->where("m.id_marca",$valor2);
		$this->db->order_by("nombre");
		$resultados = $this->db->get();
		return $resultados->result();
	}
	public function getExistente($nombre){
		$this->db->where("nombre", $nombre);
		$resultados = $this->db->get("productos");
		return $resultados->row();
	  }
	public function getExistenteCod($nombre){
		$this->db->select("pre.codigo as codigo");
		$this->db->from("presentaciones_producto pre");
		$this->db->join("productos p", "p.id_producto = pre.id_producto");
		$this->db->where("pre.codigo", $nombre);
		$this->db->where("p.estado", 1);
		$resultados = $this->db->get();
	//	$resultados = $this->db->get("presentaciones_producto");
		return $resultados->row();
	}

	public function getPresentacion($nom){
		$array = array(
			"estado" => 1,
        );
			$this->db->select("id_presentacion, nombre");
			$this->db->from("presentacion");
			$this->db->where($array);
			$this->db->like("nombre", $nom);
			$resultados = $this->db->get();
			return $resultados->result();
	 }

	 public function addPresentacionesProducto($data){
		$this->db->insert("presentaciones_producto",$data);
	 }
}