<?php


if (isset($_GET['matau'])) {
    $matau = $_GET['matau'];

    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT t.matoa, t.tentoa, t.matau, COUNT(p.maphieu) AS soluongphieu
            FROM toa t
            LEFT JOIN ghe  ON t.matoa = ghe.matoa
            LEFT JOIN phieudat p ON ghe.maghe = p.maghe
            
            WHERE t.matau = $matau
            GROUP BY t.matoa, t.tentoa, t.matau";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
 
        echo "<table border='1'>";
        echo "

         <h4>  Thống kê số 'Phiếu' đã đặt trong các Toa của mã Tàu: '$matau'</h4>
        </div>
        <form 
        method='post' action='indexql.php?quanly=dstoa'> 
        </div>
        <div class='timkiem'>
        <input type='text' name='keyword' required>
        <input type='submit' name='search' value='Tìm Kiếm'> <br>
        </form>
        </div>
        <table class='table table-bordered table-striped w-100'>


        <tr><th>Mã Toa</th>
        <th>Tên Toa</th>
        <th>Mã Tàu</th>
        <th>Tổng Số Phiếu Đặt</th>
        <th>Ghế Trống </th>
        <th>View Phieu Details</th></tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $phieutrong = 20 - $row["soluongphieu"];
            echo "<tr>
                    <td>" . $row["matoa"] . "</td>
                    <td>" . $row["tentoa"] . "</td>
                    <td>" . $row["matau"] . "</td>
                    <td>" . $row["soluongphieu"] . "</td>
                    <td>" . $phieutrong . "</td>
                    <td>
                    <a href='indexql.php?quanly=thongketoa&matau="  . $row["matoa"] . "'><i class='bi bi-info-circle-fill'></a></td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "Không có dữ liệu cho mã tàu: $matau";
    }

    // Close connection
    $conn->close();
} else {
    echo "Invalid request. Please provide a valid 'matau' parameter.";
}
?>
