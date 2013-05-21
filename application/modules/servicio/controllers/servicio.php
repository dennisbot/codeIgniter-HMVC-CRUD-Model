<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Servicio extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->language('mcb', 'spanish');
        $this->load->helper(array('uri', 'icon'));
        $this->_post_handler();
        $this->load->model('mdl_servicio');
    }

    public function index() {
        $this->load->model('mdl_servicio_table');
        $this->mdl_servicio->default_limit = $this->config->item('results_per_page');

        $this->mdl_servicio->order_by = uri_assoc('order_by');
        $this->mdl_servicio->order = uri_assoc('order');

        $data = array(
            'servicios' => $this->mdl_servicio->paginate()->result(),
            'table_headers' => $this->mdl_servicio_table->get_table_headers()
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
        $this->template->write('header_title', 'Listado de Servicio');
        $this->template->write('title', 'Listado de Servicio');
        $this->template->write_view('content', 'index', $data);
        $this->template->render();
    }

    public function form() {
        $idproveedor = uri_assoc('idproveedor');
        if ($this->mdl_servicio->run_validation()) {
            $idproveedor = $this->mdl_servicio->save($idproveedor);
            /*redirect('servicio/form/idproveedor/' . $idproveedor);*/
            redirect('servicio/index');

        } else {
            $this->mdl_servicio->prep_form($idproveedor);
            /*
             * template
            */
            $this->template->add_js(public_url() . "jquery/validate/jquery.validate.min.js");
            $this->template->add_js(public_url() . "servicio/validate_servicio.js");
            $this->template->write('header_title', 'Administrar Servicio');
            $this->template->write('title', 'Administrar Servicio');
            $this->template->write_view('content', 'form');
            $this->template->render();
        }
    }

    public function _post_handler() {
        if ($this->input->post('btn_add'))
            redirect('servicio/form');
        if ($this->input->post('btn_cancel'))
            redirect('servicio/index');
    }

    public function delete() {
        $idproveedor = uri_assoc('idproveedor');
        if ($idproveedor) {
            $this->mdl_servicio->delete($idproveedor);
        }
        redirect('servicio/index');
    }

}

?>