<?php
define("IN_SITE", true);
ob_start();
?>
<!DOCTYPE html>

<html>
    <?php require_once '../../system/widgets/header.php'; ?>
    <?php require_once '../../system/widgets/headerfile2.php'; ?>
    <body>
        <?php require_once '../../system/widgets/nav.php'; ?>

        <?php
        require_once '../../system/library/getpost.php';
        require_once '../../system/library/session.php';
        require_once '../model/model_db.php';
        // <img style="max-width: 300px" class="mr-3 img-thumbnail" src="<?php echo create_url_site('site/image/user/nhomimg1.jpg'); " alt="Generic placeholder image">
        ?>

        <div class="container-fluid bd-content bd-example bg-dark text-white mt-1 pb-5 pt-5">
            <div class="row  mt-2">
                <!-- -->
                <div class=" col-lg-2 col-3 mt-5 pb-5  ">
                    <div id="list-example" class="list-group">
                        <a class="list-group-item list-group-item-action" href="#list-item-1">Thời gian và địa điểm</a>
                        <a class="list-group-item list-group-item-action" href="#list-item-2">Nội dung</a>
                        <a class="list-group-item list-group-item-action" href="#list-item-3">Hoạt động thành viên</a>
                        <a class="list-group-item list-group-item-action" href="#list-item-4">Hình ảnh</a>
                    </div>
                
                <div  class="col-lg-10 col-9">
                    <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example bg-secondary text-center col-12">Nhóm 1</div>
                    <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example ">
                        <h4 id="list-item-1" class="bg-success p-2">Thời gian và địa điểm</h4>                            
                        <p class="text-warning">✔ Thời gian: <b>từ 13h30 đến 18h</b> thứ 7 ngày 28 tháng 12 năm 2019</p>
                        <p>✔ Địa điểm: 106 đường Ông Ích Khiêm Quận Hải Châu Đà Nẵng<b>(OchaOfHouse)</b></p>
                        <h4 id="list-item-2">Nội dung</h4>
                        <p>✔ Thảo luận các vấn đề về giải quyết giỏ hàng và đặt hàng</p>
                        <p>✔ Các vấn đề liên quan đến function procedure trigger trong cơ sở dữ liệu</p>
                        <p>✔ Các vấn đề về chuẩn hóa cơ sở dữ liệu</p>
                        <p>✔ Thảo luận về quy trình cộng trừ số lượng sau khi đặt hay hủy đơn hàng</p>
                        <h4 id="list-item-3">Hoạt động thành viên</h4>
                        <br>
                        <p>Trương Quang Nhân: Các bước đặt hàng bằng procedure !!</p>
                        <p>Trương Quang Luận: thành viên tranh luận</p>
                        <p>Nguyễn Lê Văn Khải: thành viên tranh luận</p>
                        <p>Nguyễn Minh Tuấn: thành viên tranh luận</p>
                        <p>Đắc Hòa: thành viên tranh luận</p>
                        <p>Nguyễn Văn Gia Bảo: Nên thêm bảng danh mục sản phẩm.</p>
                        <p></p>
                        <h4 id="list-item-4">Hình ảnh</h4>
                        <p>Hình ảnh các thành viên trong buổi hoạt động nhóm</p>
                        <p>
                            <img style="max-width: 300px" class="mr-3 img-thumbnail" src="<?php echo create_url_site('site/image/user/nhomimg1.jpg'); ?>" title="Hình ảnh các thành viên nao nức hoạt động nhóm">
                            <img style="max-width: 300px" class="mr-3 img-thumbnail" src="<?php echo create_url_site('site/image/user/nhomimg2.jpg'); ?>" title="Hình ảnh các thành viên nao nức hoạt động nhóm">                            
                        </p>
                    </div>
                    <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example ">
                        <h4 id="list-item-1" class="bg-success p-2 mt-5">Thời gian và địa điểm</h4>                            
                        <p  class="text-warning">✔ Thời gian: <b>từ 13h30 đến 15h</b> Chủ nhật ngày 05 tháng 01 năm 2020</p>
                        <p>✔ Địa điểm: 106 đường Ông Ích Khiêm Quận Hải Châu Đà Nẵng<b>(OchaOfHouse)</b></p>
                        <h4 id="list-item-2">Nội dung</h4>
                        <p>✔ Thảo luận các vấn đề về bắt lỗi đặt hàng</p>
                        <p>✔ Hiển thị thêm các danh mục sản phẩm</p>
                        <p>✔ Sửa lỗi không đặt được hàng</p>                        
                        <h4 id="list-item-3">Hoạt động thành viên</h4>
                        <br>
                        <p>Trương Quang Nhân: Hiển thị thêm các danh mục sản phẩm</p>
                        <p>Trương Quang Luận: Phân loại sản phẩm theo loại</p>
                        <p>Nguyễn Lê Văn Khải: thành viên tranh luận</p>
                        <p>Nguyễn Minh Tuấn: thành viên tranh luận</p>
                        <p>Đắc Hòa: Nên thêm form để cập nhập thông tin giao hàng</p>
                        <p>Nguyễn Văn Gia Bảo: thành viên tranh luận</p>
                        <p></p>
                        <h4 id="list-item-4">Hình ảnh</h4>
                        <p>Hình ảnh các thành viên trong buổi hoạt động nhóm</p>
                        <p>                            
                            <img style="max-width: 300px" class="mr-3 img-thumbnail" src="<?php echo create_url_site('site/image/user/nhom5.jpg'); ?>" title="Hình ảnh các thành viên nao nức hoạt động nhóm">                            
                            <img style="max-width: 300px" class="mr-3 img-thumbnail" src="<?php echo create_url_site('site/image/user/nhom4.jpg'); ?>" title="Hình ảnh các thành viên nao nức hoạt động nhóm">                          
                        </p>
                    </div>
                    <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example ">
                        <h4 id="list-item-1" class="bg-success p-2 mt-5">Thời gian và địa điểm</h4>                            
                        <p  class="text-warning">✔ Thời gian: <b>từ 13h30 đến 14h</b> Thứ 5 ngày 09 tháng 01 năm 2020</p>
                        <p>✔ Địa điểm: 106 đường Ông Ích Khiêm Quận Hải Châu Đà Nẵng<b>(OchaOfHouse)</b></p>
                        <h4 id="list-item-2">Nội dung</h4>
                        <p>✔ Thống nhất bảng báo cáo</p>
                        <p>✔ Chỉnh sửa báo cáo</p>
                        <p>✔ Góp ý về báo cáo của nhóm</p>                        
                        <h4 id="list-item-3">Hoạt động thành viên</h4>
                        <br>
                        <p>Trương Quang Nhân: Góp ý chia nhỏ báo cáo thành từng phần</p>
                        <p>Trương Quang Luận: Góp ý nên tạo quy trình đặt hàng để báo cáo</p>
                        <p>Nguyễn Lê Văn Khải: thành viên tranh luận</p>
                        <p>Nguyễn Minh Tuấn: Bõ bớp phần báo cáo code và những thứ không liên quan</p>
                        <p>Đắc Hòa: thành viên tranh luận</p>
                        <p>Nguyễn Văn Gia Bảo: thành viên tranh luận</p>
                        <p></p>
                        <h4 id="list-item-4">Hình ảnh</h4>
                        <p>Hình ảnh các thành viên trong buổi hoạt động nhóm</p>
                        <p>                                                        
                            <img style="max-width: 300px" class="mr-3 img-thumbnail" src="<?php echo create_url_site('site/image/user/nhom3.jpg'); ?>" title="Hình ảnh các thành viên nao nức hoạt động nhóm">
                            <img style="max-width: 300px" class="mr-3 img-thumbnail" src="<?php echo create_url_site('site/image/user/nhom6.jpg'); ?>" title="Hình ảnh các thành viên nao nức hoạt động nhóm">
                        </p>
                    </div>
                </div>
                <!-- -->

            </div>

    </body>
</html>
