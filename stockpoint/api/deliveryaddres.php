<?php

function get($param) {
    _get('customer/address');
}

function post($param, $post) {
    _post('email', 'customer/customer', $post);
}

function delete($param) {
    _delete('email', $param, 'customer/customer');
}
