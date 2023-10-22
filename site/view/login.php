<?php define("IN_SITE", true); ?>
<!DOCTYPE html>

<html>
    <?php include_once '../../system/widgets/header.php'; ?>
    <?php include_once '../../system/widgets/headerfile2.php'; ?>
    <body>
        <?php include_once '../../system/library/getpost.php'; ?>
        <?php include_once '../../system/widgets/nav.php'; ?>
        <div class="container-fluid ">
            <div class="row">
                <div class="col-lg-4 col-md-6 vlogin">
                    <h2 >JINA<span class="text-warning">.STORE</span></h2>
                    <div class="row">
                        <form action="site/controller/login.php" class="form-inline col-12 bg-success"  method="POST">
                            <div class="form-group col-sm-12 col-12" >
                                <label class=" sr-only" for="inlineFormInputGroupUsername2">Username</label>
                                <div class="col-12 input-group mb-2  mr-sm-2">
                                    <div class=" input-group-prepend">
                                        <div class="input-group-text">Username:</div>
                                    </div>
                                    <input type="text" minlength="5" maxlength="30" class=" form-control" id="inlineFormInputGroupUsername2" name="username" placeholder="">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label class="sr-only" for="inlineFormInputGroupUsername3">Password:</label>
                                <div class="col-12 input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Password:</div>
                                    </div>
                                    <input type="password" minlength="5" maxlength="30" class="form-control" id="inlineFormInputGroupUsername3" name="password" placeholder="">
                                </div>

                            </div>
                            <div class="form-group col-12">
                                <span class="text-warning"><?php echo isset($_REQUEST['islogin']) ? (($_REQUEST['islogin']== 'false')? $_REQUEST['islogin'] = 'Tài khoản mật khẩu không chính xát' : '') : '' ; ?></span>
                            </div>


                            <div class="form-group col-12 mb-4">
                                <a href="<?php echo create_url_site('sigin')?>" class="text-white" >Chưa có tài khoản! Đăng kí ngay</a>
                            </div>

                            <div class="form-group col-6 offset-3">
                                <input type="submit" class="btn btn-warning text-uppercase text-white" value="Đăng Nhập" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
