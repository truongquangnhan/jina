<?php define("IN_SITE", true); ?>
<!DOCTYPE html>

<html>
    <?php include_once '../../system/widgets/header.php'; ?>
    <?php include_once '../../system/widgets/headerfile2.php'; ?>
    <body>
        <?php include_once '../../system/library/getpost.php'; ?>
        <?php include_once '../../system/widgets/nav.php'; ?>
        <div class="container-fluid bg-light">
            <div class="row">
                <div class="col-lg-5 col-md-6 vlogin">
                    <h2 >JINA<span class="text-warning">.STORE</span></h2>
                    <div class="row">
                        <form action="site/controller/sigin.php" class="form-inline col-12 bg-success"  method="POST">
                            <!-- usname,psword,sdt,anhnen,hovaten,diachi,email -->
                            <div class="form-group col-12">
                                <span class="text-warning"><?php echo isset($_REQUEST['isSigin']) ? (($_REQUEST['isSigin'] == 'usnamefail') ? $_REQUEST['islogin'] = 'Tài khoản này đã có người đăng kí' : 'Đăng kí thất bại !') : ''; ?></span>
                            </div>
                            <div class="form-group col-sm-12 col-12" >
                                <label class=" sr-only" for="inlineFormInputGroupUsername2">Username</label>
                                <div class="col-12 input-group mb-2  mr-sm-2">
                                    <div class=" input-group-prepend">
                                        <div class="input-group-text">Username:</div>
                                    </div>
                                    <input type="text" class="form-control" minlength="5" maxlength="30" id="inlineFormInputGroupUsername2" name="username" placeholder=" " required>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label class="sr-only" for="inlineFormInputGroupUsername3">Password:</label>
                                <div class="col-12 input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Password:</div>
                                    </div>
                                    <input type="password" class="form-control" minlength="5" maxlength="30" id="inlineFormInputGroupUsername3" name="password" placeholder=" " required >
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label class="sr-only" for="inlineFormInputGroupUsername3">Full name:</label>
                                <div class="col-12 input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Full name:</div>
                                    </div>
                                    <input type="text" minlength="5" maxlength="30" class="form-control" id="inlineFormInputGroupUsername3" name="fname" placeholder=" Trương Quang Nhân" required >
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label class="sr-only" for="inlineFormInputGroupUsername3">Address:</label>
                                <div class="col-12 input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Address:</div>
                                    </div>
                                    <input type="text" class="form-control" minlength="10" id="inlineFormInputGroupUsername3" name="diachi" placeholder=" 02 Lê Duẫn Đà Nẵng" required>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label class="sr-only" for="inlineFormInputGroupUsername3">Contact:</label>
                                <div class="col-12 input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Contact:</div>
                                    </div>
                                    <input type="text" minlength="10" maxlength="10" class="form-control" id="inlineFormInputGroupUsername3" name="sdt" placeholder=" 0977777777" required>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label class="sr-only" for="inlineFormInputGroupUsername3">Email:</label>
                                <div class="col-12 input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Email:</div>
                                    </div>
                                    <input type="email" minlength="10" maxlength="200" class="form-control" id="inlineFormInputGroupUsername3" name="email" placeholder=" truongquangnhan@gmail.com" required >
                                </div>
                            </div>
                            
                            <div class="form-group col-10 offset-1 mb-3">
                                <a href="<?php echo create_url_site('login')?>" class="text-white text-center " >Đã có tài khoản! Đăng nhập ngay</a>
                            </div>
                            <div class="form-group col-12">
                                <span class="text-white text-sm">Lưu ý: 1 Email, 1 số điện thoại chỉ đăng kí được 1 tài khoản</span>
                            </div>
                            <div class="form-group col-6 offset-3">
                                <input type="submit" class="btn btn-warning text-uppercase text-white" value="Đăng Kí" > 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
