<?php
if (isset($_POST['submit'])) {
    $matau = $_POST['matau'];
    $tentau = $_POST['tentau'];
    $diemdau = $_POST['diemdau'];
    $diemcuoi = $_POST['diemcuoi'];
     $giokhoihanh = $_POST['giokhoihanh'];
   
    $sqlAdd = "INSERT INTO tau (matau, tentau, diemdau, diemcuoi,giokhoihanh) 
    VALUES ('$matau', '$tentau', '$diemdau', '$diemcuoi','$giokhoihanh')";
    if ($conn->query($sqlAdd) === TRUE) {
        echo "Thêm Tàu thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }}
?>
<div class="textthem"> <h2>Thêm Mới Tàu</h2> </div>
<div class="themmoi">
<div class='themquaylaibang'>
    <a class='btn btn-info' href='indexql.php?quanly=dstau' role='button'> Quay Lại</a>
    </div>
<div class="thembang">
    <form method="post" action="">
        Mã Tàu: <input type="text" name="matau" required><br>
        Tên Tàu: <input type="text" name="tentau" required><br>
      Điểm đầu: <input type="text" name="diemdau" required><br>
        Điểm cuối: <input type="text" name="diemcuoi" required><br>
        <label for="giokhoihanh">Ngày Giờ Khởi Hành:</label>
<input type="datetime-local" id="giokhoihanh" name="giokhoihanh" required><br>
     
<input type="submit" name="submit" value="Thêm Mới">
    </form>
</div></div> <style> 
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
