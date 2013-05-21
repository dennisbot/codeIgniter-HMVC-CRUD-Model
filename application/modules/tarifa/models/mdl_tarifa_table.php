<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_tarifa_table extends CI_Model {

    public function get_table_headers() {

        $order = (uri_assoc('order')) == 'asc' ? 'desc' : 'asc';

        $headers = array(
        'idtarifa' => anchor('tarifa/index/order_by/idtarifa/order/'.$order, 'idtarifa'),
        'porcentaje' => anchor('tarifa/index/order_by/porcentaje/order/'.$order, 'porcentaje'),
        'descripcion' => anchor('tarifa/index/order_by/descripcion/order/'.$order, 'descripcion'),
        );


        return $headers;
    }

}

?>
