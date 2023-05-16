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
if (!function_exists('formatRupiah')) {
    function formatRupiah($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}
if (!function_exists('getNumberFromRupiah')) {
    function getNumberFromRupiah($rupiah)
    {
        $regex = '/-?Rp\s?([\d.,]+)/';
        if (preg_match($regex, $rupiah, $matches)) {
            $formattedNumber = str_replace(['.', ','], '', $matches[1]);
            return (float) $formattedNumber;
        }
        return null;
    }
}
if (!function_exists('generateInvoice')) {
    function generateInvoice()
    {
        $ci = &get_instance();
        $prefix = "INV";
        $counter = $ci->db->get('transaksi')->num_rows() + 1;
        $padding = 5;
        $year = null;
        $year = $year ?? date('Y');
        $formattedCounter = str_pad($counter, $padding, '0', STR_PAD_LEFT);
        return $year . '/' . $prefix . '/' . $formattedCounter;
    }
}
