<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_products_table extends CI_Model {

    public function get_table_headers() {

        $order = (uri_assoc('order')) == 'asc' ? 'desc' : 'asc';

        $headers = array(
        'id' => anchor('products/index/order_by/id/order/'.$order, 'id'),
        'name' => anchor('products/index/order_by/name/order/'.$order, 'name'),
        'shortdesc' => anchor('products/index/order_by/shortdesc/order/'.$order, 'shortdesc'),
        'longdesc' => anchor('products/index/order_by/longdesc/order/'.$order, 'longdesc'),
        'thumbnail' => anchor('products/index/order_by/thumbnail/order/'.$order, 'thumbnail'),
        'image' => anchor('products/index/order_by/image/order/'.$order, 'image'),
        'grouping' => anchor('products/index/order_by/grouping/order/'.$order, 'grouping'),
        'status' => anchor('products/index/order_by/status/order/'.$order, 'status'),
        'category_id' => anchor('products/index/order_by/category_id/order/'.$order, 'category_id'),
        'featured' => anchor('products/index/order_by/featured/order/'.$order, 'featured'),
        'price' => anchor('products/index/order_by/price/order/'.$order, 'price'),
        );


        return $headers;
    }

}

?>
