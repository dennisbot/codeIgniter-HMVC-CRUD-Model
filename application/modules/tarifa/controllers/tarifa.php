<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tarifa extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->language('mcb', 'spanish');
        $this->load->helper(array('uri', 'icon'));
        $this->_post_handler();
        $this->load->model('mdl_tarifa');
    }

    public function index() {
        $this->load->model('mdl_tarifa_table');
        $this->mdl_tarifa->default_limit = $this->config->item('results_per_page');

        $this->mdl_tarifa->order_by = uri_assoc('order_by');
        $this->mdl_tarifa->order = uri_assoc('order');

        $data = array(
            'tarifas' => $this->mdl_tarifa->paginate()->result(),
            'table_headers' => $this->mdl_tarifa_table->get_table_headers()
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
        $this->template->write('header_title', 'Listado de Tarifa');
        $this->template->write('title', 'Listado de Tarifa');
        $this->template->write_view('content', 'index', $data);
        $this->template->render();
    }

    public function form() {
        $idtarifa = uri_assoc('idtarifa');
        if ($this->mdl_tarifa->run_validation()) {
            $idtarifa = $this->mdl_tarifa->save($idtarifa);
            /*redirect('tarifa/form/idtarifa/' . $idtarifa);*/
            redirect('tarifa/index');

        } else {
            $this->mdl_tarifa->prep_form($idtarifa);
            /*
             * template
            */
            $this->template->add_js(public_url() . "jquery/validate/jquery.validate.min.js");
            $this->template->add_js(public_url() . "tarifa/validate_tarifa.js");
            $this->template->write('header_title', 'Administrar Tarifa');
            $this->template->write('title', 'Administrar Tarifa');
            $this->template->write_view('content', 'form');
            $this->template->render();
        }
    }

    public function _post_handler() {
        if ($this->input->post('btn_add'))
            redirect('tarifa/form');
        if ($this->input->post('btn_cancel'))
            redirect('tarifa/index');
    }

    public function delete() {
        $idtarifa = uri_assoc('idtarifa');
        if ($idtarifa) {
            $this->mdl_tarifa->delete($idtarifa);
        }
        redirect('tarifa/index');
    }

}

?>