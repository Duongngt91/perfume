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
                    <!-- tạo bảng thông tin sản phẩm -->
                    <li>
                        <h3>Thông tin sản phẩm</h3>
                    </li>
                    <table border="1">
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                        </tr>
                        <?php
                        $total = 0;
                        if (!empty($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $item) {
                                // Kiểm tra dữ liệu trước khi sử dụng
                                if (!isset($item['tensp']) || !isset($item['gia']) || !isset($item['soluong'])) {
                                    continue;
                                }
                                $subtotal = $item['gia'] * $item['soluong'];
                                $total += $subtotal;
                                echo "<tr>
                                <td>{$item['tensp']}</td>
                                <td>" . number_format($item['gia'], 0, ',', '.') . " đ</td>
                                <td>{$item['soluong']}</td>
                                <td>" . number_format($subtotal, 0, ',', '.') . " đ</td>
                              </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Giỏ hàng trống</td></tr>";
                        }
                        ?>
                        <tr>
                            <td colspan="3"><strong>Tổng cộng</strong></td>
                            <td><strong><?php echo number_format($total, 0, ',', '.'); ?> đ</strong></td>
                        </tr>
                    </table>
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
        margin: 0 10%;
        
    }

    form ul {
        list-style-type: none;
        padding: 0;
        padding: 20px 20px;
        border: 2px solid gray;
        border-radius: 10px;
        box-shadow: 0px 0px 15px 2px gray;
        overflow: hidden;
    }

    form ul li {
        padding: 5px 5px;
        display: block;
    }

    .bankQR {
        position: relative;
    }

    .bank-info {
        position: absolute;
    }
</style>