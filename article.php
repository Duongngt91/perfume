<article id="rwapper">
    <?php
    include 'connect.php';
    $conn = openconnection();
    mysqli_select_db($conn, 'Perfume');
    ?>

    <?php
    $truyvandanhmucdanhmuc = "SELECT * from DANHMUC";
    $ketquadanhmuc = mysqli_query($conn, $truyvandanhmucdanhmuc) or die(mysqli_error($conn));
    for ($i = 1; $i <= 4; $i++) :
        $dongdanhmuc = mysqli_fetch_array($ketquadanhmuc);
    ?>
        <h3>
            <a href="" class="headline" style="font-size: 30px;">
                <?php echo $dongdanhmuc['TENDM'] ?>
            </a>
        </h3>
        <h4>
            <a href="seemore.php?MADM=<?php echo $dongdanhmuc['MADM'] ?>" class="See-more">Xem thêm <i class="fa-solid fa-angle-right"></i></a>
        </h4>
        <ul style="gap: 15px; padding: 0px 7%;">
            <?php
            error_reporting(0);
            $truyvan = "SELECT * from SANPHAM Where MADM='" . $dongdanhmuc['MADM'] . "'";
            $ketqua = mysqli_query($conn, $truyvan) or die(mysqli_error($conn));
            while ($dong = mysqli_fetch_assoc($ketqua)) {
                echo '
            <li>
                <form action="" class="product-item">
                    <a href="blog.php?masp=' . $dong['MASP'] . '" class="product-top"><img src="' . $dong['HINHANH'] . '" alt=""></a>
                    <a href="blog.php?masp=' . $dong['MASP'] . '" class="product-info">' . $dong['TENSP'] . '</a>
                    <p><a href="" class="product-price">Giá: ' . number_format($dong['GIA'], 0, ',', '.')  . ' ₫</a></p>
                    <a href="blog.php?masp=' . $dong['MASP'] . '" class="buy-now" ;"><i class="fa-solid fa-cart-shopping"></i><i class="fa-regular fa-eye"></i></a>
                    </form>
                    </li>
                    ';
            }
            ?>
        </ul>
    <?php endfor; ?>
</article>

<style>
    /* headline */
    h3 {
        font-size: 20px;
        padding: 10px 20px;
        text-transform: uppercase;
        border: 2px solid gray;
        margin: 0 auto;
        width: 40%;
        border-radius: 30px;
        text-align: center;
    }

    .headline {
        text-decoration: none;
        color: black;
    }

    /* Xem thêm */
    h4 {
        font-size: 18px;
        text-transform: uppercase;
        width: 10%;
        text-align: center;
        margin-left: auto;
        margin-right: 5%;
    }

    h4 a {
        color: #555;
        transition: 0.5s;
        text-decoration: none;
    }

    h4 a:hover {
        color: #f36f40;
        transition: 0.5s;
    }

    /* Sản phẩm */
    .product-item {
        position: relative;
        overflow: hidden;
        transition: 0.5s;
    }
    .product-item:hover{
        
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
</style>