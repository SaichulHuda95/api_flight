<?php
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
