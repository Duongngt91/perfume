<html>

<head>
    <meta chatset="utf-8">
    <title>Xem Thêm</title>
    <link rel="icon" type="image/x-icon" href="anh/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <?php
    session_start();
    include 'nav.php';
    ?>
    <article>
        <?php
        include 'connect.php';

        // Khởi tạo kết nối cơ sở dữ liệu
        $conn = openconnection();

        // Chọn cơ sở dữ liệu
        $dbname = "Perfume";
        if (!mysqli_select_db($conn, $dbname)) {
            die("Lỗi: Không thể chọn cơ sở dữ liệu '$dbname'.");
        }

        if (isset($_GET['MADM'])) {
            $MADM = mysqli_real_escape_string($conn, $_GET['MADM']);

            if (empty($MADM)) {
                echo "<p>Danh mục không hợp lệ.</p>";
                exit;
            }

            $truyvan = "SELECT * FROM SANPHAM WHERE MADM = '$MADM'";
            $ketqua = mysqli_query($conn, $truyvan);

            if (!$ketqua) {
                echo "<p>Không thể lấy danh sách sản phẩm. Vui lòng thử lại sau.</p>";
                exit;
            }

            echo "<h1>Sản phẩm trong danh mục</h1>";
            echo "<section class='product-list'>  <ul>";
            while ($dong = mysqli_fetch_assoc($ketqua)) {
                echo '
            <li>
                <form action="" class="product-item">
                    <a href="blog.php?masp=' . $dong['MASP'] . '" class="product-top"><img src="' . $dong['HINHANH'] . '" alt=""></a>
                    <a href="blog.php?masp=' . $dong['MASP'] . '" class="product-info">' . $dong['TENSP'] . '</a>
                    <p class="product-price" style="color: red;">Giá: ' . number_format($dong['GIA'], 0, ',', '.')  . ' đ</p>
                    <div class="product-buttons">
                        <a href="blog.php?masp=' . $dong['MASP'] . '" class="buy-now"><i class="fa-solid fa-bag-shopping"></i> Mua ngay</a>
                        <a href="blog.php?masp=' . $dong['MASP'] . '" class="addtocart"><i class="fa-solid fa-cart-shopping"></i> Thêm giỏ hàng</a>
                    </div>
                </form>
            </li>
            ';
            }
            echo "</ul></section>";
        } else {
            echo "<p>Không tìm thấy danh mục.</p>";
        }

        closeconnection($conn);
        ?>
    </article>
    <?php
    include 'footer.php';
    ?>
</body>

</html>

<style>
    .product-list {
        margin: 30px 0;
    }

    .product-list ul {
        display: flex;
        list-style: none;
        gap: 15px;
        padding: 0px 7%;
    }

    .product-item {
        position: relative;
        overflow: hidden;
        transition: 0.5s;

    }

    .product-item::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(192, 192, 192, 0);
        /* Ban đầu trong suốt */
        transition: background 0.3s ease-in-out;
    }

    .product-item:hover::after {
        background: rgba(192, 192, 192, 0.5);
        /* Khi hover thì đen lên */
    }

    .product-item:hover {
        box-shadow: 0px 0px 17px 2px gray;
        transition: 0.5s;
    }

    .product-item a {
        display: block;
        font-size: 15px;
        font-weight: bold;
    }

    .product-top img {
        height: auto;
        transition: 0.5s;
        width: 140px;
        height: 140px;
    }

    .product-item:hover .product-top img {
        transform: scale(1.1);
        transition: 0.5s;
    }

    .product-info {
        color: black;
        text-decoration: none;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        width: 140px;
        padding-top: 15px;
    }

    .product-buttons {
        position: absolute;
        top: 60%;
        left: 50%;
        transform: translate(-50%,50%);
        display: flex;
        flex-direction: column;
        /* Xếp nút theo cột */
        gap: 10px;
        /* Khoảng cách giữa hai nút */
        opacity: 0;
        transition: all 0.5s ease-in-out;
        z-index: 10;
    }

    .buy-now,
    .addtocart {
        padding: 10px 10px;
        border-radius: 20px;
        text-align: center;
        text-decoration: none;
        transition: all 0.5s ease-in-out;
        width: 120px;
    }

    .buy-now {
        border: 1px solid red;
        color: red;
        background: white;
    }

    .buy-now:hover {
        border: 1px solid red;
        color: white;
        background: red;
    }

    .addtocart {
        border: 1px solid green;
        color: green;
        background: white;
    }

    .addtocart:hover {
        border: 1px solid green;
        color: white;
        background: green;
    }

    .product-item:hover .product-buttons {
        transform: translate(-50%, -50%);
        opacity: 1;
    }
</style>