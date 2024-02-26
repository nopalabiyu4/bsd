<?php
require "config/config.php";
// Pagination
$itemsPerPage = 4;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;
// query read semua buku
$buku = queryReadData("SELECT * FROM buku order by id_buku DESC LIMIT $offset, $itemsPerPage");
//search buku
if (isset($_POST["search"])) {
  $buku = search($_POST["keyword"]);
}

// Query to get the total number of books
$totalItems = queryReadData("SELECT COUNT(*) AS total FROM buku")[0]['total'];
$totalPages = ceil($totalItems / $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
  <title>Book Store Digital</title>
  <link rel="icon" href="assets/bookstore.png" type="image/png">
  <!-- Custom fonts for this template -->
  <link href="assets2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="assets2/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="assets2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<style media="screen">
  header {
    background-image: url('assets/tokobuku.jpeg');
    /* Replace with your image URL */
    background-size: cover;
    background-position: center;
    height: 50vh;
    /* Full viewport height */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    text-align: center;
  }

  body {
    display: block;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background-image: url(assets/background.jpg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
  }

  h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
  }

  .layout-card-custom {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1rem;
  }

  /* vertical-center */
  .vertical-center {
    min-height: 100%;
    /* Fallback for browsers do NOT support vh unit */
    min-height: 100vh;
    /* These two lines are counted as one :-)       */

    display: flex;
    align-items: center;
  }

  /* thumbnail */
  #wrapThumbnail {
    height: 350px;
    overflow: hidden;
    position: relative;
  }

  #thumbnailCard {
    background-color: rgba(0, 0, 0, 0.7);
    position: absolute;
    top: 0px;
    height: 100%;
    width: 100%;
    text-align: center;
    padding-top: 70%;
    color: white;
    font-size: 20px;
  }

  #thumbnailCard span {
    display: block;
  }

  #thumbnailCard a {
    text-decoration: none;
    color: white;
    display: block;
    width: 100px;
    margin: 0 auto;
    border: 1px solid white;
    padding: 5px;
  }

  #thumbnailCard a:hover {
    background-color: white;
    color: black;
  }

  #wrapThumbnail #thumbnailCard {
    display: none;
  }

  #wrapThumbnail img {
    width: 100%;
    height: auto;
  }

  #wrapThumbnail:hover #thumbnailCard {
    display: block;
  }
</style>

<body>
  <!-- Topbar -->

  <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand me-0 mx-3" href="index.php">
        <img src="assets/bookstore.png" alt="Avatar Logo" style="width:50px;">
      </a>
      <a class="navbar-brand" href="index.php"
        style="font-family: 'Shadows Into Light', cursive; font-size: 150%;">Book Store Digital</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="register.php">Register</a>
          </li>
        </ul>
      </div>
  </nav>
  <!--Btn filter data kategori buku-->
  <div class="d-flex gap-2 mt-3 justify-content-center">
    <div class="container-fluid">
      <header>
        <h1>Selamat datang di Book Store Digital!</h1>
      </header>
    </div>
  </div>
  <!-- End of Topbar -->
  <section id="homeSection">
    <div class="d-flex flex-wrap justify-content-center">
      <form action="" method="post" class="mt-3 mx-3 d-block col-md-5">
        <div class="input-group">
          <input class="form-control me-2" type="search" name="keyword" id="keyword"
            placeholder="cari judul atau kategori..." aria-label="Search">
          <button class="btn btn-primary" type="submit" name="search">Search</button>
        </div>
      </form>
    </div>
    <!--Card buku-->
    <div class="layout-card-custom mt-3">
      <?php foreach ($buku as $item): ?>
        <div class="card" style="width: 12rem;">
          <div class="card border-0 mb-8"
            style="background-color:rgb(255,255,255);box-shadow: 0px 0px 11px 3px rgba(0,0,0,0.07);overflow:hidden;">
            <div id="wrapThumbnail">
              <img src="imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku"
                style="width: 200px; aspect-ratio: 1/2;">

              <div id="thumbnailCard">
                <h6 class="card-title">
                  <?= $item["judul"]; ?>
                </h6>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                  data-bs-target="#cek<?= $item["id_buku"]; ?>">Cek Buku</button>
              </div>
            </div>
            <div class="card-body">
              <h5 class="card-text style=" overflow: hidden; white-space: nowrap; text-overflow: ellipsis;>
                <?php echo (str_word_count($item["judul"]) > 3 ? substr($item["judul"], 0, 25) . "..." : $item["judul"]) ?>
              </h5>
              <center>
                <li class="list-group-item">Kategori :
                  <?= $item["kategori"]; ?>
                </li>
              </center>
            </div>
          </div>
        </div>

        <!-- modal-product -->
        <div id="cek<?= $item["id_buku"]; ?>" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
          aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal">
            <div class="modal-content">
              <div class="modal-body">
                <div class="row">
                  <div class="col-5">
                    <!-- gambar -->
                    <img src="imgDB/<?= $item["cover"]; ?>" class="img-thumbnail" alt="coverBuku" height="300px">
                  </div>
                  <div class="col-7 pl-3">
                    <!-- deskripsi -->
                    <div class="dropdown-divider"></div>
                    <h3 class="pt-1 pb-1">
                      <?= $item["judul"]; ?>
                    </h3>
                    <div class="dropdown-divider"></div>
                    <h5 class="pt-1 pb-1" style="margin: 0;">Kategori :
                      <?= $item["kategori"]; ?>
                    </h5>
                    <div class="dropdown-divider"></div>
                    <p class="pt-1 pb-1" style="margin: 0;">Deskripsi :
                      <?= $item["deskripsi"]; ?>
                    </p>
                  </div>
                  <a href="login.php"></a>
                  <div class="modal-footer">
                    <a href="index.php" class="btn btn-danger">Batal</a>
                    <a href="login.php" class="btn btn-success">Pinjam</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <!-- Pagination links -->
    <div class="d-flex justify-content-center mt-3">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
              <a class="page-link" href="?page=<?php echo $i; ?>">
                <?php echo $i; ?>
              </a>
            </li>
          <?php endfor; ?>
        </ul>
      </nav>
    </div>
    </div>
    </div>
  </section>


  <footer id="footer" class="p-3 bg-primary mt-2">
    <center>
      <div class="container">
        <div class="row p-3">
          <div class="col-md-4 mt-2">
            <h3 class="text-black fs-5">Alamat</h3>
            <p class="text-black fs-6">JL Budi Utomo Pasar Baru jakarta pusat</p>
          </div>
          <div class="col-md-4 mt-1">
            <h3 class="text-black fs-5">Media Sosial</h3>
            <div class="d-flex justify-content-center">
              <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
              <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-github"></i></a>
              <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-whatsapp"></i></a>
              <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-instagram"></i></a>
            </div>
          </div>
          <div class="col-md-4 mt-3">
            <h3 class="text-black fs-5">Telepon</h3>
            <p class="text-black fs-6">0821-2596-6966</p>
          </div>
        </div>
      </div>
    </center>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

  <!-- Bootstrap core JavaScript-->
  <script src="assets2/vendor/jquery/jquery.min.js"></script>
  <script src="assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets2/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets2/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="assets2/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets2/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="assets2/js/demo/datatables-demo.js"></script>

</body>

</html>
