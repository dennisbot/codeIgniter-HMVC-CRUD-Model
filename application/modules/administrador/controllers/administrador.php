<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrador extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->language('mcb', 'spanish');
        $this->load->helper(array('uri', 'icon'));
        $this->_post_handler();
        $this->load->model('mdl_administrador');
    }

    public function index() {
        $this->load->model('mdl_administrador_table');
        $this->mdl_administrador->default_limit = $this->config->item('results_per_page');

        $this->mdl_administrador->order_by = uri_assoc('order_by');
        $this->mdl_administrador->order = uri_assoc('order');

        $data = array(
            'administradors' => $this->mdl_administrador->paginate()->result(),
            'table_headers' => $this->mdl_administrador_table->get_table_headers()
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
        $this->template->write('header_title', 'Listado de Administrador');
        $this->template->write('title', 'Listado de Administrador');
        $this->template->write_view('content', 'index', $data);
        $this->template->render();
    }

    public function form() {
        $idadministrador = uri_assoc('idadministrador');
        if ($this->mdl_administrador->run_validation()) {
            $idadministrador = $this->mdl_administrador->save($idadministrador);
            /*redirect('administrador/form/idadministrador/' . $idadministrador);*/
            redirect('administrador/index');

        } else {
            $this->mdl_administrador->prep_form($idadministrador);
            /*
             * template
            */

            $this->template->write('header_title', 'Administrar Administrador');
            $this->template->write('title', 'Administrar Administrador');
            $this->template->write_view('content', 'form');
            $this->template->render();
        }
    }

    public function _post_handler() {
        if ($this->input->post('btn_add'))
            redirect('administrador/form');
        if ($this->input->post('btn_cancel'))
            redirect('administrador/index');
    }

    public function delete() {
        $idadministrador = uri_assoc('idadministrador');
        if ($idadministrador) {
            $this->mdl_administrador->delete($idadministrador);
        }
        redirect('administrador/index');
    }

}

?>