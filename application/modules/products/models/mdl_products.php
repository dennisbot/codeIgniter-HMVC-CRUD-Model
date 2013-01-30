<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_products extends MY_Model {

    public function __construct() {

        parent::__construct();

        $this->table_name = 'products';

        $this->primary_key = 'products.id';

        $this->select_fields = "
		SQL_CALC_FOUND_ROWS
		products.*";

        $this->order_by = 'id';

        $this->custom_fields = $this->mdl_fields->get_object_fields(3);
    }

    public function validate() {
        
        $this->form_validation->set_rules('name','name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('shortdesc','shortdesc', 'required|trim|xss_clean');
        $this->form_validation->set_rules('longdesc','longdesc', 'required|trim|xss_clean');
        $this->form_validation->set_rules('thumbnail','thumbnail', 'xss_clean');
        $this->form_validation->set_rules('image','image', 'required|trim|xss_clean');
        $this->form_validation->set_rules('grouping','grouping', 'required|trim|xss_clean');
        $this->form_validation->set_rules('status','status', 'required|trim|xss_clean');
        $this->form_validation->set_rules('category_id','category_id', 'required|trim|xss_clean');
        $this->form_validation->set_rules('featured','featured', 'required|trim|xss_clean');
        $this->form_validation->set_rules('price','price', 'required|trim|xss_clean');

        foreach ($this->custom_fields as $custom_field) {

            $this->form_validation->set_rules($custom_field->column_name, $custom_field->field_name);
        }

        return parent::validate();
    }

    public function save() {

        parent::save(parent::db_array(), uri_assoc('id'));
    }

}
?>