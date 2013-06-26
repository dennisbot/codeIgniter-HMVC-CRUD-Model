<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_cuenta_redes_sociales extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'cuenta_redes_sociales';
        $this->primary_key = 'cuenta_redes_sociales.id';
    }

    public function default_select() {
        $this->db->select('cuenta_redes_sociales.*');
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
            'cuenta' => array(
                    'field' => 'cuenta',
                    'label' => 'cuenta',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'usuario' => array(
                    'field' => 'usuario',
                    'label' => 'usuario',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'password' => array(
                    'field' => 'password',
                    'label' => 'password',
                    'rules' => 'required|trim|xss_clean'
                    )
        );
    }
}
?>