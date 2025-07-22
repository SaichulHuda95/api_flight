<?php

Flight::route('GET /', function () {
    Flight::json([
        'response_code' => '00',
        'response_message' => 'API ready'
    ]);
});
