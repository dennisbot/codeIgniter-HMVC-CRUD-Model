<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_empleados_table extends CI_Model {

    public function get_table_headers() {

        $order = (uri_assoc('order')) == 'asc' ? 'desc' : 'asc';

        $headers = array(
        '' => anchor('empleados/index/order_by//order/'.$order, ''),
        'idempleado' => anchor('empleados/index/order_by/idempleado/order/'.$order, 'idempleado'),
        'nombres' => anchor('empleados/index/order_by/nombres/order/'.$order, 'nombres'),
        'departamento' => anchor('empleados/index/order_by/departamento/order/'.$order, 'departamento'),
        'sueldo' => anchor('empleados/index/order_by/sueldo/order/'.$order, 'sueldo'),
        );


        return $headers;
    }

}

?>
