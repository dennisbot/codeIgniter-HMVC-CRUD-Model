<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class {model_name_table} extends CI_Model {

    public function get_table_headers() {

        $order = (uri_assoc('order')) == 'asc' ? 'desc' : 'asc';

        {headers}

        return $headers;
    }

}

?>
