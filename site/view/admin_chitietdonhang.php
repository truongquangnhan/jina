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
        if (empty(input_get('iddh'))) {
            location(create_url_site('admin-index'));
        } else {
            if (input_get('iddh') <= 0) {
                location(create_url_site('admin-index'));
            } else if (input_get('iddh') / 1) {
                $iddh = input_get('iddh');
            } else {
                location(create_url_site('admin-index'));
            }
        }
        ?>
        <div class="container-fluid">
            <div class=" row btn btn-sm btn-group">
                <a href="<?php echo create_url_site('admin-index'); ?>" class=" btn btn-sm btn-success">Quản lý đơn</a>
                <a href="<?php echo create_url_site('admin-add-product'); ?>" class=" btn btn-sm btn-dark">Thêm sản phẩm</a>
                <a href="<?php echo create_url_site('admin-list-product'); ?>" class=" btn btn-sm btn-dark">Danh sách sản phẩm</a>
                <a href="#" class=" btn btn-sm btn-dark">Thống kê</a>
                <a href="<?php echo create_url_site('admin-manage-account'); ?>" class=" btn btn-sm btn-dark">Quản lý tài khoản</a>
            </div>
            <div class="container">
                <div class="row text-sm">                
                    <table class="table table-sm">
                        <thead>
                            <tr class=""><th class="bg-dark text-white " colspan="9"><span>Thông tin sản phẩm khách hàng mua</span></th></tr>

                        </thead>
                        <thead>
                            <tr class="bg-primary text-white">
                                <th scope="col">#</th>
                                <th scope="col">TÊN SẢN PHẨM</th>
                                <th scope="col">LOẠI SẢN PHẨM</th>
                                <th scope="col">SỐ LƯỢNG</th>
                                <th scope="col">GIÁ SẢN PHẨM</th>                                                                                         
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 1;
                            $tongtien = 0;
                            $mdon;
                            $mtaikhoan;
                            $tennguoidat;
                            $diachi;
                            $sdt;
                            $trangthai;
                            $nguoiship;
                            $ngaydat;
                            foreach (admin_chitietdonhang($iddh) as $value) {
                                $mdon = $value['iddh'];
                                $mtaikhoan = $value['idtk'];
                                $tennguoidat = $value['tennguoinhan'];
                                $diachi = $value['diachinhan'];
                                $sdt = $value['sdtnhan'];
                                $trangthai = $value['trangthaidonhang'];
                                $nguoiship = $value['nguoigiaohang'];
                                $ngaydat = $value['ngaytaodh'];
                                $tensp = $value['tensanpham'];
                                $loai = $value['loaisanpham'];
                                $sl = $value['soluong'];
                                $gia = $value['giaxuathoadon'];
                                $tongtien = $tongtien + $value['soluong'] * $value['giaxuathoadon'];
                                echo '<tr>
                            <th scope="row">' . $stt . '</th>
                            <td>' . $tensp . '</td>
                            <td>' . $loai . '</td>
                            <td>' . $sl . '</td>
                            <td>' . $gia . '</td>
                            </tr>';
                                $stt += 1;
                            }
                            echo '<tr class="bg-success text-warning">
                            <td colspan="2"></td>
                            <td colspan="2">Tổng tiền:</td>
                            <td>' . $tongtien . '</td>
                            </tr>';
                            ?>
                        </tbody>
                    </table >
                    <table class="table table-sm">
                        <tbody>
                            <tr class=""><th class="bg-dark text-white" colspan="9"><span>Thông tin đơn hàng</span></th></tr>
                        </tbody>
                        <tfoot>
                            <tr class="bg-primary text-white font-weight-light">                       
                                <th scope="col">MÃ ĐƠN</th>
                                <th scope="col">MÃ TK</th>
                                <th scope="col">TÊN NGƯỜI ĐẶT</th>
                                <th scope="col">ĐỊA CHỈ</th>
                                <th scope="col">ĐIỆN THOẠI</th>
                                <th scope="col">TRẠNG THÁI ĐƠN</th>
                                <th scope="col">NGƯỜI SHIP</th>
                                <th scope="col">NGÀY ĐẶT</th>                                                                  
                            </tr>

                            <?php
                            echo '<tr>'
                            . '<td>' . $mdon . '</td>'
                            . '<td>' . $mtaikhoan . '</td>'
                            . '<td>' . $tennguoidat . '</td>'
                            . '<td>' . $diachi . '</td>'
                            . '<td>' . $sdt . '</td>'
                            . '<td>' . $trangthai . '</td>'
                            . '<td>' . $nguoiship . '</td>'
                            . '<td>' . $ngaydat . '</td>'
                            . '</tr>'
                            ;
                            ?>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <?php require_once '../../system/widgets/footer.php'; ?>
    </body>
</html>
