<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tcliente extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->language('mcb', 'spanish');
        $this->load->helper(array('uri', 'icon'));
        $this->_post_handler();
        $this->load->model('mdl_tcliente');
    }

    public function index()
    {
        $this->load->model('mdl_tcliente_table');
        $this->mdl_tcliente->default_limit = $this->config->item('results_per_page');

        $this->mdl_tcliente->order_by = uri_assoc('order_by');
        $this->mdl_tcliente->order = uri_assoc('order');

        $data = array(
            'tclientes' => $this->mdl_tcliente->paginate()->result(),
            'table_headers' => $this->mdl_tcliente_table->get_table_headers()
        );
        /* bootbox */
        $this->template->add_js(public_url('bootstrap/bootbox/js/bootbox.min.js'));
        /* custom js */
        $this->template->add_js(public_url('activos/js/index.js'));
        $css_inline = "
            form {
                float: right;
                margin-bottom: 23px;
            }
        ";
        $this->template->add_css($css_inline, "embed");
        $this->template->write('header_title', 'Listado de activo');
        $this->template->write('title', 'Listado de activo
                               <a
                               href="'.base_url('activo/toprint').'"
                               target="_blank"
                               class="btn btn-warning"
                               style="float:right;padding: 6px 19px"
                               id="imprimir"
                               >
                   <i class="icon-print icon-large"></i> Imprimir</a>');
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
        $this->template->write('header_title', 'Listado de Tcliente');
        $this->template->write('title', 'Listado de Tcliente');
        $this->template->write_view('content', 'index', $data);
        $this->template->render();
    }

    public function form()
    {
        $CodCliente = uri_assoc('CodCliente');
        if ($this->mdl_tcliente->run_validation()) {
            $CodCliente = $this->mdl_tcliente->save($CodCliente);
            /*redirect('tcliente/form/CodCliente/' . $CodCliente);*/
            redirect('tcliente/index');

        } else {
            $this->mdl_tcliente->prep_form($CodCliente);
            /*
             * template
            */
            $this->template->add_js(public_url() . "jquery/validate/jquery.validate.min.js");
            $this->template->add_js(public_url() . "tcliente/validate_tcliente.js");
            $this->template->write('header_title', 'Administrar Tcliente');
            $this->template->write('title', 'Administrar Tcliente');
            $this->template->write_view('content', 'form');
            $this->template->render();
        }
    }

    public function _post_handler()
    {
        if ($this->input->post('btn_add'))
            redirect('tcliente/form');
        if ($this->input->post('btn_cancel'))
            redirect('tcliente/index');
    }

    public function delete()
    {
        $CodCliente = uri_assoc('CodCliente');
        if ($CodCliente) {
            $this->mdl_tcliente->delete($CodCliente);
        }
        redirect('tcliente/index');
    }

}

?>