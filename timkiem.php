<html>

<head>
    <meta charset="UTF-8">
    <title>Dương Perfume</title>
    <link rel="stylesheet" href="Trangchu.css">
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
    include 'nav.php';
    include 'aside.php';
    ?>

    <?php

    include 'connect.php';
    $conn = openconnection();
    mysqli_select_db($conn, 'Perfume');

    // Get search term
    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

    ?>


    <div class="search-container">
        <form action="" method="GET" class="search-box">
            <input type="text" name="search" class="search-input"
                placeholder="Nhập tên sản phẩm bạn cần tìm..."
                value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="search-button">
                <i class="fas fa-search"></i> Tìm kiếm
            </button>
        </form>

        <div class="search-results">
            <?php if (!empty($search)): ?>
                <?php
                $query = "SELECT * FROM SANPHAM 
                          WHERE TENSP LIKE '%$search%'
                          ";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);
                ?>

                <div class="results-count">
                    Tìm thấy <?php echo $count; ?> kết quả cho "<strong><?php echo htmlspecialchars($search); ?></strong>"
                </div>

                <?php if ($count > 0): ?>
                    <ul class="products-grid">
                        <?php while ($product = mysqli_fetch_assoc($result)): ?>
                            <li class="product-item">
                                <form action="">
                                    <a href="blog.php?masp=<?php echo $product['MASP']; ?>" class="product-top">
                                        <img src="<?php echo $product['HINHANH']; ?>" alt="<?php echo $product['TENSP']; ?>">
                                    </a>
                                    <a href="blog.php?masp=<?php echo $product['MASP']; ?>" class="product-info">
                                        <?php echo $product['TENSP']; ?>
                                    </a>
                                    <p class="product-price">
                                        <?php echo number_format($product['GIA'], 0, ',', '.'); ?> ₫
                                    </p>
                                    <a href="blog.php?masp=<?php echo $product['MASP']; ?>" class="buy-now">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </form>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <div class="no-results">
                        <p>Không tìm thấy sản phẩm nào phù hợp.</p>
                        <p>Vui lòng thử lại với từ khóa khác.</p>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="no-results">
                    <p>Vui lòng nhập từ khóa tìm kiếm vào ô bên trên.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <style>
        /* New Search Page Styles */
        .search-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        .search-input {
            flex: 1;
            padding: 12px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #6c757d;
            box-shadow: 0 0 8px rgba(108, 117, 125, 0.2);
        }

        .search-button {
            padding: 12px 25px;
            background: #6c757d;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .search-button:hover {
            background: #5a6268;
        }

        .search-results {
            padding: 0 7%;
        }

        .results-count {
            margin-bottom: 20px;
            color: #666;
            font-size: 0.9em;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 25px;
            padding: 0;
        }

        .product-item {
            position: relative;
            overflow: hidden;
            transition: 0.5s;
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
            white-space: nowrap;
            /* Ngăn không cho văn bản xuống dòng */
            overflow: hidden;
            /* Ẩn phần văn bản vượt quá vùng chứa */
            text-overflow: ellipsis;
            /* Thêm "..." ở cuối văn bản bị cắt */
            width: 140px;
            /* Chiều rộng của vùng chứa */
            /* text-align: center; */
            padding-top: 15px;
            text-decoration: none;
            color: black;
        }

        #rwapper ul {
            display: flex;
            list-style-type: none;
        }

        .product-price {
            position: relative;
            font-size: 16px;
            text-decoration: none;
            transform: scale(1);
            transition: all .4s ease-out;
            color: red;
            display: block;
            line-height: 1;
            left: 5px;
        }

        .buy-now {
            position: absolute;
            bottom: 22px;
            font-size: 17px;
            left: 5px;
            transform: scale(0);
            opacity: 0;
            text-decoration: none;
            transition: all .4s ease-out;
            text-align: center;
            z-index: 1;
        }

        .product-info:hover+.product-price,
        .product-top:hover~.product-price,
        .product-item:hover .product-price {
            transform: scale(0);
            transition: all .4s ease-out;
            opacity: 0;
        }

        .product-price:hover+.buy-now,
        .product-info:hover~.buy-now,
        .product-top:hover~.buy-now,
        .product-item:hover .buy-now {
            transform: scale(1);
            opacity: 1;
            transition: all .4s ease-out;
        }

        .product-item:hover .buy-now {
            transition: transform 0.4s ease, opacity 0.4s ease;
        }

        .product-item .buy-now {
            left: 15px;
            bottom: 15px;
        }

        .buy-now i {
            margin: 0 5px;
            border: 2px solid green;
            padding: 5px 5px;
            border-radius: 5px;
            color: green;
            transition: 0.3s;
        }

        .buy-now i:hover {
            background-color: green;
            color: white;
            transition: 0.3s;
        }

        .no-results {
            text-align: center;
            padding: 50px 0;
            color: #666;
            font-size: 1.2em;
        }

        @media (max-width: 768px) {
            .search-container {
                padding: 0 15px;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
                gap: 15px;
            }
        }
    </style>

    <?php
    include 'footer.php';
    ?>
</body>

</html>