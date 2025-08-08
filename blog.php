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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // Kiểm tra dữ liệu hợp lệ trước khi lưu vào session
    if (!isset($data['masp']) || !isset($data['tensp']) || !isset($data['gia']) || !isset($data['soluong'])) {
        echo json_encode(["status" => "error", "message" => "Dữ liệu không hợp lệ"]);
        exit;
    }

    if (!isset($_SESSION['pay'])) {
        $_SESSION['pay'] = [];
    }

    $found = false;
    foreach ($_SESSION['pay'] as &$item) {
        if ($item['masp'] == $data['masp']) {
            $item['soluong'] += $data['soluong'];
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['pay'][] = $data;
    }

    echo json_encode(["status" => "success", "pay" => $_SESSION['pay']]);
    exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="icon" type="image/x-icon" href="anh/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    
    <?php include 'header.php'; ?>
    <?php include 'nav.php'; ?>
    <article style="margin: 30px auto;">
        <table border="0" width="80%" align="center" cellspacing="0" cellpadding="10" style="background-color: #fff; margin: 30px 10%; box-shadow: 0 0 10px #ccc;">
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
                                    <input type="number" name="soluong" class="soluong" value="1" hidden id="formSoluong">
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

                                        // Hàm hiển thị thông báo
                                        const showNotification = () => {
                                            const notification = document.querySelector('.notification');
                                            notification.style.display = 'block';
                                            setTimeout(() => {
                                                notification.style.display = 'none';
                                            }, 3000);
                                        };

                                        fetch('cart.php', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json'
                                                },
                                                body: JSON.stringify(data)
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                // showNotification();
                                            })
                                            .catch(error => console.error('Error:', error));
                                    });
                                </script>
                            </td>
                            <td>
                                <action="pay.php">
                                    <input type="text" name="masp" value="<?= htmlspecialchars($product['MASP']); ?>" hidden>
                                    <input type="text" name="tensp" value="<?= htmlspecialchars($product['TENSP']); ?>" hidden>
                                    <input type="text" name="gia" value="<?= intval($product['GIA']); ?>" hidden>
                                    <input type="number" name="soluong" class="soluong" value="1" hidden id="formSoluong">
                                    <a class="btnpay" href="pay.php" style="cursor: pointer;">
                                        <i class="fa-brands fa-cc-amazon-pay"></i> THANH TOÁN
                                    </a>
                                    </form>

                                    <script>
                                        document.querySelector('.btnpay').addEventListener('click', function(event) {
                                            event.preventDefault();

                                            const formData = new FormData(document.querySelector('.form-cart'));
                                            const data = {
                                                masp: formData.get('masp'),
                                                tensp: formData.get('tensp'),
                                                gia: formData.get('gia'),
                                                soluong: formData.get('soluong'),
                                            };

                                            fetch(`cart.php?action=pay`, {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json'
                                                    },
                                                    body: JSON.stringify(data)
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    window.location.href = 'pay.php';
                                                })
                                                .catch(error => console.error('Error:', error));
                                        });
                                    </script>
                                </action>
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
                            
                                                const formSoluong = document.getElementById('formSoluong');
                                                formSoluong.value = value;
                                            }
                                        });
                            
                                        btnthem.addEventListener("click", function() {
                                            var value = parseInt(input.value, 10);
                                            value++;
                                            input.value = value;
                            
                                            const formSoluong = document.getElementById('formSoluong');
                                            formSoluong.value = value;
                                        });
                                    });
                                </script>
                                <script>
                                    document.querySelector('.btnpay').addEventListener('click', function(event) {
                                        event.preventDefault();

                                        const formData = new FormData(document.querySelector('.form-cart'));
                                        const data = {
                                            masp: formData.get('masp'),
                                            tensp: formData.get('tensp'),
                                            gia: formData.get('gia'),
                                            soluong: formData.get('soluong'),
                                        };

                                        fetch(`cart.php?action=pay`, {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json'
                                                },
                                                body: JSON.stringify(data)
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                window.location.href = 'pay.php';
                                            })
                                            .catch(error => console.error('Error:', error));
                                    });
                                </script>
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
        </table>

        <a href="trangchu.php" style="text-decoration: none; color: blue; font-size: 16px; margin-left: 10%;">
            &larr; Quay về Trang chủ
        </a>
    </article>

    <!-- Notification -->
    <aside class="notification">
        <p>Đã thêm sản phẩm vào giỏ hàng.</p>
    </aside>

    <?php include 'footer.php'; ?>
</body>

</html>
<style>
    .btnmore{
        background-color: #008800;
        color: #fff;
        padding: 10px 10px;
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
        padding: 10px 10px;
        border-radius: 20px;
        text-decoration: none;
        transition: 0.5s;
        font-size: 20px;
    }

    .btnpay:hover {
        background-color: #FF3300;
        color: #000;
    }

    .notification {
        position: fixed;
        right: 10px;
        top: 10px;
        background-color: rgb(56, 209, 68);
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        display: none;
    }
</style>