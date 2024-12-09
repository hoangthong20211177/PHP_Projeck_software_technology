<?php


 if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $matoa = $_POST['matoa'];//
    $tentoa = $_POST['tentoa'];//
   $matau = $_POST['matau'];//



$sql = "INSERT INTO toa (matoa, tentoa  , matau)
VALUES ( '$matoa','$tentoa ' ,'$matau');
";

if ($conn->multi_query($sql) === TRUE) {
    echo "
    
    <p style='color: green;'>Thêm Toa Thành Công!</p>
    <a class='btn btn-info' href='indexql.php?quanly=dstoa' role='button'> Quay Lại Bảng Toa</a>
    ";

    exit();
} else {
    echo "<p style='color: red;'>Lỗi: " . $conn->error . "</p>";
   
    exit();
}
} else {
}
$sqlTau = "SELECT matau, tentau FROM tau";
$resultTau = $conn->query($sqlTau);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Toa Mới</title>
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

        input[type="checkbox"] {
            width: auto;
            margin: 5px 10px 10px 0;
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


<h2>Thêm Toa Mới</h2>

<form method="post" action="indexql.php?quanly=themtoa2">


    <label for="matoa">Mã Toa</label>
    <input type="text" id="matoa" name="matoa" required>

    <label for="tentoa">Tên Toa</label>
    <input type="text" id="tentoa" name="tentoa" required>

 <label for="matau">Mã Tàu</label>
    <select id="matau" name="matau" required>
        <?php
        while ($rowTau = $resultTau->fetch_assoc()) {
            echo '<option value="' . $rowTau['matau'] .'">' . $rowTau['tentau'] . '</option>';
        }
        ?>
    </select>

    <input type="submit" value="Thêm Toa">
 <!--

        <?php/*

*/?> -->


  
</form>

</body>
</html>
    
<?php
// Đóng kết nối
$conn->close();
?>
