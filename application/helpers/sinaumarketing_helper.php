<?php

function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    } else {
        $role = $ci->session->userdata('role');
        $menu = $ci->uri->segment(1);
        if (($role == 2 && $menu == 'guru')) {
            redirect('auth/block');
        }
    }
}
