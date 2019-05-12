<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Backend_model extends CI_Model {
    public function getID($link){
        $this->db->like('link',$link);
        $resultado = $this->db->get("menu");
        return $resultado->row();
    }

    public function getPermisos($menu,$rol){
        $this->db->where("menu_id",$menu);
        $this->db->where("rol_id",$rol);
        $resultado = $this->db->get("permisos");
        return $resultado->row();
        
    }
}