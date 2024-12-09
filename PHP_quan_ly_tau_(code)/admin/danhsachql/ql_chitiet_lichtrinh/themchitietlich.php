<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $machitiet = $_POST['machitiet'];
    $magiave = $_POST['magiave'];
    $malichtrinh = $_POST['malichtrinh'];
    $magadi = $_POST['magadi'];
    $gioden = $_POST['gioden'];
    $giodi = $_POST['giodi'];
    $magaden = $_POST['magaden'];

    // Kiểm tra ga đi và ga đến
    if ($magadi === $magaden) {
        echo "<p style='color: red;'>Lỗi: Ga đi và Ga đến không được trùng nhau.</p>";
        exit();
    }

    // Kiểm tra định dạng giờ đi và giờ đến (hh:mm)
    $timePattern = "/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/";
    if (!preg_match($timePattern, $giodi) || !preg_match($timePattern, $gioden)) {
        echo "<p style='color: red;'>Lỗi: Giờ đi hoặc Giờ đến không đúng định dạng (hh:mm).</p>";
        exit();
    }

    // Thêm dữ liệu vào bảng
    $sql = "INSERT INTO chitietlich (machitiet, magiave, malichtrinh, magadi, gioden, giodi, magaden)
            VALUES ('$machitiet', '$magiave', '$malichtrinh', '$magadi', '$gioden', '$giodi', '$magaden')";

    if ($conn->query($sql) === TRUE) {
        echo "
            <p style='color: green;'>Thêm chi tiết lịch thành công!</p>
            <a class='btn btn-info' href='indexql.php?quanly=themlichtrinh' role='button'>Thêm Lịch Trình</a>
            <a class='btn btn-info' href='indexql.php?quanly=lichtrinh' role='button'>Quay Lại DS Lịch Trình</a>
        ";
        exit();
    } else {
        echo "<p style='color: red;'>Lỗi: " . $conn->error . "</p>";
        exit();
    }
}

// Lấy danh sách dữ liệu từ các bảng
$sqlLichTrinh = "SELECT malichtrinh, tenlichtrinh FROM lichtrinh";
$resultLichTrinh = $conn->query($sqlLichTrinh);

$sqlGiaVe = "SELECT magiave, giatien FROM giave";
$resultGiaVe = $conn->query($sqlGiaVe);

$sqlGadi = "SELECT maga, tengadi FROM gadi";
$resultGadi = $conn->query($sqlGadi);

$sqlGadi2 = "SELECT maga, tengaden FROM gadi";
$resultGadi2 = $conn->query($sqlGadi2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Chi Tiết Lịch Trình Mới</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h2>Thêm Chi Tiết Lịch Trình Mới</h2>
<form method="post" action="">
    <label for="machitiet">Mã Chi Tiết</label>
    <input type="number" id="machitiet" name="machitiet" required>

    <label for="malichtrinh">Lịch Trình</label>
    <select id="malichtrinh" name="malichtrinh" required>
        <?php while ($rowLichTrinh = $resultLichTrinh->fetch_assoc()) : ?>
            <option value="<?= $rowLichTrinh['malichtrinh'] ?>"><?= $rowLichTrinh['tenlichtrinh'] ?></option>
        <?php endwhile; ?>
    </select>

    <label for="magiave">Số Điểm Dừng</label>
    <select id="magiave" name="magiave" required>
        <?php while ($rowGiaVe = $resultGiaVe->fetch_assoc()) : ?>
            <option value="<?= $rowGiaVe['magiave'] ?>"><?= $rowGiaVe['magiave'] ?></option>
        <?php endwhile; ?>
    </select>

    <label for="magadi">Ga Đi</label>
    <select id="magadi" name="magadi" required>
        <?php while ($rowGadi = $resultGadi->fetch_assoc()) : ?>
            <option value="<?= $rowGadi['maga'] ?>"><?= $rowGadi['tengadi'] ?></option>
        <?php endwhile; ?>
    </select>

    <label for="magaden">Ga Đến</label>
    <select id="magaden" name="magaden" required>
        <?php while ($rowGadi2 = $resultGadi2->fetch_assoc()) : ?>
            <option value="<?= $rowGadi2['maga'] ?>"><?= $rowGadi2['tengaden'] ?></option>
        <?php endwhile; ?>
    </select>

    <label for="giodi">Giờ Đi</label>
    <input type="time" id="giodi" name="giodi" placeholder="hh:mm" required>

    <label for="gioden">Giờ Đến</label>
    <input type="time" id="gioden" name="gioden" placeholder="hh:mm" required>

    <input type="submit" value="Thêm Lịch Trình">
</form>

<script>
    // Kiểm tra JavaScript
    document.querySelector("form").addEventListener("submit", function (event) {
        const magadi = document.getElementById("magadi").value;
        const magaden = document.getElementById("magaden").value;
        const giodi = document.getElementById("giodi").value;
        const gioden = document.getElementById("gioden").value;

        // Kiểm tra Ga đi và Ga đến
        if (magadi === magaden) {
            alert("Ga đi và Ga đến không được trùng nhau.");
            event.preventDefault();
            return;
        }

        // Kiểm tra định dạng giờ
        const timePattern = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
        if (!timePattern.test(giodi) || !timePattern.test(gioden)) {
            alert("Giờ đi và Giờ đến phải đúng định dạng hh:mm.");
            event.preventDefault();
        }
    });
</script>
</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>
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
