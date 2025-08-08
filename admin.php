<?php
include 'connect.php';
$conn = openconnection();

$sql = "SELECT * FROM SANPHAM";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body style="text-align: center;padding: 30px 20%;">
    <h2>Quản lý sản phẩm</h2>
    <a href="add_product.php" style="margin: 0px 20px; color: blue;">Thêm sản phẩm</a>
    <a href="Trangchu.php" style="margin: 0px 20px; color: blue;">Quay lại trang chủ</a>
    <table>
        <tr>
            <th>Mã SP</th>
            <th>Tên SP</th>
            <th>Giá</th>
            <th>Danh mục</th>
            <th>Hình ảnh</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['MASP'] ?></td>
            <td><?= $row['TENSP'] ?></td>
            <td><?= number_format($row['GIA'], 0, ',', '.') ?> VND</td>
            <td><?= $row['MADM'] ?></td>
            <td><img src="<?= $row['HINHANH'] ?>" width="50"></td>
            <td>
                <a href="edit_product.php?id=<?= $row['MASP'] ?>">Sửa</a> | 
                <a href="delete_product.php?id=<?= $row['MASP'] ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php closeconnection($conn); ?>
