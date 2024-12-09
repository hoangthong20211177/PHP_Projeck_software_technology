<?php
if (isset($_GET['machitiet'])) {
    $machitiet = $_GET['machitiet'];

    // Lấy thông tin chi tiết lịch trình
    $sql = "SELECT c.machitiet, c.magiave, giave.giatien, g.tengadi, g2.tengaden, c.giodi, c.gioden, l.tenlichtrinh, t.tentau
            FROM chitietlich c
            INNER JOIN gadi g ON c.magadi = g.maga
            INNER JOIN gadi g2 ON c.magaden = g2.maga
            INNER JOIN giave ON c.magiave = giave.magiave
            INNER JOIN lichtrinh l ON c.malichtrinh = l.malichtrinh
            INNER JOIN tau t ON l.matau = t.matau
            WHERE c.machitiet = '$machitiet'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tenlichtrinh = $row['tenlichtrinh'];
        $tentau = $row['tentau'];
        $tengadi = $row['tengadi'];
        $tengaden = $row['tengaden'];
        $giatien = $row['giatien'];

        echo "
        <h2>Đặt Vé Chuyến: $tenlichtrinh</h2>
        <form method='post' action=''>
            <label for='tenkhach'>Tên Khách:</label>
            <input type='text' name='tenkhach' required><br>

            <label for='sodienthoai'>Số Điện Thoại:</label>
            <input type='text' name='sodienthoai' required><br>

            <label for='toa'>Chọn Toa:</label>
            <select name='toa' id='toa' required>";
            
            // Lấy danh sách các toa của tàu
            $sqlToa = "SELECT * FROM toa WHERE matoua = (SELECT matoua FROM tau WHERE tentau = '$tentau')";
            $toaResult = $conn->query($sqlToa);
            while ($toa = $toaResult->fetch_assoc()) {
                echo "<option value='" . $toa['matoa'] . "'>" . $toa['tentoa'] . "</option>";
            }

            echo "</select><br>";

            // Tạo tùy chọn ghế theo toa đã chọn
            echo "
            <label for='ghe'>Chọn Ghế:</label>
            <select name='ghe' id='ghe' required>";
            
            // Ghế sẽ được load sau khi chọn toa
            echo "</select><br>";
            
            echo "
            <input type='submit' name='submit' value='Đặt Vé'>
        </form>";

        // Xử lý submit form
        if (isset($_POST['submit'])) {
            $tenkhach = $_POST['tenkhach'];
            $sodienthoai = $_POST['sodienthoai'];
            $toa = $_POST['toa'];
            $ghe = $_POST['ghe'];

            // Lưu thông tin vào bảng phieudat
            $sqlDatVe = "INSERT INTO phieudat (tenkhach, sodienthoai, machitiet, maghe, tinhtrangve)
                        VALUES ('$tenkhach', '$sodienthoai', '$machitiet', '$ghe', 0)";
            if ($conn->query($sqlDatVe) === TRUE) {
                echo "Đặt vé thành công!";
            } else {
                echo "Lỗi: " . $conn->error;
            }
        }
    }
}
?>
<script>
    // Lắng nghe sự kiện thay đổi toa
    document.getElementById('toa').addEventListener('change', function() {
        var toaId = this.value;
        
        // Gửi AJAX request để lấy danh sách ghế của toa đã chọn
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_ghes.php?toa=' + toaId, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var gheOptions = JSON.parse(xhr.responseText);
                var gheSelect = document.getElementById('ghe');
                gheSelect.innerHTML = ''; // Xóa danh sách ghế cũ

                // Thêm các ghế mới vào select
                gheOptions.forEach(function(ghe) {
                    var option = document.createElement('option');
                    option.value = ghe.maghe;
                    option.text = ghe.tenghe;
                    gheSelect.appendChild(option);
                });
            }
        };
        xhr.send();
    });
</script>
