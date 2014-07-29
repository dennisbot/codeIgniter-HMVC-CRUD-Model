<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_docente extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'docente';
        $this->primary_key = 'docente.docente_id';
    }

    public function default_select()
    {
        $this->db->select('docente.*');
    }

    public function default_order_by()
    {
        if ($this->order_by && $this->order) {
            $this->db->order_by($this->order_by, $this->order);
        }
        else {
            $this->db->order_by($this->primary_key);
        }
    }
    public function validation_rules()
    {
        return array(
            'paterno' => array(
                    'field' => 'paterno',
                    'label' => 'paterno',
                    'rules' => 'trim|xss_clean'
                    ),
            'materno' => array(
                    'field' => 'materno',
                    'label' => 'materno',
                    'rules' => 'trim|xss_clean'
                    ),
            'nombres' => array(
                    'field' => 'nombres',
                    'label' => 'nombres',
                    'rules' => 'trim|xss_clean'
                    ),
            'dni' => array(
                    'field' => 'dni',
                    'label' => 'dni',
                    'rules' => 'trim|xss_clean'
                    ),
            'telefono' => array(
                    'field' => 'telefono',
                    'label' => 'telefono',
                    'rules' => 'trim|xss_clean'
                    ),
            'direccion' => array(
                    'field' => 'direccion',
                    'label' => 'direccion',
                    'rules' => 'trim|xss_clean'
                    ),
            'tipo_docente' => array(
                    'field' => 'tipo_docente',
                    'label' => 'tipo_docente',
                    'rules' => 'trim|xss_clean'
                    ),
            'email' => array(
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'trim|valid_email|xss_clean'
                    ),
            'sexo' => array(
                    'field' => 'sexo',
                    'label' => 'sexo',
                    'rules' => 'trim|xss_clean'
                    )
        );
    }
}
?>