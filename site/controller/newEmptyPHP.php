<form action="http://jina/shiper-update-status" method="POST" class="form-inline">
    <input type ="text" value = "1001" name="iddh" style="display:none">
    <select name="trangthai" class="form-inline bg-warning" required>
        <option>chọn trạng thái...</option>
        <option value="B">Đã lấy hàng</option>
        <option value="C">Đang Giao</option>
        <option value="D">Giao hàng thành công</option>
        <option value="F">Khách không nhận hàng</option>
    </select>
    <input type="submit" class="form-inline btn-sm btn-dark" height="25px;" value="Cập nhập">
</form>