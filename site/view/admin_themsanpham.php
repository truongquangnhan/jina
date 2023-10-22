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
        // nếu chưa đăng nhập
        if (!session_get('sstaikhoan')) {
            location(create_url_site());
            exit();
        } else {
            // đã đăng nhập
            // nếu ko phải quyền admin
            if (session_get('ssquyen') != 'D') {
                // đá về index
                 location(create_url_site());
                exit();
            }
        }
//Trường hợp còn lại chắc chắn là admin --------------------------------------------------------------------------
        ?>
        <div class="container-fluid">
            <div class=" row btn btn-sm btn-group">
                <a href="<?php echo create_url_site('admin-index'); ?>" class=" btn btn-sm btn-dark">Quản lý đơn</a>
                <a href="<?php echo create_url_site('admin-add-product'); ?>" class=" btn btn-sm btn-success">Thêm sản phẩm</a>
                <a href="<?php echo create_url_site('admin-list-product'); ?>" class=" btn btn-sm btn-dark">Danh sách sản phẩm</a>
                <a href="#" class=" btn btn-sm btn-dark">Thống kê</a>
                <a href="<?php echo create_url_site('admin-manage-account'); ?>" class=" btn btn-sm btn-dark">Quản lý tài khoản</a>
            </div>
            <div class="container">
                <div class="row text-sm">
                    <form action="site/controller/admin_themsanpham.php" method="POST" enctype = "multipart/form-data">
                        <?php
                        if (!empty(input_get("status"))) {
                            if (input_get("status") == 'true') {
                                echo '<div class="row bg-warning text-white" ><span style="width: 100%;text-align: center">ĐÃ THÊM 1 SẢN PHẨM</span></div> ';
                            } else {
                                echo '<div class="row bg-warning text-white" ><span style="width: 100%;text-align: center">';
                                echo 'LỖI THÊM SẢN PHẨM THẤT BẠI';
                                if (!empty(input_get("text"))) {
                                    echo '-'.input_get("text");
                                }
                                echo'</span></div> ';
                            }
                        }
                        ?>

                        <div class="row bg-info text-white">Thông tin sản phẩm</div> 
                        <div class="form-group">    
                            <div class="row">
                                <input type="text" required class="col-6 form-control" id="exampleFormControlInput1" placeholder="Tên sản phẩm" name="tensp">
                                <input type="text" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Thương hiệu" name="hangsp">               
                            </div>

                            <div class="row">
                                <select class="col-6 form-control" id="exampleFormControlSelect1" name="loaisp">
                                    <option value="Like new" >Like new</option>
                                    <option value="Full box">Full box</option>
                                    <option value="New 100%" selected>New 100%</option>
                                    <option value="Máy cũ">Máy cũ</option>

                                </select>
                                <input type="number" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Kho chứa" name="kho">
                            </div>

                        </div>
                        <div class="row bg-info text-white">Thông tin giá & số lượng</div> 
                        <div class="form-group">
                            <div class="row">

                                <input type="number" required class="col-6 form-control" id="exampleFormControlInput1" placeholder="Giá nhập" name="gianhap">   
                                <input type="number" required class="col-6 form-control" id="exampleFormControlInput1" placeholder="Giá bán" name="giaban"> 
                                <input type="number" required class="col-6 form-control" id="exampleFormControlInput1" placeholder="Số lượng nhập" name="soluongnhap">
                            </div>

                        </div>
                        <div class="row bg-info text-white">Thông tin chi tiết</div> 
                        <div class="form-group">
                            <div class="row">
                                <input type="text" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Hệ điều hành" name="hedieuhanh">
                                <input type="text" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Phiên bản" name="phienban">
                                <input type="text" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Độ phân giải màn hình" name="dophangiaimanhinh">   
                                <input type="text" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Camera trước" name="cameratruoc"> 
                                <input type="text" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Camera sau" name="camerasau"> 
                                <input type="text" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Sim" name="sim"> 
                                <input type="text" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Wifi" name="wifi"> 
                                <input type="text" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Bluetoolh" name="bluetoolh"> 
                                <input type="text" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Pin" name="pin"> 
                                <input type="text" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Bảo mật" name="baomat"> 
                                <input type="text" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Ram" name="ram"> 
                                <input type="text" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Bộ nhớ trong" name="bonhotrong">
                                <input type="file" required  class="col-6 form-control" id="exampleFormControlInput1" placeholder="Hình ảnh" name="hinhanh" accept="image/jpeg ,image/gif">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormControlTextarea1">Thông tin khác</label>
                            <textarea class="col-12 form-control" id="exampleFormControlTextarea1" rows="3" name="thongtinkhac"></textarea>

                        </div>
                        <div class="form-group">
                            <input type="submit" class="col-6 offset-3 bg-dark btn text-white" value="Thêm sản phẩm">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php require_once '../../system/widgets/footer.php'; ?>
    </body>
</html>
