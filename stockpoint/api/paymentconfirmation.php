<?php

function get($param) {
    $i = 0;
    $models = mage::getModel('konfirmasipembayaran/konfirmasipembayaran')->getCollection();
    foreach ($models->getData() as $data) {
        $result[$i]['id'] = $data['id'];
        $result[$i]['no_order'] = $data['no_order'];
        $result[$i]['bank_buyer'] = $data['bank_buyer'];
        $result[$i]['bank_merchant'] = $data['bank_merchant'];
        $result[$i]['metode_transfer'] = $data['metode_transfer'];
        $result[$i]['nama_buyer'] = $data['nama_buyer'];
        $result[$i]['no_rek_buyer'] = $data['no_rek_buyer'];
        $result[$i]['tanggal_transfer'] = $data['tanggal_transfer'];
        $result[$i]['created_time'] = $data['created_time'];
        $result[$i]['update_time'] = $data['update_time'];
        $result[$i]['email_buyer'] = $data['email_buyer'];
        $result[$i]['jumlah_transfer'] = $data['jumlah_transfer'];
$i++;
    }

    success('success', $result);
}

function post($param, $post) {
    _post('id', 'konfirmasipembayaran/konfirmasipembayaran', $post);
}

function delete($param) {
    _delete('id', $param, 'konfirmasipembayaran/konfirmasipembayaran');
}
