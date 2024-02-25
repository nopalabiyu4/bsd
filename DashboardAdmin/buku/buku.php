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

include "../../config/config.php";
$kategori = queryReadData("SELECT * FROM kategori_buku");
$databuku = queryReadData("SELECT * FROM buku order by id_buku desc");
$query = mysqli_query($connection, "SELECT max(id_buku) as kodeTerbesar FROM buku");
$dataid = mysqli_fetch_array($query);
$kodebuku = $dataid['kodeTerbesar'];
$urutan = (int) substr($kodebuku, -4, 4);
$urutan++;
$huruf = "KB";
$kodebuku = $huruf . sprintf("%04s", $urutan);

if (isset($_POST["tambah"])) {

    if (tambahBuku($_POST) > 0) {
        echo "<script>alert('Data berhasil ditambah.');window.location='buku.php';</script>";
    } else {
        echo "<script>
      alert('Data buku gagal ditambahkan!');
      </script>";
    }
}

if (isset($_POST["edit"])) {

    if (updateBuku($_POST) > 0) {
        echo "<script>alert('Data berhasil diubah.');window.location='buku.php';</script>";
    } else {
        echo "<script>
      alert('Data buku gagal diubah!');
      </script>";
    }
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
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="buku.php">
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
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
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
                <li class="nav-item active">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-book"></i>
                        <span>Buku</span>
                    </a>
                    <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item active" href="buku.php">Daftar Buku</a>
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="../../assets/user.png" alt="memberLogo" width="40px">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item text-center text-secondary" href="#"> <span
                                        class="text-capitalize">
                                        <?php echo $_SESSION['nama']; ?>
                                    </span></a>
                                <a class="dropdown-item text-center mb-2" href="#">Admin</a>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item text-center p-2 bg-danger text-light rounded"
                                    href="../signOut.php">Logout <i class="fa-solid fa-right-to-bracket"></i></a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <button style="margin-bottom:20px" type="button" class="btn btn-primary col-md-2"
                        data-bs-toggle="modal" data-bs-target="#myModal"><span
                            class="glyphicon glyphicon-plus"></span><i class="fas fa-plus mr-2"></i>Tambah Buku</button>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Buku</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Cover</th>
                                            <th>ID Buku</th>
                                            <th>Judul</th>
                                            <th>Pengarang</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($databuku as $item):
                                            $id_buku = $item['id_buku'];
                                            ?>


                                            <tr>
                                                <td align="center">
                                                    <?php echo $no++ ?>
                                                </td>
                                                <td><img src="../../imgDB/<?= $item["cover"]; ?>" class="card-img-top"
                                                        alt="coverBuku"
                                                        style="width: 75px; height: 88px; aspect-ratio: 6/10;"></td>
                                                <td align="center">
                                                    <?php echo $item['id_buku'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $item['judul'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $item['pengarang'] ?>
                                                </td>
                                                <td align="center">
                                                    <a title="detail" class="btn btn-primary"
                                                        href="detail_buku.php?id=<?= $item['id_buku']; ?>"><i
                                                            class="fas fa-eye"></i></a>
                                                    <a title="edit" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#myModalEdit<?= $id_buku; ?>"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a title="hapus" class="btn btn-danger"
                                                        href="deleteBuku.php?id=<?= $item['id_buku']; ?>"
                                                        onclick="return confirm('Anda yakin akan menghapus data ini?')"><i
                                                            class="fas fa-trash"></i></a>&nbsp;
                                                </td>
                                            </tr>


                                            <!-- The Modal -->
                                            <div class="modal" id="myModalEdit<?= $id_buku; ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="" method="post" enctype="multipart/form-data"
                                                            class="mt-3 p-2">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Form Edit Buku -
                                                                    <?= $item['judul']; ?>
                                                                </h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="custom-css-form">
                                                                    <div class="mb-3">
                                                                        <input type="hidden" name="coverLama"
                                                                            value="<?= $item["cover"]; ?>">
                                                                        <img src="../../imgDB/<?= $item["cover"]; ?>"
                                                                            width="80px" height="80px">
                                                                        <label for="formFileMultiple"
                                                                            class="form-label">Cover Buku</label>
                                                                        <input class="form-control" type="file" name="cover"
                                                                            id="formFileMultiple">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="exampleFormControlInput1"
                                                                            class="form-label">Id Buku</label>
                                                                        <input type="text" class="form-control"
                                                                            name="id_buku" id="id_buku"
                                                                            value="<?= $item['id_buku']; ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="input-group mb-3">
                                                                    <label class="input-group-text"
                                                                        for="inputGroupSelect01">Kategori</label>
                                                                    <select class="form-select" id="kategori"
                                                                        name="kategori" value="">
                                                                        <option selected>
                                                                            <?= $item["kategori"]; ?>
                                                                        </option>
                                                                        <?php foreach ($kategori as $p): ?>
                                                                            <option value="<?= $p['kategori']; ?>">
                                                                                <?= $p["kategori"]; ?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="exampleFormControlInput1"
                                                                        class="form-label">Judul Buku</label>
                                                                    <input type="text" class="form-control" name="judul"
                                                                        id="judul" value="<?= $item['judul']; ?>">
                                                                </div>


                                                                <div class="mb-3">
                                                                    <label for="exampleFormControlInput1"
                                                                        class="form-label">Pengarang</label>
                                                                    <input type="text" class="form-control" name="pengarang"
                                                                        id="pengarang" value="<?= $item['pengarang']; ?>">
                                                                </div>




                                                                <div class="mb-3">
                                                                    <label for="exampleFormControlInput1"
                                                                        class="form-label">Penerbit</label>
                                                                    <input type="text" class="form-control" name="penerbit"
                                                                        id="penerbit" value="<?= $item['penerbit']; ?>">
                                                                </div>

                                                                <label for="validationCustom01" class="form-label">Tahun
                                                                    Terbit</label>
                                                                <div class="input-group mt-0">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="fa-solid fa-calendar-days"></i></span>
                                                                    <input type="date" class="form-control"
                                                                        name="thn_terbit" id="thn_terbit"
                                                                        value="<?= $item['thn_terbit']; ?>">
                                                                </div>

                                                                <label for="validationCustom01" class="form-label">Jumlah
                                                                    Halaman</label>
                                                                <div class="input-group mt-0">
                                                                    <span class="input-group-text" id="basic-addon1"><i
                                                                            class="fa-solid fa-book-open"></i></span>
                                                                    <input type="number" class="form-control"
                                                                        name="jml_halaman" id="jml_halaman"
                                                                        value="<?= $item['jml_halaman']; ?>">
                                                                </div>

                                                                <div class="form-floating mt-3 mb-3">
                                                                    <textarea class="form-control"
                                                                        placeholder="sinopsis tentang buku ini"
                                                                        name="deskripsi" id="deskripsi"
                                                                        style="height: 100px"></textarea>
                                                                    <label for="floatingTextarea2">Deskripsi</label>
                                                                </div>

                                                                <div class="custom-css-form">



                                                                    <button class="btn btn-success" type="submit"
                                                                        name="edit">Edit</button>
                                                                    <input type="reset" class="btn btn-warning text-light"
                                                                        value="Reset">
                                                                </div>

                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Script to redirect after form submission -->
                                                <script>
                                                    // Assuming your form has an id attribute, for example, "myForm"
                                                    document.getElementById('myForm').addEventListener('submit', function () {
                                                        alert('Data buku berhasil ditambahkan');
                                                        // Redirect to 'buku.php' after successful form submission
                                                        window.location.href = '../buku.php';
                                                    });
                                                </script>

                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php endforeach; ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- modal input -->
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data" class="mt-3 p-2">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Form Tambah Buku</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="custom-css-form">
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Cover Buku</label>
                                <input class="form-control" type="file" name="cover" id="cover" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Id Buku</label>
                                <input type="text" class="form-control" name="id_buku" id="id_buku"
                                    value="<?= $kodebuku; ?>" readonly>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori">
                                <option selected>Choose</option>
                                <?php foreach ($kategori as $item): ?>
                                    <option>
                                        <?= $item["kategori"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-book"></i></span>
                            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Buku"
                                aria-label="Username" aria-describedby="basic-addon1" required>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Pengarang</label>
                            <input type="text" class="form-control" name="pengarang" id="pengarang"
                                placeholder="Pengarang" required>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" id="penerbit"
                                placeholder="Penerbit" required>
                        </div>

                        <label for="validationCustom01" class="form-label">Tahun Terbit</label>
                        <div class="input-group mt-0">
                            <span class="input-group-text" id="basic-addon1"><i
                                    class="fa-solid fa-calendar-days"></i></span>
                            <input type="date" class="form-control" name="thn_terbit" id="thn_terbit" required>
                        </div>

                        <label for="validationCustom01" class="form-label">Jumlah Halaman</label>
                        <div class="input-group mt-0">
                            <span class="input-group-text" id="basic-addon1"><i
                                    class="fa-solid fa-book-open"></i></span>
                            <input type="number" class="form-control" name="jml_halaman" id="jml_halaman" required>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <textarea class="form-control" placeholder="sinopsis tentang buku ini" name="deskripsi"
                                id="deskripsi" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Deskripsi</label>
                        </div>

                        <div class="custom-css-form">
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Isi Buku</label>
                                <input class="form-control" type="file" name="isi_buku" id="isi_buku" required>
                            </div>


                            <button class="btn btn-success" type="submit" name="tambah">Tambah</button>
                            <input type="reset" class="btn btn-warning text-light" value="Reset">
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                </form>

                <!-- Script to redirect after form submission -->
                <script>
                    // Assuming your form has an id attribute, for example, "myForm"
                    document.getElementById('myForm').addEventListener('submit', function () {
                        alert('Data buku berhasil ditambahkan');
                        // Redirect to 'buku.php' after successful form submission
                        window.location.href = '../buku.php';
                    });
                </script>

            </div>
        </div>
    </div>
    </div>



    <!-- End of Main Content -->

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
    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('content').classList.toggle('active');
        });
    </script>
</body>

</html>