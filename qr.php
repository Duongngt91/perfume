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
        <ul class="payment">
            <li>
                <div class="bank-info">
                    <h4>Thông tin tài khoản</h4>
                    <p>Ngân hàng: BIDV</p>
                    <p>Chủ tài khoản: Nguyễn Tùng Dương</p>
                    <p>Số tài khoản: 0929496129</p>
                    <p>Chi nhánh: Chợ lớn</p>
                    <img src="anh/anhbank.jpg" alt="QR Code thanh toán" style="width: 300px; height: 300px;">
                    <p>Quét mã QR để thanh toán nhanh</p>
                </div>
            </li>
            <li>
                <a href="nhanhang.php">
                    <button type="submit">Xác nhận thanh toán</button>

                </a>
            </li>
        </ul>
    </article>
    <?php
    include 'footer.php';
    ?>
</body>

</html>
<style>
    article ul {
        text-align: center;
    }

    article ul li {
        list-style-type: none;
    }

    h4 {
        color: #815854;
        font-size: 50px;
    }
</style>