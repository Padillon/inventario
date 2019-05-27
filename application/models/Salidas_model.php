<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Salidas_model extends CI_Model {
	
    public function getSalidas(){ 
      $this->db->where('estado',1);
      $resultados = $this->db->get("salidas");
      return $resultados->result();
    }

    public function getClientes($valor){
      $this->db->select("id_cliente, nombre as label, apellido");
      $this->db->from("clientes");
      $this->db->like("nombre", $valor);
      $this->db->or_like("apellido", $valor);
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
      $this->db->or_like("p.codigo", $valor);
      $resultados = $this->db->get();
      return $resultados->result_array();
    }

    public function save($data){
      return $this->db->insert("salidas", $data);
    }

    public function lastID(){
      return $this->db->insert_id();
    }

    public function save_detalle($data){
      $this->db->insert("detalle_salida", $data);
    }
    public function updateP($id,$data){
      $this->db->where("id_producto",$id);		
      $this->db->update("productos",$data);
      return 0;
    }

    public function  getComprobantes(){
      $resultados = $this->db->get('tipo_comprobante');
      return $resultados->result();
    }

    public function update_correlativo($id,$cantidad){
      $this->db->where("id_tipo_comprobante",$id);		
      $this->db->update("tipo_comprobante",$cantidad);
      return 0;
    }

    public function getSalida($id){
      $this->db->select("s.*, u.usuario, c.nombre, c.apellido");
      $this->db->from("salidas s");
      $this->db->join("usuarios u", "s.id_usuario = u.id_usuario");
      $this->db->join("clientes c", "s.id_cliente = c.id_cliente");
      $this->db->where("s.id_salida", $id);
      $resultado = $this->db->get();
      return $resultado->row();
    }

    public function getDetalleSalida($id){
            $this->db->select("d.*, p.codigo, p.nombre");
            $this->db->from("detalle_salida d");
            $this->db->join("productos p", "d.id_producto = p.id_producto");
            $this->db->where("d.id_salida", $id);
		  $resultados = $this->db->get();
		  return $resultados->result();
    }

    public function getDetalle($id){ 
      $this->db->where("id_salida",$id);
      $resultados = $this->db->get("detalle_salida");
      return $resultados->result();
    }

    public function updateSalida($id,$data){
      $this->db->where("id_salida",$id);		
      $this->db->update("salidas",$data);
      return 0;
    }
}