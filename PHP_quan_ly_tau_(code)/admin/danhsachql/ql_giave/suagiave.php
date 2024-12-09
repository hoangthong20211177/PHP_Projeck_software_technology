<?php
// Xử lý lấy thông tin giá vé để hiển thị form sửa
if (isset($_GET['magiave'])) {
    $magiaveToEdit = $_GET['magiave'];
    $sqlGetInfo = "SELECT * FROM giave WHERE magiave = '$magiaveToEdit'";
    $resultInfo = $conn->query($sqlGetInfo);

    if ($resultInfo->num_rows > 0) {
        $rowInfo = $resultInfo->fetch_assoc(); 
        $magiave = $rowInfo['magiave'];
        $giatien = $rowInfo['giatien'];
    } else {
        echo "Không tìm thấy thông tin tàu."; 
        exit();
    }
}
// Xử lý cập nhật thông tin 
if (isset($_POST['update'])) {
    $magiave = $_POST['magiave'];
    $giatien = $_POST['giatien'];

    $sqlUpdate = "UPDATE giave SET giatien='$giatien' WHERE magiave='$magiave'";
    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Cập nhật thông tin thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
// Đóng kết nối
$conn->close();
?>
<!-- Thẻ div cho khung chứa form -->
<div class="textsua">
    <h2> Sửa Giá Vé</h2>
</div>
<div class="suabang1">
<div class='suaquaylaibang'>
    <a class='btn btn-info' href='indexql.php?quanly=dsgiave' role='button'> Quay Lại Bảng Giá Vé</a>
    </div>
    <!-- Thẻ form cho các phần tử trong form -->
    <div class="suabang">
    <form method="post" action="">
        <!-- Thêm thuộc tính style cho thẻ form để định dạng màu nền và màu chữ -->
        <form>
            Mã Giá Vé: <div class="suanhautau"> <input type="text" name="magiave" value="<?php echo $magiave; ?>" readonly> </div>
            Giá Tiền: <div class="suanhautau"> <input type="number" name="giatien" value="<?php echo $giatien; ?>" required> </div>
              <input type="submit" name="update" value="Cập Nhật" class="suacapnhattau" ><br>
          
        </form>
    </form>
</div>
</div>
</body>
</html>   <style> 
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
