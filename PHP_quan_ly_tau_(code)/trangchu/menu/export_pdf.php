<?php 
// Kiểm tra xem mã phiếu có được truyền qua URL không
if (isset($_GET['maphieu'])) {
    $maphieu = $_GET['maphieu'];

    // Kết nối cơ sở dữ liệu
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "tau_cn";
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    // Truy vấn thông tin phiếu đặt vé từ cơ sở dữ liệu
    $sql = "SELECT 
    pd.maphieu, 
    pd.tenkhach, 
    pd.sodienthoai, 
    t.tentau, 
    toa.tentoa, 
    ghe.tenghe, 
    l.tenlichtrinh, 
    c.magadi, 
    gadi1.tengadi,   -- Sử dụng alias gadi1 cho magadi
    gadi2.tengaden,  -- Sử dụng alias gadi2 cho magaden
    c.magaden, 
    g.giatien, 
    g.magiave, 
    c.giodi, 
    c.gioden
FROM phieudat pd
JOIN chitietlich c ON pd.machitiet = c.machitiet
JOIN lichtrinh l ON c.malichtrinh = l.malichtrinh
JOIN tau t ON l.matau = t.matau
JOIN toa toa ON t.matau = toa.matau
JOIN ghe ghe ON toa.matoa = ghe.matoa
JOIN giave g ON c.magiave = g.magiave
LEFT JOIN gadi AS gadi1 ON c.magadi = gadi1.maga
LEFT JOIN gadi AS gadi2 ON c.magaden = gadi2.maga
WHERE pd.maphieu = ?";

    // Chuẩn bị câu lệnh và sử dụng tham số để tránh SQL Injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $maphieu);  // "i" là kiểu dữ liệu integer
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $veInfo = $result->fetch_assoc();

            // Yêu cầu thư viện TCPDF
            require_once 'tcpdf/tcpdf.php';  // Đảm bảo đường dẫn đúng đến thư viện TCPDF

            // Tạo đối tượng TCPDF để xuất file PDF
            $pdf = new TCPDF();
            $pdf->AddPage();  // Thêm một trang mới

            // Đặt font chữ hỗ trợ tiếng Việt (Sử dụng "dejavusans" hoặc font khác có hỗ trợ tiếng Việt)
            $pdf->SetFont('dejavusans', '', 12);

            // Tiêu đề
            $pdf->Cell(0, 10, "Hóa Đơn Đặt Vé Tàu", 0, 1, 'C'); // Tiêu đề ở giữa
            $pdf->Ln(10);  // Dịch xuống 10 đơn vị

            // Thông tin khách hàng và vé
            $pdf->SetFont('dejavusans', '', 12); // Cài đặt font chữ cho thông tin khách hàng
            
            // Các thông tin hiển thị trên một dòng:
            $pdf->Cell(0, 10, "Mã phiếu: " . $veInfo['maphieu'], 0, 1);
            $pdf->Cell(0, 10, "Tên khách hàng: " . $veInfo['tenkhach'] . " | Số điện thoại: " . $veInfo['sodienthoai'], 0, 1);
            $pdf->Cell(0, 10, "Tàu: " . $veInfo['tentau'] . " | Toa: " . $veInfo['tentoa'] . " | Ghế: " . $veInfo['tenghe'], 0, 1);
            $pdf->Cell(0, 10, "Lịch trình: " . $veInfo['tenlichtrinh'], 0, 1);
            $pdf->Cell(0, 10, "Giá vé: " . number_format($veInfo['giatien'], 0, ',', '.') . " VND", 0, 1);

            // Kiểm tra sự tồn tại của các trường 'giodi', 'gioden', 'tengadi', 'tengaden'
            $giodi = isset($veInfo['giodi']) ? $veInfo['giodi'] : 'Chưa có thông tin';
            $gioden = isset($veInfo['gioden']) ? $veInfo['gioden'] : 'Chưa có thông tin';
            $tengadi = isset($veInfo['tengadi']) ? $veInfo['tengadi'] : 'Chưa có thông tin';
            $tengaden = isset($veInfo['tengaden']) ? $veInfo['tengaden'] : 'Chưa có thông tin';

            // Thêm thông tin ga đi, ga đến, giờ đi, giờ đến:
            $pdf->Cell(0, 10, "Ga đi: " . $veInfo['tengadi'] . " | Ga đến: " . $veInfo['tengaden'], 0, 1);
            $pdf->Cell(0, 10, "Giờ đi: " . $giodi . " | Giờ đến: " . $gioden, 0, 1);

            // Xuất file PDF
            // Tự động tải file về với tên 'hoadon_datve_[maphieu].pdf'
            $pdf->Output('HOADON_DATVE_' . $maphieu . '.PDF', 'D');  // 'D' là tải xuống file PDF
        } else {
            echo "Không tìm thấy thông tin vé!";
        }

        // Đóng statement
        $stmt->close();
    } else {
        echo "Lỗi trong việc chuẩn bị câu lệnh truy vấn!";
    }

    // Đóng kết nối cơ sở dữ liệu
    $conn->close();
} else {
    echo "Mã phiếu không hợp lệ!";
}
?>
