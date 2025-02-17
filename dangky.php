<html>

<head>
    <meta charset="utf-8">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="trangchu.css">
    <link rel="icon" type="image/x-icon" href="anh/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>

<body>
    <?php
    $Surname = "";
    $Nhappassword = "";
    $Nhaplaipassword = "";
    $gender = '';
    $Username = "";
    $Diachi = "";
    $Number = "";
    $Mail = "";
    include 'connect.php';
    $conn = openconnection();
    if ($conn->connect_error) {
        echo "<p class = 'zz'>Không thể kết nối được MySQL</p>";
    }
    mysqli_select_db($conn, "Perfume");

    if (isset($_POST["btnDangKy"])) {
        $Surname = $_POST['txtSurname'];
        $Nhappassword = $_POST['txtNhappassword'];
        $Nhaplaipassword = $_POST['txtNhaplaipassword'];
        $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '';
        $Username = $_POST['txtUsername'];
        $Diachi = $_POST['txtDiachi'];
        $Number = $_POST['txtNumber'];
        $Mail = $_POST['txtMail'];
        $kt = 1;
        if ($Nhappassword != $Nhaplaipassword) {
            echo "<p class = 'zz'>Bạn nhập lại mật khẩu chưa đúng</p>";
            $kt = 0;
        }
        if (empty($Surname) || empty($Nhappassword) || empty($Nhaplaipassword) || empty($Number) || empty($Username)) {
            echo "<p class = 'zz'>Bạn nhập những thông tin bắt buộc (*) chưa đầy đủ</p>";
            $kt = 0;
        }
        if (mysqli_num_rows(mysqli_query($conn, "SELECT TENDANGNHAP FROM NGUOIDUNG WHERE TENDANGNHAP='$Username'")) > 0) {
            echo "<p class = 'zz'>Tên đăng nhập đã có người dùng. Vui lòng chọ tên đăng nhập khác.</p>";
            $kt = 0;
        }
        if (mysqli_num_rows(mysqli_query($conn, "SELECT SODT FROM NGUOIDUNG WHERE SODT='$Number'")) > 0) {
            echo "<p class='zz'>Số điện thoại đã có người dùng. Vui lòng chọn số điện thoại khác.</p>";
            $kt = 0;
        }
        if ($kt == 1) {
            $nguoidung = "INSERT INTO NGUOIDUNG(TENDANGNHAP,MATKHAU,HOTEN,GIOITINH,DIACHI,SODT,EMAIL)
        VALUE('{$Surname}','$Nhappassword','$Username', '$gender','$Diachi','$Number','$Mail')";
            $results = mysqli_query($conn, $nguoidung) or die(mysqli_error($conn));

            echo "<p class='zz'>Bạn đã đăng ký thành công. Hãy đăng nhập trang web hoặc quay về trang chủ</p>";
        }
    } else {
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
    <article class="br" style="margin-top: 40px;">
        <form action="dangky.php" class="Q3" method="post">
            <table class="A5">
                <tr>
                    <td>
                        <h1 class="qq">Thông tin tài khoản</h1>
                    </td>
                </tr>
                <TR>
                    <td class="ha"> Tên đăng nhập*:
                        <input type="text" name="txtSurname" require="true" value="<?php echo $Surname ?>"><br>
                    </td>
                </TR>
                <tr>
                    <td class="ha"> Nhập password*:
                        <input type="password" name="txtNhappassword" require="true" value="<?php echo $Nhappassword ?>">
                    </td>
                </tr>
                <tr>
                    <td class="ha"> Nhập lại password*:
                        <input type="password" name="txtNhaplaipassword" require="true" value="<?php echo $Nhaplaipassword ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2 class="qq">Thông tin cá nhân</h2>
                    </td>
                </tr>
                <tr>
                    <td class="ha" style="display: block;">Họ Tên*:
                        <input type="text" name="txtUsername" require="true" value="<?php echo $Username ?>">
                    </td>
                </tr>
                <tr class="gioitinh">
                    <td class="ha">
                        <p style="margin: 0;">Giới tính*:</p>
                        <input type="radio" id="male" name="gender" style="width: 10%; display: inline;" value="Nam" <?= (isset($_POST['gender']) && $_POST['gender'] == 'Nam') ? 'checked' : '' ?>>
                        <label for="male">Nam</label>
                        <input type="radio" id="female" name="gender" style="width: 10%; display: inline;" value="Nữ" <?= (isset($_POST['gender']) && $_POST['gender'] == 'Nữ') ? 'checked' : '' ?>>
                        <label for="female">Nữ</label>
                    </td>
                </tr>
                <tr>
                    <td class="ha">Địa chỉ*:
                        <input type="text" name="txtDiachi" require="true" value="<?php echo $Diachi ?>">
                    </td>
                </tr>
                <tr>
                    <td class="ha"> Số điện thoại*:
                        <input type="text" name="txtNumber" require="true" value="<?php echo $Number ?>">
                    </td>
                </tr>
                <tr>
                    <td class="ha"> Email*:
                        <input type="email" name="txtMail" require="true" value="<?php echo $Mail ?>">
                    </td>
                </tr>
                <tr>
                    <td class="form-btn">
                        <input name="btnDangKy" type="submit" value="Đăng Ký" class="form-submit">
                    </td>
                </tr>
                <tr>
                    <td class="c">
                        <p>Bạn đã có tài khoản?<a href="dangnhap.php">Đăng nhập tại đây</a></p>
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
    .Q3 {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 500px;
        margin-right: 500px;
        height: auto;
    }

    table.A5 {
        width: 100%;
        background: rgba(0, 0, 0, 0.8);
        padding: 30px 30px 40px;
        border-radius: 10px;
        border: none;
        box-shadow: 0px 0px 17px 2px white;
    }
    .qq {
        text-align: center;
    }
    a.form-submit {
        padding: 5px 5px;
        width: 100%;
        display: inline-block;
        border-radius: 5px;
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

    }

    .form-submit:hover {
        border: 1px solid #1fff1f;
    }

    a.form-submit {
        padding: 5px 5px;
        width: 206%;
        display: inline-block;
    }

    .A5 tr {
        color: #fcfcfc;

    }

    input {
        display: block;
        width: 100%;
        margin: 10px 10px;
        background: transparent;
        color: white;
        border: 1px solid #fcfcfc;
        border-radius: 5px;
    }

    .zz {
        color: #000000;
    }

    .c {
        text-align: center;
        padding-top: 10px;
    }

    .c a {
        color: #fcfdfc;
    }

    .c a:hover {
        color: aqua;
        transition: 0.25s;
    }

    .gioitinh {
        right: 10px;
        bottom: 100px;
        box-sizing: border-box;
    }
</style>