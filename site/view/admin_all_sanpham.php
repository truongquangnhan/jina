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
            // location('http://localhost/jina.com/site/view/index.php');
            exit();
        } else {
            // đã đăng nhập
            // nếu ko phải quyền admin
            if (session_get('ssquyen') != 'D') {
                // đá về index
                location(create_url_site());
                //location("http://localhost/jina.com/site/view/index.php");
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
            <div class="row text-sm">
                <table class="table table-sm">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th scope="col">#</th>
                            <th scope="col">IDĐT</th>
                            <th scope="col">IDK</th>
                            <th scope="col">TÊN ĐT</th>
                            <th scope="col">LOẠI MÁY</th>
                            <th scope="col">TỔNG SL</th>
                            <th scope="col">SL CÒN</th>
                            <th scope="col">THƯƠNG HIỆU</th>
                            <th scope="col">GIÁ BÁN</th>
                            <th scope="col">GIÁ NHẬP</th>
                            <th scope="col">SALE</th>
                            <th scope="col">#</th>                                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt = 1;
                        foreach (view_admin_sanpham() as $value) {
                            echo '<tr ';
                            if ($stt % 2 == 0)
                                echo 'style="background-color: #ebebeb"';echo '>'
                            . '<th scope="row">' . $stt . '</th>'
                            . '<td>' . $value['iddt'] . '</td>'
                            . '<td>' . $value['idkho'] . '</td>'
                            . '<td>' . $value['tendt'] . '</td>'
                            . '<td>' . $value['loaimay'] . '</td>'
                            . '<td>' . $value['tongsl'] . '</td>'
                            . '<td>' . $value['soluongcon'] . '</td>'
                            . '<td>' . $value['hangdt'] . '</td>'
                            . '<td>' . number_format($value['giaban']) . '</td>'
                            . '<td>' . number_format($value['gianhap']) . '</td>'
                            . '<td>' . $value['giamgia'] . '</td>'
                            . '<td><a title="Xem chi tiết và cập nhập sản phẩm" href ="'. create_url_site('admin-detail-product?iddt='. $value['iddt']).'"><i class="fas fa-align-justify"></i></a>'
                            . '<span> | </span><a title="Xóa sản phẩm" href = "'. create_url_site('ctl-delete-product?iddt='. $value['iddt']).'"> <i class="fas fa-backspace"></i></a></td>'
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
