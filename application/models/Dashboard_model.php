<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_model extends CI_Model {
	public function getVentas(){

    //  $resultados =  $this->db->get('entradas');
      $sql = "select fecha, SUM(total) as suma from salidas group by fecha order by fecha asc limit 7";
      $resultados = $this->db->query($sql);

      return $resultados->result();
    }
}