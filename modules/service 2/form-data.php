<?php
//route untuk ambil data dari body request form-data
Flight::route('POST /form_data', function () {
    $data = Flight::request()->data;

    $kode = $data['kode_transaksi'];
    $nama = $data['nama_pelanggan'];

    $response = [
        'response_code' => '00',
        'response_message' => 'Data berhasil diterima',
        'data' => [
            'kode' => $kode,
            'nama' => $nama,
        ]
    ];

    Flight::json($response);
});
