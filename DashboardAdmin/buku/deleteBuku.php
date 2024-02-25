<?php
require "../../config/config.php";

$bukuId = $_GET["id"];
if(deleteBuku($bukuId) > 0) {
    echo "<script>
    alert('Buku berhasil dihapus!');
    document.location.href = 'buku.php';
    </script>";
  }else {
    echo "<script>
    alert('Buku gagal dihapus!');
    document.location.href = 'buku.php';
    </script>";
}
?>