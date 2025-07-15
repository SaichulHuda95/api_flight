<?php
require_once 'flight/Flight.php';
require_once 'config.php';

// Inject PDO ke Flight
Flight::set('pdo', $pdo);

// Route root
Flight::route('GET /', function () {
    echo 'Welcome to Flight PHP API!';
});

// Route insert_data (bulk insert 100K)
Flight::route('POST /insert_data', function () {
    $pdo = Flight::get('pdo');

    try {
        $statuses = ['pending', 'selesai', 'batal'];
        $start = microtime(true);

        $pdo->beginTransaction();

        $stmt_insert = $pdo->prepare("INSERT INTO transaksi (
            kode_transaksi, nama_pelanggan, total, status
        ) VALUES (
            :kode_transaksi, :nama_pelanggan, :total, :status
        )");

        for ($i = 1; $i <= 50000; $i++) {
            $kode = 'TRX' . str_pad($i, 8, '0', STR_PAD_LEFT);
            $nama = 'Pelanggan ' . $i;
            $total = rand(10000, 1000000);
            $status = $statuses[array_rand($statuses)];

            $stmt_insert->execute([
                ':kode_transaksi' => $kode,
                ':nama_pelanggan' => $nama,
                ':total' => $total,
                ':status' => $status
            ]);

            if ($i % 1000 == 0) {
                echo "Inserted $i records...<br>";
                flush(); // agar bisa tampil bertahap
            }
        }

        $pdo->commit();

        $end = microtime(true);
        echo "<br><strong>Selesai dalam " . round($end - $start, 2) . " detik</strong>";
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Error saat insert transaksi: " . $e->getMessage();
    }
});

// Route get_data (data 100K)
Flight::route('GET /get_data', function () {
    $pdo = Flight::get('pdo');

    try {
        $start = microtime(true);
        $stmt = $pdo->prepare("SELECT * FROM transaksi");
        $stmt->execute();
        $data_stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = array();
        $no = 1;
        foreach ($data_stmt as $row) {
            $data[] = [
                'no' => $no++,
                'kode_transaksi' => $row['kode_transaksi'],
                'nama_pelanggan' => $row['nama_pelanggan'],
                'total' => $row['total'],
                'status' => $row['status']
            ];
        }

        $end = microtime(true);
        $waktu = ($end - $start) . " detik\n";

        $response = [
            'response_code' => '00',
            'response_message' => 'success',
            'waktu' => $waktu,
            'data' => $data
        ];

        echo json_encode($response, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        echo "Error saat ambil data transaksi: " . $e->getMessage();
    }
});

// Route get data detail
Flight::route('GET /get_data_detail', function () {
    $pdo = Flight::get('pdo');
    $kode_transaksi = Flight::request()->query['kode_transaksi'];

    try {
        $start = microtime(true);
        $stmt = $pdo->prepare("SELECT * FROM transaksi WHERE kode_transaksi = :kode_transaksi");
        $stmt->execute([
            ':kode_transaksi' => $kode_transaksi
        ]);
        $data_stmt = $stmt->fetch(PDO::FETCH_ASSOC);

        $end = microtime(true);
        $waktu = ($end - $start) . " detik\n";

        if ($data_stmt) {
            $response = [
                'response_code' => '00',
                'response_message' => 'success',
                'waktu' => $waktu,
                'data' => $data_stmt
            ];
        } else {
            $response = [
                'response_code' => '00',
                'response_message' => 'success',
                'waktu' => $waktu,
                'data' => 'Data not found'
            ];
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        echo "Error saat ambil data transaksi: " . $e->getMessage();
    }
});

Flight::start();
