<?php
if (isset($_SESSION['sebagai'])) {
  if ($_SESSION['sebagai'] == 'petugas') {
    header("Location: DashboardPetugas/index.php");
    exit;
  }
}
// Start the session first
session_start();
// Check if 'nama' is set in the session, if not, redirect to the login page
if (!isset($_SESSION['username'])) {
  header("Location: ../admin.php");
  exit();
}

require "../../config/config.php";
$peminjaman = queryReadData("SELECT peminjaman.id AS peminjaman_id,
buku.cover AS cover,
buku.id_buku AS id_buku, 
buku.judul AS judul,
member.nisn AS nisn, 
member.nama AS nama, 
user.username AS username,
user.no_tlp AS no_tlp,
peminjaman.harga AS harga,
peminjaman.tgl_pinjam AS tgl_pinjam,
peminjaman.tgl_kembali AS tgl_kembali,
peminjaman.status AS status
FROM peminjaman
INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
INNER JOIN member ON peminjaman.nisn = member.nisn
INNER JOIN user ON peminjaman.id_user = user.id
order by peminjaman.status ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Book Store Digital</title>
  <link rel="icon" href="../../assets/bookstore.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <!-- Custom fonts for this template -->
  <link href="../../assets2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../assets2/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../../assets2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <div class="sticky-top">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="peminjaman.php">
          <div class="image">
            <img src="../../assets/bookstore.png" class="m-2 img-circle" alt="User Image" width="50px">
          </div>
          <div class="sidebar-brand-text">BSD</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="../index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="../kategori/kategori.php">
            <i class="fas fa-bars"></i>
            <span>Kategori</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item active">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-address-card"></i>
            <span>Pengguna</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded ">
              <a class="collapse-item" href="../akun/akun.php">Daftar Akun</a>
              <a class="collapse-item" href="../member/member.php">Daftar Member</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-book"></i>
            <span>Buku</span>
          </a>
          <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="../buku/buku.php">Daftar Buku</a>
              <a class="collapse-item active" href="peminjaman.php">Daftar Peminjaman</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="../signOut.php">
            <i class="fa-solid fa-right-to-bracket"></i>
            <span>Logout</span></a>
        </li>

    </ul>
    <!-- End of Sidebar -->

    <?php
    // Mendapatkan tanggal dan waktu saat ini
    $date = date('Y-m-d H:i:s'); // Format tanggal dan waktu default (tahun-bulan-tanggal jam:menit:detik)
    // Mendapatkan hari dalam format teks (e.g., Senin, Selasa, ...)
    $day = date('l');
    // Mendapatkan tanggal dalam format 1 hingga 31
    $dayOfMonth = date('d');
    // Mendapatkan bulan dalam format teks (e.g., Januari, Februari, ...)
    $month = date('F');
    // Mendapatkan tahun dalam format 4 digit (e.g., 2023)
    $year = date('Y');
    ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <h5 class="mt-1 mx-3 fw-bold"><span class="fs-5 text-secondary">
              <?php echo $day . ", " . $dayOfMonth . " " . " " . $month . " " . $year; ?>
            </span></h5>
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img src="../../assets/user.png" alt="memberLogo" width="40px">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item text-center text-secondary" href="#"> <span class="text-capitalize">
                    <?php echo $_SESSION['nama']; ?>
                  </span></a>
                <a class="dropdown-item text-center mb-2" href="#">Admin</a>
                <div class="dropdown-divider"></div>

                <a class="dropdown-item text-center p-2 bg-danger text-light rounded" href="../signOut.php">Logout <i
                    class="fa-solid fa-right-to-bracket"></i></a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Peminjaman</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th>No</th>
                      <th>Cover</th>
                      <th>Judul Buku</th>
                      <th>NISN</th>
                      <th>Nama</th>
                      <th>Nama Petugas</th>
                      <th>No. Telepon</th>
                      <th>Harga</th>
                      <th>Tgl. Pinjam</th>
                      <th>Tgl. Selesai</th>
                      <th>Status</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1; // Nomor urut dimulai dari 1
                    $totalHarga = 0; // Inisialisasi total harga
                    
                    if (isset($peminjaman) && is_array($peminjaman) && count($peminjaman) > 0) {
                      foreach ($peminjaman as $item):
                        // Menghapus karakter non-angka seperti "Rp." dan "."
                        $hargaBuku = floatval(preg_replace("/[^0-9]/", "", $item['harga']));
                        $totalHarga += $hargaBuku; // Menambahkan harga buku ke total
                        ?>
                        <tr>
                          <td align="center">
                            <?php echo $no++ ?>
                          </td>
                          <td>
                            <img src="../../imgDB/<?= $item['cover']; ?>" alt="" width="70px" height="100px"
                              style="border-radius: 5px;">
                          </td>
                          <td>
                            <?= $item["judul"]; ?>
                          </td>
                          <td align="center">
                            <?= $item["nisn"]; ?>
                          </td>
                          <td align="center">
                            <?= $item["nama"]; ?>
                          </td>
                          <td align="center">
                            <?= $item["username"]; ?>
                          </td>
                          <td align="center">
                            <?= $item["no_tlp"]; ?>
                          </td>
                          <td align="center">
                            <?= $item["harga"]; ?>
                          </td>
                          <td align="center">
                            <?= $item["tgl_pinjam"]; ?>
                          </td>
                          <td align="center">
                            <?= $item["tgl_kembali"]; ?>
                          </td>
                          <td align="center"><?php
                            $statusClass = '';
                            if ($item['status'] == 0) {
                              $statusText = 'Menunggu Persetujuan';
                              $statusClass = 'text-warning';
                            } elseif ($item['status'] == 1) {
                              $statusText = 'Telah Disetujui';
                              $statusClass = 'text-primary';
                            } elseif ($item['status'] == 2) {
                              $statusText = 'Tidak Disetujui';
                              $statusClass = 'text-danger';
                            } else {
                              $statusText = 'Telah Dinonaktifkan';
                              $statusClass = 'text-secondary';
                            }
                            ?>
                          <span class="<?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                        </td>
                        </tr>
                      <?php endforeach;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <strong>Total Harga: </strong>
                Rp.
                <?= number_format($totalHarga, 0, ',', '.'); ?>
              </div>
            </div>
          </div>

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../../assets2/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets2/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets2/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../assets2/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../assets2/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../assets2/js/demo/datatables-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>

</body>

</html>