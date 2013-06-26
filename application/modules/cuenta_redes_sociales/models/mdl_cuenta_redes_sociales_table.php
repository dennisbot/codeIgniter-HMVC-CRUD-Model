<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_cuenta_redes_sociales_table extends CI_Model {

    public function get_table_headers() {

        $order = (uri_assoc('order')) == 'asc' ? 'desc' : 'asc';

        $headers = array(
        'id' => anchor('cuenta_redes_sociales/index/order_by/id/order/'.$order, 'id'),
        'cuenta' => anchor('cuenta_redes_sociales/index/order_by/cuenta/order/'.$order, 'cuenta'),
        'usuario' => anchor('cuenta_redes_sociales/index/order_by/usuario/order/'.$order, 'usuario'),
        'password' => anchor('cuenta_redes_sociales/index/order_by/password/order/'.$order, 'password'),
        );


        return $headers;
    }

}

?>
