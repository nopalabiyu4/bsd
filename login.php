<?php
session_start();
include "loginSystem/connect.php";
if (isset($_POST['nisn']) && isset($_POST['nama'])) {
    // Get user input
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];

    // Query to check user credentials
    $query = "SELECT * FROM member WHERE nisn='$nisn' AND nama='$nama'";
    $result = $connect->query($query);

    if ($result->num_rows == 1) {
        // Login successful
        $_SESSION['nama'] = $nama;
        $_SESSION['nisn'] = $nisn;
        header("Location: DashboardMember/dashboard.php"); // Redirect to dashboard or any other page
    } else {
        // Login failed
        echo "<script>alert('nis atau nama Anda salah. Silahkan coba lagi!')</script>";
    }
}
$connect->close();

?>
<!DOCTYPE html>
<html lang="en">
    
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
                        <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;">
                        </div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
                        <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
                        <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
                        <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;">
                        </div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
                        <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;">
                        </div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
                        <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
                        <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;">
                        </div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
                        <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;">
                        </div>
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
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" placeholder="Masukan Nama">
                                </div>
                                <div class="field padding-bottom--15">
                                    <label for="nisn">NISN</label>
                                    <input type="text" name="nisn" placeholder="Masukan NISN">
                                </div>
                                <div class="field field-checkbox padding-bottom--15 flex-flex align-center"></div>
                                <div class="field padding-bottom--15">
                                    <input type="submit" name="signIn" value="Continue">
                                </div>
                                <div class="field field-checkbox flex-flex align-center"></div>
                                <center>
                                    <div class="field padding-bottom--15">
                                        <a type="button" class="btn btn-link" href="index.php">Go Back</a>
                                    </div>
                                    <h5>Belum Punya Akun? <a href="register.php">Register</a></h5>
                                    <div class="field padding-bottom--15">
                                        <br>
                                        <h5><a href="admin.php">Anda Admin?</a></h5>
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
</body>

</html>
<!-- partial -->

</body>

</html>