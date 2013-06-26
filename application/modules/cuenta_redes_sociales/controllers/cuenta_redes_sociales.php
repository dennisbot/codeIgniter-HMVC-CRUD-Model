<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cuenta_redes_sociales extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->language('mcb', 'spanish');
        $this->load->helper(array('uri', 'icon'));
        $this->_post_handler();
        $this->load->model('mdl_cuenta_redes_sociales');
    }

    public function index() {
        $this->load->model('mdl_cuenta_redes_sociales_table');
        $this->mdl_cuenta_redes_sociales->default_limit = $this->config->item('results_per_page');

        $this->mdl_cuenta_redes_sociales->order_by = uri_assoc('order_by');
        $this->mdl_cuenta_redes_sociales->order = uri_assoc('order');

        $data = array(
            'cuenta_redes_socialess' => $this->mdl_cuenta_redes_sociales->paginate()->result(),
            'table_headers' => $this->mdl_cuenta_redes_sociales_table->get_table_headers()
        );

        /*
         * assets
         */
        /*
        $this->template->add_css('nombre_archivo.css', 'link', false);
        $this->template->add_js('nombre_archivo.js', 'import', false);
        $javascript_inline = '
            $(".clase").accion({
              //operaciones
            })
        ';
        $this->template->add_js($javascript_inline, 'embed', false);
        */

        /*
         * template
         */
        $this->template->write('header_title', 'Listado de Cuenta_redes_sociales');
        $this->template->write('title', 'Listado de Cuenta_redes_sociales');
        $this->template->write_view('content', 'index', $data);
        $this->template->render();
    }

    public function form() {
        $id = uri_assoc('id');
        if ($this->mdl_cuenta_redes_sociales->run_validation()) {
            $id = $this->mdl_cuenta_redes_sociales->save($id);
            /*redirect('cuenta_redes_sociales/form/id/' . $id);*/
            redirect('cuenta_redes_sociales/index');

        } else {
            $this->mdl_cuenta_redes_sociales->prep_form($id);
            /*
             * template
            */
            $this->template->add_js(public_url() . "jquery/validate/jquery.validate.min.js");
            $this->template->add_js(public_url() . "cuenta_redes_sociales/validate_cuenta_redes_sociales.js");
            $this->template->write('header_title', 'Administrar Cuenta_redes_sociales');
            $this->template->write('title', 'Administrar Cuenta_redes_sociales');
            $this->template->write_view('content', 'form');
            $this->template->render();
        }
    }

    public function _post_handler() {
        if ($this->input->post('btn_add'))
            redirect('cuenta_redes_sociales/form');
        if ($this->input->post('btn_cancel'))
            redirect('cuenta_redes_sociales/index');
    }

    public function delete() {
        $id = uri_assoc('id');
        if ($id) {
            $this->mdl_cuenta_redes_sociales->delete($id);
        }
        redirect('cuenta_redes_sociales/index');
    }

}

?>