<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        if ($item['id'] == $data['id']) {
            $item['quantity'] += 1;
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
    <title>Đăng nhập thư viện</title>
    <link rel="stylesheet" href="trangchu.css">
    <link rel="icon" type="image/x-icon" href="anh/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <?php
    // Nếu không có session, thì sẽ tạo session
    if (!isset($_SESSION)) {
        session_start();
    }

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
                    if (!isset($item['name']) || !isset($item['price']) || !isset($item['quantity'])) {
                        continue;
                    }

                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                    echo "<tr>
                    <td>{$item['name']}</td>
                    <td>" . number_format($item['price'], 0, ',', '.') . " đ</td>
                    <td>{$item['quantity']}</td>
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
        <a href="checkout.php">Thanh toán</a>
    </article>
    <?php
    include 'footer.php';
    ?>
</body>

</html>