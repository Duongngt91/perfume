<html>

<head>
    <meta charset="utf-8">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="trangchu.css">
    <link rel="icon" type="image/x-icon" href="anh/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <?php
    session_start();
    include 'header.php';
    include 'nav.php';
    include 'aside.php';
    ?>
    <article>
        <?php

        // // Kiểm tra xem có thông tin đơn hàng không
        // if (!isset($_SESSION['thongtin_donhang'])) {
        // die("❌ LỖI: Không tìm thấy thông tin đơn hàng! Hãy thử đặt hàng lại.");
        // }

        // $donhang = $_SESSION['thongtin_donhang']; // Gán dữ liệu đơn hàng từ session vào biến $donhang
        ?>
        <img src="anh/logo.webp" alt="Tea Leaf" class="tea-leaf">
        <!-- <h2>🎉 Đặt Hàng Thành Công! 🎉</h2>
        <p>Cảm ơn bạn, <strong><?php echo htmlspecialchars($donhang['hoten']); ?></strong>, đã tin tưởng và đặt hàng.</p>
        <p>Đơn hàng sẽ sớm được giao đến: <strong><?php echo htmlspecialchars($donhang['diachi']); ?></strong></p>
        <p>📞 Số điện thoại: <strong><?php echo htmlspecialchars($donhang['SODT']); ?></strong></p>
        <p>🛒 Phương thức thanh toán: <strong>Thanh toán khi nhận hàng</strong></p>
        <p>💰 Tổng số tiền: <strong><?php echo number_format($donhang['tongTien'], 0, ',', '.'); ?> đ </strong></p>
        <a href="Trangchu.php" class="button">Trở về trang chủ</a> -->

        <h2>🎉 Đặt Hàng Thành Công! 🎉</h2>
        <p>Cảm ơn bạn <strong> </strong> đã tin tưởng và đặt hàng.</p>
        <!-- <p>Đơn hàng sẽ sớm được giao đến: <strong></strong></p>
        <p>📞 Số điện thoại: <strong></strong></p> -->
        <p>🛒 Phương thức thanh toán: <strong>Thanh toán khi nhận hàng</strong></p>
        <a href="Trangchu.php" class="button">Trở về trang chủ</a>

    </article>
    <?php
    include 'footer.php';
    ?>
</body>

</html>
<style>
    article {
        text-align: center;
        margin: 50px 0;
    }
    article ul {
        text-align: center;
    }
    article img {
        width: 200px;
        height: 200px;
        margin: 0 auto;
        border-radius: 100px;
    }

    article ul li {
        list-style-type: none;
    }

    h4 {
        color: #815854;
        font-size: 50px;
    }
</style>