<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_servicio_table extends CI_Model {

    public function get_table_headers() {

        $order = (uri_assoc('order')) == 'asc' ? 'desc' : 'asc';

        $headers = array(
        'idproveedor' => anchor('servicio/index/order_by/idproveedor/order/'.$order, 'idproveedor'),
        'nombre' => anchor('servicio/index/order_by/nombre/order/'.$order, 'nombre'),
        'costo_confidencial' => anchor('servicio/index/order_by/costo_confidencial/order/'.$order, 'costo_confidencial'),
        'costo_base' => anchor('servicio/index/order_by/costo_base/order/'.$order, 'costo_base'),
        'indicador_costo' => anchor('servicio/index/order_by/indicador_costo/order/'.$order, 'indicador_costo'),
        'status' => anchor('servicio/index/order_by/status/order/'.$order, 'status'),
        );


        return $headers;
    }

}

?>
