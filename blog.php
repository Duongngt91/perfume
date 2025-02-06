<html>

<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="icon" type="image/x-icon" href="anh/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <?php
    session_start();
    include 'nav.php';
    ?>
    <article>
        <?php
        include 'connect.php';
        $conn = openconnection();
        mysqli_select_db($conn, 'Perfume');
        ?>
        <table border="0" width="80%" align="center" cellspacing="0" cellpadding="10" style="background-color: #fff; margin-top: 30px; box-shadow: 0 0 10px #ccc;">
            <?php
            // error_reporting(0);
            $truyvan = "SELECT * from SANPHAM Where MASP='" . $_GET['masp'] . "'";

            $ketqua = mysqli_query($conn, $truyvan) or die(mysqli_error($conn));
            $dongsanpham = mysqli_fetch_array($ketqua);
            echo '<tr>
                    
                        <td align="center" width="50%" style="border-right: 1px solid #ddd;">
                            <img src=' . $dongsanpham['HINHANH'] . ' alt="imgPerfume" width="90%">
                        </td>


                        <td width="50%" valign="top" style="padding: 20px;">
                            <h1 style="font-size: 28px; color: #222; margin-bottom: 20px;">' . $dongsanpham['TENSP'] . '</h1>
                            <p style="color: #d63384; font-size: 24px; margin: 10px 0;">Giá: ' . number_format($dongsanpham['GIA'], 0, ',', '.') . ' đ</p>
                            <p style="margin: 10px 0;">Đã bán: <strong>1578</strong></p>


                            <table cellspacing="5" cellpadding="5">
                                <tr>
                                    <td>Số lượng:</td>
                                    <td>
                                    <script> 
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var btnbot = document.querySelector(".btnbot");
                                            var btnthem = document.querySelector(".btnthem");
                                            var input = document.querySelector(".soluong");
                                            btnbot.addEventListener("click", function() {
                                                var value = parseInt(input.value);
                                                if (value > 1) {
                                                    value--;
                                                }
                                                input.value = value;
                                            });
                                            btnthem.addEventListener("click", function() {
                                                var value = parseInt(input.value);
                                                value++;
                                                input.value = value;
                                            });
                                        });
                                    
                                    </script>
                                        <button class="btnbot" style="border-radius: 20px ; padding: 5px 10px; background-color: #ddd; border: none; cursor: pointer;">-</button>
                                        <input class="soluong" type="text" value="1" style="width: 50px; text-align: center;color:#222;" >
                                        <button class="btnthem" style="border-radius: 20px; padding: 5px 10px; background-color: #ddd; border: none; cursor: pointer;">+</button>
                                    </td>
                                </tr>
                            </table>


                            <table cellspacing="10" cellpadding="10">
                                <tr>
                                    <td>
                                        <form method="POST" action="cart.php">
                                            <input type="hidden" name="masp" value="<?php echo' .htmlspecialchars($dongsanpham['MASP']) . '; ?>">
                                            <input type="hidden" name="tensp" value="<?php echo' . htmlspecialchars($dongsanpham['TENSP']) . '; ?>">
                                            <input type="hidden" name="gia" value="<?php echo' . intval($dongsanpham['GIA']) . '; ?>">
                                            <input type="hidden" name="soluong" class="soluong" value="1">

                                            <button type="submit" class="btnmore" style="cursor: pointer; border: none;">
                                                <i class="fa-solid fa-cart-shopping"></i> THÊM GIỎ HÀNG
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <a class="btnpay" href="pay.php" style="cursor: pointer;"><i class="fa-brands fa-cc-amazon-pay"></i> THANH TOÁN</a>
                                    </td>
                                </tr>
                            </table>


                            <h3 style="margin-top: 20px; width: 50%;">Tiêu chuẩn dịch vụ</h3>
                            <ul style="list-style: none; padding: 0; display: block;">
                                <li>🚚 Giao hàng nội thành 2 - 4 giờ</li>
                                <li>✅ Đổi trả trong 48 giờ nếu sản phẩm không đạt chất lượng</li>
                            </ul>
                        </td>
                        <table border="0" width="80%" align="center" cellspacing="0" cellpadding="10" style="margin-top: 20px;">
                            <tr>
                                <td align="left">
                                    <a href="trangchu.php" style="text-decoration: none; color: blue; font-size: 16px;">
                                        &larr; Quay về Trang chủ
                                    </a>
                                </td>
                            </tr>
                        </table>
                    
                    </tr>';
            ?>
        </table>
    </article>
    <?php
    include 'footer.php';
    ?>
</body>

</html>
<style>
    .btnmore {
        background-color: #008800;
        color: #fff;
        padding: 10px 20px;
        border-radius: 20px;
        text-decoration: none;
        transition: 0.5s;
        font-size: 20px;
    }

    .btnmore:hover {
        background-color: #00FF00;
        color: #000;
        transition: 0.5s;
    }

    .btnpay {
        background-color: #EE0000;
        color: #fff;
        padding: 10px 20px;
        border-radius: 20px;
        text-decoration: none;
        transition: 0.5s;
        font-size: 20px;
    }

    .btnpay:hover {
        background-color: #FF3300;
        color: #000;
        transition: 0.5s;
    }
</style>