<?php


// Xử lý thêm tài khoản
if (isset($_POST['submit'])) {
    $taikhoan = $_POST['taikhoan'];
    $matkhau = $_POST['matkhau'];
    $hoten = $_POST['hoten'];
    $sodienthoai = $_POST['sodienthoai'];
    $email = $_POST['email'];
    $role = $_POST['role'];  // Lưu ý giá trị của role sẽ là 1 hoặc 2

    // Kiểm tra tài khoản đã tồn tại chưa
    $sqlCheck = "SELECT * FROM adminnv WHERE taikhoan='$taikhoan'";
    $result = $conn->query($sqlCheck);
    
    // Nếu tài khoản đã tồn tại, thông báo lỗi và không thêm vào cơ sở dữ liệu
    if ($result->num_rows > 0) {
        $_SESSION['error_message'] = "Tài khoản $taikhoan đã tồn tại. Vui lòng chọn tài khoản khác.";
    } else {
        // Nếu tài khoản chưa tồn tại, thực hiện thêm tài khoản vào cơ sở dữ liệu
        $sqlAdd = "INSERT INTO adminnv (taikhoan, matkhau, hoten, sodienthoai, email, role) 
                   VALUES ('$taikhoan', '$matkhau', '$hoten', '$sodienthoai', '$email', '$role')";
        if ($conn->query($sqlAdd) === TRUE) {
            $_SESSION['success_message'] = "Thêm Tài Khoản Nhân Viên thành công.";
        } else {
            $_SESSION['error_message'] = "Lỗi: " . $conn->error;
        }
    }
}


// Hiển thị thông báo nếu có
if (isset($_SESSION['error_message'])) {
    echo "<script>alert('" . $_SESSION['error_message'] . "');</script>";
    unset($_SESSION['error_message']); // Xóa thông báo sau khi hiển thị
}

if (isset($_SESSION['success_message'])) {
    echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
    unset($_SESSION['success_message']); // Xóa thông báo sau khi hiển thị
}
?>




<div class="textthem">
    <h2>Thêm Mới Tài Khoản Nhân Viên</h2>
</div>
<div class="themmoi">
    <div class='themquaylaibang'>
        <a class='btn btn-info' href='indexql.php?quanly=ds_nhanvien' role='button'>Quay Lại Danh Sách Tài Khoản</a>
    </div>
    <div class="thembang">
        <form method="post" action="" onsubmit="return validateForm()">
            Tài Khoản: <input type="text" name="taikhoan" id="taikhoan" required oninput="validateTaikhoan()"><br>
            <span id="taikhoanError" style="color:red;"></span><br>
            Mật Khẩu: <input type="text" name="matkhau" id="matkhau" required oninput="validateMatkhau()"><br>
            <span id="matkhauError" style="color:red;"></span><br>
            Họ Tên: <input type="text" name="hoten" id="hoten" required oninput="validateHoten()"><br>
            <span id="hotenError" style="color:red;"></span><br>
            Số Điện Thoại: <input type="text" name="sodienthoai" id="sodienthoai" required oninput="validateSodienthoai()"><br>
            <span id="sodienthoaiError" style="color:red;"></span><br>
            Email: <input type="email" name="email" id="email" value="@gmail.com" required oninput="validateEmail()"><br>
            <span id="emailError" style="color:red;"></span><br>
            Vai Trò: 
<select name="role" required>
    <option value="1">Admin</option>
    <option value="2">Nhân Viên</option>
</select><br>

            <input type="submit" name="submit" value="Thêm Mới">
        </form>
    </div>
</div> 

<script>
  function validateForm() {
    // Kiểm tra tất cả các trường
    var isValid = true;
    validateTaikhoan();
    validateMatkhau();
    validateHoten();
    validateSodienthoai();
    validateEmail();

    // Kiểm tra nếu có bất kỳ lỗi nào
    if (
        document.getElementById("taikhoanError").innerText ||
        document.getElementById("matkhauError").innerText ||
        document.getElementById("hotenError").innerText ||
        document.getElementById("sodienthoaiError").innerText ||
        document.getElementById("emailError").innerText
    ) {
        isValid = false; // Nếu có lỗi, không gửi biểu mẫu
    }

    // Hiển thị thông báo lỗi chung nếu có lỗi
    if (!isValid) {
        alert("Bạn cần điền đúng định dạng thông tin.");
    }

    // Trả về kết quả để quyết định có gửi biểu mẫu không
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
    
    // Kiểm tra độ dài mật khẩu
    if (matkhau.length < 6) {
        matkhauError.innerText = "Mật khẩu phải có ít nhất 6 ký tự.";
    }
    // Kiểm tra mật khẩu có ít nhất một chữ cái in hoa, một chữ cái thường, một số và một ký tự đặc biệt
    else if (!/[A-Z]/.test(matkhau)) {
        matkhauError.innerText = "Mật khẩu phải có ít nhất một chữ cái in hoa.";
    } else if (!/[a-z]/.test(matkhau)) {
        matkhauError.innerText = "Mật khẩu phải có ít nhất một chữ cái thường.";
    } else if (!/[0-9]/.test(matkhau)) {
        matkhauError.innerText = "Mật khẩu phải có ít nhất một chữ số.";
    } else if (!/[!@#$%^&*(),.?":{}|<>]/.test(matkhau)) {
        matkhauError.innerText = "Mật khẩu phải có ít nhất một ký tự đặc biệt.";
    }
    // Nếu mật khẩu hợp lệ
    else {
        matkhauError.innerText = "";
    }
}




function validateHoten() {
    var hoten = document.getElementById("hoten").value;
    var hotenError = document.getElementById("hotenError");
    
    // Biểu thức chính quy cho phép các ký tự chữ cái tiếng Việt và khoảng trắng, tối đa 25 ký tự
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
    if (!/^[a-zA-Z0-9._%+-]+@gmail\.com$/.test(email) || email.length > 25) {
        emailError.innerText = "Email phải có dạng @gmail.com và tối đa 25 ký tự.";
    } else {
        emailError.innerText = "";
    }
}

</script>  <style> 
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
