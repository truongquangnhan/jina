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
            if (session_get('ssquyen') != 'D' && session_get('ssquyen') != 'C' && session_get('ssquyen') != 'B') {
                // đá về index
                location(create_url_site());
                exit();
            }
        }
//Trường hợp còn lại chắc chắn là admin or shiper--------------------------------------------------------------------------
        ?>
        <div class="container-fluid">
            <div class=" row btn btn-sm btn-group">
                <a href="<?php echo create_url_site('admin-index'); ?>" class=" btn btn-sm btn-success">Danh sách đơn đang cần ship</a>
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
                            <th scope="col">NGÀY MUA</th>
                            <th scope="col">THU HỘ(vnd)</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Cập nhập</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt = 1;
                        $sumtien = 0;
                        //if ($stt % 2 == 0)
                        //echo 'class="bg-secondary" ';
                        $tk = session_get('ssidtk');
                        foreach (viewofshiper($tk) as $value) {
                            echo '<tr ';
                            if ($stt % 2 == 0)
                                echo 'style="background-color: #ebebeb"';
                            echo '>'
                            . '<th scope="row">' . $stt . '</th>'
                            . '<td>' . $value['iddh'] . '</td>'
                            . '<td>' . $value['idtk'] . '</td>'
                            . '<td>' . $value['tennguoinhan'] . '</td>'
                            . '<td>' . $value['diachinhan'] . '</td>'
                            . '<td>' . $value['sdtnhan'] . '</td>'
                            . '<td>' . $value['ngaytaodh'] . '</td>'
                            . '<td>' . number_format($value['tongtien']) . '</td>'
                            . '<td class="text-success "><span><b>'.$value['mota'].'<b></span></td>'
                            . '<td>'
                            . '<br><form action="'. create_url_site('shiper-update-status').'" method="POST" class="form-inline">'
                            . '<input type ="text" value = "' . $value['iddh'] . '" name="iddh" style="display:none">'
                            . '<select name="trangthai"class="form-inline bg-warning" required>'
                            . '<option>chọn trạng thái...</option>'
                            . '<option value="B">Đã lấy hàng</option>'
                            . '<option value="C">Đang Giao</option>'
                            . '<option value="D">Giao hàng thành công</option>'
                            . '<option value="F">Khách không nhận hàng</option>'
                            . '</select>'
                            . '<input type="submit" class="form-inline btn-sm btn-dark" height="25px;" value="Cập nhập">'
                            . '</form>'
                            . '</td>'
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
                        . ''
                        . '<td colspan="2">Tổng:</td>'
                        . '<td><strong>' . number_format($sumtien, 0, ".", ",") . '</strong></td>
                              <td></td>
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
