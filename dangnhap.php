<html>

<head>
    <meta charset="utf-8">
    <title>Đăng nhập thư viện</title>
    <link rel="stylesheet" href="trangchu.css">
    <link rel="icon" type="image/x-icon" href="anh/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body id="body">
    <?php
    session_start();
    $Surname = "";
    $Nhappassword = "";
    include 'connect.php';
    $conn = openconnection();
    if ($conn->connect_error) {
        echo "<p class = 'zz'>Không thể kết nối được MySQL</p>";
    }
    // mysqli_select_db($conn, "");
    if (!mysqli_select_db($conn, "Perfume")) {
        echo "<p class='zz'>Không thể chọn được cơ sở dữ liệu</p>";
        exit();
    }

    if (isset($_POST["btnDangNhap"])) {
        $Surname = $_POST['txtSurname'];
        $Nhappassword = $_POST['txtNhappassword'];

        $query = "SELECT TENDANGNHAP, PHANQUYEN FROM NGUOIDUNG WHERE TENDANGNHAP='$Surname' AND MATKHAU='$Nhappassword'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <= 0) {
            echo "<p class = 'zz'>Tên đăng nhập hoặc mật khẩu không đúng.</p>";
        } else {
            echo "<p class = 'zz'>Đăng nhập thành công.</p>";
            $row = mysqli_fetch_assoc($result);

            // Lưu thông tin vào session
            $_SESSION['username'] = $row['TENDANGNHAP'];
            $_SESSION['phanquyen'] = $row['PHANQUYEN'];

            header("Location: trangchu.php");
        }
    }
    ?>

    <?php
    include 'header.php';
    ?>
    <?php
    include 'nav.php';

    ?>
    <?php
    include 'aside.php';
    ?>
    <article class="login">
        <form action="dangnhap.php" class="Q2" method="post">
            <table class="A5">
                <tr>
                    <td>
                        <h1 class="qq" style="padding: 30px;font-size: 35px;">Đăng Nhập</h1>
                    </td>
                </tr>
                <tr class="form-group">
                    <td class="ee"><i class="fa-regular fa-user" padding-top: 10px></i>
                        <input name="txtSurname" type="text" class="form-input" placeholder="Tên Đăng Nhập">
                    </td>
                </tr>
                <tr class="form-group">
                    <td class="ee"><i class="fa-solid fa-lock" padding-top: 10px></i>
                        <input name="txtNhappassword" type="password" class="form-input form-password" placeholder="Mật Khẩu">
                    </td>
                    <!-- <i class="fa-regular fa-eye"></i> -->
                </tr>
                <tr>
                    <td class="form-btn">
                        <!-- <a name="btnDangNhap" class="form-submit"> -->
                        <!-- Đăng Nhập -->
                        <input name="btnDangNhap" type="submit" value="Đăng Nhập" class="form-submit">
                        <!-- </a>     -->
                        <!-- <a href="dangky.php" class="form-submit">
                            Tạo tài khoản -->
                        <input type="submit" value="Tạo tài khoản" class="form-submit">
                        <!-- </a> -->
                    </td>
                </tr>
            </table>
        </form>
    </article>
    <?php
    include 'footer.php';
    ?>
</body>

</html>

<style>
    .login {
        margin: 0 0%;
        width: 100%;
    }

    .Q2 {
        min-height: 50vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 500px;
        margin-right: 500px;
        height: auto;
    }

    i {
        padding-top: 0px;
    }

    table.A5 {
        width: 100%;
        background: #815854;
        padding: 30px 30px 40px;
        border-radius: 10px;
        border: none;
        box-shadow: 0px 0px 17px 2px white;
    }

    tr {
        width: 100%;
    }

    .qq {
        text-align: center;
        color: #F9EBDE;
    }

    .form-group {
        color: #fff;
        font-size: 14px;
        padding-top: 5px;
        padding-right: 10px;
        width: 100%;
    }

    .form-submit {
        background: transparent;
        border: 1px solid #fcfcfc;
        color: #fff;
        width: 100%;
        text-transform: uppercase;
        padding: 6PX 30px;
        transition: 0.25s ease-in-out;
        border-radius: 5px;
        margin: 0 5px;
    }

    .ee {
        display: flex;
        margin-bottom: 10px;
        align-items: center;

    }

    i {
        margin: 5px;
    }

    .form-input {
        width: 95%;
        background: transparent;
        border: 1px;
        border-bottom: 1px solid white;
        color: #fff;
    }

    .form-submit:hover {
        border-color: #1fff1f;

    }

    .form-password {
        width: 95%;
    }

    .form-btn {
        display: flex;
    }

    .form-btn a {
        text-align: center;
    }

    .form-btn a:first-child {
        margin-right: 50px;
    }
</style>