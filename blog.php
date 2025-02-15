<?php
session_start();
include 'connect.php';
$conn = openconnection();
mysqli_select_db($conn, 'Perfume');

if (!isset($_GET['masp'])) {
    die('No product specified.');
}

$masp = mysqli_real_escape_string($conn, $_GET['masp']);
$query   = "SELECT * FROM SANPHAM WHERE MASP='$masp'";
$result  = mysqli_query($conn, $query) or die(mysqli_error($conn));

$product = mysqli_fetch_assoc($result);
if (!$product) {
    die("Product not found.");
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="icon" type="image/x-icon" href="anh/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <?php include 'nav.php'; ?>
    <article>
        <table border="0" width="80%" align="center" cellspacing="0" cellpadding="10" style="background-color: #fff; margin-top: 30px; box-shadow: 0 0 10px #ccc;">
            <tr>
                <td align="center" width="50%" style="border-right: 1px solid #ddd;">
                    <img src="<?= htmlspecialchars($product['HINHANH']); ?>" alt="imgPerfume" width="90%">
                </td>
                <td width="50%" valign="top" style="padding: 20px;">
                    <h1 style="font-size: 28px; color: #222; margin-bottom: 20px;"><?= htmlspecialchars($product['TENSP']); ?></h1>
                    <p style="color: #d63384; font-size: 24px; margin: 10px 0;">Giá: <?= number_format($product['GIA'], 0, ',', '.'); ?> đ</p>
                    <p style="margin: 10px 0;">Đã bán: <strong>1578</strong></p>
                    <table cellspacing="5" cellpadding="5">
                        <tr>
                            <td>Số lượng:</td>
                            <td>
                                <button class="btnbot" style="border-radius: 20px; padding: 5px 10px; background-color: #ddd; border: none; cursor: pointer;">-</button>
                                <input class="soluong" type="text" value="1" style="width: 50px; text-align: center; color:#222;">
                                <button class="btnthem" style="border-radius: 20px; padding: 5px 10px; background-color: #ddd; border: none; cursor: pointer;">+</button>
                            </td>
                        </tr>
                    </table>
                    <table cellspacing="10" cellpadding="10">
                        <tr>
                            <td>
                                <form method="POST" action="cart.php" class="form-cart">
                                    <input type="text" name="masp" value="<?= htmlspecialchars($product['MASP']); ?>" hidden>
                                    <input type="text" name="tensp" value="<?= htmlspecialchars($product['TENSP']); ?>" hidden>
                                    <input type="text" name="gia" value="<?= intval($product['GIA']); ?>" hidden>
                                    <input type="text" name="soluong" class="soluong" value="1" hidden>
                                    <button type="submit" class="btnmore" style="cursor: pointer; border: none;">
                                        <i class="fa-solid fa-cart-shopping"></i> THÊM GIỎ HÀNG
                                    </button>
                                </form>

                                <script>
                                    document.querySelector('.form-cart').addEventListener('submit', function(event) {
                                        event.preventDefault();

                                        const formData = new FormData(event.target);
                                        const data = {
                                            masp: formData.get('masp'),
                                            tensp: formData.get('tensp'),
                                            gia: formData.get('gia'),
                                            soluong: formData.get('soluong')
                                        };

                                        fetch('cart.php', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json'
                                                },
                                                body: JSON.stringify(data)
                                            })
                                            .then(response => response.json())
                                            .then(data => console.log(data))
                                            .catch(error => console.error('Error:', error));
                                    });
                                </script>
                            </td>
                            <td>
                                <a class="btnpay" href="pay.php" style="cursor: pointer;">
                                    <i class="fa-brands fa-cc-amazon-pay"></i> THANH TOÁN
                                </a>
                            </td>
                        </tr>
                    </table>
                    <h3 style="margin-top: 20px; width: 50%;">Tiêu chuẩn dịch vụ</h3>
                    <ul style="list-style: none; padding: 0; display: block;">
                        <li>🚚 Giao hàng nội thành 2 - 4 giờ</li>
                        <li>✅ Đổi trả trong 48 giờ nếu sản phẩm không đạt chất lượng</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="left">
                    <a href="trangchu.php" style="text-decoration: none; color: blue; font-size: 16px;">
                        &larr; Quay về Trang chủ
                    </a>
                </td>
            </tr>
        </table>
    </article>
    <?php include 'footer.php'; ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var btnbot = document.querySelector(".btnbot");
            var btnthem = document.querySelector(".btnthem");
            var input = document.querySelector(".soluong");

            btnbot.addEventListener("click", function() {
                var value = parseInt(input.value, 10);
                if (value > 1) {
                    value--;
                    input.value = value;
                }
            });

            btnthem.addEventListener("click", function() {
                var value = parseInt(input.value, 10);
                value++;
                input.value = value;
            });
        });
    </script>
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
    }
</style>