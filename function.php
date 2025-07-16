<?php
require_once "config.php";

// Inject PDO ke Flight
Flight::set('pdo', $pdo);

function insert_data()
{
    $pdo = Flight::get('pdo');
    try {
        $statuses = ['pending', 'selesai', 'batal'];

        $pdo->beginTransaction();

        $stmt_insert = $pdo->prepare("INSERT INTO transaksi (
            kode_transaksi, nama_pelanggan, total, status
        ) VALUES (
            :kode_transaksi, :nama_pelanggan, :total, :status
        )");

        for ($i = 1; $i <= 1000; $i++) {
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
        }

        $pdo->commit();

        return [
            'success' => true
        ];
    } catch (PDOException $e) {
        return [
            'success' => false,
            'error' => $e->getMessage()
        ];
    }
}

function get_all_data()
{
    $pdo = Flight::get('pdo');

    try {
        $stmt = $pdo->prepare("SELECT * FROM transaksi LIMIT 1000");
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

        return [
            'success' => true,
            'data' => $data // atau null
        ];
    } catch (PDOException $e) {
        return [
            'success' => false,
            'error' => $e->getMessage()
        ];
    }
}

function get_data_detail($kode_transaksi)
{
    $pdo = Flight::get('pdo');

    try {
        $stmt = $pdo->prepare("SELECT * FROM transaksi WHERE kode_transaksi = :kode_transaksi LIMIT 1");
        $stmt->execute([
            ':kode_transaksi' => $kode_transaksi
        ]);
        $data_stmt = $stmt->fetch(PDO::FETCH_ASSOC);

        return [
            'success' => true,
            'data' => $data_stmt // atau null
        ];
    } catch (PDOException $e) {
        return [
            'success' => false,
            'error' => $e->getMessage()
        ];
    }
}
