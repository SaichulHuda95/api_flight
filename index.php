<?php
require_once 'flight/Flight.php';
require_once 'function.php';

Flight::route('GET /', function () {
    Flight::json([
        'response_code' => '00',
        'response_message' => 'API ready'
    ]);
});

// Route insert_data (bulk insert 100K)
Flight::route('POST /insert_data', function () {
    $result = insert_data();

    if ($result['success'] == true) {
        $response = [
            'response_code' => '00',
            'response_message' => 'success'
        ];

        Flight::json($response);
    } else {
        $response = [
            'response_code' => '99',
            'response_message' => $result['error']
        ];

        Flight::json($response, 500);
    }
});

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

// Route get_data (data 100K)
Flight::route('GET /get_data', function () {
    $result = get_all_data();

    if ($result['success'] == true) {
        $response = [
            'response_code' => '00',
            'response_message' => 'success',
            'data' => $result['data']
        ];

        Flight::json($response);
    } else {
        $response = [
            'response_code' => '99',
            'response_message' => $result['error']
        ];

        Flight::json($response, 500);
    }
});

// Route get data detail
Flight::route('GET /get_data_detail', function () {
    $data = Flight::request()->query;
    $kode_transaksi = $data['kode_transaksi'];

    $result = get_data_detail($kode_transaksi);

    if ($result['success'] == true) {
        $response = [
            'response_code' => '00',
            'response_message' => 'success',
            'data' => $result['data']
        ];

        Flight::json($response);
    } else {
        $response = [
            'response_code' => '99',
            'response_message' => $result['error']
        ];

        Flight::json($response, 500);
    }
});

Flight::start();
