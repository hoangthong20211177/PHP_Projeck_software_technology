<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tin Tức</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <style>
    /* Bố cục tin tức */
    .body {
        background: red;
    }
    .texttintuc {
      
      font-size: 20px;
      font-weight: bold;
      margin-top: 20px;
      margin-bottom: 15px;
      color: #333;
    }

    .texttintuc a {
      text-decoration: none;
      color: #007bff;
      font-size: 18px;
    }

    .texttintuc a:hover {
      text-decoration: underline;
    }

    /* Box tin tức */
    .fullbox {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 30px;
    }

    .boxdau2 {
      flex: 1 1 calc(50% - 10px); /* Mỗi box sẽ chiếm 50% chiều rộng của hàng */
      box-sizing: border-box;
      transition: transform 0.3s ease;
    }

    .boxdau2:hover {
      transform: scale(1.02);
    }

    .box1, .box2 {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
    }

    /* Cấu trúc nội dung trong box */
    .box1, .box2 {
      display: grid;
      grid-template-columns: auto 1fr;
      gap: 15px;
      padding: 15px;
    }

    .box1anh {
      width: 100%;
      height: auto;
      border-radius: 8px;
    }

    .box1chu {
      display: flex;
      flex-direction: column;
    }

    .boxchu1 a {
      font-size: 18px;
      font-weight: bold;
      color: #333;
      text-decoration: none;
      margin-bottom: 10px;
    }

    .boxchu1 a:hover {
      text-decoration: underline;
    }

    .boxchu2 a {
      font-size: 14px;
      color: #666;
      text-decoration: none;
    }

    .boxchu2 a:hover {
      text-decoration: underline;
    }

    .thea {
      text-align: center;
      margin: 20px 0;
    }

    .thea a {
      font-size: 18px;
      color: #333;
    }
  </style>
</head>
<body>

  <!-- Tin Tức-->
  <div class="texttintuc">
    <a href="/qltau2/indextrangchu.php" style="text-decoration:none"><i class="bi bi-calendar2-week"></i> Tin Tức - Khuyến Mãi</a>
  </div>

  <div class="fullbox">
    <!-- 2 box đầu -->
    <div class="boxdau2">
      <div class="box1">
        <div style="display: grid; grid-template-columns: auto 1fr;">
          <img class="box1anh" src="csstrangchu/anhtintuc/anh1.jpg" alt="Hình ảnh">
          <div class="box1chu">
            <div class="boxchu1"><a href="/qltau2/indextrangchu.php">Đường Sắt Việt Nam triển khai bán vé trực tuyến</a></div>
            <div class="boxchu2"><a>Từ ngày 01/10/2017, Đường Sắt Việt Nam triển khai chương trình bán vé tàu trực tuyến trên trang: https://dsvn.vn Khi sử dụng dịch vụ mua vé online, khách hàng sẽ: Tiết kiệm chi phí,...</a></div>
          </div>
        </div>
      </div>
    </div>

    <div class="boxdau2">
      <div class="box2">
        <div style="display: grid; grid-template-columns: auto 1fr;">
          <img class="box1anh" src="csstrangchu/anhtintuc/anh2.jpg" alt="Hình ảnh">
          <div class="box1chu">
            <div class="boxchu1"><a href="/qltau2/indextrangchu.php">Súp lươn Nghệ An, món ngon khó từ chối</a></div>
            <div class="boxchu2"><a>Theo Đông y, lươn có tác dụng bồi dưỡng khí huyết, tiêu trừ phong thấp, có thể chữa được bệnh suy dinh dưỡng, kiết lị, đau nhức xương sống, trĩ nội, phong...</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="thea">
    <a>____________________________________</a>
  </div>

  <div class="fullbox">
    <!-- 2 box tiếp theo -->
    <div class="boxdau2">
      <div class="box1">
        <div style="display: grid; grid-template-columns: auto 1fr;">
          <img class="box1anh" src="csstrangchu/anhtintuc/anh3.jpg" alt="Hình ảnh">
          <div class="box1chu">
            <div class="boxchu1"><a href="/qltau2/indextrangchu.php">Đường Sắt Việt Nam thông báo lịch trình tuyến đường tháng 5</a></div>
            <div class="boxchu2"><a>Để thuận tiện hơn trong quá trình đăng ký vé hành trình Hà Nội – Sài Gòn và ngược lại, Đường Sắt Việt Nam thông báo lịch trình tuyến đường tháng 5....</a></div>
          </div>
        </div>
      </div>
    </div>

    <div class="boxdau2">
      <div class="box2">
        <div style="display: grid; grid-template-columns: auto 1fr;">
          <img class="box1anh" src="csstrangchu/anhtintuc/anh4.jpg" alt="Hình ảnh">
          <div class="box1chu">
            <div class="boxchu1"><a href="/qltau2/indextrangchu.php">Cá trích nướng Thạch Kim – ăn một lần nhớ mãi…</a></div>
            <div class="boxchu2"><a>Đi dọc cảng cá Thạch Kim (Lộc Hà, Hà Tĩnh), bất kể mùa nắng hay mùa mưa, ta vẫn nghe thơm lừng mùi cá trích nướng lẫn trong mùi khói than hồng,....</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
