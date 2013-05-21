<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_servicio extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'servicio';
        $this->primary_key = 'servicio.idproveedor';
    }

    public function default_select() {
        $this->db->select('servicio.*');
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
            'nombre' => array(
                    'field' => 'nombre',
                    'label' => 'nombre',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'costo_confidencial' => array(
                    'field' => 'costo_confidencial',
                    'label' => 'costo_confidencial',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'costo_base' => array(
                    'field' => 'costo_base',
                    'label' => 'costo_base',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'indicador_costo' => array(
                    'field' => 'indicador_costo',
                    'label' => 'indicador_costo',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'status' => array(
                    'field' => 'status',
                    'label' => 'status',
                    'rules' => 'required|trim|xss_clean'
                    )
        );
    }
}
?>