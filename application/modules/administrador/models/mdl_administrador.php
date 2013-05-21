<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_administrador extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'administrador';
        $this->primary_key = 'administrador.idadministrador';
    }

     public function default_select() {
        $this->db->select('administrador.*');
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
            'apellidos' => array(
                    'field' => 'apellidos',
                    'label' => 'apellidos',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'email' => array(
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'required|trim|valid_email|xss_clean'
                    ),
            'clave' => array(
                    'field' => 'clave',
                    'label' => 'clave',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'status' => array(
                    'field' => 'status',
                    'label' => 'status',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'created_at' => array(
                    'field' => 'created_at',
                    'label' => 'created_at',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'es_super' => array(
                    'field' => 'es_super',
                    'label' => 'es_super',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'id_admin' => array(
                    'field' => 'id_admin',
                    'label' => 'id_admin',
                    'rules' => 'required|trim|xss_clean'
                    )
        );
    }
}
?>