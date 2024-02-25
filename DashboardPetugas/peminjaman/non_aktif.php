<?php

include '../../config/config.php';

    $statusArray = [0, 1, 2];
    $statusString = implode(',', $statusArray);  // Mengubah array menjadi string terpisah koma
    // Mendapatkan waktu saat ini
    $currentDate = date('Y-m-d');

    // Mengupdate status peminjaman yang sudah melewati tanggal akhir
    $sql = "UPDATE peminjaman SET status='3' WHERE tgl_kembali < '$currentDate' AND status IN ($statusString)";

    if ($connection->query($sql) === TRUE) {
        echo '<script>alert("Peminjaman berhasil dinonaktifkan."); window.location.href="peminjaman.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }