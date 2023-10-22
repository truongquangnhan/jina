<?php define("IN_SITE", true); ?>
<!DOCTYPE html>
<html>
    <?php include_once '../../system/widgets/header.php'; ?>

    <body>
        <?php include_once '../../system/widgets/nav.php';
        ?>
        <!-- Danh sách SP -->
        <div class="container-fluid mrtop">      
            <div class="row">                
                <!-- detail -->

                <div class="bg-dark col-lg-10 offset-lg-1 col-md-10 offset-md-1 col-sm-12 col-12">
                    <div class="row" style="min-height: 30px;" ></div>


                    <!-- start -->
                    <?php
                    if (session_get('ssidtk')) {
                        $tk = session_get('ssidtk');
                    } else {
                         location(create_url_site('login'));
                    }

                    $tt = '';
                    $tring = '';
                    $bg1 = '';
                    $bg2 = '';
                    $bg3 = '';
                    $bg4 = '';
                    $bg5 = '';
                    foreach (gettrangthaidonhang($tk) as $value) {
                        $tt = $value['trangthaidh'];
                    }
                    switch ($tt) {
                        case 'A':
                            $bg1 = 'bg-warning';
                            $tring = 'Đơn hàng chưa tiến hành đặt hàng';
                            break;
                        case 'B':
                            $bg1 = 'bg-warning';
                            $bg2 = 'bg-warning';
                            $tring = 'Đã tiếp nhận đơn hàng';
                            break;
                        case 'C':
                            $bg1 = 'bg-warning';
                            $bg2 = 'bg-warning';
                            $bg3 = 'bg-warning';
                            $tring = 'Kiện hàng đang được vận chuyển';
                            break;
                        case 'D':
                            $bg1 = 'bg-warning';
                            $bg2 = 'bg-warning';
                            $bg3 = 'bg-warning';
                            $bg4 = 'bg-warning';
                            $bg5 = 'bg-success';
                            $tring = 'Đơn hàng thành công. Bạn vui lòng đánh giá và gửi feedback bên dưới';
                            break;
                        default:
                            $tring = 'Làm gì tồn tại đơn hàng nào để xem đâu chứ !';
                            break;
                    }
                    echo '<div class="row">                            
                        <div class="col-8 offset-2 ">
                            <div class="row">

                                <div class="col-2 offset-1  ' . $bg1 . ' ">
                                    <div class="row ">
                                        <img class="w-100" src="site/image/logo/0.png" alt=""/>
                                    </div>

                                </div>
                                <div class="col-2 ">
                                    <div class="row ' . $bg2 . '">
                                        <img class="w-100" src="site/image/logo/1.png" alt=""/>
                                    </div>

                                </div>
                                <div class="col-2   ' . $bg3 . ' ">
                                    <div class="row ">
                                        <img class="w-100" src="site/image/logo/2.png" alt=""/>
                                    </div>

                                </div>
                                <div class="col-2   ' . $bg4 . ' ">
                                    <div class="row ">
                                        <img class="w-100" src="site/image/logo/3.png" alt=""/>
                                    </div>

                                </div>
                                <div class="col-2   ' . $bg5 . ' ">
                                    <div class="row ">
                                        <img class="w-100" src="site/image/logo/4.png" alt=""/>
                                    </div>

                                </div>

                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <p class="h6 col-12 text-center text-warning">' . $tring . '</p>
                            </div>

                        </div>
                    </div>';
                    ?>


                    <!--end -->


                    <div class="row" style="min-height: 30px;" ></div>
                    <div class="row text-white">

                        <!-- thông tin đơn hàng đã mua -->
                        <?php
                        user_print_allcart_detail(session_get('ssidtk'));
                        ?>

                        <!-- end thông tin đơn hàng đã mua -->
                    </div>
                    <div class="row" style="min-height: 30px;" ></div>
                </div>
            </div>
            <!-- end row 1 -->

            <!-- ------- -->
        </div>
        <!-- ---end container-fluid---- -->
















        <?php include_once '../../system/widgets/footer.php'; ?>

    </body>
</html>
