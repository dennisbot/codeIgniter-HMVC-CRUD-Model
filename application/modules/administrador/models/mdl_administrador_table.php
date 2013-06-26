<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_administrador_table extends CI_Model {

    public function get_table_headers() {

        $order = (uri_assoc('order')) == 'asc' ? 'desc' : 'asc';

        $headers = array(
        'idadministrador' => anchor('administrador/index/order_by/idadministrador/order/'.$order, 'idadministrador'),
        'nombre' => anchor('administrador/index/order_by/nombre/order/'.$order, 'nombre'),
        'apellidos' => anchor('administrador/index/order_by/apellidos/order/'.$order, 'apellidos'),
        'email' => anchor('administrador/index/order_by/email/order/'.$order, 'email'),
        'clave' => anchor('administrador/index/order_by/clave/order/'.$order, 'clave'),
        'status' => anchor('administrador/index/order_by/status/order/'.$order, 'status'),
        'created_at' => anchor('administrador/index/order_by/created_at/order/'.$order, 'created_at'),
        'es_super' => anchor('administrador/index/order_by/es_super/order/'.$order, 'es_super'),
        'id_admin' => anchor('administrador/index/order_by/id_admin/order/'.$order, 'id_admin'),
        );


        return $headers;
    }

}

?>
