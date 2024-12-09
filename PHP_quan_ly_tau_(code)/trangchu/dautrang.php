<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trang Chủ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    /* Toàn bộ trang */
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f4;
      color: #333;
      margin: 0;
      padding: 0;
    }

    /* Thanh tiêu đề (header) */
    .dautrang {
      background-color: #2d87f0;
      color: white;
      text-align: center;
      font-size: 18px;
      padding: 15px;
      font-weight: bold;
    }

    /* Navbar */
    .navbar {
      background-color: #343a40;
      transition: background-color 0.3s ease;
    }

    .navbar-nav .nav-item .nav-link {
      color: white;
      padding: 12px 20px;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .navbar-nav .nav-item .nav-link:hover {
      background-color: #007bff;
      border-radius: 5px;
    }

    .navbar-toggler-icon {
      background-color: #fff;
    }

    /* Logo */
    .logo {
      width: 120px;
      height: auto;
      transition: transform 0.3s ease;
    }

    .logo:hover {
      transform: scale(1.1);
    }

    /* Nút Tìm Vé Đã Đặt */
    .them {
      text-align: center;
      margin-top: 30px;
    }

    .btn-info {
      font-size: 16px;
      padding: 12px 25px;
      background-color: #28a745;
      border-color: #28a745;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-info:hover {
      background-color: #218838;
      transform: translateY(-3px);
    }

    /* Animation cho các phần tử */
    .navbar-nav .nav-item {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 0.5s ease-in-out forwards;
    }

    .navbar-nav .nav-item:nth-child(1) { animation-delay: 0.2s; }
    .navbar-nav .nav-item:nth-child(2) { animation-delay: 0.4s; }
    .navbar-nav .nav-item:nth-child(3) { animation-delay: 0.6s; }
    .navbar-nav .nav-item:nth-child(4) { animation-delay: 0.8s; }
    .navbar-nav .nav-item:nth-child(5) { animation-delay: 1s; }
    .navbar-nav .nav-item:nth-child(6) { animation-delay: 1.2s; }

    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Thêm hiệu ứng cho phần tiêu đề lớn */
    .dautrang {
      font-size: 20px;
      animation: slideInFromLeft 1s ease-out forwards;
    }

    @keyframes slideInFromLeft {
      0% {
        opacity: 0;
        transform: translateX(-100%);
      }
      100% {
        opacity: 1;
        transform: translateX(0);
      }
    }
  </style>
</head>
<body>

  <div class="dautrang">Tổng đài vé Online: 19006469</div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="nav-link active" aria-current="trangchu" href="indextrangchu.php?trangchu=home">
        <img class="logo" src="csstrangchu/anh/logo.jpg" alt="Logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
        <ul class="navbar-nav align-items-end">
          <li class="nav-item"><a class="nav-link active" href="indextrangchu.php?trangchu=home"><i class="bi bi-house-door-fill"></i> Trang chủ</a></li>
          <li class="nav-item"><a class="nav-link active" href="indextrangchu.php?trangchu=gioithieu"><i class="bi bi-info-circle-fill"></i> Giới thiệu</a></li>
          <li class="nav-item"><a class="nav-link" href="indextrangchu.php?trangchu=lichtrinh"><i class="bi bi-card-checklist"></i> Chuyến Tàu</a></li>
          <li class="nav-item"><a class="nav-link" href="indextrangchu.php?trangchu=phieudatve"><i class="bi bi-stickies-fill"></i> Phiếu Đặt Vé</a></li>
          <li class="nav-item"><a class="nav-link" href="indextrangchu.php?trangchu=dichvu"><i class="bi bi-send-fill"></i> Dịch Vụ</a></li>
          <li class="nav-item"><a class="nav-link" href="admin/login.php"><i class="bi bi-person-fill"></i> Đăng Nhập</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Nút Tìm Vé Đã Đặt -->
  <div class="them">
    <a class="btn btn-info" href="indextrangchu.php?trangchu=phieudatve" role="button">Tìm Vé Đã Đặt</a>
  </div>

</body>
</html>
