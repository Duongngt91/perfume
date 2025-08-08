<?php

// Nếu không có session, thì sẽ tạo session
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nếu action là pay thì xử lý thanh toán
    if (isset($_GET["action"]) && $_GET["action"] == "pay") {

        $data = json_decode(file_get_contents("php://input"), true);

        // Kiểm tra dữ liệu hợp lệ trước khi lưu vào session
        if (!isset($data['masp']) || !isset($data['tensp']) || !isset($data['gia']) || !isset($data['soluong'])) {
            echo json_encode(["status" => "error", "message" => "Dữ liệu không hợp lệ"]);
            exit;
        }

        // Xoá giá trị cũ trong session pay
        if (isset($_SESSION['pay'])) {
            unset($_SESSION['pay']);
        }

        // Thêm sản phẩm vào session pay
        $_SESSION['pay'][] = $data;

        echo json_encode(["status" => "success"]);
        exit;
    }

    //// Xử lý xóa sản phẩm khỏi giỏ hàng
    if (isset($_GET["action"]) && $_GET["action"] == "remove") {
        if (!isset($_GET["masp"])) {
            echo json_encode(["status" => "error", "message" => "Dữ liệu không hợp lệ"]);
            exit;
        }

        $masp = $_GET["masp"];
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['masp'] == $masp) {
                unset($_SESSION['cart'][$index]);
                break;
            }
        }

        echo json_encode(["status" => "success", "cart" => $_SESSION['cart']]);
        exit;
    }
    $data = json_decode(file_get_contents("php://input"), true);

    // Kiểm tra dữ liệu hợp lệ trước khi lưu vào session
    if (!isset($data['masp']) || !isset($data['tensp']) || !isset($data['gia']) || !isset($data['soluong'])) {
        echo json_encode(["status" => "error", "message" => "Dữ liệu không hợp lệ"]);
        exit;
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['masp'] == $data['masp']) {
            $item['soluong'] += $data['soluong'];
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = $data;
    }

    echo json_encode(["status" => "success", "cart" => $_SESSION['cart']]);
    exit;
}
?>

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
    include 'header.php';
    ?>
    <?php
    include 'nav.php';
    ?>
    <?php
    include 'aside.php';
    ?>
    <article>
        <h2>Giỏ hàng của bạn</h2>
        <table border="1">
            <tr>
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
            ?>
            <!-- <td><a href='?action=remove&$masp={$item['masp']}' style='color: red;'>Xóa</a></td> -->
            <tr>
                <td colspan="4"><strong>Tổng cộng</strong></td>
                <td><strong><?php echo number_format($total, 0, ',', '.'); ?> đ</strong></td>
            </tr>
        </table>

        <a href="trangchu.php" style="text-decoration: none; color: blue; font-size: 16px;padding: 15px 10%;">
            Tiếp tục mua hàng
        </a>

        <a href="pay.php" style="text-decoration: none; color: blue; font-size: 16px;padding-left: 54%;">
            Thanh toán
        </a>

        </tr>
    </article>
    <?php
    include 'footer.php';
    ?>
</body>

</html>
<style>
    article {
        margin: 40px 10%;
        overflow: hidden;
    }

    h2 {
        text-align: center;
        color: #815854;
    }

    table {
        width: 80%;
        border-collapse: collapse;
        margin: 0 auto;
        text-align: center;
    }
</style>