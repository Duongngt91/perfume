<html>

<head>
    <meta charset="utf-8">
    <title>Mua ngay</title>
    <link rel="stylesheet" href="trangchu.css">
    <link rel="icon" type="image/x-icon" href="anh/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <?php
    include 'header.php';
    include 'nav.php';
    include 'aside.php';
    ?>
    <article>
        <main>
            <form action="">
                <!-- Form nhập thông tin thanh toán -->
                <ul>
                    <li>
                        <h3>Thông tin mua hàng</h3>
                    </li>
                    <li>
                        <label for="HOTEN">Họ tên:
                            <input type="text" name="HOTEN" required>
                        </label>
                    </li>
                    <li>
                        <label for="SODT">Số điện thoại:
                            <input type="text" name="SODT" required>
                        </label>
                    </li>
                    <li>
                        <label for="email">Email:
                            <input type="text" name="email" required>
                        </label>
                    </li>
                    <li>
                        <label for="DIACHI">Địa chỉ nhận hàng:
                            <input type="text" name="DIACHI" required>
                        </label>
                    </li>
                </ul>
                <ul>
                    <li>
                        <h3>Thanh toán bằng:</h3>
                    </li>
                    <li>
                        <label for="COD">
                            <input type="radio" name="payment" value="COD" required onclick="toggleBankInfo(false)"> Thanh toán khi nhận hàng
                        </label>
                    </li>
                    <li>
                        <label for="ATM">
                            <input class="bankQR" type="radio" name="payment" value="ATM" required onclick="toggleBankInfo(true)"> Thanh toán qua ngân hàng
                        </label>
                    </li>
                    <div class="bank-info">
                        <h4>Thông tin chuyển khoản</h4>
                        <p>Ngân hàng: BIDV</p>
                        <p>Chủ tài khoản: Nguyễn Tùng Dương</p>
                        <p>Số tài khoản: 0929496129</p>
                        <p>Chi nhánh: Chợ lớn</p>
                        <img src="anh/anhbank.jpg" alt="QR Code thanh toán" style="width: 300px; height: 300px;">
                        <p>Quét mã QR để thanh toán nhanh</p>
                    </div>
                </ul>
                <ul>

                    <button type="submit">Xác nhận thanh toán</button>
                </ul>
                <script>
                    function toggleBankInfo(show) {
                        const bankInfo = document.getElementById('bank-info');
                        if (show) {
                            bankInfo.style.display = 'block';
                        } else {
                            bankInfo.style.display = 'none';
                        }
                    }
                </script>
            </form>
        </main>
    </article>
    <?php
    include 'footer.php';
    ?>
</body>

</html>
<style>
    form {
        display: flex;
        justify-content: space-between;
    }

    form ul {
        list-style-type: none;
        padding: 0;
    }

    .bank-info {}
</style>