<?php
session_start();
include "loginSystem/connect.php";

if (isset($_SESSION['sebagai'])) {
  if ($_SESSION['sebagai'] == 'petugas') {
    header("Location: DashboardPetugas/index.php");
    exit;
  } elseif ($_SESSION['sebagai'] == 'admin') {
    header("Location: DashboardAdmin/index.php");
    exit;
  }
}


if (isset($_POST['btn-login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];


// Query to check user credentials
$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = $connect->query($query);

if (mysqli_num_rows($result) === 1) {
  $_SESSION['username'] = true;
  $rows = mysqli_fetch_assoc($result);
  if ($rows['sebagai'] == 'petugas') {
    $_SESSION['sebagai'] = $rows['sebagai'];
    $_SESSION['nama'] = $rows['nama'];
    $_SESSION['id'] = $rows['id'];
    // $_SESSION['id'] = $rows['password'];
    return header("Location: DashboardPetugas/index.php");

    if (isset($_SESSION['username'])) {
      header("Location: DashboardPetugas/index.php");
      exit;
    }
  } elseif ($rows['sebagai'] == 'admin') {
    $_SESSION['sebagai'] = $rows['sebagai'];
    $_SESSION['nama'] = $rows['nama'];
    $_SESSION['id'] = $rows['id'];
    // $_SESSION['id'] = $rows['password'];
    return header("Location: DashboardAdmin/index.php");


    if (isset($_SESSION['username'])) {
      header("Location: DashboardAdmin/index.php");
      exit;
    }
  }

} else {
    // Login failed
    echo "Invalid username or password";
}
}
$connect->close();
?>


<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store Digital</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" href="assets/bookstore.png" type="image/png">
        <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
    <body>
        <div class="login-root">
            <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
                <div class="loginbackground box-background--white padding-top--64">
                    <div class="loginbackground-gridContainer">
                        <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
                            <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
                            </div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
                            <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;"></div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
                            <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
                            <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
                            <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
                            <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
                            <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
                            <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
                            <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
                        </div>
                    </div>
                </div>
                <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
                    <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
                        <h1><a href="#" rel="dofollow">Book Store Digital</a></h1>
                    </div>
                    <div class="formbg-outer">
                        <div class="formbg">
                            <div class="formbg-inner padding-horizontal--48">
                                <span align="center" class="padding-bottom--15">Login Form</span>
                                <form method="POST" id="stripe-login">
                                    <div class="field padding-bottom--15">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" placeholder="Masukan Username">
                                    </div>
                                    <div class="field padding-bottom--15">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" placeholder="Masukan Password">
                                    </div>
                                    <div class="field field-checkbox padding-bottom--15 flex-flex align-center"></div>
                                    <div class="field padding-bottom--15">
                                        <input type="submit" name="btn-login" value="Continue">
                                    </div>
                                    <div class="field field-checkbox flex-flex align-center"></div>
                                    <center>
                                    <div class="field padding-bottom--15">
                                    <a type="button" class="btn btn-link" href="login.php">Go Back</a>
                                    </div>
                                    </center>
                                </form>
                            </div>
                        </div>
                        <div class="footer-link padding-top--24">
                            <div class="listing padding-top--24 padding-bottom--24 flex-flex center-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($error)) : ?>
    <div class="alert alert-danger mt-2" role="alert">Nama atau Password Salah!</div>
<?php endif; ?>
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
})();
  </script>
    </body>

    </html>
    <!-- partial -->

</body>

</html>
