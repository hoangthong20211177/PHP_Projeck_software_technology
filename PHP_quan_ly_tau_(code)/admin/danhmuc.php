


<div class="dmtrangchu">

<div class="list-group">
  <a href="/qltau22/qltau2/indextrangchu.php" class="list-group-item list-group-item-action list-group-item-info"> <i class="bi bi-house-door-fill"></i> Trang Chủ</a>
</div>
</div>


<div class="list-group">
<a href="indexql.php?quanly=ds_nhanvien" class="list-group-item list-group-item-action list-group-item-info"> <i class="bi bi-person-fill"></i> Quản Lý Nhân Viên</a>
<a href="indexql.php?quanly=lichtrinh" class="list-group-item list-group-item-action list-group-item-info"> <i class="bi bi-table"></i> Quản Lý Chuyến Tàu</a>
  <a href="indexql.php?quanly=dstau" class="list-group-item list-group-item-action list-group-item-info"> <i class="bi bi-table"></i> Danh Sách Tàu</a>
  <a href="indexql.php?quanly=dstoa" class="list-group-item list-group-item-action list-group-item-info">  <i class="bi bi-table"></i> Danh Sách Toa</a>
  <a href="indexql.php?quanly=dsgiave" class="list-group-item list-group-item-action list-group-item-info"> <i class="bi bi-table"></i> Danh Sách Giá Vé</a>
  <a href="indexql.php?quanly=lichtrinh" class="list-group-item list-group-item-action list-group-item-info"> <i class="bi bi-table"></i> Danh Sách Lịch Trình</a>

</div>




<div class="dmtrangchu">
<div class="list-group">
<a href="indexql.php?quanly=thongke" class="list-group-item list-group-item-action list-group-item-info"> <i class="bi bi-table"></i> Thống Kê</a>
<a href="logout.php" class="list-group-item list-group-item-action list-group-item-info" onclick="return confirmLogout();">
            <i class="bi bi-table"></i> Đăng xuất
        </a>

</div>
</div>



<script type="text/javascript">
    function confirmLogout() {
        // Hiển thị hộp thoại xác nhận
        var result = confirm("Bạn có muốn đăng xuất tài khoản không?");
        if (result) {
            // Nếu người dùng nhấn "OK", cho phép chuyển hướng đến logout.php
            return true;
        } else {
            // Nếu người dùng nhấn "Cancel", ngừng chuyển hướng
            return false;
        }
    }
</script>
<style>
    </style>
    