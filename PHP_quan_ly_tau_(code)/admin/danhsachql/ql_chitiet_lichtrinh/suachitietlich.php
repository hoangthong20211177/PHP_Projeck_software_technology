<?php


// Xử lý lấy thông tin lịch trình để hiển thị form sửa
if (isset($_GET['machitiet'])) {
    $machitietToEdit = $_GET['machitiet'];
    $sqlGetInfo = "SELECT * FROM chitietlich WHERE machitiet = '$machitietToEdit'";
    $resultInfo = $conn->query($sqlGetInfo);

    if ($resultInfo->num_rows > 0) {
        $rowInfo = $resultInfo->fetch_assoc(); 
        $machitiet = $rowInfo['machitiet'];

        $magiave = $rowInfo['magiave'];
        $malichtrinh = $rowInfo['malichtrinh'];
        $magadi = $rowInfo['magadi'];
        $gioden = $rowInfo['gioden'];
        $giodi = $rowInfo['giodi'];
        $magaden = $rowInfo['magaden'];

    } else {
        echo "Không tìm thấy thông tin Lịch trình."; 
        exit();
    }
}





// Xử lý cập nhật thông tin
if (isset($_POST['update'])) {
     $machitiet = $_POST['machitiet'];
        $magiave = $_POST['magiave'];
        $malichtrinh = $_POST['malichtrinh'];
        $magadi = $_POST['magadi'];
        $gioden = $_POST['gioden'];
        $giodi = $_POST['giodi'];
        $magaden = $_POST['magaden'];

    $sqlUpdate = "UPDATE chitietlich SET magiave='$magiave',  malichtrinh='$malichtrinh', magadi='$magadi',
    gioden='$gioden', giodi='$giodi', magaden='$magaden'
    WHERE machitiet='$machitiet'";
    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Cập nhật thông tin lịch trình thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
$sqlLichTrinh = "SELECT malichtrinh, tenlichtrinh FROM lichtrinh";
$resultLichTrinh = $conn->query($sqlLichTrinh);

$sqlGiaVe = "SELECT magiave, giatien FROM giave";
$resultGiaVe = $conn->query($sqlGiaVe);

$sqlGadi = "SELECT maga, tengadi FROM gadi";
$resultGadi = $conn->query($sqlGadi);

$sqlGadi2 = "SELECT maga, tengaden FROM gadi";
$resultGadi2 = $conn->query($sqlGadi2);



// Đóng kết nối
$conn->close();
?>



<!-- Thẻ div cho khung chứa form -->
<div class="textsua"> 
    <h2> Sửa Chi Tiết lịch trình</h2>
</div>
<div class="suabang1">
<div class='suaquaylaibang'>
    <a class='btn btn-info' href="indexql.php?quanly=chitietlich" role='button'> Quay Lại Bảng Ch Tiết Lịch Trình</a>
    </div>
    <!-- Thẻ form cho các phần tử trong form -->
    <div class="suabang">
    <form method="post" action="indexql.php?quanly=suachitietlich">
        <!-- Thêm thuộc tính style cho thẻ form để định dạng màu nền và màu chữ -->
        <form>

        Mã Chi Tiết: <div class="suanhautau"> <input type="text" name="machitiet" value="<?php echo $machitiet; ?>" readonly> </div>
          
         
            <div class="suanhautau">  
            <label for="malichtrinh">Lịch Trình</label>
    <select id="malichtrinh" name="malichtrinh" required>
        <?php
        while ($rowLichTrinh = $resultLichTrinh->fetch_assoc()) {
            echo '<option value="' . $rowLichTrinh['malichtrinh'] .'">' . $rowLichTrinh['tenlichtrinh'] . '</option>';
        }
        ?>
</select>

<label for="magiave"> Số điểm dừng</label>
    <select id="magiave" name="magiave" required>
        <?php
        while ($rowGiaVe = $resultGiaVe->fetch_assoc()) {
            echo '<option value="' . $rowGiaVe['magiave'] .'">' . $rowGiaVe['magiave'] . '</option>';
        }
        ?>
</select>

<label for="magadi">Ga Đi</label>
    <select id="magadi" name="magadi" required>
        <?php
        while ($rowGadi = $resultGadi->fetch_assoc()) {
            echo '<option value="' . $rowGadi['maga'] .'">' . $rowGadi['tengadi'] . '</option>';
        }
        ?>
</select>

<label for="magaden">Ga Đi</label>
    <select id="magaden" name="magaden" required>
        <?php
        while ($rowGadi2 = $resultGadi2->fetch_assoc()) {
            echo '<option value="' . $rowGadi2['maga'] .'">' . $rowGadi2['tengaden'] . '</option>';
        }
        ?>
</select>


<label for="giodi">Giờ đi</label>
    <input type="text" id="giodi" name="giodi" required>

    <label for="gioden">Giờ đến</label>
    <input type="text" id="gioden" name="gioden" required>



</div>
            <!-- Thêm thuộc tính style cho thẻ input để định dạng kiểu dáng của button -->
            <input type="submit" name="update" value="Cập Nhật" class="suacapnhattau" ><br>
           
        </form>
    </form>
</div>
</div>
</body>
</html><style> 
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
