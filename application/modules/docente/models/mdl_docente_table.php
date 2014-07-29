<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_docente_table extends CI_Model
{
    public function get_table_headers()
    {

        $order = (uri_assoc('order')) == 'asc' ? 'desc' : 'asc';

        $headers = array(
        'docente_id' => anchor('docente/index/order_by/docente_id/order/'.$order, 'docente_id'),
        'paterno' => anchor('docente/index/order_by/paterno/order/'.$order, 'paterno'),
        'materno' => anchor('docente/index/order_by/materno/order/'.$order, 'materno'),
        'nombres' => anchor('docente/index/order_by/nombres/order/'.$order, 'nombres'),
        'dni' => anchor('docente/index/order_by/dni/order/'.$order, 'dni'),
        'telefono' => anchor('docente/index/order_by/telefono/order/'.$order, 'telefono'),
        'direccion' => anchor('docente/index/order_by/direccion/order/'.$order, 'direccion'),
        'tipo_docente' => anchor('docente/index/order_by/tipo_docente/order/'.$order, 'tipo_docente'),
        'email' => anchor('docente/index/order_by/email/order/'.$order, 'email'),
        'sexo' => anchor('docente/index/order_by/sexo/order/'.$order, 'sexo'),
        );


        return $headers;
    }
}

?>
