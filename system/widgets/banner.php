<?php
// chỉ được nhúng code không được gọi từ URL tránh hacker đọc file thông qua url
if (!defined('IN_SITE')) die ('Đường dẫn hợp lệ nhưng thực chất không hợp lệ bạn ơi');
?>
<!--Baner Slide-->
        <div class="bd-example">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="site/image/banner/s1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block text-warning">
                            <h5>Iphone XI</h5>
                            <p>Điện thoại cao cấp cho IFAN</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="site/image/banner/s2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block text-warning">
                            <h5 >Google Pixel 4XL</h5>
                            <p>Con cưng của Google</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="site/image/banner/s3.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block text-warning">
                            <h5>XIAOMI</h5>
                            <p>Chỉ dành cho dân cày</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <!--END Baner Slide-->
