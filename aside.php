<aside>
    <ul style="text-align: center;">

        <li class="banner-list" style="margin-left: 50px;">
            <button class="banner-btn-left" style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); z-index: 1;background: rgb(255, 255, 255, 0.5);border: none;border-radius: 5px; cursor: pointer;">
                <i class="fa-solid fa-caret-left" style="padding: 10px 0px; font-size: 25px;"></i>
            </button>
            <a href="" class="banner">
                <img src="anh/banner1.webp" alt="">
            </a>
            <a href="" class="banner">
                <img src="anh/banner2.webp" alt="">
            </a>
            <a href="" class="banner">
                <img src="anh/banner3.webp" alt="">
            </a>
            <button class="banner-btn-right" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%);background: rgb(255, 255, 255, 0.5);border: none;border-radius: 5px; cursor: pointer;"> 
                <i class="fa-solid fa-caret-right" style="padding: 10px 0px; font-size: 25px; "></i>
            </button>
        </li>
        <script>
            function showBanner(index) {
                var banner = document.querySelectorAll('.banner');
                for (var i = 0; i < banner.length; i++) {
                    banner[i].style.transform = 'translateX(-' + index * 100 + '%)';
                }
                // Nếu banner cuối cùng thì tạo hiệu ứng chuyển đến banner đầu tiên

            }

            var banner = document.querySelectorAll('.banner');
            var bannerIndex = 0;
            var bannerBtnLeft = document.querySelector('.banner-btn-left');
            var bannerBtnRight = document.querySelector('.banner-btn-right');
            bannerBtnLeft.addEventListener('click', function() {
                bannerIndex--;
                if (bannerIndex < 0) {
                    bannerIndex = banner.length - 1;
                }
                showBanner(bannerIndex);
            });
            bannerBtnRight.addEventListener('click', function() {
                bannerIndex++;
                if (bannerIndex > banner.length - 1) {
                    bannerIndex = 0;
                }
                showBanner(bannerIndex);
            });

            // Tự động chuyển banner
            setInterval(function() {
                bannerIndex++;
                if (bannerIndex > banner.length - 1) {
                    bannerIndex = 0;
                }
                showBanner(bannerIndex);
            }, 3000);
        </script>
        <li class="brand" style="width: 50%; margin-left: 20px;">
            <a href="">
                <img src="anh/logo-brand-burberryx.webp" alt="" class="logo-brand">

            </a>
            <a href="">
                <img src="anh/logo-brand-calvin-klein.webp" alt="" class="logo-brand">
            </a>
            <a href="">
                <img src="anh/logo-brand-carolina-herrera.webp" alt="" class="logo-brand">
            </a>
            <a href="">
                <img src="anh/logo-brand-chloe.webp" alt="" class="logo-brand">
            </a>
            <a href="">
                <img src="anh/logo-brand-giorgio-armani.webp" alt="" class="logo-brand">
            </a>
            <a href="">
                <img src="anh/logo-brand-gucci.webp" alt="" class="logo-brand">
            </a>
            <a href="">
                <img src="anh/logo-brand-jean-paul-gaultier.webp" alt="" class="logo-brand">
            </a>
            <a href="">
                <img src="anh/logo-brand-lacoste.webp" alt="" class="logo-brand">
            </a>
            <a href="">
                <img src="anh/logo-brand-marc-jacobss.webp" alt="" class="logo-brand">
            </a>
            <a href="">
                <img src="anh/logo-brand-narciso-rodriguez.webp" alt="" class="logo-brand">
            </a>
            <a href="">
                <img src="anh/logo-brand-paco-rabanne.webp" alt="" class="logo-brand">
            </a>
            <a href="">
                <img src="anh/logo-brand-prada.webp" alt="" class="logo-brand">
            </a>
            <a href="">
                <img src="anh/logo-brand-ralph-lauren.webp" alt="" class="logo-brand">
            </a>
            <a href="">
                <img src="anh/logo-brand-valentino.webp" alt="" class="logo-brand">
            </a>
            <a href="">
                <img src="anh/logo-brand-versace.webp" alt="" class="logo-brand">
            </a>
            <a href="">
                <img src="anh/logo-brand-viktor-rolf.webp" alt="" class="logo-brand">
            </a>
        </li>
    </ul>
</aside>
<style>
    aside {
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 10px;
    }

    aside ul {
        display: flex;
        list-style-type: none;
        overflow: hidden;
    }

    aside ul li a {
        text-decoration: none;
        color: black;
    }

    .banner-list {
        position: relative;
        width: 44%;
        height: 300px;
        display: flex;
        overflow: hidden;
    }

    .banner {
        display: inline-block;
        width: 100%;
        transition: all 0.5s;
    }



    .banner img {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 100%;
    }

    .logo-brand {
        width: 150px;
        height: auto;
    }
</style>