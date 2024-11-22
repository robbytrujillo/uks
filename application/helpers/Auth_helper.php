<?php

defined('BASEPATH') OR exit ('No direct script access allowed');

function cek_login() {
    $CI =& get_instance();
    $email = $CI->session->email;

    if ($email == NULL) {
        $CI->session->set_flashdata('message', '<div class="alert alert-danger"> Anda harus Login dulu </div>');
        redirect('auth/login');
    }
}

function uksadmin() {
    $CI =& get_instance();

    $tipe_user = $CI->session->level_user;

    if ($tipe_user == '2') {
        return $tipe_user;
    }

    return null;
}