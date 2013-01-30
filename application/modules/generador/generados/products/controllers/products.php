<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('session');

        $this->load->model(array('mcb_data/mdl_mcb_data'));
        
        $this->load->language('mcb', $this->mdl_mcb_data->setting('default_language'));

        $this->load->helper(array('uri', 'mcb_icon'));

        $this->load->library(array('form_validation', 'redir'));

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


        $this->_post_handler();

        $this->load->model('mdl_products');
    }

    public function index() {

        $this->load->model('mdl_products_table');

        $params = array(
            'paginate' => TRUE,
            'limit' => $this->config->item('results_per_page'),
            'page' => uri_assoc('page')
        );

        $order_by = uri_assoc('order_by');

        $order = uri_assoc('order');

        switch ($order_by) {
          case 'name':
              $params['order_by'] = 'products.name ' .$order;
              break;
          case 'shortdesc':
              $params['order_by'] = 'products.shortdesc ' .$order;
              break;
          case 'longdesc':
              $params['order_by'] = 'products.longdesc ' .$order;
              break;
          case 'thumbnail':
              $params['order_by'] = 'products.thumbnail ' .$order;
              break;
          case 'image':
              $params['order_by'] = 'products.image ' .$order;
              break;
          case 'grouping':
              $params['order_by'] = 'products.grouping ' .$order;
              break;
          case 'status':
              $params['order_by'] = 'products.status ' .$order;
              break;
          case 'category_id':
              $params['order_by'] = 'products.category_id ' .$order;
              break;
          case 'featured':
              $params['order_by'] = 'products.featured ' .$order;
              break;
          case 'price':
              $params['order_by'] = 'products.price ' .$order;
              break;
          default:
              $params['order_by'] = 'products.id ' .$order;
          }


        $data = array(
            'productss' => $this->mdl_products->get($params),
            'table_headers' => $this->mdl_products_table->get_table_headers()
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
		$this->template->write('header_title', 'Listado de Products');
		$this->template->write('title', 'Listado de Products');
		$this->template->write_view('content', 'index', $data);
		
		//$this->template->write_view('system_messages', 'dashboard/system_messages');
		//$this->template->write_view('sidebar', 'sidebar_view');
		
		$this->template->render();
    }

    public function form() {

        $id = uri_assoc('id');
        
        if ($this->mdl_products->validate()) {
            
            $this->mdl_products->save();

            $id = ($id) ? $id : $this->db->insert_id();

            redirect('products/form/id/' . $id);
            
        } else {
            
            if (!$_POST && $id) {

                $this->mdl_products->prep_validation($id);
            }
            
            /*
             * template
            */
            $this->template->write('header_title', 'Administrar Products');
            $this->template->write('title', 'Administrar Products');
            $this->template->write_view('content', 'form', array('custom_fields' => $this->mdl_products->custom_fields));
            
            $this->template->write_view('system_messages', 'dashboard/system_messages');
            //$this->template->write_view('sidebar', 'sidebar_view');
            
            $this->template->render();
        }
    }

    public function _post_handler() {
        
        if ($this->input->post('btn_add'))
            redirect('products/form');
        if ($this->input->post('btn_cancel'))
            redirect($this->session->userdata('last_index'));
    }

    public function delete() {

        $id = uri_assoc('id');

        if ($id) {
            $this->mdl_products->delete(array('id' => $id));
        }
        
        redirect('products');
    }

}

?>