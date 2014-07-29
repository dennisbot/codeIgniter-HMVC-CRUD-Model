<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_tcliente extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tcliente';
        $this->primary_key = 'tcliente.CodCliente';
    }

    public function default_select()
    {
        $this->db->select('tcliente.*');
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
            'Nombres' => array(
                    'field' => 'Nombres',
                    'label' => 'Nombres',
                    'rules' => 'required|trim|xss_clean'
                    ),
            'Direccion' => array(
                    'field' => 'Direccion',
                    'label' => 'Direccion',
                    'rules' => 'trim|xss_clean'
                    ),
            'RUC' => array(
                    'field' => 'RUC',
                    'label' => 'RUC',
                    'rules' => 'required|trim|xss_clean'
                    )
        );
    }
}
?>