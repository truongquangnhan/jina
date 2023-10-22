<?php
// chỉ được nhúng code không được gọi từ URL tránh hacker đọc file thông qua url
if (!defined('IN_SITE'))
    die('Đường dẫn hợp lệ nhưng thực chất không hợp lệ bạn ơi');

require_once '../../system/library/session.php';
require_once '../../system/library/getpost.php';
require_once '../../site/controller/user_function.php';
?>
<!--Nav menu-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="<?php echo create_url_site(); ?>"><span class="text-warning">MÁY IN CÔNG NGHIỆP </span>ĐÀ NẴNG</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo create_url_site('option-result?key=Google');?>">MÁY IN DATE</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo create_url_site('option-result?key=Apple');?>">MÁY IN PHUN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo create_url_site('option-result?key=Samsung');?>">MỰC MÁY IN</a>
            </li>  
            <li class="nav-item">
                <a class="nav-link" href="<?php echo create_url_site('option-result?key=Sony');?>">BĂNG TẢI BĂNG CHUYỀN</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="<?php echo create_url_site('option-result?key=Huawei');?>">HUAWEI</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link unborder" href="<?php echo create_url_site('option-result?key=Xiaomi');?>">XIAOMI</a>
            </li> 
        </ul>

    </div>        

    <!-- search -->
    <form action="<?php echo create_url_site('option-result');?>" method="POST" class="form-inline my-2 my-lg-0 mr-1">
        <input class="form-control mr-sm-2 " type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <!-- login -->
    <div class="btn-group">

        <?php
        // nếu đã đăng nhập thì sstaikhoan != null
        if (session_get('sstaikhoan')) {
            echo '<a href="#" class="btn btn-dark active">
                    <i class="fas fa-user"></i>' . ' ' . session_get('sstaikhoan') . '
                </a>
                <a href="'. create_url_site('ctl-logout').'" class="btn btn-secondary">
                    <i class="fas fa-sign-out-alt"></i>
                </a>';
            // nếu là admin thì cho các nút quản lý
            if (session_get('ssquyen') == 'D') {
                echo '
                <a href="'. create_url_site('admin-index').'" class="btn btn-secondary">
                    <i class="fas fa-cogs"></i>
                </a>
                <a href="'. create_url_site('admin-manage-account').'" class="btn btn-secondary">
                    <i class="fas fa-user-cog"></i>
                </a>';
                // neu la shiper
            } else if (session_get('ssquyen') == 'B') {
                echo '
                <a href="'. create_url_site('shiper-index').'" class="btn btn-secondary">
                    <i class="fas fa-list-ul"></i>
                </a>
                <a href="'. create_url_site('shiper-product').'" class="btn btn-secondary">
                   <i class="fas fa-shipping-fast"></i>
                </a>';
            } else {
                // không phải admin thì các công cụ như thường
                $giohang = 0;
                $giohang = countproduct(session_get('ssidtk'));
                echo '
                <a href="'. create_url_site('status-order').'" class="btn btn-secondary">
                    <i class="fas fa-list-ul"></i>
                </a>
                <a href="'. create_url_site('detail-cart').'" class="btn btn-secondary">
                    <i class="fa fa-cart-plus"></i><sup class="ghnumber">' . $giohang . '</sup>
                </a>';
            }
        } else {
            //else này là chưa đăng nhâp
            echo '<a href="'. create_url_site('login').'" class="btn btn-secondary">
            <i class="fas fa-user-check"></i>Login
        </a>
         <a href="'. create_url_site('sigin').'" class="btn btn-secondary">
            <i class="fa fa-user-plus"></i>sign in
        </a>
        <a href="'. create_url_site('login').'" class="btn btn-secondary">
            <i class="fa fa-cart-plus"></i><sup class="ghnumber">0</sup>
        </a>';
        }
        ?>
    </div>
</nav>
<!--END Nav menu-->
