<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_empleados extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'empleados';
        $this->primary_key = 'empleados.';
    }

     public function default_select() {
        $this->db->select('empleados.*');
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
            'idempleado' => array(
                    'field' => 'idempleado',
                    'label' => 'idempleado',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'nombres' => array(
                    'field' => 'nombres',
                    'label' => 'nombres',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'departamento' => array(
                    'field' => 'departamento',
                    'label' => 'departamento',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'sueldo' => array(
                    'field' => 'sueldo',
                    'label' => 'sueldo',
                    'rules' => 'required|trim|xss_clean'
                    )
        );
    }
}
?>