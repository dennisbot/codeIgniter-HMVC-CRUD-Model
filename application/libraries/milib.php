<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package CodeIgniter
 * @author  ExpressionEngine Dev Team
 * @copyright  Copyright (c) 2006, EllisLab, Inc.
 * @license http://codeigniter.com/user_guide/license.html
 * @link http://codeigniter.com
 * @since   Version 1.0
 * @filesource
 */
// --------------------------------------------------------------------

/**
 * CodeIgniter Template Class
 *
 * This class is and interface to CI's View class. It aims to improve the
 * interaction between controllers and views. Follow @link for more info
 *
 * @package		CodeIgniter
 * @author		Colin Williams
 * @subpackage	Libraries
 * @category	Libraries
 * @link		http://www.williamsconcepts.com/ci/libraries/template/index.html
 * @copyright  Copyright (c) 2008, Colin Williams.
 * @version 1.4.1
 *
 */
class CI_Milib {

    var $CI;

    /**
     * Constructor
     *
     * Loads template configuration, template regions, and validates existence of
     * default template
     *
     * @access	public
     */
    function CI_Milib() {
        // Copy an instance of CI so we can use the entire framework.
        $this->CI = & get_instance();
    }

    // --------------------------------------------------------------------

    /**
     * Recupera todas las categorias existentes
     *
     * @access	public
     * @return	an array of category's objects
     */
    function categorias_con_eventos($solo_ids = true) {
        //para elegir los eventos que aún no empezaron
        $today = time();
        //primero recuperamos las categorias con eventos creados,
        //para mostrar a demanda
        $this->CI->load->model("evento/mdl_evento");
        $eventos = $this->CI->mdl_evento->proximos_eventos();
        $cat_with_events = array();
        foreach ($eventos as $evento) {
            $cat_with_events[$evento->categoria_id] = true;
        }
        if ($solo_ids) {
            return $data['cat_with_events'] = $cat_with_events;
        }
        else {
            $this->CI->load->model("categoria/mdl_categoria");
            $keys = array();
            foreach ($cat_with_events as $key => $value) {
                $keys[] = $key;
            }
            $params['where_in'] = array('categoria_id' => $keys);
            return $this->CI->mdl_categoria->get($params);

        }
    }

    function categorias() {
        $this->CI->load->model('categoria/mdl_categoria');
        $categorias = $this->CI->mdl_categoria->get(array('select' => 'categoria_id, nombre'));

        $cat_mapeadas = array();
        foreach ($categorias as $categoria) {
            $cat_mapeadas[$categoria->categoria_id] = $categoria->nombre;
        }
        return $cat_mapeadas;
    }

    function categorias_ordenadas($select) {
        $this->CI->load->model('categoria/mdl_categoria');
        $params = array();
        $params['select'] = $select;
        $params['order_by'] = 'nombre';
        $categorias = $this->CI->mdl_categoria->get($params);
        return $categorias;
    }

    function bienvenido_usuario() {
        if (trim($this->CI->session->userdata('username')) != '')
            return "Bienvenido ".$this->CI->session->userdata('username');
        return "Bienvenido amigo Chull";
    }

    //verifica si usuario esta o no logueado
    function logueado() {
    	return ($this->CI->session->userdata('logged_in') && $this->CI->session->userdata('sesion_id_user'));
    }

    //verifica si una url esta repetida
	function verificar_url_repetida($url) {
		$CI =& get_instance();
		$CI->load->model('mdl_evento');

		$params = array();
        $params['select'] = 'url';
        $params['where']['url'] = $url;
        $params['return_row'] = true;
        $evento = $CI->mdl_evento->get($params);
		if(count($evento) > 0){
			$nro_item = 1;
			do {
				$nueva_url = $url . "-" . $nro_item;
		        $params['select'] = 'url';
		        $params['where']['url'] = $nueva_url;
		        $params['return_row'] = true;
		        $evento = $CI->mdl_evento->get($params);
				$nro_item++;
			} while (count($evento) > 0);
			return $nueva_url;
		}
		return $url;
	}

    function user_campos_incompletos($id_user) {
        $this->CI->load->model('user/mdl_usuario');
		$params = array();
        $params['select'] = 'ciudad_id, nombres, apellidos, ocupacion, direccion, fecha_nac, img';
        $params['where']['usuario_id'] = $id_user;
        $params['return_row'] = true;
        $usuarios = $this->CI->mdl_usuario->get($params);
        $campos = array();
        $selected_fields = explode(",", $params['select']);
        $campos["total"] = count($selected_fields);
        $campos["campo"] = array();
        if($usuarios->ciudad_id == 0){
        	$var = 'Le falta completar su pa&iacute;s y ciudad';
        	array_push($campos["campo"], $var);
        }
        if ($usuarios->nombres == '') {
        	$var = 'Le falta completar sus nombres';
        	array_push($campos["campo"], $var);
        }
        if ($usuarios->apellidos == '') {
        	$var = 'Le falta completar sus apellidos';
        	array_push($campos["campo"], $var);
        }
        if ($usuarios->ocupacion == '') {
        	$var = 'Le falta completar su ocupaci&oacute;n';
        	array_push($campos["campo"], $var);
        }
        if ($usuarios->direccion == '') {
        	$var = 'Le falta completar su direcci&oacute;n';
        	array_push($campos["campo"], $var);
        }
        if ($usuarios->fecha_nac == '') {
        	$var = 'Le falta completar su fecha de nacimiento';
        	array_push($campos["campo"], $var);
        }
        if ($usuarios->img == '') {
        	$var = 'Le falta subir su imagen';
        	array_push($campos["campo"], $var);
        }
        if (isset($campos["campo"]))
        {
        	$campos["faltan"] = count($campos["campo"]);
        }
        return $campos;
    }

}

// END Template Class

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */