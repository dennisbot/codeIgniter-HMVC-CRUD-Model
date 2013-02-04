<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class {controller_name} extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->language('mcb', 'spanish');
        $this->load->helper(array('uri', 'icon'));
        $this->_post_handler();
        $this->load->model('{model_name}');
    }

    public function index() {
        $this->load->model('{model_name_table}');
        $this->{model_name}->default_limit = $this->config->item('results_per_page');

        $this->{model_name}->order_by = uri_assoc('order_by');
        $this->{model_name}->order = uri_assoc('order');

        $data = array(
            '{entity}s' => $this->{model_name}->paginate()->result(),
            'table_headers' => $this->{model_name_table}->get_table_headers()
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
        $this->template->write('header_title', 'Listado de {controller_name}');
        $this->template->write('title', 'Listado de {controller_name}');
        $this->template->write_view('content', 'index', $data);
        $this->template->render();
    }

    public function form() {
        ${identity} = uri_assoc('{identity}');
        if ($this->{model_name}->run_validation()) {
            ${identity} = $this->{model_name}->save(${identity});
            /*redirect('{entity}/form/{identity}/' . ${identity});*/
            redirect('{entity}/index');

        } else {
            $this->{model_name}->prep_form(${identity});
            /*
             * template
            */
            $data['header_title'] = 'Administrar Empleados';

            $this->template->write('header_title', 'Administrar {controller_name}');
            $this->template->write('title', 'Administrar {controller_name}');
            $this->template->write_view('content', 'form');
            $this->template->render();
        }
    }

    public function _post_handler() {
        if ($this->input->post('btn_add'))
            redirect('{entity}/form');
        if ($this->input->post('btn_cancel'))
            redirect('{entity}/index');
    }

    public function delete() {
        ${identity} = uri_assoc('{identity}');
        if (${identity}) {
            $this->{model_name}->delete(${identity});
        }
        redirect('{entity}/index');
    }

}

?>