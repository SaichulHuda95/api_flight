<?php
//route untuk ambil data dari body request json
Flight::route('POST /data_json', function () {
    $data = Flight::request()->data;

    $kode = $data->kode_transaksi;
    $nama = $data->nama_pelanggan;

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
