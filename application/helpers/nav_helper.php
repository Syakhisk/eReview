<?php

function navbartemp()
{
    $thiss = get_instance();
    $login = $thiss->session->userdata('logged_in');
    echo '<style>';
    echo 'body {background-color: white;}';
    echo 'a {text-decoration: none; font-weight: bold; font-family: arial;}';
    echo '</style>';

    echo '<a href="' . base_url('managemytask') . '"> ManageMyTask </a>';
    echo '<a href="' . base_url('accountctl') . '"> AccountCtl </a>';
    echo '<a href="' . base_url('editorctl') . '"> editorctl </a>';
    echo '<a href="' . base_url('reviewerctl') . '"> reviewerctl </a>';
    echo '<a href="' . base_url('makelaarctl') . '"> makelaarctl </a>';
    echo '   |   ';
    echo '<a href="' . base_url('managemytask/addnewtask') . '"> addNewTask </a>';
    echo '   |   ';
    echo '<a href="' . base_url('accountctl/login') . '"> Login </a>';
    echo '<a href="' . base_url('accountctl/logout') . '"> Logout </a>';
    echo '<a href="' . base_url('accountctl/createAccount') . '"> createAccount </a>';
    echo '   |   ';
    echo 'Logged as: ' . $login['username'] . '( ' . ' Role: ' . $login['nama_grup'] . ' )';
}
