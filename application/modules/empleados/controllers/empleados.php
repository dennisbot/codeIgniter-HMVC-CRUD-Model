<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empleados extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->language('mcb', 'spanish');
        $this->load->helper(array('uri', 'icon'));
        $this->_post_handler();
        $this->load->model('mdl_empleados');
    }

    public function index() {
        $this->load->model('mdl_empleados_table');
        $this->mdl_empleados->default_limit = $this->config->item('results_per_page');

        $this->mdl_empleados->order_by = uri_assoc('order_by');
        $this->mdl_empleados->order = uri_assoc('order');

        $data = array(
            'empleadoss' => $this->mdl_empleados->paginate()->result(),
            'table_headers' => $this->mdl_empleados_table->get_table_headers()
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
        $this->template->write('header_title', 'Listado de Empleados');
        $this->template->write('title', 'Listado de Empleados');
        $this->template->write_view('content', 'index', $data);
        $this->template->render();
    }

    public function form() {
        $idempleado = uri_assoc('idempleado');
        if ($this->mdl_empleados->run_validation()) {
            $idempleado = $this->mdl_empleados->save($idempleado);
            /*redirect('empleados/form/idempleado/' . $idempleado);*/
            redirect('empleados/index');

        } else {
            $this->mdl_empleados->prep_form($idempleado);
            /*
             * template
            */
            $this->template->add_js(public_url() . "jquery/validate/jquery.validate.min.js");
            $this->template->add_js(public_url() . "empleados/validate_empleados.js");
            $this->template->write('header_title', 'Administrar Empleados');
            $this->template->write('title', 'Administrar Empleados');
            $this->template->write_view('content', 'form');
            $this->template->render();
        }
    }

    public function _post_handler() {
        if ($this->input->post('btn_add'))
            redirect('empleados/form');
        if ($this->input->post('btn_cancel'))
            redirect('empleados/index');
    }

    public function delete() {
        $idempleado = uri_assoc('idempleado');
        if ($idempleado) {
            $this->mdl_empleados->delete($idempleado);
        }
        redirect('empleados/index');
    }

}

?>