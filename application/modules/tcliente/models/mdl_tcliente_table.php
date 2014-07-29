<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_tcliente_table extends CI_Model
{
    public function get_table_headers()
    {

        $order = (uri_assoc('order')) == 'asc' ? 'desc' : 'asc';

        $headers = array(
        'CodCliente' => anchor('tcliente/index/order_by/CodCliente/order/'.$order, 'CodCliente'),
        'Nombres' => anchor('tcliente/index/order_by/Nombres/order/'.$order, 'Nombres'),
        'Direccion' => anchor('tcliente/index/order_by/Direccion/order/'.$order, 'Direccion'),
        'RUC' => anchor('tcliente/index/order_by/RUC/order/'.$order, 'RUC'),
        );


        return $headers;
    }
}

?>
