<?php
// chỉ được nhúng code không được gọi từ URL tránh hacker đọc file thông qua url
if (!defined('IN_SITE')) die ('Đường dẫn hợp lệ nhưng thực chất không hợp lệ bạn ơi');
?>
<a href="#" class="col-lg-12 col-md12 col-xs col-2 padding5px btn text-white disabled">Máy cũ</a> 
<a href="#" class="col-lg-12 col-md12 col-xs col-2 padding5px btn text-white disabled">Like new</a>
<a href="<?php echo create_url_site('option-result?tu=1000000&den=4000000'); ?>" class="col-lg-12 col-md12 col-xs col-2 padding5px btn text-white">Từ 1-4tr</a>
<a href="<?php echo create_url_site('option-result?tu=4000000&den=6000000'); ?>" class="col-lg-12 col-md12 col-xs col-2 padding5px btn text-white">Từ 4-6tr</a>
<a href="<?php echo create_url_site('option-result?tu=6000000&den=10000000'); ?>" class="col-lg-12 col-md12 col-xs col-2 padding5px btn text-white">Từ 6-10tr</a>
<a href="<?php echo create_url_site('option-result?tu=10000000&den=1000000000'); ?>" class="col-lg-12 col-md12 col-xs col-2 padding5px btn text-white">Trên 10tr</a>