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
      $this->db->where("id_entrada",$id);
      $resultados = $this->db->get("detalle_entrada");
      return $resultados->result();
    }


    public function getProveedores($valor){
      $this->db->select("id_proveedor, empresa as label, nombre");
      $this->db->from("proveedores");
      $this->db->like("empresa", $valor);
      $this->db->or_like("nombre", $valor);
      $resultados = $this->db->get();
      return $resultados->result_array();
    }

    public function getProveedoresTodos(){
      $this->db->select("id_proveedor, empresa, nombre");
      $this->db->from("proveedores");
      $this->db->where("estado", 1);
      $resultados = $this->db->get();
      return $resultados->result();
    }

    public function getProductos($valor){
    $this->db->select("p.*,m.nombre as id_marca, pre.nombre as id_presentacion,s.stock_actual as existencias");
      $this->db->from("productos p");
      $this->db->join("marcas m","p.id_marca = m.id_marca");
      $this->db->join("presentacion pre","p.id_presentacion = pre.id_presentacion");
      $this->db->join("stock s","p.id_stock = s.id_stock");
      $this->db->where("p.estado","1");
      $this->db->like("p.nombre", $valor);
      $this->db->or_like("p.codigo", $valor);
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
    public function save_lote($data){
      $this->db->insert('lotes',$data);
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

    public function updateLote($id, $data){
      $this->db->where("id_entrada",$id);		
      $this->db->update("lotes",$data);
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

    public function getEntrada($id){
      $this->db->select("e.*, u.usuario, p.empresa");
      $this->db->from("entradas e");
      $this->db->join("usuarios u", "e.id_usuario = u.id_usuario");
      $this->db->join("proveedores p", "e.id_proveedor = p.id_proveedor");
      $this->db->where("e.id_entrada", $id);
      $resultado = $this->db->get();
      return $resultado->row();
    }

    public function getDetalleEntrada($id){
            $this->db->select("d.*, p.codigo, p.nombre, p.precio_compra");
            $this->db->from("detalle_entrada d");
            $this->db->join("productos p", "d.id_producto = p.id_producto");
            $this->db->where("d.id_entrada", $id);
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

  public function getEntradasInactivos(){
        $this->db->select("date_format(e.fecha, '%d-%m-%Y') as fecha, e.total,u.usuario as id_usuario, pro.empresa as id_proveedor");
        $this->db->from("entradas e");
        $this->db->join("usuarios u","e.id_usuario = u.id_usuario");  
        $this->db->join("proveedores pro","e.id_proveedor = pro.id_proveedor");  
        $this->db->where("e.estado",0);
        $resultados = $this->db->get();
        return $resultados->result();
  }

  public function getEntradasFechas($fecha1, $fecha2){ 
        $this->db->select("date_format(e.fecha, '%d-%m-%Y') as fecha, e.total, u.usuario as id_usuario, pro.empresa as id_proveedor");
        $this->db->from("entradas e");
        $this->db->join("usuarios u","e.id_usuario = u.id_usuario");  
        $this->db->join("proveedores pro","e.id_proveedor = pro.id_proveedor");  
        $this->db->where("e.estado",1);
        $this->db->where("e.fecha BETWEEN '$fecha1' AND '$fecha2'");
        $resultados = $this->db->get();
        return $resultados->result();
    }

    public function totalEntradasFechas($fecha1, $fecha2){
      
      $resultado = $this->db->query("
                      select truncate(sum(total), 3) as totalTotal
                      from entradas
                      where estado = 1
                      and fecha between cast('$fecha1' as date) and cast('$fecha2' as date)
                      ");
      return $resultado->row();
    }

    public function getEntradasProveedor($fecha1, $fecha2, $prov){ 
      $this->db->select("date_format(e.fecha, '%d-%m-%Y') as fecha, e.total, u.usuario as id_usuario, pro.empresa as id_proveedor");
      $this->db->from("entradas e");
      $this->db->join("usuarios u","e.id_usuario = u.id_usuario");  
      $this->db->join("proveedores pro","e.id_proveedor = pro.id_proveedor");  
      $this->db->where("e.id_proveedor", $prov);
      $this->db->where("e.estado",1);
      $this->db->where("e.fecha BETWEEN '$fecha1' AND '$fecha2'");
      $resultados = $this->db->get();
      return $resultados->result();
  }

  public function getResumenDiario($fecha1, $fecha2){
    $resultado = $this->db->query("
        select date_format(fecha, '%d-%m-%Y') as fecha, sum(total) as totalDia 
        from entradas 
        where estado = 1
        and fecha between cast('$fecha1' as date) and cast('$fecha2' as date) 
        group by fecha
    ");
    return $resultado->result();
}

}