<?php

function isNavActive($path, $active = 'active') {
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function isCarouselItemActive($path, $active = 'active') {
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function presetPrice($total) {
    return 'Rp. '.number_format($total, 2);
}
