<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_model extends CI_Model {
	public function getVentas(){

    //  $resultados =  $this->db->get('entradas');
      $sql = "select fecha, SUM(total) as suma from salidas group by fecha order by fecha asc limit 7";
      $resultados = $this->db->query($sql);

      return $resultados->result();
    }

  public function compras (){
    $sql = "select count(fecha) contador from entradas where fecha ='".date('Y-m-d')."'";
    $resultado = $this->db->query($sql);
    return $resultado->row();
  }
  public function ventas (){
    $sql = "select count(fecha) contador from salidas where fecha ='".date('Y-m-d')."'";
    $resultado = $this->db->query($sql);
    return $resultado->row();
  }
  public function Kardex (){
    $sql = "select count(fecha) contador from kardex where fecha ='".date('Y-m-d')."'";
    $resultado = $this->db->query($sql);
    return $resultado->row();
  }

  public function stock(){
    $this->db->select('s.stock_actual as actual, s.stock_minimo minimo, s.id_stock, pr.valor,p.nombre');
    $this->db->from("stock s");
    $this->db->join("productos p", "p.id_stock = s.id_stock");
    $this->db->join("presentaciones_producto pr", "p.id_producto = pr.id_producto");
    $this->db->where("p.estado",1);
    $this->db->where("pr.equivalencia",1);
	$resultados = $this->db->get();
		return $resultados->result();
	}

}