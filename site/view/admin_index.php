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
               <a href="<?php echo create_url_site('admin-index'); ?>" class=" btn btn-sm btn-success">Quản lý đơn</a>
                <a href="<?php echo create_url_site('admin-add-product'); ?>" class=" btn btn-sm btn-dark">Thêm sản phẩm</a>
                <a href="<?php echo create_url_site('admin-list-product'); ?>" class=" btn btn-sm btn-dark">Danh sách sản phẩm</a>
                <a href="#" class=" btn btn-sm btn-dark">Thống kê</a>
                <a href="<?php echo create_url_site('admin-manage-account'); ?>" class=" btn btn-sm btn-dark">Quản lý tài khoản</a>
            </div>
            <div class="row text-sm">
                <table class="table table-sm">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th scope="col">#</th>
                            <th scope="col">IDĐH</th>
                            <th scope="col">IDKH</th>
                            <th scope="col">TÊN KH</th>
                            <th scope="col">ĐỊA CHỈ</th>
                            <th scope="col">SĐT</th>
                            <th scope="col">TRẠNG THÁI</th>
                            <th scope="col">NGÀY MUA</th>
                            <th scope="col">NGƯỜI GIAO</th>
                            <th scope="col">THU HỘ(vnd)</th>
                            <th scope="col">THAO TÁC✔</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt = 1;
                        $sumtien = 0;
                        //if ($stt % 2 == 0)
                            //echo 'class="bg-secondary" ';
                        foreach (view_index_admin() as $value) {
                            echo '<tr ';
                            if ($stt % 2 == 0)
                                echo 'style="background-color: #ebebeb"';echo '>'
                            . '<th scope="row">' . $stt . '</th>'
                            . '<td>' . $value['iddh'] . '</td>'
                            . '<td>' . $value['idtk'] . '</td>'
                            . '<td>' . $value['tennguoinhan'] . '</td>'
                            . '<td>' . $value['diachinhan'] . '</td>'
                            . '<td>' . $value['sdtnhan'] . '</td>'
                            . '<td>' . $value['trangthai'] . '</td>'
                            . '<td>' . $value['ngaytaodh'] . '</td>'
                            . '<td>' . $value['nguoigiaohang'] . '</td>'
                            . '<td>' . number_format($value['tongtien']) . '</td>'
                            . '<td><a title="Shop đã nhận tiền click để hoàn tất đơn hàng" class="btn-sm btn-success" href="'. create_url_site('ctl-ok-order?dh=' . $value['iddh']).'">✔</a>'
                            . '<span> | </span><a title="Xem chi tiết đơn hàng" class="btn-sm btn-success" href = "'. create_url_site('admin-detail-order?iddh=' . $value['iddh'] ).'"> <i class="fas fa-align-justify"></i></a></td>'
                            . '</tr>'
                            ;
                            $sumtien = $value['tongtien'] + $sumtien;
                            $stt = $stt + 1;
                        }
                        echo '<tr class="bg-success">'
                        . '<th scope="row">#</th>'
                        . '<td></td>'
                        . '<td></td>'
                        . '<td></td>'
                        . '<td></td>'
                        . '<td></td>'
                        . '<td></td>'
                        . '<td colspan="2">Tổng:</td>'
                        . '<td><strong>' . number_format($sumtien, 0, ".", ",") . '</strong></td>
                              <td></td>
                              </tr>';
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
        <?php require_once '../../system/widgets/footer.php'; ?>
    </body>
</html>
