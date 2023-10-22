<?php define("IN_SITE", true); ?>
<!DOCTYPE html>
<html>
    <?php include_once '../../system/widgets/header.php'; ?>

    <body>
        <?php
        include_once '../../system/widgets/nav.php';
        include_once '../../system/widgets/banner.php';
        ?>
        <!-- Danh sách SP -->
        <div class="container-fluid mrtop">      
            <div class="row">
                <div class=" col-lg-1  bg-light logo-hover bg-dark ">
                    <div class="row btn-group ">                     
                        <?php include_once '../../system/widgets/navbarmini.php'; ?>
                    </div>
                </div>
                <div class=" col-lg-11 ">
                    <div class="row bg-dark" style=" margin-bottom: 20px">
                        <marquee><h5 class="  text-white text-sm" style="margin-top: 3px">📢 Thông báo: Từ mùng 1 - 5 tết Âm lịch jina tổ chức quay thưởng cho toàn bộ khách hàng đã đặt hàng tại jina. Giải nhất: 1 thẻ cào trị giá 699k | Giải nhì: 2 voucher 500k mua hàng tại jina | Giải ba: 3 chiếc óp lưng tùy chọn. Xin cảm ơn!</h5></marquee>
                    </div>
                    <?php
                    require_once '../model/model_db_view_index.php';                                        
                    index_viewproduct2("Google");
                    index_viewproduct2("Apple");
                    index_viewproduct2("Huawei");
                    index_viewproduct2("Xiaomi");
                    index_viewproduct2("Samsung");
                    ?>
                </div>
            </div>
            <!-- ------- -->
        </div>
        <?php include_once '../../system/widgets/footer.php'; ?>

    </body>
</html>
