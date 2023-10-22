<?php define("IN_SITE", true); ?>
<!DOCTYPE html>
<html>
    <?php include_once '../../system/widgets/header.php'; ?>

    <body>
        <?php include_once '../../system/widgets/nav.php';
        ?>
        <!-- Danh sách SP -->
        <div class="container-fluid mrtop">      
            <div class="row">                
                <!-- detail -->

                <div class=" col-lg-10 offset-lg-1 col-md-10 offset-md-1 col-sm-12 col-12">

                    <div class="row">       
                        <!--print -->
                        <?php
                        require_once '../controller/user_function.php';
                        if (session_get('ssidtk')) {
                            
                        } else {
                            location(create_url_site('login'));
                        }
                        ?>
                        <!-- end print -->
                        <!-- Masthead -->
                        <header class="masthead bg-dark">
                            <div class="container h-100">
                                <div class="row h-100 align-items-center justify-content-center text-center">
                                    <!-- print rs --> 
                                    <?php
                                    if (input_get("isfinish")) {
                                         result(input_get("isfinish"));
                                    } else {
                                         location(create_url_site());
                                    }
                                   
                                    ?>


                                    <!-- end print rs --> 
                                    <hr class="divider my-4">

                                    <div class="col-lg-8 align-self-baseline text-white">

                                        <form action="site/controller/feedback.php" method="POST" class="form-group">
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Cảm nhận mua hàng của bạn tại <span class="text-warning">jina</span> như thế nào. Bạn có thể gửi Feeback tại đây và hoàn toàn ẩn danh</label>
                                                <textarea name="feed" class="form-control" id="exampleFormControlTextarea1" required minlength="5" maxlength="200" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Send-Feedback" class=" btn btn-success">
                                            </div>
                                        </form>                                       
                                    </div>
                                </div>
                            </div>
                        </header>

                        <!-- About Section -->


                    </div>


                </div>
            </div>
            <!-- end row 1 -->

            <!-- ------- -->
        </div>
        <!-- ---end container-fluid---- -->
















        <?php include_once '../../system/widgets/footer.php'; ?>

    </body>
</html>
