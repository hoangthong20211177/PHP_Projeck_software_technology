
    <?php
// Xử lý lấy thông tin lịch trình để hiển thị form sửa

if (isset($_GET['maphieu'])) {
    $maphieuToEdit = $_GET['maphieu'];
    $sqlGetInfo = "SELECT 
   maphieu, 
tinhtrangve,  
    tenkhach, 
    sodienthoai
    from phieudat  
    WHERE maphieu = '$maphieuToEdit'";
    $resultInfo = $conn->query($sqlGetInfo);

    if ($resultInfo->num_rows > 0) {
        $rowInfo = $resultInfo->fetch_assoc(); 
        $maphieu = $rowInfo['maphieu'];
        $sodienthoai = $rowInfo['sodienthoai'];
        $tinhtrangve = $rowInfo['tinhtrangve'];
    } else {
        echo "Không tìm thấy thông tin Lịch trình."; 
        exit();
    }
}


// Xử lý cập nhật thông tin 
if (isset($_POST['update'])) {
        $maphieu = $_POST['maphieu'];
        $sodienthoai = $_POST['sodienthoai'];
        $tinhtrangve = $_POST['tinhtrangve'];
  
    $sqlUpdate = "UPDATE phieudat SET sodienthoai='$sodienthoai',tinhtrangve=$tinhtrangve
    WHERE maphieu=$maphieu";
    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Cập nhật thông tin lịch trình thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
// Đóng kết nối
$conn->close();
?>



<!-- Thẻ div cho khung chứa form -->
<div class="textsua"> 
    <h2> Cập Nhật Vé</h2>
</div>
<div class="suabang1">
<div class='suaquaylaibang'>

    </div>
    <!-- Thẻ form cho các phần tử trong form -->
    <div class="suabang">
    <form method="post" action="indexnv.php?quanly=capnhatve">
        <!-- Thêm thuộc tính style cho thẻ form để định dạng màu nền và màu chữ -->
        <form>
            Mã Phiếu Đặt: <div class="suanhautau"> <input type="text" name="maphieu" value="<?php echo $maphieu; ?>" readonly> </div>
            Số điện thoại: <div class="suanhautau"> <input type="text" name="sodienthoai" value="<?php echo $sodienthoai; ?>" required> </div>
            <div class="suanhautau">  
        
  <label for="tinhtrangve">Tình trạng vé:</label>
    <select id="tinhtrangve" name="tinhtrangve" required>
        <option value="1">Đã Thanh Toán</option>
        <option value="0">Chưa Thanh Toán</option>
    </select>
  <input type="submit" name="update" value="Cập nhật">
</form>

        </form>
    </form>
</div>
</div>
</body>
</html>
<style> 
 /* Cấu trúc cơ bản */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    color: #333;
}

/* Tiêu đề */
h2 {
    color: #333;
    text-align: center;
    margin-top: 30px;
    font-size: 28px;
    font-weight: bold;
}

/* Form */
form {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Label */
label {
    display: block;
    margin: 10px 0 5px;
    color: #555;
    font-weight: 600;
}

/* Input và Select */
input, select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

input[type="date"] {
    font-size: 16px;
}

select {
    font-size: 16px;
}

/* Button - Thêm lịch trình */
input[type="submit"] {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

/* Nút quay lại */
a.btn-info {
    background-color: #17a2b8;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    display: inline-block;
    margin-bottom: 20px;
    transition: background-color 0.3s;
}

a.btn-info:hover {
    background-color: #138496;
}

/* Cải thiện hiển thị lỗi */
input:invalid {
    border-color: #e74c3c;
}

input:valid {
    border-color: #2ecc71;
}

/* Các lỗi và thông báo */
.alert {
    background-color: #e74c3c;
    color: white;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    font-size: 14px;
    display: none;
}
</style>