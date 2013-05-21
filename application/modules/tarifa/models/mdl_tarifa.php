<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_tarifa extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'tarifa';
        $this->primary_key = 'tarifa.idtarifa';
    }

    public function default_select() {
        $this->db->select('tarifa.*');
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
            'porcentaje' => array(
                    'field' => 'porcentaje',
                    'label' => 'porcentaje',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'descripcion' => array(
                    'field' => 'descripcion',
                    'label' => 'descripcion',
                    'rules' => 'required|trim|xss_clean'
                    )
        );
    }
}
?>