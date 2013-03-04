<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_guia_table extends CI_Model {

    public function get_table_headers() {

        $order = (uri_assoc('order')) == 'asc' ? 'desc' : 'asc';

        $headers = array(
        'idguia' => anchor('guia/index/order_by/idguia/order/'.$order, 'idguia'),
        'tipo_documento' => anchor('guia/index/order_by/tipo_documento/order/'.$order, 'tipo_documento'),
        'documento' => anchor('guia/index/order_by/documento/order/'.$order, 'documento'),
        'nombres' => anchor('guia/index/order_by/nombres/order/'.$order, 'nombres'),
        'apellidos' => anchor('guia/index/order_by/apellidos/order/'.$order, 'apellidos'),
        'telefono' => anchor('guia/index/order_by/telefono/order/'.$order, 'telefono'),
        'proveedor_idproveedor' => anchor('guia/index/order_by/proveedor_idproveedor/order/'.$order, 'proveedor_idproveedor'),
        );


        return $headers;
    }

}

?>
