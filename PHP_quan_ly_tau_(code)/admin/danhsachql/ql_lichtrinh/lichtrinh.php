<?php



//xóa tàu
if (isset($_GET['delete'])) {
    $malichtrinhToDelete = $_GET['delete'];
    $conn->query("SET foreign_key_checks = 0");



$sqlDelete = "DELETE lichtrinh, chitietlich
FROM lichtrinh
left JOIN tau ON lichtrinh.matau = tau.matau
left JOIN chitietlich ON lichtrinh.malichtrinh = chitietlich.malichtrinh
WHERE lichtrinh.malichtrinh ='$malichtrinhToDelete' ";


    if ($conn->query($sqlDelete) === TRUE) {  
        echo "<script>
        alert('Xóa lịch trình thành công.');
        window.location.href = 'indexql.php?quanly=lichtrinh'; // Điều hướng về trang danh sách nhân viên
      </script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
} 



// Xử lý tìm kiếm lịch trình
if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    
    // Sửa câu lệnh SQL để tìm kiếm theo tất cả các cột
    $sqlSearch = "SELECT * FROM lichtrinh 
                  WHERE malichtrinh LIKE '%$keyword%' 
                  OR tenlichtrinh LIKE '%$keyword%' 
                  OR ngaykhoihanh LIKE '%$keyword%' 
                  OR ngayketthuc LIKE '%$keyword%' 
                  OR matau LIKE '%$keyword%'";

    $result = $conn->query($sqlSearch);
} else {
    // Truy vấn dữ liệu nếu không có tìm kiếm
    $sql = "SELECT * from lichtrinh";
    $result = $conn->query($sql);
}


// Hiển thị dữ liệu
if ($result->num_rows > 0) {

    echo "
<div = class='tenbang'>
    <h2> Quản Lý Danh Sách Lịch Trình</h2>
    </div>
    <form 
    method='post' action='indexql.php?quanly=lichtrinh'> 
    <div class='them'>
    <a class='btn btn-info' href='indexql.php?quanly=themlichtrinh' role='button'> Thêm mới</a>
    </div>
    <div class='timkiem'>
    <input type='text' name='keyword' required>
    <input type='submit' name='search' value='Tìm Kiếm'> <br>
    </form>
    </div>
    <table class='table table-bordered table-striped w-100'>
    
            <tr>
                <th>Mã Lịch Trình </th>
                <th>Tên Lịch Trình</th>
                <th>Ngày Khởi Hành</th>
                <th>Ngày Kết Thúc</th>
                <th>Mã Tàu</th>
                <th>Sửa</th>
                <th>Xóa</th>
                <th>Chi Tiết</th>
           
           
              
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["malichtrinh"] . "</td>
                <td>" . $row["tenlichtrinh"] . "</td>
                <td>" . $row["ngaykhoihanh"] . "</td>
                <td>" . $row["ngayketthuc"] . "</td>
                <td>" . $row["matau"] . "</td>
            
        
                <td>
                <div class='suaxoa'>
                <a href='indexql.php?quanly=sualichtrinh&malichtrinh=" . $row["malichtrinh"] . "'>    <i class='bi bi-pen-fill  '></i></a>
            
                </div>
                </td>
                <td>
             
                <div class='suaxoa'>


                        <a href='#' onclick='confirmDelete(\"indexql.php?quanly=lichtrinh&delete=" . $row["malichtrinh"] . "\")'>
                            <i class='bi bi-trash2-fill'></i>
                        </a>
                    </td>

                <td>
                <div class='suaxoa'>
          

                <a href='indexql.php?quanly=chitietlich&malichtrinh=" . $row["malichtrinh"] . "'>   <i class='bi bi-info-circle-fill'></i></a>  
                </div>
                </td>

   
              </tr>";
    }


echo "</table>";
} else {
    echo "Không có dữ liệu lịch trình.";
}
// Đóng kết nối
  
$conn->close();
?>

 
<script>
        function confirmDelete(url) {
            if (confirm("Bạn có chắc chắn muốn xóa chuyến tàu này?")) {
                window.location.href = url;
            }
        }
        </script>
         <style>/* Tổng quan về body và các phần tử */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f7f7f7;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Tiêu đề */
.tenbang h2 {
    text-align: center;
    color: #34495e;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 30px;
}

/* Khung cho bảng */
.table-container {
    margin: 0 auto;
    padding: 30px;
    max-width: 1200px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Bảng dữ liệu */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th,
table td {
    padding: 15px;
    text-align: center;
    border: 1px solid #ddd;
    font-size: 16px;
}

table th {
    background-color: #3498db;
    color: white;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #f1f1f1;
}

/* Phần button thêm mới và tìm kiếm */
.them {
    text-align: center;
    margin-bottom: 20px;
}

.them .btn {
    background-color: #3498db;
    color: white;
    font-size: 16px;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.them .btn:hover {
    background-color: #2980b9;
}

/* Tìm kiếm */
.timkiem {
    text-align: center;
    margin-bottom: 20px;
}

.timkiem input[type="text"] {
    padding: 10px;
    font-size: 16px;
    width: 250px;
    border-radius: 5px;
    border: 1px solid #ddd;
    margin-right: 10px;
}

.timkiem input[type="submit"] {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #3498db;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.timkiem input[type="submit"]:hover {
    background-color: #2980b9;
}

/* Icon trên các nút sửa và xóa */
table td a {
    font-size: 18px;
    color: #34495e;
    text-decoration: none;
    padding: 5px;
}

table td a:hover {
    color: #e74c3c;
}

/* Xóa dữ liệu */
table td a i {
    transition: transform 0.3s ease;
}

table td a:hover i {
    transform: scale(1.2);
}

/* Phần cuối trang */
.cuoi {
    text-align: center;
    margin-top: 50px;
    padding: 15px;
    background-color: #34495e;
    color: white;
    font-size: 14px;
}

/* Hiệu ứng khi hover vào hàng trong bảng */
table tr:hover td {
    background-color: #d5dbdb;
}

/* Phần Confirm Delete Modal */
.confirm-delete {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

.confirm-delete .modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    width: 400px;
    text-align: center;
}

.confirm-delete button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #e74c3c;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.confirm-delete button:hover {
    background-color: #c0392b;
}

            </style>