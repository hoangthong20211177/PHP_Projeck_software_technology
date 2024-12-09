<?php
// Xử lý lấy thông tin tài khoản để hiển thị form sửa
if (isset($_GET['taikhoan'])) {
    $taikhoanToEdit = $_GET['taikhoan'];
    $sqlGetInfo = "SELECT * FROM adminnv WHERE taikhoan = '$taikhoanToEdit'";
    $resultInfo = $conn->query($sqlGetInfo);

    if ($resultInfo->num_rows > 0) {
        $rowInfo = $resultInfo->fetch_assoc(); 
        $taikhoan = $rowInfo['taikhoan'];
        $matkhau = $rowInfo['matkhau'];
        $hoten = $rowInfo['hoten'];
        $sodienthoai = $rowInfo['sodienthoai'];
        $email = $rowInfo['email'];
        $role = $rowInfo['role'];
    } else {
        echo "Không tìm thấy thông tin tài khoản."; 
        exit();
    }
}

// Xử lý cập nhật thông tin tài khoản
if (isset($_POST['update'])) {
    $taikhoan = $_POST['taikhoan'];
    $matkhau = $_POST['matkhau'];
    $hoten = $_POST['hoten'];
    $sodienthoai = $_POST['sodienthoai'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Câu lệnh SQL cập nhật thông tin tài khoản
    $sqlUpdate = "UPDATE adminnv SET taikhoan='$taikhoan', matkhau='$matkhau', hoten='$hoten', sodienthoai='$sodienthoai', email='$email', role='$role' WHERE taikhoan='$taikhoan'";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Cập nhật thông tin tài khoản thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
?>

<div class="textsua">
    <h2> Sửa Tài Khoản</h2>
</div>
<div class="suabang1">
    <div class='suaquaylaibang'>
        <a class='btn btn-info' href='indexql.php?quanly=ds_nhanvien' role='button'> Quay Lại Danh Sách Tài Khoản</a>
    </div>
    <div class="suabang">
        <!-- Form nhập thông tin tài khoản -->
        <form method="post" action="" onsubmit="return validateForm()">
            Tài Khoản: 
            <div class="suanhautau">
                <input type="text" name="taikhoan" id="taikhoan" value="<?php echo $taikhoan; ?>" readonly>
                <span id="taikhoanError" style="color:red;"></span>
            </div>
            Mật Khẩu: 
            <div class="suanhautau">
                <input type="text" name="matkhau" id="matkhau" value="<?php echo $matkhau; ?>" required>
                <span id="matkhauError" style="color:red;"></span>
            </div>
            Họ Tên: 
            <div class="suanhautau">
                <input type="text" name="hoten" id="hoten" value="<?php echo $hoten; ?>" required>
                <span id="hotenError" style="color:red;"></span>
            </div>
            Số Điện Thoại: 
            <div class="suanhautau">
                <input type="text" name="sodienthoai" id="sodienthoai" value="<?php echo $sodienthoai; ?>" required>
                <span id="sodienthoaiError" style="color:red;"></span>
            </div>
            Email: 
            <div class="suanhautau">
                <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
                <span id="emailError" style="color:red;"></span>
            </div>
            Vai Trò: 
            <div class="suanhautau">
                <select name="role" required>
                    <option value="1" <?php echo $role == 1 ? 'selected' : ''; ?>>Admin</option>
                    <option value="2" <?php echo $role == 2 ? 'selected' : ''; ?>>Nhân Viên</option>
                </select>
            </div>
            <input type="submit" name="update" value="Cập Nhật" class="suacapnhattau"><br>
        </form>
    </div>
</div>

<script>
document.getElementById("taikhoan").addEventListener("input", validateTaikhoan);
document.getElementById("matkhau").addEventListener("input", validateMatkhau);
document.getElementById("hoten").addEventListener("input", validateHoten);
document.getElementById("sodienthoai").addEventListener("input", validateSodienthoai);
document.getElementById("email").addEventListener("input", validateEmail);

function validateForm() {
    var isValid = true;

    // Kiểm tra tất cả các trường lỗi
    if (document.getElementById("taikhoanError").innerText || 
        document.getElementById("matkhauError").innerText || 
        document.getElementById("hotenError").innerText || 
        document.getElementById("sodienthoaiError").innerText || 
        document.getElementById("emailError").innerText) {
        isValid = false;
        alert("Bạn cần nhập đúng tất cả thông tin.");
    }

    return isValid;
}

function validateTaikhoan() {
    var taikhoan = document.getElementById("taikhoan").value;
    var taikhoanError = document.getElementById("taikhoanError");
    if (!/^[a-zA-Z0-9]{3,25}$/.test(taikhoan)) {
        taikhoanError.innerText = "Tài khoản chỉ được phép chứa chữ và số, tối thiểu 3 ký tự.";
    } else {
        taikhoanError.innerText = "";
    }
}

function validateMatkhau() {
    var matkhau = document.getElementById("matkhau").value;
    var matkhauError = document.getElementById("matkhauError");
    if (matkhau.length < 6) {
        matkhauError.innerText = "Mật khẩu phải có ít nhất 6 ký tự.";
    } else if (!/[A-Z]/.test(matkhau)) {
        matkhauError.innerText = "Mật khẩu phải có ít nhất một chữ cái in hoa.";
    } else if (!/[a-z]/.test(matkhau)) {
        matkhauError.innerText = "Mật khẩu phải có ít nhất một chữ cái thường.";
    } else if (!/[0-9]/.test(matkhau)) {
        matkhauError.innerText = "Mật khẩu phải có ít nhất một chữ số.";
    } else if (!/[!@#$%^&*(),.?":{}|<>]/.test(matkhau)) {
        matkhauError.innerText = "Mật khẩu phải có ít nhất một ký tự đặc biệt.";
    } else {
        matkhauError.innerText = "";
    }
}

function validateHoten() {
    var hoten = document.getElementById("hoten").value;
    var hotenError = document.getElementById("hotenError");
    if (!/^[\p{L} ]{1,25}$/u.test(hoten)) {
        hotenError.innerText = "Tên chỉ được phép chứa ký tự chữ (bao gồm tiếng Việt) và tối đa 25 ký tự.";
    } else {
        hotenError.innerText = "";
    }
}

function validateSodienthoai() {
    var sodienthoai = document.getElementById("sodienthoai").value;
    var sodienthoaiError = document.getElementById("sodienthoaiError");
    if (!/^0[0-9]{9,10}$/.test(sodienthoai)) {
        sodienthoaiError.innerText = "Số điện thoại phải bắt đầu bằng số 0, có từ 10 đến 11 chữ số.";
    } else {
        sodienthoaiError.innerText = "";
    }
}

function validateEmail() {
    var email = document.getElementById("email").value;
    var emailError = document.getElementById("emailError");
    if (!/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(email)) {
        emailError.innerText = "Email không hợp lệ.";
    } else {
        emailError.innerText = "";
    }
}
</script>
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
