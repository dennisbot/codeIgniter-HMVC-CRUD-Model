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
    function toKeyValue($collection, $key, $value)
    {
        $array = array();
        foreach ($collection as $item) {
            $array[$item->$key] = $item->$value;
        }
        return $array;
    }
    function generar_params($from_tabla = '')
    {
        if ($from_tabla == '') die('no existe la tabla especificada');
        $CI  = & get_instance();
        $fields = $CI->db->query("show fields from $from_tabla");
        $campos = $fields->result();
        $handle = fopen($from_tabla . "_params.txt", "w");
        foreach ($campos as $key => $value) {
            $escribir = "\$params['p{$value->Field}'] = \$this->input->post('{$value->Field}');\n";
            fwrite($handle, $escribir);
        }
        fclose($handle);
        var_dump("escrito");
        exit;
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
    function generar_clave($salt, $input)
    {
        $at = strpos($input, '@');
        $toreverse = substr($input, 0, $at);
        return sha1($salt . strrev($toreverse));
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
    function generar_nombre_servicio()
    {
        //return @MD5(uniqid(""));
        return 'servicio_' . substr(@md5(uniqid(rand(), true)), 0, 16);
    }
    if (!function_exists('attrs')) {
        function attrs($params = '')
        {
            $CI = &get_instance();
            return $CI->config->item('language_attributes') . $params;
        }
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
        function base_path($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_path') . ltrim($uri, '/');
        }
    }
    if (!function_exists('file_uploader')) {
        function file_uploader($uri = '') {
            $CI = & get_instance();
            return $CI->config->slash_item('file_uploader') . ltrim($uri, '/');
        }
    }
    /*
     * Bootstrap Assets
     */
    if ( ! function_exists('bootstrap_css'))
    {
        function bootstrap_css($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('bootstrap_css') . ltrim($uri, '/');
        }
    }

    if ( ! function_exists('bootstrap_img'))
    {
        function bootstrap_img($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('bootstrap_img') . ltrim($uri, '/');
        }
    }

    if ( ! function_exists('bootstrap_js'))
    {
        function bootstrap_js($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('bootstrap_js') . ltrim($uri, '/');
        }
    }

    /*
     * Font Awesome Assets
    */
    if ( ! function_exists('font_awesome_css'))
    {
        function font_awesome_css($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('font_awesome_css') . ltrim($uri, '/');
        }
    }

    /*
     * Apuservicios Assets
    */
    if ( ! function_exists('base_css'))
    {
        function base_css($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_css') . ltrim($uri, '/');
        }
    }

    if ( ! function_exists('base_img'))
    {
        function base_img($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_img') . ltrim($uri, '/');
        }
    }

    if ( ! function_exists('base_js'))
    {
        function base_js($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_js') . ltrim($uri, '/');
        }
    }

    if ( ! function_exists('base_jquery'))
    {
        function base_jquery($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_jquery') . ltrim($uri, '/');
        }
    }

    if ( ! function_exists('public_url'))
    {
        function public_url($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('public_url') . ltrim($uri, '/');
        }
    }

    if ( ! function_exists('base_url_foto_servicio'))
    {
        function base_url_foto_servicio($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_url_foto_servicio') . ltrim($uri, '/');
        }
    }

    if ( ! function_exists('base_url_foto_servicio_thumb'))
    {
        function base_url_foto_servicio_thumb($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_url_foto_servicio_thumb') . ltrim($uri, '/');
        }
    }



        if ( ! function_exists('base_url_foto_temp'))
    {
        function base_url_foto_temp($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_url_foto_temp') . ltrim($uri, '/');
        }
    }

    if ( ! function_exists('base_path_foto_servicio'))
    {
        function base_path_foto_servicio($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_path_foto_servicio') . ltrim($uri, '/');
        }
    }
    if ( ! function_exists('base_path_foto_servicio_thumb'))
    {
        function base_path_foto_servicio_thumb($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_path_foto_servicio_thumb') . ltrim($uri, '/');
        }
    }

    if ( ! function_exists('base_path_foto_temp'))
    {
        function base_path_foto_temp($uri = '')
        {
            $CI =& get_instance();
            return $CI->config->slash_item('base_path_foto_temp') . ltrim($uri, '/');
        }
    }
    if (!function_exists('base_galeria')) {
        function base_galeria($uri = '') {
            $CI = & get_instance();
            return $CI->config->item('base_galeria') . ltrim($uri, '/');
        }
    }
    if ( ! function_exists('site_name')) {
        function site_name()
        {
            $CI = & get_instance();
            return $CI->config->item('site_name');
        }
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