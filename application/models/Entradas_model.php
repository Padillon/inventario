<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Entradas_model extends CI_Model {
	
    public function getEntradas(){ 
      $this->db->select("e.*,u.usuario as id_usuario, pro.empresa as id_proveedor");
        $this->db->from("entradas e");
        $this->db->join("usuarios u","e.id_usuario = u.id_usuario");  
        $this->db->join("proveedores pro","e.id_proveedor = pro.id_proveedor");  
        $this->db->where("e.estado",1);
		$resultados = $this->db->get();
			return $resultados->result();
    }

    public function get($id){ 
      $this->db->where("id_entrada",$id);
      $this->db->where("estado",1);
    $resultado = $this->db->get("entradas");
    return $resultado->row();
    }

    public function getDetalle($id){ 
      //$this->db->select("d.*,p.nombre nombreP,p.codigo codigoP,p.id_producto id_productoP,p.precio_venta precioSalidaP");
      //$this->db->from("detalle_entrada d");
      //$this->db->join("productos p","p.id_producto = d.id_producto");
      //$this->db->where("id_entrada",$id);
      //$resultados = $this->db->get("detalle_entrada");
      $this->db->where("id_entrada",$id);
      $resultados = $this->db->get("detalle_entrada");
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
    $this->db->select("p.*,m.nombre as id_marca, pre.nombre as id_presentacion");
      $this->db->from("productos p");
      //$this->db->join("categoria c","p.id_categoria = c.id_categoria");
      $this->db->join("marcas m","p.id_marca = m.id_marca");
      $this->db->join("presentacion pre","p.id_presentacion = pre.id_presentacion");
     // $this->db->join("proveedores pr","p.id_proveedor = pr.id_proveedor");
      $this->db->where("p.estado","1");
      $this->db->like("p.nombre", $valor);
      //$this->db->from("productos");
     // $this->db->like("nombre", $valor);
      $resultados = $this->db->get();
      return $resultados->result_array();
    }

    public function save($data){
      return $this->db->insert("entradas", $data);
    }

    public function lastID(){
      return $this->db->insert_id();
    }

    public function save_detalle($data){
      $this->db->insert("detalle_entrada", $data);
    }
    public function updateP($id,$data){
      $this->db->where("id_producto",$id);		
      $this->db->update("productos",$data);
      return 0;
    }
    public function updateDetalle($id,$data){
      $this->db->where("id_entrada",$id);		
      $this->db->update("detalle_entrada",$data);
      return 0;
    }
    public function updateEntrada($id,$data){
      $this->db->where("id_entrada",$id);		
      $this->db->update("entradas",$data);
      return 0;
    }

    public function get_productosDetalle($id){
      $this->db->select("p.nombre nombre,p.codigo codigo,p.id_producto id_producto");
      $this->db->from("detalle_entrada d");
      $this->db->join("productos p","p.id_producto = d.id_producto");
      $this->db->where("d.id_entrada",$id);
      $resultados = $this->db->get();
      return $resultados->result_array();
    }
}