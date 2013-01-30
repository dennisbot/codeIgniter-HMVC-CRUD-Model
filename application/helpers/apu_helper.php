<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    function p($a) {
        echo '<pre>';
        print_r($a);
        echo '</pre>';
    }

    function v($a) {
        echo '<pre>';
        var_dump($a);
        echo '</pre>';
    }

    function IsNullOrEmptyString($question) {

        return (!isset($question) || trim($question) === '');
    }

    function elimina_comas($data) {
        $posicoma = strrpos($data, ',');
        $data = substr($data, 0, $posicoma);
        $tags = explode(',', $data);
        return $tags;
    }

    function a_url_amigable($str = '') {

        $friendlyURL = htmlentities($str, ENT_COMPAT, "UTF-8", false);
        $friendlyURL = preg_replace('/&([a-z]{1,2})(?:acute|lig|grave|ring|tilde|uml|cedil|caron);/i', '\1', $friendlyURL);
        $friendlyURL = html_entity_decode($friendlyURL, ENT_COMPAT, "UTF-8");
        $friendlyURL = preg_replace('/[^a-z0-9-]+/i', '-', $friendlyURL);
        $friendlyURL = preg_replace('/-+/', '-', $friendlyURL);
        $friendlyURL = trim($friendlyURL, '-');
        $friendlyURL = strtolower($friendlyURL);
        return $friendlyURL;

    }

    function obtener_tiempo_gmt($nro){
        return gmdate("d-m-Y H:i:s", time() + 3600*$nro);
    }

    //obtener fecha gmt -5
    function obtener_gmt($time, $nro){
        return gmdate("d-m-Y H:i:s", $time + 3600*$nro);
    }

    //obtener fecha gmt -5 para calendar
    function obtener_gmt_calendar($time, $nro){
        return gmdate("Y-m-d H:i:s", $time + 3600*$nro);
    }

    //obtener hora gmt -5 para calendar
    function obtener_gmt_hora($time, $nro){
        return gmdate("H:i:s", $time + 3600*$nro);
    }

    //generacion de md5 para proteger pass
    function generar_md5($string)
    {
        $salt = "8kaW1cNqdqclNojmrlAZ1borBfEAqDdquN250PMtZDkpkbP4OEif4eIP8jW8JKF";
        return md5($string.$salt);
    }

    //generacion de codigo de activacion
    function generar_codigo_activacion()
    {
        //return @MD5(uniqid(""));
        return @md5(uniqid(rand(), true));
    }

        function generar_nombre_foto()
    {
        //return @MD5(uniqid(""));
        return 'foto_' . substr(@md5(uniqid(rand(), true)), 0, 16);
    }
    function generar_nombre_evento()
    {
        //return @MD5(uniqid(""));
        return 'evento_' . substr(@md5(uniqid(rand(), true)), 0, 16);
    }
    //generacion password para el pass perdido
    function generar_password()
    {
        $salt = "OEf5eZEmPMtpz2B";
        return substr(sha1(uniqid(rand(), false).$salt), 20, 12);
    }


    /*
     * variables generales
     */
    if ( ! function_exists('base_path'))
    {
        function base_path()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_path');
        }
    }

    /*
     * Bootstrap Assets
     */
    if ( ! function_exists('bootstrap_css'))
    {
        function bootstrap_css()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('bootstrap_css');
        }
    }

    if ( ! function_exists('bootstrap_img'))
    {
        function bootstrap_img()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('bootstrap_img');
        }
    }

    if ( ! function_exists('bootstrap_js'))
    {
        function bootstrap_js()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('bootstrap_js');
        }
    }

    /*
     * Font Awesome Assets
    */
    if ( ! function_exists('font_awesome_css'))
    {
        function font_awesome_css()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('font_awesome_css');
        }
    }

    /*
     * Apueventos Assets
    */
    if ( ! function_exists('base_css'))
    {
        function base_css()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_css');
        }
    }

    if ( ! function_exists('base_img'))
    {
        function base_img()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_img');
        }
    }

    if ( ! function_exists('base_js'))
    {
        function base_js()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_js');
        }
    }

    if ( ! function_exists('base_jquery'))
    {
        function base_jquery()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_jquery');
        }
    }

    if ( ! function_exists('public_url'))
    {
        function public_url()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('public_url');
        }
    }

    if ( ! function_exists('base_url_foto_evento'))
    {
        function base_url_foto_evento()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_url_foto_evento');
        }
    }

    if ( ! function_exists('base_url_foto_user'))
    {
        function base_url_foto_user()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_url_foto_user');
        }
    }


        if ( ! function_exists('base_url_foto_temp'))
    {
        function base_url_foto_temp()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_url_foto_temp');
        }
    }

    if ( ! function_exists('base_path_foto_evento'))
    {
        function base_path_foto_evento()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_path_foto_evento');
        }
    }

    if ( ! function_exists('base_path_foto_user'))
    {
        function base_path_foto_user()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_path_foto_user');
        }
    }

        if ( ! function_exists('base_path_foto_temp'))
    {
        function base_path_foto_temp()
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_path_foto_temp');
        }
    }
        /*
     * Configuraci�n del paginador
    */
    function paginador($url_base, $total_filas, $filas_x_pagina, $links, $uri)
    {
        $config['base_url'] = $url_base;
        $config['total_rows'] = $total_filas;
        $config['per_page'] = $filas_x_pagina;
        $config['num_links'] = $links;
        $config['uri_segment'] = $uri;
        $config['first_link'] = "<<";
        $config['last_link'] = ">>";
        $config['next_link'] = ">";
        $config['prev_link'] = "<";
        $config['cur_tag_open'] = "<span class='current'>";
        $config['cur_tag_close'] = "</span>";
        return $config;
    }

    function save_image_from_url($in_path, $out_path)
    {
        $in = fopen($in_path, "rb");
        $out = fopen(base_path_foto_user().$out_path, "wb");
        while ($chunk = fread($in, 8192))
        {
            fwrite($out, $chunk, 8192);
        }
        fclose($in);
        fclose($out);
    }