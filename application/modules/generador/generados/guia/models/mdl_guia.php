<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_guia extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'guia';
        $this->primary_key = 'guia.idguia';
    }

     public function default_select() {
        $this->db->select('guia.*');
    }

    public function default_order_by() {
        if ($this->order_by && $this->order) {
            $this->db->order_by($this->order_by, $this->order);
        }
        else {
            $this->db->order_by($this->primary_key);
        }
    }
    public function validation_rules() {
        return array(
            'tipo_documento' => array(
                    'field' => 'tipo_documento',
                    'label' => 'tipo_documento',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'documento' => array(
                    'field' => 'documento',
                    'label' => 'documento',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'nombres' => array(
                    'field' => 'nombres',
                    'label' => 'nombres',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'apellidos' => array(
                    'field' => 'apellidos',
                    'label' => 'apellidos',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'telefono' => array(
                    'field' => 'telefono',
                    'label' => 'telefono',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'proveedor_idproveedor' => array(
                    'field' => 'proveedor_idproveedor',
                    'label' => 'proveedor_idproveedor',
                    'rules' => 'required|trim|xss_clean'
                    )
        );
    }
}
?>