<nav>
    <ul>
        <?php
        if (basename($_SERVER['PHP_SELF']) == 'dangnhap.php' || basename($_SERVER['PHP_SELF']) == 'dangky.php') {
            echo "";
        }
        //$role = $_SESSION[['phanquyen']];
        ?>
        <li>
            <a href=""><i class="fa-solid fa-bars"></i> MENU</a>
        </li>
        <li class="search_nav">
            <form action="timkiem.php" method="GET">
                <input type="search" name="search" class="search_nav" style="margin-top:0px; background: white; color: black;
                font-size: 14px;border: none; outline: none; background: transparent;" placeholder="Bạn cần tìm gì...">
                <label for=""><i class="fa-solid fa-magnifying-glass" style="right: -210px; color: white;"></i></label>
            </form>
        </li>
        <li>
            <a href=""><i class="fa-solid fa-phone"></i> Hotline: 0929496129</a>
        </li>


        <?php
        if (isset($_SESSION['username'])): ?>
            <?php if ($_SESSION['phanquyen'] === 'user'): ?>
                <li>
                    <a href="cart.php">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Giỏ hàng
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($_SESSION['phanquyen'] === 'admin'): ?>
                <li>
                    <a href="#"><i class="fa-solid fa-gear"></i> Quản trị</a>
                </li>
            <?php endif; ?>

            <li>
                <a href='dangxuat.php'>
                    <i class='fa-solid fa-circle-user'></i>
                    <?php echo "Chào " .  $_SESSION['username'] . " (Đăng Xuất)" ?>
                </a>
            </li>
            <?php else: ?>
            <?php if (basename($_SERVER['PHP_SELF']) != 'dangnhap.php'): ?>
                <li><a href='dangnhap.php'>Đăng Nhập</a></li>
            <?php endif; ?>

            <?php if (basename($_SERVER['PHP_SELF']) != 'dangky.php'): ?>
                <li><a href='dangky.php'>Đăng Ký</a></li>
            <?php endif; ?>
        <?php endif; ?>

    </ul>
</nav>
<style>
    form {
        border: 2px solid white;
        border-radius: 30px;
        padding: 5px 15px;
        margin: auto;
        margin: 0 15px;
    }

    nav {
        background-color: rgb(176, 102, 95, 0.8);
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        border-radius: 10px;
    }

    nav ul {
        display: flex;
        list-style-type: none;
        padding: 0px 4%;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    nav ul li {
        width: auto;
        text-align: center;
    }

    nav ul li a {
        text-decoration: none;
        color: #F9EBDE;
        font-size: 21px;
    }
</style>