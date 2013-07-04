<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class {model_name} extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = '{entity}';
        $this->primary_key = '{entity}.{identity}';
    }

    public function default_select()
    {
        $this->db->select('{entity}.*');
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
        {form_validations}
    }
}
?>