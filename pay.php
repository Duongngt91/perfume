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
            <form action="pay.php" method="post" class="payment">
                <ul>
                    <!-- tạo bảng thông tin sản phẩm -->
                    <li>
                        <h3>Thông tin sản phẩm</h3>
                    </li>
                    <li>
                        <table border="1" style="border-collapse: collapse; border: none; text-align: center;">
                            <tr style="background: #815854;">
                                <th>Hình ảnh</th>
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
                                    // Nếu chưa có openconnection() và closeconnection() thì thêm vào
                                    if (!function_exists('openconnection')) {
                                        include 'connect.php';
                                    }
                                    $conn = openconnection();

                                    // Truy vấn dữ liệu từ database
                                    $sql = "SELECT * FROM sanpham WHERE masp = '{$item['masp']}'";
                                    $result = mysqli_query($conn, $sql);
                                    $product = mysqli_fetch_assoc($result);
                                    echo "<tr>
                                    <td><img src='{$product['HINHANH']}' alt='imgPerfume' width='100'></td>
                                    <td>{$item['tensp']}</td>
                                    <td>" . number_format($item['gia'], 0, ',', '.') . " đ</td>
                                    <td>{$item['soluong']}</td>
                                    <td>" . number_format($subtotal, 0, ',', '.') . " đ</td>
                                  </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>Giỏ hàng trống</td></tr>";
                            }
                            if (!empty($_SESSION['pay'])) {
                                foreach ($_SESSION['pay'] as $item) {
                                    // Kiểm tra dữ liệu trước khi sử dụng
                                    if (!isset($item['tensp']) || !isset($item['gia']) || !isset($item['soluong'])) {
                                        continue;
                                    }
                                    $subtotal = $item['gia'] * $item['soluong'];
                                    $total += $subtotal;
                                    $hasItems = false;
                                }}
                            include 'connect.php';
                            $conn = openconnection();

                            // Xử lý session pay trước nếu tồn tại
                            if (!empty($_SESSION['pay'])) {
                                $hasItems = true;

                                foreach ($_SESSION['pay'] as $item) {
                                    echo $item['masp'];
                                    if (!isset($item['tensp'], $item['gia'], $item['soluong'])) continue;


                                    $sql = "SELECT * FROM sanpham WHERE masp = '{$item['masp']}'";
                                    $result = mysqli_query($conn, $sql);
                                    $product = mysqli_fetch_assoc($result);

                                    $subtotal = $item['gia'] * $item['soluong'];
                                    $total += $subtotal;

                                    echo "<tr>
                                            <td><img src='{$product['HINHANH']}' alt='imgPerfume' width='100'></td>
                                            <td>{$item['tensp']}</td>
                                            <td>" . number_format($item['gia'], 0, ',', '.') . " đ</td>
                                            <td>{$item['soluong']}</td>
                                            <td>" . number_format($subtotal, 0, ',', '.') . " đ</td>
                                        </tr>";
                                }
                            }
                            // Nếu không có pay thì xử lý cart
                            else if (!empty($_SESSION['cart'])) {
                                $hasItems = true;
                                foreach ($_SESSION['cart'] as $item) {
                                    if (!isset($item['tensp'], $item['gia'], $item['soluong'])) continue;

                                    $sql = "SELECT * FROM sanpham WHERE masp = '{$item['masp']}'";
                                    $result = mysqli_query($conn, $sql);
                                    $product = mysqli_fetch_assoc($result);

                                    $subtotal = $item['gia'] * $item['soluong'];
                                    $total += $subtotal;

                                    echo "<tr>
                                            <td><img src='{$product['HINHANH']}' alt='imgPerfume' width='100'></td>
                                            <td>{$item['tensp']}</td>
                                            <td>" . number_format($item['gia'], 0, ',', '.') . " đ</td>
                                            <td>{$item['soluong']}</td>
                                            <td>" . number_format($subtotal, 0, ',', '.') . " đ</td>
                                        </tr>";
                                }
                            }

                            // Hiển thị thông báo nếu không có item nào
                            if (!$item) {
                                echo "<tr><td colspan='5'>Giỏ hàng trống</td></tr>";
                            }
                            ?>
                            <tr>
                                <td colspan="4"><strong>Tổng cộng</strong></td>
                                <td><strong><?php echo number_format($total, 0, ',', '.'); ?> đ</strong></td>
                            </tr>
                        </table>
                    </li>
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
                <!-- Form nhập thông tin thanh toán -->
                <ul>
                    <li>
                        <h3>Thông tin mua hàng</h3>
                    </li>
                    <li>
                        <label for="HOTEN">Họ tên: <br>
                            <input type="text" name="HOTEN" required>
                        </label>
                    </li>
                    <li>
                        <label for="SODT">Số điện thoại:<br>
                            <input type="text" name="SODT" required>
                        </label>
                    </li>
                    <li>
                        <label for="email">Email:<br>
                            <input type="text" name="email" required>
                        </label>
                    </li>
                    <li>
                        <label for="DIACHI">Địa chỉ nhận hàng:<br>
                            <input type="text" name="DIACHI" required>
                        </label>
                    </li>
                </ul>
                <ul>
                    <li>
                        <h3>Thanh toán bằng:</h3>
                    </li>
                    <li style="padding: 30px 0; ">
                        <a href="nhanhang.php" class="btnpay">
                            Thanh toán khi nhận hàng
                        </a>
                    </li>
                    <li style="padding: 30px 0; ">
                        <a href="qr.php" onclick="toggleBankInfo(true)" class="btnQR">
                            Thanh toán qua ngân hàng
                        </a>
                    </li>
                </ul>
            </form>
        </main>
    </article>
    <?php
    include 'footer.php';
    ?>
</body>

</html>
<style>
    .payment {
        display: flex;
        justify-content: space-between;
        margin: 5% 9%;
        list-style-type: none;
        padding: 0;
        padding: 20px 20px;
        border: 2px solid gray;
        border-radius: 10px;
        box-shadow: 0px 0px 15px 2px gray;
        overflow: hidden;

    }

    .payment ul li {
        padding: 5px 5px;
        display: block;
        text-decoration: none;
        list-style-type: none;
    }

    .payment ul li table tr td{
        padding: 5px 5px;
    }
    .btnpay {
        background-color: #008800;
        color: #fff;
        padding: 20px 10px;
        border-radius: 20px;
        text-decoration: none;
        /* padding: 5px 5px; */
        margin: 5px 5px;
        transition: 0.5s;
    }

    .btnQR {
        background-color: rgb(223, 5, 5);
        color: #fff;
        padding: 20px 10px;
        border-radius: 20px;
        text-decoration: none;
        /* padding: 5px 5px; */
        margin: 5px 5px;
        transition: 0.5s;
    }

    .btnQR:hover {
        background-color: rgb(251, 67, 67);
        transition: 0.5s;
        color: #000;
    }

    .btnpay:hover {
        background-color: #00FF00;
        color: #000;
        transition: 0.5s;
    }

    .btnpay+.btnQR {
        margin: 10px 10px;
    }
</style>