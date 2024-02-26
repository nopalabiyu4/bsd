<?php 
require "loginSystem/connect.php";
if(isset($_POST["signUp"]) ) {
  
  if(signUp($_POST) > 0) {
    echo "<script>
    alert('Sign Up berhasil!')
    document.location.href = 'login.php';
    </script>";
  }else {
    echo "<script>
    alert('Sign Up gagal!')
    </script>";
  }
  
}

?><!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Book Store Digital</title>
    <link rel="icon" href="assets/bookstore.png" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'><link rel="stylesheet" href="assets/style2.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="user-ragistration">
	<div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="assets/bookstore.png" alt=""/>
                <h3>Welcome</h3>
                <p>Silahkan Register jika belum punya akun!</p>
                <h6>Sudah Buat Akun? <a href="login.php">Login</a></h6>
            </div>
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Register Form</h3>
                        <form action="" method="POST">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">NISN
                                    <input type="number" name="nisn" class="form-control" placeholder="NISN" value="" required/>
                                </div>
                                <div class="form-group">Nama
                                    <input type="text" name="nama" class="form-control" placeholder="Nama" value="" required/>
                                </div>
                                <div class="form-group">Password
                                    <input type="password" name="password" class="form-control" placeholder="Password" value="" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">Kelas
                                    <select name="kelas" class="form-control" required>
                                        <option class="hidden" selected disabled>Pilih Kelas</option>
                                        <option value="X">X</option>
                                        <option value="XI">XI</option>
                                        <option value="XII">XII</option>
                                    </select>
                                </div>
                                <div class="form-group">Jurusan
                                    <select name="jurusan" class="form-control" required>
                                        <option class="hidden" selected disabled>Pilih Jurusan</option>
                                        <option value="Otomatisasi dan Tata Kelola Perkantoran">Otomatisasi dan Tata Kelola Perkantoran</option>
                                        <option value="Akuntansi dan Keuangan Lembaga">Akuntansi dan Keuangan Lembaga</option>
                                        <option value="Bisnis Daring dan Pemasaran">Bisnis Daring dan Pemasaran</option>
                                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                        <option value="Multimedia">Multimedia</option>
                                    </select>
                                </div>
                                <div class="form-group">Alamat
                                    <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="" required/>
                                </div>
                                <input type="submit" name="signUp" class="btnRegister" value="Register"/>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
  </script>
  
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js'></script>
</body>
</html>
