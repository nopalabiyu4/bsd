<?php
// Start the session
session_start();

// Check if 'nama' is set in the session, if not, redirect to the login page
if (!isset($_SESSION['nama'])) {
  header("Location: ../../login.php");
  exit();
}

if (!isset($_SESSION['nisn'])) {
  header("Location: ../../login.php");
  exit();
}

require "../../config/config.php";
// Tangkap id buku dari URL (GET)
$idBuku = $_GET["id"];
$query = queryReadData("SELECT * FROM buku WHERE id_buku = '$idBuku'");
//Menampilkan data siswa yg sedang login
$nisnSiswa = $_SESSION['nisn'];
$dataSiswa = queryReadData("SELECT * FROM member WHERE nisn = $nisnSiswa");
$admin = queryReadData("SELECT * FROM user where sebagai='petugas'");

// Peminjaman 
if (isset($_POST["pinjam"])) {

  if (pinjamBuku($_POST) > 0) {
    echo "<script>
    alert('Buku berhasil dipinjam');
    document.location.href = 'daftar_pinjam.php';
    </script>";
  } else {
    echo "<script>
    alert('Buku gagal dipinjam!');
    </script>";
  }
} ?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <title>Book Store Digital</title>
  <link rel="icon" href="../../assets/bookstore.png" type="image/png">
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

<body>
  <!-- Topbar -->
  <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand me-0 mx-3" href="../dashboard.php">
        <img src="../../assets/bookstore.png" alt="Avatar Logo" style="width:50px;">
      </a>
      <a class="navbar-brand" href="../dashboard.php"
        style="font-family: 'Shadows Into Light', cursive; font-size: 150%;">Book Store Digital</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="../dashboard.php">Daftar Buku</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="daftar_pinjam.php">Daftar Pinjam</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="history.php">History</a>
          </li>
        </ul>
      </div>

      <div class="dropdown ms-auto" data-bs-theme="primary">
        <a href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="../../assets/user.png" alt="memberLogo" width="40px">
        </a>
        <ul style="margin-left: -7rem;" class="dropdown-menu position-absolute">
          <li>
            <a class="dropdown-item text-center text-secondary" href="#"> <span class="text-capitalize">
                <?php echo $_SESSION['nama']; ?>
              </span></a>
            <a class="dropdown-item text-center mb-2" href="#">Siswa</a>
          </li>
          <li>
            <a class="dropdown-item text-center p-2 bg-danger text-light rounded" href="../logout.php">Logout <i
                class="fa-solid fa-right-to-bracket"></i></a>
          </li>
        </ul>
      </div>
    </div>

  </nav>
  <!-- End of Topbar -->

  <div class="container-xxl p-4 my-0">
    <div class="">
      <div class="alert alert-primary" role="alert">Form Peminjaman Buku</div>
      <!-- Default box -->
      <div class="card mb-auto">
        <h5 class="card-header">Data lengkap Buku</h5>
        <div class="row" style="padding: 10px;">
          <?php foreach ($query as $item): ?>
            <!-- img -->
            <div class="col-md-3 d-flex justify-content-center mb-3">
              <img src="../../imgDB/<?= $item["cover"]; ?>"
                style="width: 225px; aspect-ratio: 8/12; border-radius: 10px;">
            </div>
            <!-- description -->
            <div class="col-md-9 col-12" style="width: 100%;">
              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">ID Buku</span>
                    <input type="text" class="form-control" placeholder="id buku" aria-label="Username"
                      aria-describedby="basic-addon1" value="<?= $item["id_buku"]; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Kategori</span>
                    <input type="text" class="form-control" placeholder="kategori" aria-label="kategori"
                      aria-describedby="basic-addon1" value="<?= $item["kategori"]; ?>" readonly>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Judul</span>
                <input type="text" class="form-control" placeholder="judul" aria-label="judul"
                  aria-describedby="basic-addon1" value="<?= $item["judul"]; ?>" readonly>
              </div>

              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Pengarang</span>
                    <input type="text" class="form-control" placeholder="pengarang" aria-label="pengarang"
                      aria-describedby="basic-addon1" value="<?= $item["pengarang"]; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Penerbit</span>
                    <input type="text" class="form-control" placeholder="penerbit" aria-label="penerbit"
                      aria-describedby="basic-addon1" value="<?= $item["penerbit"]; ?>" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Tahun Terbit</span>
                    <input type="date" class="form-control" placeholder="tahun_terbit" aria-label="tahun_terbit"
                      aria-describedby="basic-addon1" value="<?= $item["thn_terbit"]; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Jumlah Halaman</span>
                    <input type="number" class="form-control" placeholder="jumlah halaman" aria-label="jumlah halaman"
                      aria-describedby="basic-addon1" value="<?= $item["jml_halaman"]; ?>" readonly>
                  </div>
                </div>
              </div>

              <div class="form-floating">
                <textarea class="form-control" placeholder="deskripsi singkat buku" id="floatingTextarea2"
                  style="height: 100px" readonly><?= $item["deskripsi"]; ?></textarea>
                <label for="floatingTextarea2">Deskripsi Buku</label>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="card mt-4">
          <h5 class="card-header">Data lengkap Siswa</h5>
          <div class="card-body d-flex flex-wrap gap-4 justify-content-center">
            <p><img src="../../assets/user.png" width="150px"></p>
            <form action="" method="post" class="w-100">
              <?php foreach ($dataSiswa as $item): ?>

                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">NISN</span>
                      <input type="number" class="form-control" placeholder="nisn" aria-label="nisn"
                        aria-describedby="basic-addon1" value="<?= $item["nisn"]; ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">Nama</span>
                      <input type="text" class="form-control" placeholder="nama" aria-label="nama"
                        aria-describedby="basic-addon1" value="<?= $item["nama"]; ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">Kelas</span>
                      <input type="text" class="form-control" placeholder="kelas" aria-label="kelas"
                        aria-describedby="basic-addon1" value="<?= $item["kelas"]; ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">Jurusan</span>
                      <input type="text" class="form-control" placeholder="jurusan" aria-label="jurusan"
                        aria-describedby="basic-addon1" value="<?= $item["jurusan"]; ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">Alamat</span>
                  <input type="text" class="form-control" placeholder="no tlp" aria-label="no tlp"
                    aria-describedby="basic-addon1" value="<?= $item["alamat"]; ?>" readonly>
                </div>
              <?php endforeach; ?>
            </form>
          </div>
        </div>

        <div class="alert alert-danger mt-4" role="alert">Silahkan periksa kembali data diatas, pastikan sudah benar
          sebelum meminjam buku! jika ada kesalahan data harap hubungi petugas.</div>

        <div class="card mt-4">
          <h5 class="card-header">Form Pinjam Buku</h5>
          <div class="card-body">
            <form action="" method="post">
              <!--Ambil data id buku-->
              <?php foreach ($query as $item): ?>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">Id Buku</span>
                  <input type="text" name="id_buku" class="form-control" placeholder="id buku" aria-label="id_buku"
                    aria-describedby="basic-addon1" value="<?= $item["id_buku"]; ?>" readonly>
                </div>
              <?php endforeach; ?>
              <!-- Ambil data NISN user yang login-->
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">NISN</span>
                <input type="number" name="nisn" class="form-control" placeholder="nisn" aria-label="nisn"
                  aria-describedby="basic-addon1" value="<?php echo htmlentities($_SESSION["nisn"]); ?>" readonly>
              </div>
              <!--Ambil data id admin-->
              <select name="id_user" id="id_user" class="form-select" aria-label="Default select example"
                placeholder="chosse" required>
                <option value="" selected disabled>Pilih Nama Petugas</option>
                <?php foreach ($admin as $item): ?>
                  <option value="<?= $item["id"]; ?>">
                    <?= $item["username"]; ?>
                  </option>
                <?php endforeach;
                $sekarang = date("Y-m-d");
                ?>
              </select>
              <div class="input-group mb-3 mt-3">
                <span class="input-group-text" id="basic-addon1">Telepon Petugas</span>
                <input type="number" name="no_tlp" id="no_tlp" class="form-control" placeholder="No. Telepon"
                  aria-label="No. Telepon" aria-describedby="basic-addon1" readonly>
              </div>
              <div class="input-group mb-3 mt-1">
                <select class="form-select" aria-label="Default select example" name="paket" id="paket"
                  onchange="setReturnDate()">
                  <option disabled selected>Pilih Paketan</option>
                  <option value="">Non Paket</option>
                  <option value="1">Paket 1</option>
                  <option value="2">Paket 2</option>
                  <option value="3">Paket 3</option>
                </select>
              </div>
              <div class="row">
                <div class="col-md-4 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group">Tanggal Pinjam</span>
                    <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" value="<?= $sekarang; ?>"
                      placeholder="tgl_pinjam" aria-label="tgl_pinjam" onchange="setReturnDate()" required>
                  </div>
                </div>
                <div class="col-md-4 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group">Tanggal Akhir Peminjaman</span>
                    <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control"
                      placeholder="tgl_kembali" aria-label="tgl_kembali" required>
                  </div>
                </div>
                <div class="col-md-4 col-12">
                  <div class="input-group mb-3">
                    <span class="input-group">Harga</span>
                    <input type="text" name="harga" onchange="setPrice()" class="form-control" placeholder="harga"
                      aria-label="harga" aria-describedby="basic-addon1" readonly>
                  </div>
                </div>
              </div>
              <a class="btn btn-danger" href="daftarBuku.php"> Batal</a>
              <button type="submit" class="btn btn-success" name="pinjam">Pinjam</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script>
    function setReturnDate() {
      const tglpinjam = document.getElementById('tgl_pinjam');
      const tglkembali = document.getElementById('tgl_kembali');
      const currentDate = new Date();
      let returnDate = new Date();

      const selectedPackage = document.getElementById('paket').value;
      let daysToAdd = 1; // Default return date if no package is selected

      // Adjust days to add based on the selected package
      switch (selectedPackage) {
        case "1":
          daysToAdd = 5; // Change to the duration of Paket 1
          break;
        case "2":
          daysToAdd = 7; // Change to the duration of Paket 2
          break;
        case "3":
          daysToAdd = 10; // Change to the duration of Paket 3
          break;
        default:
          daysToAdd = 1; // Default return date if no package is selected
      }

      returnDate.setDate(currentDate.getDate() + daysToAdd);

      // Format tanggal untuk input HTML
      const formattedReturnDate = returnDate.toISOString().split('T')[0];
      tglkembali.value = formattedReturnDate;

      setPrice(); // Call setPrice() after setting return date

      // Enable or disable tgl_kembali input based on whether a package is selected
      if (selectedPackage === "") {
        tglkembali.removeAttribute('readonly');
        tglpinjam.removeAttribute('readonly');
      } else {
        tglkembali.setAttribute('readonly', 'readonly');
        tglpinjam.setAttribute('readonly', 'readonly');
      }

    }


    function setPrice() {
      const priceInput = document.getElementsByName('harga')[0];
      const isPackageSelected = document.getElementById('paket').value !== ""; // Check if a package is selected

      // Get the selected dates
      const tglPinjam = new Date(document.getElementById('tgl_pinjam').value);
      const tglKembali = new Date(document.getElementById('tgl_kembali').value);

      // Get the difference in days between tgl_pinjam and tgl_kembali
      const diffTime = Math.abs(tglKembali - tglPinjam);
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

      let pricePerDay;

      if (isPackageSelected) {
        // Adjust price calculation based on package selection
        const selectedPackage = parseInt(document.getElementById('paket').value);
        // Assuming different packages have different prices
        // You can set prices based on the selected package
        // Here, we are just setting some arbitrary values
        switch (selectedPackage) {
          case 1:
            pricePerDay = 1000; // Price for Paket 1
            break;
          case 2:
            pricePerDay = 900; // Price for Paket 2
            break;
          case 3:
            pricePerDay = 800; // Price for Paket 3
            break;
          default:
            pricePerDay = 1250; // Default price if no package selected
        }
      } else {
        // If no package is selected, set default price per day
        pricePerDay = 1250; // Default price per day for non-package
      }

      // Calculate total price
      const totalPrice = diffDays * pricePerDay;
      priceInput.value = "Rp. " + totalPrice.toLocaleString('id-ID');
    }

    // Fungsi untuk mengatur tanggal pinjam dengan hari ini
    function setTodayDate() {
      const todayDateInput = document.getElementById('tgl_pinjam');
      const currentDate = new Date();

      // Format tanggal untuk input HTML
      const formattedTodayDate = currentDate.toISOString().split('T')[0];
      todayDateInput.value = formattedTodayDate;

      setReturnDate(); // Call setReturnDate() after setting today's date
    }

    // Panggil fungsi setTodayDate saat halaman dimuat
    window.onload = function () {
      setTodayDate();
    };

    // Panggil setPrice() saat tgl_pinjam atau tgl_kembali berubah
    document.getElementById('tgl_pinjam').addEventListener('change', setPrice);
    document.getElementById('tgl_kembali').addEventListener('change', setPrice);

    // Validasi tanggal tenggat pengembalian
    document.getElementById('tgl_kembali').addEventListener('change', function () {
      var tglPinjam = document.getElementById('tgl_pinjam').value;
      var tglPengembalian = this.value;

      // Bandingkan tanggal tenggat pengembalian dengan tanggal pinjam
      if (tglPengembalian <= tglPinjam) {
        alert('Tanggal tenggat pengembalian tidak boleh sebelum atau sama dengan tanggal pinjam');
        this.value = '';
      }
    });
    var adminData = <?php echo json_encode($admin); ?>;

    document.getElementById('id_user').addEventListener('change', function () {
      var id_user = this.value;

      for (var i = 0; i < adminData.length; i++) {
        if (adminData[i].id === id_user) { // Assuming 'id' is the correct property to match
          document.getElementById('no_tlp').value = adminData[i].no_tlp;
          break;
        }
      }
    });
  </script>

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

</body>

</html>
