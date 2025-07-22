<?php
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
