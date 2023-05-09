<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('template_view')) {
    function template_view($path_view = null, $data = [])
    {
        $ci = &get_instance();
        $ci->load->view('template/header', $data);
        if (isset($path_view)) {
            $ci->load->view($path_view);
        }
        $ci->load->view('template/footer');
    }
}
