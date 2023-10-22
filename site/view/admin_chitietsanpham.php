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
                <a href="<?php echo create_url_site('admin-add-product'); ?>" class=" btn btn-sm btn-dark">Thêm sản phẩm</a>
                <a href="<?php echo create_url_site('admin-list-product'); ?>" class=" btn btn-sm btn-success">Danh sách sản phẩm</a>
                <a href="#" class=" btn btn-sm btn-dark">Thống kê</a>
                <a href="<?php echo create_url_site('admin-manage-account'); ?>" class=" btn btn-sm btn-dark">Quản lý tài khoản</a>
            </div>
            <div class="container">
            <div class="row text-sm">
                <form action="site/controller/admin_capnhapsanpham.php" method="POST" enctype="multipart/form-data">
                    <?php /*
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
                        } */
                    ?>

                    <div class="row bg-info text-white"> - Thông tin sản phẩm</div> 
                    <?php
                    if (!empty(input_get("iddt"))) {
                        $iddt = input_get("iddt");
                        foreach (view_admin_chitietsanpham($iddt) as $value) {
                            echo '<div class="form-group">    
                        <div class="row">
                        
                            <input type="text" class="" style="display: none" name="iddt" value="' . $iddt . '">'
                            . '<input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Tên sản phẩm" name="tensp" value="' . $value['tendt'] . '">'
                            . ' <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Thương hiệu" value="' . $value['hangdt'] . '" name="hangsp">     '
                            . '
                            <select class="col-3 form-control" id="exampleFormControlSelect1" name="loaisp">'
                            ;
                            switch ($value['loaimay']) {
                                case "Full box":
                                    echo '<option value="Like new" >Like new</option>
                                    <option value="Full box" selected>Full box</option>
                                    <option value="New" >New 100%</option>
                                    <option value="old">Máy cũ</option>';
                                    break;
                                case "Like new":
                                    echo '<option value="Like new" selected>Like new</option>
                                    <option value="Full box" >Full box</option>
                                    <option value="New" >New 100%</option>
                                    <option value="old">Máy cũ</option>';
                                    break;
                                case "New":
                                    echo '<option value="Like new" >Like new</option>
                                    <option value="Full box" >Full box</option>
                                    <option value="New" selected >New 100%</option>
                                    <option value="old">Máy cũ</option>';
                                    break;
                                case "old":
                                    echo '<option value="Like new" >Like new</option>
                                    <option value="Full box" >Full box</option>
                                    <option value="New" >New 100%</option>
                                    <option value="old" selected>Máy cũ</option>';
                                    break;

                                default:
                                    echo '<option value="Like new" >Like new</option>
                                    <option value="Full box">Full box</option>
                                    <option value="New" selected>New 100%</option>
                                    <option value="old">Máy cũ</option>';
                                    break;
                            }                           
                            echo '</select>'
                            . '<input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Kho chứa" value="'.$value['idkho'].'" name="kho">
                    </div>

                    </div>
                    <div class="row bg-info text-white"> - Thông tin giá & số lượng</div> 
                    <div class="form-group">
                        <div class="row">

                            <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Giá nhập" value="'.$value['gianhap'].'" name="gianhap">   
                    <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Giá bán" value="'.$value['giaban'].'" name="giaban"> 
                            <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Số lượng nhập" value="'.$value['tongsl'].'"  name="soluongnhap">
                        </div>

                    </div>
                    <div class="row bg-info text-white"> - Thông tin chi tiết</div> 
                    <div class="form-group">
                        <div class="row">
                            <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Hệ điều hành" value="'.$value['hedieuhanh'].'"  name="hedieuhanh">
                            <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Phiên bản" value="'.$value['phienban'].'"  name="phienban">
                            <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Độ phân giải màn hình" value="'.$value['dophangiaimh'].'"  name="dophangiaimanhinh">   
                            <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Camera trước" value="'.$value['cameratruoc'].'"  name="cameratruoc"> 
                            <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Camera sau" value="'.$value['camerasau'].'"  name="camerasau"> 
                            <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Sim" value="'.$value['sim'].'"  name="sim"> 
                            <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Wifi" value="'.$value['wifi'].'"  name="wifi"> 
                            <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Bluetoolh" value="'.$value['bluetoolh'].'"  name="bluetoolh"> 
                            <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Pin" value="'.$value['pin'].'"  name="pin"> 
                            <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Bảo mật" value="'.$value['baomat'].'"  name="baomat"> 
                            <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Ram" value="'.$value['ram'].'"  name="ram"> 
                            <input type="text" class="col-3 form-control" id="exampleFormControlInput1" title="Bộ nhớ trong" value="'.$value['bonhotrong'].'"  name="bonhotrong">
                            <input type="file" class="col-3 form-control" id="exampleFormControlInput1" title="Hình ảnh" value="'.$value['hinhanh'].' "  name="hinhanh" >

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormControlTextarea1">Thông tin khác</label>
                        <textarea class="col-12 form-control" id="exampleFormControlTextarea1" rows="3"  value=""  name="thongtinkhac">'.$value['thongtinkhac'].'</textarea>'
                        ;
                        }
                    }
                    ?>



                   

               
                   
                    </div>
                    <div class="form-group">
                        <input type="submit" class="col-4 offset-4 bg-dark btn text-white" value="Cập nhập sản phẩm">
                    </div>
                </form>
            </div>
            </div>
        </div>
        <?php require_once '../../system/widgets/footer.php'; ?>
    </body>
</html>

