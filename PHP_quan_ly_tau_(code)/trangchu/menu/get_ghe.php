<?php
include '../ketnoi.php';

if (isset($_GET['toaId']) && isset($_GET['machitiet'])) {
    $toaId = $_GET['toaId'];
    $machitiet = $_GET['machitiet'];

    // Truy vấn để lấy danh sách ghế dựa trên toaId
    $sqlGhe = "SELECT maghe, tenghe FROM ghe WHERE matoa = '$toaId'";
    $resultGhe = $conn->query($sqlGhe);

    if ($resultGhe->num_rows > 0) {
        // Lặp qua các ghế và trả về danh sách option
        echo "";
        while ($ghe = $resultGhe->fetch_assoc()) {
            echo "<option value='" . $ghe['maghe'] . "'>" . $ghe['tenghe'] . "</option>";
        }
    } else {
        echo "<option value=''>Không có ghế nào</option>";
    }
}
?>
