<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guia extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->language('mcb', 'spanish');
        $this->load->helper(array('uri', 'icon'));
        $this->_post_handler();
        $this->load->model('mdl_guia');
    }

    public function index() {
        $this->load->model('mdl_guia_table');
        $this->mdl_guia->default_limit = $this->config->item('results_per_page');

        $this->mdl_guia->order_by = uri_assoc('order_by');
        $this->mdl_guia->order = uri_assoc('order');

        $data = array(
            'guias' => $this->mdl_guia->paginate()->result(),
            'table_headers' => $this->mdl_guia_table->get_table_headers()
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
        $this->template->write('header_title', 'Listado de Guia');
        $this->template->write('title', 'Listado de Guia');
        $this->template->write_view('content', 'index', $data);
        $this->template->render();
    }

    public function form() {
        $idguia = uri_assoc('idguia');
        if ($this->mdl_guia->run_validation()) {
            $idguia = $this->mdl_guia->save($idguia);
            /*redirect('guia/form/idguia/' . $idguia);*/
            redirect('guia/index');

        } else {
            $this->mdl_guia->prep_form($idguia);
            /*
             * template
            */

            $this->template->write('header_title', 'Administrar Guia');
            $this->template->write('title', 'Administrar Guia');
            $this->template->write_view('content', 'form');
            $this->template->render();
        }
    }

    public function _post_handler() {
        if ($this->input->post('btn_add'))
            redirect('guia/form');
        if ($this->input->post('btn_cancel'))
            redirect('guia/index');
    }

    public function delete() {
        $idguia = uri_assoc('idguia');
        if ($idguia) {
            $this->mdl_guia->delete($idguia);
        }
        redirect('guia/index');
    }

}

?>