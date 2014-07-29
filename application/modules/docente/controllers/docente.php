<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Docente extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->language('mcb', 'spanish');
        $this->load->helper(array('uri', 'icon'));
        $this->_post_handler();
        $this->load->model('mdl_docente');
    }

    public function index()
    {
        $this->load->model('mdl_docente_table');
        $this->mdl_docente->default_limit = $this->config->item('results_per_page');

        $this->mdl_docente->order_by = uri_assoc('order_by');
        $this->mdl_docente->order = uri_assoc('order');

        $data = array(
            'docentes' => $this->mdl_docente->paginate()->result(),
            'table_headers' => $this->mdl_docente_table->get_table_headers()
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
        $this->template->write('header_title', 'Listado de Docente');
        $this->template->write('title', 'Listado de Docente');
        $this->template->write_view('content', 'index', $data);
        $this->template->render();
    }

    public function form()
    {
        $docente_id = uri_assoc('docente_id');
        if ($this->mdl_docente->run_validation()) {
            $docente_id = $this->mdl_docente->save($docente_id);
            /*redirect('docente/form/docente_id/' . $docente_id);*/
            redirect('docente/index');

        } else {
            $this->mdl_docente->prep_form($docente_id);
            /*
             * template
            */
            $this->template->add_js(public_url() . "jquery/validate/jquery.validate.min.js");
            $this->template->add_js(public_url() . "docente/validate_docente.js");
            $this->template->write('header_title', 'Administrar Docente');
            $this->template->write('title', 'Administrar Docente');
            $this->template->write_view('content', 'form');
            $this->template->render();
        }
    }

    public function _post_handler()
    {
        if ($this->input->post('btn_add'))
            redirect('docente/form');
        if ($this->input->post('btn_cancel'))
            redirect('docente/index');
    }

    public function delete()
    {
        $docente_id = uri_assoc('docente_id');
        if ($docente_id) {
            $this->mdl_docente->delete($docente_id);
        }
        redirect('docente/index');
    }

}

?>