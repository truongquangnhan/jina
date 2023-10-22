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
                <a href="<?php echo create_url_site('admin-list-product'); ?>" class=" btn btn-sm btn-dark">Danh sách sản phẩm</a>
                <a href="#" class=" btn btn-sm btn-dark">Thống kê</a>
                <a href="<?php echo create_url_site('admin-manage-account'); ?>" class=" btn btn-sm btn-success">Quản lý tài khoản</a>
            </div>
            <div class="row text-sm">
                <table class="table table-sm">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th scope="col">#</th>
                            <th scope="col">IDTK</th>
                            <th scope="col">USERNAME</th>
                            <th scope="col">QUYỀN TK</th>
                            <th scope="col">STATUS</th>                           
                            <th scope="col">HỌ VÀ TÊN</th>
                            <th scope="col">ĐỊA CHỈ</th>
                            <th scope="col">SĐT</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">NGÀY TẠO</th>
                            <th scope="col">#</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt = 1;
                        foreach (admin_viewtaikhoan() as $value) {
                            echo '<tr ';
                            if ($stt % 2 == 0)
                                echo 'style="background-color: #ebebeb"'; 
                            echo '>'
                            . '<th scope="row">' . $stt . '</th>'
                            . '<td>' . $value['idtk'] . '</td>'
                            . '<td>' . $value['usname'] . '</td>'
                            . '<td>' . $value['quyen'] . '</td>'
                            . '<td>' . $value['trangthai'] . '</td>'
                            . '<td>' . $value['hovaten'] . '</td>'
                            . '<td>' . $value['diachi'] . '</td>'
                            . '<td>' . $value['sdt'] . '</td>'
                            . '<td>' . $value['email'] . '</td>'
                            . '<td>' . $value['ngaytaotk'] . '</td>'
                            . '<td>'
                            . '<a title="Tạm khóa tài khoản" href ="#"><i class="fas fa-align-justify"></i></a>'
                            . '</td>'
                            . '</tr>'
                            ;
                            $stt = $stt + 1;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php require_once '../../system/widgets/footer.php'; ?>
    </body>
</html>
