<?php
require "../../config/config.php";

$member = queryReadData("SELECT * FROM user where id");

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <!-- Custom fonts for this template -->
  <link href="../../assets2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="akun.php">
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
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-address-card"></i>
            <span>Pengguna</span>
          </a>
          <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded ">
              <a class="collapse-item active" href="akun.php">Daftar Akun</a>
              <a class="collapse-item" href="../member/member.php">Daftar Member</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-book"></i>
            <span>Buku</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="../buku/buku.php">Daftar Buku</a>
              <a class="collapse-item" href="../peminjaman/peminjaman.php">Daftar Peminjaman</a>
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

          <h5 class="mt-1 mx-3 fw-bold"><span class="fs-5 text-secondary"> <?php echo $day . ", " . $dayOfMonth . " " . " " . $month . " " . $year; ?> </span></h5>
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="../../assets/user.png" alt="memberLogo" width="40px">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item text-center text-secondary" href="#"> <span class="text-capitalize"><?php echo $_SESSION['nama']; ?></span></a>
                <a class="dropdown-item text-center mb-2" href="#">Admin</a>
                <div class="dropdown-divider"></div>

                <a class="dropdown-item text-center p-2 bg-danger text-light rounded" href="../signOut.php">Logout <i class="fa-solid fa-right-to-bracket"></i></a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->

          <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-primary col-md-2"><span class="glyphicon glyphicon-plus"></span><i class="fas fa-plus mr-2"></i>Tambah Akun</button>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Akun</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th>No</th>
                      <th>Username</th>
                      <th>Nama</th>
                      <th>No.Telepon</th>
                      <th>Sebagai</th>
                      <th>Aksi</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($member as $item) :
                      $id = $item['id'];
                    ?>
                      <tr>
                        <td align="center"><?php echo $no++ ?></td>
                        <td align="center"><?php echo $item['username'] ?></td>
                        <td align="center"><?php echo $item['nama'] ?></td>
                        <td align="center"><?php echo $item['no_tlp'] ?></td>
                        <td align="center"><?php echo $item['sebagai'] ?></td>
                        <td align="center">
                          <a title="edit" data-toggle="modal" data-target="#edit<?= $id; ?>" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                          <a title="hapus" data-toggle="modal" data-target="#del<?= $id; ?>" class="btn btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>&nbsp;
                        </td>
                      </tr>

                      <!-- The Modal -->
                      <div class="modal fade" id="edit<?= $id; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form method="post">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Akun - <?= $item['username']; ?></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">

                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" class="form-control" value="<?= $item['username']; ?>">

                                <label for="nama">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control" value="<?= $item['nama'] ?>" ;>

                                <label for="password">Password</label>
                                <input type="text" id="password" name="password" class="form-control" value="<?= $item['password']; ?>">

                                <label for="no_tlp">No.Telepon</label>
                                <input type="text" id="no_tlp" name="no_tlp" class="form-control" value="<?= $item['no_tlp']; ?>">
                                
                                <label>Sebagai</label>
                                <select name="sebagai" class="form-control" required>
                                  <option value="">Pilih Sebagai</option>
                                  <option value="admin">admin</option>
                                  <option value="petugas">petugas</option>
                                </select>
                                <input type="hidden" name="id" value="<?= $id; ?>">

                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-times mr-2"></i>Close</button>
                                <button type="submit" class="btn btn-sm btn-primary" name="update"><i class="fa fa-plus mr-2"></i>Save</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <!-- The Modal -->
                      <div class="modal fade" id="del<?= $id; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form method="post">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Hapus Akun - <?= $item['username']; ?></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                                Apakah Anda yakin ingin menghapus Akun ini?
                                <input type="hidden" name="id" value="<?= $id; ?>">
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success" name="hapus">Hapus</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                    <?php endforeach; ?>

                    <?php
                    if (isset($_POST['user'])) {
                      $username = $_POST['username'];
                      $password = $_POST['password'];
                      $nama = $_POST['nama'];
                      $sebagai = $_POST['sebagai'];
                      $no_tlp = $_POST['no_tlp'];

                      // Check if the username already exists
                      $checkQuery = mysqli_query($connection, "SELECT * FROM user WHERE username = '$username'");
                      if (mysqli_num_rows($checkQuery) > 0) {
                        echo "<div class='alert alert-warning'>
                    <strong>Failed!</strong> Username already exists. Redirecting you back in 1 second.
                  </div>";
                        echo "<meta http-equiv='refresh' content='1; url= akun.php'/>";
                        exit; // Stop further execution
                      }

                      // If the username is unique, proceed with the insert
                      $insertQuery = mysqli_query($connection, "INSERT INTO user VALUES('', '$username', '$password', '$nama', '$sebagai', '$no_tlp')");
                      if ($insertQuery) {
                        echo "<div class='alert alert-success'>
                    <strong>Success!</strong> Redirecting you back in 1 second.
                  </div>";
                      }

                      echo "<meta http-equiv='refresh' content='1; url= akun.php'/>";
                    };

                    if (isset($_POST['update'])) {
                      $id = $_POST['id'];
                      $username = $_POST['username'];
                      $nama = $_POST['nama'];
                      $password = $_POST['password'];
                      $sebagai = $_POST['sebagai'];
                      $no_tlp = $_POST['no_tlp'];

                      $updatedata = mysqli_query($connection, "update user set username='$username', nama='$nama', password='$password', sebagai='$sebagai', no_tlp='$no_tlp' where id='$id'");

                      //cek apakah berhasil
                      if ($updatedata) {

                        echo " <div class='alert alert-success'>
                              <strong>Success!</strong> Redirecting you back in 1 seconds.
                            </div>
                          <meta http-equiv='refresh' content='1; url= akun.php'/>  ";
                      } else {
                        echo "<div class='alert alert-warning'>
                              <strong>Failed!</strong> Redirecting you back in 1 seconds.
                            </div>
                           <meta http-equiv='refresh' content='1; url= akun.php'/> ";
                      }
                    };

                    if (isset($_POST['hapus'])) {
                      $id = $_POST['id'];

                      $delete = mysqli_query($connection, "delete from user where id='$id'");
                      if ($delete) {

                        echo " <div class='alert alert-success'>
                              <strong>Success!</strong> Redirecting you back in 1 seconds.
                          </div>
                          <meta http-equiv='refresh' content='1; url= akun.php'/>  ";
                      } else {
                        echo "<div class='alert alert-warning'>
                              <strong>Failed!</strong> Redirecting you back in 1 seconds.
                          </div>
                          <meta http-equiv='refresh' content='1; url= akun.php'/> ";
                      }
                    };
                    ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <!-- modal input -->
          <div id="myModal" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Akun Baru</h4>
                </div>
                <div class="modal-body">
                  <form method="POST">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" name="username" id="username" required="required" placeholder="Username" autocomplete="off" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" name="nama" id="nama" required="required" placeholder="Nama" autocomplete="off" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="text" name="password" id="password" required="required" placeholder="Password" autocomplete="off" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="no_tlp">No.Telepon</label>
                      <input type="number" name="no_tlp" id="no_tlp" required="required" placeholder="No.Telepon" autocomplete="off" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Sebagai</label>
                      <select name="sebagai" class="form-control" required>
                        <option value="">Pilih Sebagai</option>
                        <option value="admin">admin</option>
                        <option value="petugas">petugas</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-sm btn-primary" name="user"><i class="fa fa-plus"></i> Tambah</button>
                      <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Reset</button>
                      <a href="akun.php" class="btn btn-sm btn-secondary"><i class="fa fa-reply"></i> Kembali</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

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

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>