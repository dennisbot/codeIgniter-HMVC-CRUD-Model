<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function uri_assoc($var, $segment = 3) {

    $CI = & get_instance();

    $uri_assoc = $CI->uri->uri_to_assoc($segment);

    if (isset($uri_assoc[$var])) {

        return $uri_assoc[$var];
    } else {

        return NULL;
    }
}

function uri_page() {
    $CI = &get_instance();
    $segments = $CI->uri->segment_array();
    $tam = count($segments);
    foreach ($segments as $key => $value) {
        if ($value == "page") {
            if ($key == $tam)
                return 0;
            else
                return (int) $segments[$key + 1];
        }
    }
    return 0;
}

function uri_this_month() {
    $CI = &get_instance();
    $segments = $CI->uri->segment_array();
    foreach ($segments as $key => $value) {
        if (substr($value, 0, 1) == "f") {
            //yyyy-mm-dd
            if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{1,2}$/", substr($value, 2))
                    || preg_match("/^[0-9]{4}-[0-9]{2}$/", substr($value, 2)))
                return substr(substr($value, 2), 5, 2);
        }
    }
    return date("m");
}

function uri_this_year() {
    $CI = &get_instance();
    $segments = $CI->uri->segment_array();
    foreach ($segments as $key => $value) {
        if (substr($value, 0, 1) == "f") {
            //yyyy-mm-dd
            if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{1,2}$/", substr($value, 2))
                    || preg_match("/^[0-9]{4}-[0-9]{2}$/", substr($value, 2)))
                return substr(substr($value, 2), 0, 4);
        }
    }
    return date("Y");
}

function anchor_filter($new_segment = '', $new_name = '', $attributes = '') {
    $CI = & get_instance();
    //si viene de evento/filtro entonces estamos filtrando
    if (strpos($CI->uri->ruri_string(), "evento/filtro") != FALSE) {
        return anchor(build_segment($new_segment), $new_name, $attributes);
    }
    else
        return anchor("eventos/" . $new_segment, $new_name, $attributes);
}

function build_segment($new_segment = '') {
    $CI = & get_instance();
    $segment_built = "/eventos";
    $segments = $CI->uri->segment_array();
    $new = true;
    $filtro = array("c_", "f_", "t_", "p_", "i_", "q_");
    for ($i = 2; $i <= count($segments); $i++) {
        if (!in_array(substr($segments[$i], 0, 2), $filtro))
            continue;
        if (substr($segments[$i], 0, 1) == substr($new_segment, 0, 1)) {
            $segment_built .= '/' . $new_segment;
            $new = false;
        }
        else
            $segment_built .= '/' . $segments[$i];
    }
    if ($new && $new_segment != '')
        $segment_built .= '/' . $new_segment;
    return site_url($segment_built);
}

function build_segment_prev_next() {
    $CI = & get_instance();
    $segment_built = "/eventos/calendario-mes";
    $segments = $CI->uri->segment_array();
    //en este caso quitamos f_ porque si es prev next entonces hara append
    //en otra instancia de ese segmento (f_year_month)
    $filtro = array("c_", "t_", "p_", "i_", "q_");
    for ($i = 2; $i <= count($segments); $i++) {
        if (!in_array(substr($segments[$i], 0, 2), $filtro))
            continue;
        $segment_built .= '/' . $segments[$i];
    }
    return site_url($segment_built);
}

function retrieve_user_info_json() {
    /* esta tmb deberia funcionar pero a mi me devuelve 127.0.0.1
     * supongo que en produccion devolvera bien (falta probar)
     *  */
    //$ip = $_SERVER['REMOTE_ADDR'];
    $ip = '190.42.127.195';
    // remember chmod 0777 for folder 'cache'
    $file = "./cache/" . $ip;
    if (!file_exists($file)) {
        // request
        $json = file_get_contents("http://api.easyjquery.com/ips/?ip=" . $ip . "&full=true");
        $f = fopen($file, "w+");
        fwrite($f, $json);
        fclose($f);
    } else {
        $json = file_get_contents($file);
    }
    /* 2do parametro true para retornar como arreglo asociativo (es objeto por defecto)*/
    return json_decode($json, true);
}

?>