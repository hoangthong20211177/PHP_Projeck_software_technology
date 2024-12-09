<?php
// Kết nối tới cơ sở dữ liệu


// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL để thống kê số toa có trong các tàu
$sql_toa = "SELECT t.matau, t.tentau, COUNT(t1.matau) AS soluongtoa
            FROM tau t 
            INNER JOIN toa t1 ON t.matau = t1.matau
            GROUP BY t.tentau";
$result_toa = $conn->query($sql_toa);
if (!$result_toa) {
    die("Query failed: " . $conn->error);
}

// SQL để thống kê tổng quan về tàu (số toa, số ghế, số phiếu, tổng tiền đã thu, tổng tiền chưa thu)
$sql_tongquan = "
    SELECT t.matau, t.tentau,
        COUNT(DISTINCT t1.matoa) AS tongtoa,
        COUNT(DISTINCT ghe.maghe) AS tongghe,
        COUNT(DISTINCT phieudat.maphieu) AS tongphieu,
        SUM(CASE WHEN phieudat.tinhtrangve = 1 THEN giave.giatien ELSE 0 END) AS tongthu,
        SUM(CASE WHEN phieudat.tinhtrangve = 0 THEN giave.giatien ELSE 0 END) AS tongchuathu
    FROM tau t
    LEFT JOIN toa t1 ON t.matau = t1.matau
    LEFT JOIN ghe ON t1.matoa = ghe.matoa
    LEFT JOIN phieudat ON ghe.maghe = phieudat.maghe
    LEFT JOIN chitietlich ON phieudat.machitiet = chitietlich.machitiet
    LEFT JOIN giave ON chitietlich.magiave = giave.magiave
    GROUP BY t.tentau";
$result_tongquan = $conn->query($sql_tongquan);
if (!$result_tongquan) {
    die("Query failed: " . $conn->error);
}

// SQL để thống kê doanh thu theo tháng
$sql_thang = "
    SELECT 
        YEAR(lt.ngaykhoihanh) AS nam,
        MONTH(lt.ngaykhoihanh) AS thang,
        SUM(CASE WHEN pd.tinhtrangve = 1 THEN gv.giatien ELSE 0 END) AS tongthu,
        SUM(CASE WHEN pd.tinhtrangve = 0 THEN gv.giatien ELSE 0 END) AS tongchuathu
    FROM tau t
    LEFT JOIN lichtrinh lt ON t.matau = lt.matau
    LEFT JOIN toa toa ON t.matau = toa.matau
    LEFT JOIN ghe g ON toa.matoa = g.matoa
    LEFT JOIN phieudat pd ON g.maghe = pd.maghe
    LEFT JOIN chitietlich cl ON pd.machitiet = cl.machitiet
    LEFT JOIN giave gv ON cl.magiave = gv.magiave
    GROUP BY YEAR(lt.ngaykhoihanh), MONTH(lt.ngaykhoihanh)
    ORDER BY nam, thang;
";
$result_thang = $conn->query($sql_thang);
if (!$result_thang) {
    die("Query failed: " . $conn->error);
}

// SQL để thống kê doanh thu theo năm
$sql_nam = "
    SELECT 
        YEAR(lt.ngaykhoihanh) AS nam,
        SUM(CASE WHEN pd.tinhtrangve = 1 THEN gv.giatien ELSE 0 END) AS tongthu,
        SUM(CASE WHEN pd.tinhtrangve = 0 THEN gv.giatien ELSE 0 END) AS tongchuathu
    FROM tau t
    LEFT JOIN lichtrinh lt ON t.matau = lt.matau
    LEFT JOIN toa toa ON t.matau = toa.matau
    LEFT JOIN ghe g ON toa.matoa = g.matoa
    LEFT JOIN phieudat pd ON g.maghe = pd.maghe
    LEFT JOIN chitietlich cl ON pd.machitiet = cl.machitiet
    LEFT JOIN giave gv ON cl.magiave = gv.magiave
    GROUP BY YEAR(lt.ngaykhoihanh)
    ORDER BY nam;
";
$result_nam = $conn->query($sql_nam);
if (!$result_nam) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống Kê Doanh Thu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Thống Kê Doanh Thu</h2>

        <!-- Thống kê số 'Toa' có trong các 'Tàu' -->
        <?php if ($result_toa->num_rows > 0): ?>
            <h4>Thống kê số 'Toa' có trong các 'Tàu'</h4>
            <table class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>Mã Tàu</th>
                        <th>Tên Tàu</th>
                        <th>Số Toa</th>
                        <th>Xem Thêm</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_toa->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["matau"]; ?></td>
                            <td><?php echo $row["tentau"]; ?></td>
                            <td><?php echo $row["soluongtoa"]; ?></td>
                            <td><a href="indexql.php?quanly=thongketoa&matau=<?php echo $row["matau"]; ?>"><i class="bi bi-info-circle-fill"></i></a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Không có kết quả thống kê số toa.</p>
        <?php endif; ?>

        <!-- Thống kê tổng quan tàu -->
        <?php if ($result_tongquan->num_rows > 0): ?>
            <h4>Thống kê Tổng | Số Toa | Số ghế | Số phiếu đặt | Tổng tiền đã thu | Tổng tiền chưa thu của các Tàu</h4>
            <table class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>Mã Tàu</th>
                        <th>Tên Tàu</th>
                        <th>Số Toa</th>
                        <th>Số Ghế</th>
                        <th>Số Phiếu</th>
                        <th>Tổng Tiền Đã Thanh Toán</th>
                        <th>Tổng Tiền Chưa Thanh Toán</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_tongquan->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["matau"]; ?></td>
                            <td><?php echo $row["tentau"]; ?></td>
                            <td><?php echo $row["tongtoa"]; ?></td>
                            <td><?php echo $row["tongghe"]; ?></td>
                            <td><?php echo $row["tongphieu"]; ?></td>
                            <td><?php echo number_format($row["tongthu"], 0, ',', '.'); ?> VND</td>
                            <td><?php echo number_format($row["tongchuathu"], 0, ',', '.'); ?> VND</td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Không có kết quả thống kê tổng quan tàu.</p>
        <?php endif; ?>

        <!-- Thống kê doanh thu theo tháng -->
        <?php if ($result_thang->num_rows > 0): ?>
            <h4>Thống kê doanh thu theo tháng</h4>
            <table class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>Năm</th>
                        <th>Tháng</th>
                        <th>Tổng Tiền Đã Thanh Toán</th>
                        <th>Tổng Tiền Chưa Thanh Toán</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_thang->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["nam"]; ?></td>
                            <td><?php echo $row["thang"]; ?></td>
                            <td><?php echo number_format($row["tongthu"], 0, ',', '.'); ?> VND</td>
                            <td><?php echo number_format($row["tongchuathu"], 0, ',', '.'); ?> VND</td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Không có kết quả thống kê doanh thu theo tháng.</p>
        <?php endif; ?>

        <!-- Thống kê doanh thu theo năm -->
        <?php if ($result_nam->num_rows > 0): ?>
            <h4>Thống kê doanh thu theo năm</h4>
            <table class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>Năm</th>
                        <th>Tổng Tiền Đã Thanh Toán</th>
                        <th>Tổng Tiền Chưa Thanh Toán</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_nam->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["nam"]; ?></td>
                            <td><?php echo number_format($row["tongthu"], 0, ',', '.'); ?> VND</td>
                            <td><?php echo number_format($row["tongchuathu"], 0, ',', '.'); ?> VND</td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Không có kết quả thống kê doanh thu theo năm.</p>
        <?php endif; ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>
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