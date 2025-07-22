<?php
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
