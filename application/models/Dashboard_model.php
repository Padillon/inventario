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
    $this->db->select('stock_actual as actual, stock_minimo minimo');
	$resultados = $this->db->get('stock');
		return $resultados->result();
	}

}