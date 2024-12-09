<?php
// Kết nối cơ sở dữ liệu
include './trangchu/ketnoi.php';

// Xử lý lấy thông tin phiếu để hiển thị form sửa
if (isset($_GET['maphieu'])) {
    $maphieuToEdit = $_GET['maphieu'];

    // Truy vấn để lấy thông tin phiếu đặt vé
    $sqlGetInfo = "SELECT * FROM phieudat WHERE maphieu = '$maphieuToEdit' AND tinhtrangve = '0'";
    $resultInfo = $conn->query($sqlGetInfo);

    if ($resultInfo->num_rows > 0) {
        $rowInfo = $resultInfo->fetch_assoc();
        $maphieu = $rowInfo['maphieu'];
        $tenkhach = $rowInfo['tenkhach'];
        $sodienthoai = $rowInfo['sodienthoai'];
        $machitiet = $rowInfo['machitiet'];
        $maghe = $rowInfo['maghe'];
    } else {
        echo "Vé này đã thanh toán, bạn không thể sửa, hãy liên hệ với tổng đài: 19001000 để được hỗ trợ!";
        exit();
    }
}

// Xử lý cập nhật thông tin vé khi người dùng nhấn Cập Nhật
if (isset($_POST['update'])) {
    $maphieu = $_POST['maphieu'];
    $tenkhach = $_POST['tenkhach'];
    $sodienthoai = $_POST['sodienthoai'];
    $machitiet = $_POST['machitiet'];
    $maghe = $_POST['maghe'];

    // Cập nhật thông tin phiếu đặt vé
    $sqlUpdate = "UPDATE phieudat SET tenkhach='$tenkhach', sodienthoai='$sodienthoai', machitiet='$machitiet', maghe='$maghe' WHERE maphieu='$maphieu'";
    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Cập nhật thông tin vé thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Lấy danh sách ghế và lịch trình tàu
$sqlGhe = "SELECT ghe.maghe, toa.tentoa, ghe.tenghe FROM ghe INNER JOIN toa ON ghe.matoa = toa.matoa";
$resultGhe = $conn->query($sqlGhe);

$sqlChiTietLich = "SELECT chitietlich.machitiet, tau.tentau FROM chitietlich INNER JOIN lichtrinh ON chitietlich.malichtrinh = lichtrinh.malichtrinh INNER JOIN tau ON lichtrinh.matau = tau.matau";
$resultChiTietLich = $conn->query($sqlChiTietLich);

// Đóng kết nối
$conn->close();
?>

<div class="textsua">
    <h2>Sửa Phiếu Đặt Vé</h2>
</div>
<div class="suabang1">
    <div class="suaquaylaibang"></div>

    <div class="suabang">
        <form method="post" action="indextrangchu.php?trangchu=suaphieudatve">
            <label for="maphieu">Mã Phiếu:</label>
            <input type="number" name="maphieu" value="<?php echo $maphieu; ?>" readonly><br>

            <label for="tenkhach">Họ Tên:</label>
            <input type="text" name="tenkhach" value="<?php echo $tenkhach; ?>" required><br>

            <label for="sodienthoai">Số Điện Thoại:</label>
            <input type="number" name="sodienthoai" value="<?php echo $sodienthoai; ?>" required><br>

            <!-- Ẩn Mã Chi Tiết nhưng vẫn gửi giá trị -->
            <label for="machitiet" style="display:none;">Mã Chi Tiết:</label>
            <select id="machitiet" name="machitiet" style="display:none;" required>
                <?php
                while ($rowChiTietLich = $resultChiTietLich->fetch_assoc()) {
                    $selected = ($rowChiTietLich['machitiet'] == $machitiet) ? 'selected' : '';
                    echo '<option value="' . $rowChiTietLich['machitiet'] . '" ' . $selected . '>' . $rowChiTietLich['machitiet'] . ' - ' . $rowChiTietLich['tentau'] . '</option>';
                }
                ?>
            </select><br>

            <!-- Ẩn Ghế - Toa nhưng vẫn gửi giá trị -->
            <label for="maghe" style="display:none;">Ghế - Toa:</label>
            <select id="maghe" name="maghe" style="display:none;" required>
                <?php
                while ($rowGhe = $resultGhe->fetch_assoc()) {
                    $selected = ($rowGhe['maghe'] == $maghe) ? 'selected' : '';
                    echo '<option value="' . $rowGhe['maghe'] . '" ' . $selected . '>' . $rowGhe['tentoa'] . ' - ' . $rowGhe['tenghe'] . '</option>';
                }
                ?>
            </select><br>

            <!-- Hai nút nằm trên cùng một hàng -->
            <div class="button-group">
                <input type="submit" name="update" value="Cập Nhật" class="suacapnhattau">
                <a class="btn btn-info" href="indextrangchu.php?trangchu=phieudatve" role="button">Quay Lại Bảng Phiếu Đặt Vé</a>
            </div>
        </form>
    </div>
</div>


<style>
/* Cấu trúc chung của trang */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

/* Tạo một container rộng cho nội dung */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Tiêu đề chính */
.textsua h2 {
    text-align: center;
    font-size: 32px;
    font-weight: 700;
    color: #FF6F61;
    margin-bottom: 40px;
}

/* Cấu trúc của các phần trong form */
.suabang1 {
    background-color: #fff;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Quay lại bảng phiếu */
.suaquaylaibang {
    text-align: center;
    margin-bottom: 20px;
}

.suaquaylaibang a {
    background-color: #2196F3;
    color: white;
    padding: 12px 30px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.suaquaylaibang a:hover {
    background-color: #1976D2;
}

/* Form sửa phiếu */
.suabang {
    max-width: 600px;
    margin: 0 auto;
    background: #ffdbdb;
    padding: 20px;  /* Thêm padding cho form */
    box-sizing: border-box; /* Đảm bảo các phần tử không bị tràn ra ngoài */
}

form {
    display: flex;
    flex-direction: column;
}

form label {
    font-size: 16px;
    color: #444;
    margin-bottom: 8px;
}

/* Các input trường trong form */
input[type="text"], input[type="number"], select {
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    background-color: #f9f9f9;
    transition: background-color 0.3s ease, border 0.3s ease;
    width: 100%; /* Đảm bảo các input có chiều rộng 100% */
    box-sizing: border-box; /* Đảm bảo padding không làm tràn form */
}

input[type="text"]:focus, input[type="number"]:focus, select:focus {
    background-color: #ffe6e6;
    border-color: #FF6F61;
    outline: none;
}

/* Nút Cập Nhật */
input[type="submit"] {
    background-color: #FF6F61;
    color: white;
    padding: 12px;
    font-size: 18px;
    cursor: pointer;
    border: none;
    border-radius: 8px;
    transition: background-color 0.3s ease;
    width: 100%; /* Đảm bảo nút Cập Nhật có chiều rộng 100% */
    box-sizing: border-box;
}

input[type="submit"]:hover {
    background-color: #FF3B30;
}

/* Ẩn phần tử input nếu không cần hiển thị nhưng vẫn gửi giá trị */
input[type="text"][readonly], select[style="display:none;"] {
    display: none;
}

/* Hiển thị Mã Phiếu rõ ràng */
input[name="maphieu"] {
    display: block;  /* Đảm bảo mã phiếu được hiển thị */
    width: 100%;     /* Đảm bảo rộng đầy đủ */
    padding: 12px;
    margin-bottom: 20px;
    font-size: 16px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-weight: bold;
    color: #333;
}

/* Hiệu ứng khi hover vào form */
form:hover {
    transform: scale(1.02);
    transition: transform 0.3s ease;
}

/* Responsive Design */
@media (max-width: 768px) {
    .suabang1 {
        padding: 20px;
    }

    .suabang {
        width: 100%;
        padding: 20px;
    }

    .textsua h2 {
        font-size: 28px;
    }
}

/* Button group: Nút Cập Nhật và Quay Lại */
.button-group {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-top: 20px;
    width: 100%; /* Đảm bảo nhóm nút có chiều rộng 100% */
}

.button-group input[type="submit"], .button-group a {
    width: 48%; /* Đảm bảo các nút có chiều rộng bằng nhau */
    padding: 12px;
    font-size: 18px;
    border-radius: 8px;
    text-align: center;
    box-sizing: border-box;
}

/* Định dạng nút Quay Lại */
.button-group a {
    background-color: #2196F3;
    color: white;
    text-decoration: none;
}

.button-group a:hover {
    background-color: #1976D2;
}

/* Định dạng nút Cập Nhật */
.button-group input[type="submit"] {
    background-color: #FF6F61;
    color: white;
    cursor: pointer;
}

.button-group input[type="submit"]:hover {
    background-color: #FF3B30;
}


</style>
