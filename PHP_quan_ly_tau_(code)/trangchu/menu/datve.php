

<?php
// datve.php
// Đảm bảo kết nối cơ sở dữ liệu
include './trangchu/ketnoi.php';

if (isset($_GET['machitiet'])) {
    $machitiet = $_GET['machitiet'];

    // Truy vấn thông tin chi tiết chuyến đi
    $sql = "SELECT c.machitiet, l.tenlichtrinh, t.tentau, c.magadi, c.magaden, g.giatien
            FROM chitietlich c
            JOIN lichtrinh l ON c.malichtrinh = l.malichtrinh
            JOIN tau t ON l.matau = t.matau
            JOIN giave g ON c.magiave = g.magiave
            WHERE c.machitiet = '$machitiet'";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tenlichtrinh = $row['tenlichtrinh'];
        $tentau = $row['tentau'];
        $magadi = $row['magadi'];
        $magaden = $row['magaden'];
        $giatien = $row['giatien'];  // Giá tiền từ bảng giave

        // Hiển thị thông tin chi tiết chuyến đi
        echo "<h2>Đặt Vé: $tenlichtrinh - $tentau</h2>";

        // Form Đặt Vé
        echo "
        <form id='formDatVe' method='post' action=''>
            <div>
                <label>Mã Chi Tiết:</label>
                <input type='text' name='machitiet' value='$machitiet' readonly>
            </div>
            <div>
                <label>Tên Lịch Trình:</label>
                <input type='text' name='tenlichtrinh' value='$tenlichtrinh' readonly>
            </div>
            <div>
                <label>Tên Tàu:</label>
                <input type='text' name='tentau' value='$tentau' readonly>
            </div>
            
            <div>
                <label>Chọn Toa:</label>
                <select name='toa' id='toa' required>
                ";

        // Lấy danh sách các toa từ tàu tương ứng
        $sqlToa = "SELECT * FROM toa WHERE matau = (SELECT matau FROM lichtrinh WHERE malichtrinh = (SELECT malichtrinh FROM chitietlich WHERE machitiet = '$machitiet'))";
        $toaResult = $conn->query($sqlToa);
        
        // Kiểm tra có toa nào không
        if ($toaResult->num_rows > 0) {
            while ($toa = $toaResult->fetch_assoc()) {
                echo "<option value='" . $toa['matoa'] . "'>" . $toa['tentoa'] . "</option>";
            }
        } else {
            echo "<option value=''>Không có toa nào</option>";
        }

        echo "</select>
        </div>

        <div>
            <label>Chọn Ghế:</label>
            <select name='ghe' id='ghe' required></select>
        </div>
        
         <div>
            <label>Tên Khách:</label>
            <input type='text' name='tenkhach' id='tenkhach' required>
            <div id='tenkhach-error' style='color: red; display: none;'></div>
        </div>

        <div>
            <label>Số Điện Thoại:</label>
            <input type='number' name='sodienthoai' id='sodienthoai' required>
            <div id='sodienthoai-error' style='color: red; display: none;'></div>
        </div>
        <div>
            <input type='submit' name='submit' value='Đặt Vé' id='btnDatVe'>
        </div>
    </form>";

        // Xử lý đặt vé khi người dùng nhấn submit
        if (isset($_POST['submit'])) {
            $tenkhach = $_POST['tenkhach'];
            $sodienthoai = $_POST['sodienthoai'];
            $toa = $_POST['toa'];
            $ghe = $_POST['ghe'];

            // Thêm phiếu đặt vào bảng phieudat
            $sqlDatVe = "INSERT INTO phieudat (tenkhach, sodienthoai, machitiet, maghe, tinhtrangve)
                         VALUES ('$tenkhach', '$sodienthoai', '$machitiet', '$ghe', 0)";
            if ($conn->query($sqlDatVe) === TRUE) {
                $maphieu = $conn->insert_id; // Lấy mã phiếu đặt mới

                // Truy vấn thông tin chi tiết về vé đã đặt để hiển thị trong popup
                $sqlThongTinVe = "
                SELECT pd.tenkhach, pd.sodienthoai, t.tentau, toa.tentoa, ghe.tenghe, l.tenlichtrinh, c.magadi, c.giodi, c.gioden, g.giatien
                FROM phieudat pd
                JOIN chitietlich c ON pd.machitiet = c.machitiet
                JOIN lichtrinh l ON c.malichtrinh = l.malichtrinh
                JOIN tau t ON l.matau = t.matau
                JOIN toa toa ON t.matau = toa.matau
                JOIN ghe ghe ON toa.matoa = ghe.matoa
                JOIN giave g ON c.magiave = g.magiave
                WHERE pd.maphieu = $maphieu
                ";

                $resultThongTinVe = $conn->query($sqlThongTinVe);
                $veInfo = $resultThongTinVe->fetch_assoc();

                // Hiển thị thông báo yêu cầu thanh toán trong form nổi
                echo "
<div id='popup' class='popup'>
    <div class='popup-content'>
        <span class='close'>&times;</span>
        <h3>Thông Tin Đặt Vé</h3>
        <p><strong>Tên Khách Hàng:</strong> {$veInfo['tenkhach']} <strong>Số Điện Thoại:</strong> {$veInfo['sodienthoai']}</p>
        <!-- Tàu, Toa, Ghế cùng 1 dòng -->
        <p><strong>Tàu: </strong> {$veInfo['tentau']} - {$veInfo['tentoa']} - {$veInfo['tenghe']}</p>
        
        <!-- Giờ Khởi Hành và Giờ Đến cùng 1 dòng -->
        <p><strong>Giờ Khởi Hành, Giờ Đến:</strong> {$veInfo['giodi']} - {$veInfo['gioden']}</p>
        <p><strong>Lịch Trình:</strong> {$veInfo['tenlichtrinh']}</p>
        <p><strong>Giá Vé:</strong> {$veInfo['giatien']} VND</p>

        <!-- Thêm hình ảnh ở đây -->
        <img src='trangchu/menu/qr.jpg' alt='Hình minh họa' style='max-width: 40%; lert height: auto;' />

        <h3>Thông Báo Thanh Toán</h3>
        <p>Bạn cần thanh toán mã vé: <strong>$maphieu: </strong> <strong>{$veInfo['giatien']} VND</strong> để hoàn thành đặt vé.</p>
        <p>GHI NỘI DUNG: <strong>$maphieu</strong> + SĐT hoặc tên khách hàng.</p>
        <p>Liên hệ: 19001000 để kiểm tra thanh toán nhanh nhất.</p>

        <!-- Nút OK và Xuất PDF -->
        <button id='btnOk'>OK</button>
        <button id='btnExportPDF' onclick='exportPDF($maphieu)'>Xuất PDF</button>
    </div>
</div>


                ";
            } else {
                echo "Lỗi: " . $conn->error;
            }
        }
    } else {
        echo "Không tìm thấy thông tin chuyến đi!";
    }
} else {
    echo "Mã chi tiết không hợp lệ!";
}

$conn->close();
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Kiểm tra tên khách khi người dùng nhập
    $('#tenkhach').on('input', function() {
        var namePattern = /^[\p{L}\s]+$/u;
        var tenkhach = $(this).val();
        var errorMessage = '';

        if (!namePattern.test(tenkhach)) {
            errorMessage = 'Tên khách chỉ được phép chứa ký tự chữ tiếng Việt.';
        }

        if (errorMessage) {
            $('#tenkhach-error').text(errorMessage).show();
        } else {
            $('#tenkhach-error').text('').hide();
        }
    });

    // Kiểm tra số điện thoại khi người dùng nhập
    $('#sodienthoai').on('input', function() {
        var phonePattern = /^0\d{8,10}$/;
        var sodienthoai = $(this).val();
        var errorMessage = '';

        if (!phonePattern.test(sodienthoai)) {
            errorMessage = 'Số điện thoại phải bắt đầu bằng 0 và có từ 9 đến 11 chữ số.';
        }

        if (errorMessage) {
            $('#sodienthoai-error').text(errorMessage).show();
        } else {
            $('#sodienthoai-error').text('').hide();
        }
    });

    // Kiểm tra khi gửi form
    $('#formDatVe').submit(function(e) {
        var isValid = true;
        var tenkhach = $('#tenkhach').val();
        var sodienthoai = $('#sodienthoai').val();

        // Kiểm tra tên khách
        if (!/^[\p{L}\s]+$/u.test(tenkhach)) {
            $('#tenkhach-error').text('Tên khách chỉ được phép chứa ký tự chữ tiếng Việt.').show();
            isValid = false;
        }

        // Kiểm tra số điện thoại
        if (!/^0\d{8,10}$/.test(sodienthoai)) {
            $('#sodienthoai-error').text('Số điện thoại phải bắt đầu bằng 0 và có từ 9 đến 11 chữ số.').show();
            isValid = false;
        }

        // Nếu không hợp lệ, ngừng gửi form
        if (!isValid) {
            e.preventDefault();
        }
    });

    // Sự kiện khi người dùng chọn toa
    $('#toa').change(function() {
        var toaId = $(this).val();  // Lấy giá trị của toa đã chọn

        // Kiểm tra nếu không có toa nào được chọn
        if (!toaId) {
            $('#ghe').html('<option value="">Vui lòng chọn toa</option>');
            return;
        }

        // Gửi yêu cầu AJAX để lấy ghế từ toa
        $.ajax({
            url: 'trangchu/menu/get_ghe.php',  // Truyền tới file xử lý ghế
            method: 'GET',
            data: { 
                toaId: toaId, 
                machitiet: '<?php echo $machitiet; ?>'  // Truyền ID của toa và machitiet
            },
            success: function(data) {
                $('#ghe').html(data);  // Cập nhật danh sách ghế vào select
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + error);  // Xử lý lỗi nếu có
                $('#ghe').html('<option value="">Không thể tải ghế</option>');
            }
        });
    });

    // Đóng popup khi nhấn vào nút x
    $('.close').click(function() {
        $('#popup').hide();
    });

    // Đảm bảo popup sẽ hiển thị sau khi đặt vé thành công
    <?php if (isset($maphieu)) { ?>
        $('#popup').show();
    <?php } ?>

    // Đóng popup khi nhấn nút OK
    $('#btnOk').click(function() {
        $('#popup').hide();
    });
});

// Hàm xuất PDF
// Đoạn mã JavaScript khác

// Hàm exportPDF
function exportPDF(maphieu) {
    if (maphieu) {
        // Kiểm tra nếu mã phiếu có hợp lệ
        window.location.href = 'trangchu/menu/export_pdf.php?maphieu=' + maphieu;
        
    } else {
        alert("Mã phiếu không hợp lệ!");
    }
}
</script>

<!-- CSS cho Popup và giao diện chung -->
<!-- CSS cho Popup và giao diện chung với nhiều màu sắc -->
<style>
/* Thống nhất font chữ toàn trang */
body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

/* Wrapper chính */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Tiêu đề chính */
h2 {
    text-align: center;
    font-size: 28px;
    color: #333;
    margin-bottom: 20px;
    font-weight: bold;
    text-transform: uppercase;
}

/* Form đặt vé */
form {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 0 auto;
    transition: all 0.3s ease;
}

form:hover {
    transform: scale(1.05);
}

/* Các trường input trong form */
form label {
    font-size: 16px;
    color: #444;
    margin-bottom: 8px;
    display: block;
}

/* Input và select */
input[type="text"], input[type="number"], select {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    background-color: #f9f9f9;
    transition: background-color 0.3s ease, border 0.3s ease;
}

input[type="text"]:focus, input[type="number"]:focus, select:focus {
    border-color: #FF6F61;
    background-color: #ffe6e6;
    outline: none;
}

/* Button submit */
input[type="submit"] {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #FF6F61, #FFC107);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.3s ease;
}

input[type="submit"]:hover {
    background: linear-gradient(135deg, #FF3B30, #FF5722);
    transform: translateY(-2px);
}




/* Phần popup */
/* Phần popup */
/* Phần popup */
.popup {
    display: none;
    justify-content: center;
    position: fixed; /* Giúp popup luôn hiển thị ở vị trí cố định */
    top: 50%; /* Căn giữa theo chiều dọc */
    left: 50%; /* Căn giữa theo chiều ngang */
    transform: translate(-50%, -50%); /* Điều chỉnh vị trí chính xác ở giữa */
    z-index: 1000; /* Đảm bảo popup nằm trên các phần tử khác */
    background-color: rgba(0, 0, 0, 0.7); /* Màu nền với độ trong suốt */
    padding: 20px; /* Khoảng cách bên trong popup */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Đổ bóng cho popup */
    border-radius: 8px; /* Bo góc popup */
    width: 80%; /* Đặt chiều rộng cho popup */
    max-width: 600px; /* Giới hạn chiều rộng tối đa */
    max-height: 90%; /* Giới hạn chiều cao tối đa */
    overflow: auto; /* Cho phép cuộn khi nội dung dài */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    box-sizing: border-box;
    color: white; /* Đảm bảo tất cả văn bản trong popup là màu trắng */
}

/* Khi popup có thể di chuyển */
.popup-content {
    width: 100%;
    overflow: auto; /* Đảm bảo nội dung trong popup có thể cuộn */
    padding-right: 10px; /* Đảm bảo có không gian để cuộn */
}

/* Kéo popup */
.popup-header {
    cursor: move; /* Chỉ thị cho người dùng biết có thể kéo */
    padding: 10px;
    background-color: #fff; /* Màu nền tiêu đề */
    border-radius: 8px 8px 0 0;
    width: 100%;
    text-align: center;
    color: black; /* Màu chữ tiêu đề vẫn là đen để dễ đọc */
}

/* Chữ trong nội dung popup */
.popup-content p, .popup-content h1, .popup-content h2, .popup-content h3 {
    color: white; /* Đảm bảo màu chữ trắng cho các phần tử trong nội dung */
}

/* Thêm màu trắng cho các nút hoặc bất kỳ phần tử nào khác trong popup nếu cần */
.popup-button {
    color: white; /* Ví dụ: màu trắng cho các nút */
}


.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 32px;
    font-weight: bold;
    color: #555;
    cursor: pointer;
}

h3 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #FF6F61;
}

.popup p {
    font-size: 18px;
    color: #88;
    margin: 10px 0;
}

button {
    background-color: #FF6F61;
    color: white;
    padding: 12px 24px;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin: 10px;
    transition: background 0.3s ease;
}

button:hover {
    background-color: #FF3B30;
}

/* Thêm màu cho nút Xuất PDF */
#btnExportPDF {
    background-color: #3F51B5;
}

#btnExportPDF:hover {
    background-color: #283593;
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    form {
        padding: 15px;
        max-width: 100%;
    }

    h2 {
        font-size: 22px;
    }

    .popup-content {
        width: 90%;
        padding: 25px;
    }

    button {
        width: 100%;
    }
}

/* Màu sắc nền cho từng phần */
.bg-primary {
    background-color: #FF6F61;
    color: white;
}

.bg-secondary {
    background-color: #2196F3;
    color: white;
}

.bg-light {
    background-color: #F1F1F1;
}

/* Đặt hiệu ứng hover cho form input khi focus */
input[type="text"]:focus, input[type="number"]:focus, select:focus {
    border-color: #FF6F61;
    outline: none;
    background-color: #ffe6e6;
}

/* Các class giúp căn chỉnh văn bản */
.text-center {
    text-align: center;
}

.text-left {
    text-align: left;
}

.text-right {
    text-align: right;
}
</style>
