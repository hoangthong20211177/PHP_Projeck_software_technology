

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link rel="stylesheet" href="bootstrapExp1.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">
</head>
<body>
    <style>body{
    background-color: rgb(218, 218, 218);
}
/* KHOẢNG CÁCH VIỀN*/
.vien{
    border: 30px solid rgb(212, 187, 187)
}

/*DANH MỤC BẢNG   danhmuc.php*/ 
.danhmuc{
    width: 17%; 
    height: 100%; 
    background-color:
    rgb(252, 234, 238); 
    float: left;
    font-family: Arial;
}

.dmtrangchu{
    margin-bottom: 7px;
    margin-top: 7px;
}

/*BẢNG*/
.bang{
    width: 80%; 
    height: 100%; 
    background-color:
     rgb(252, 234, 238); 
    float: right
} 

/*CUỐI TRANG QUẢN LÝ*/
.cuoitrang{
    width: 100%; 
    height: 100%; 
    background-color:
     rgb(141, 246, 199);
    float: left;
}





/* HIỂN THỊ BẢNG */
.them{ margin-bottom: 10px;
    margin-left: 30px;
    float: left
}

.timkiem{
    margin-right: 30px;
    float: right
}

.tenbang{
    text-align: center;
}

.suaxoa{
    text-align: center;
}









.formdangnhap{
    background-color: rgb(141, 90, 18);
    width: 500px; /* chiều ngang*/
     margin: 0 auto; /* căn giữa*/
      border: 76px solid rgb(130, 0, 35); /* độ đậm viền*/
    padding: auto;
   }

   
.fromdangnhap2{
    text-align: center;
   }

</style>
<?php
    include __DIR__ .'/dautrang.php';

?>


<?php
        session_start();
        if(!isset($_SESSION['login_us']))
            header("location:login.php");
            include __DIR__ .'/menu.php';
?>

<div class="vien">
<div class="danhmuc">
    
    <?php
   include __DIR__ .'/ketnoi.php';

        include __DIR__ .'/danhmuc.php';
    ?>
</div>


    <div class="bang">
        <?php
            if(isset($_REQUEST['quanly']))
            {
             $quanly=$_REQUEST['quanly'];
             switch ($quanly)
                { 
    /*Nhân Viên*/
    case "ds_nhanvien":
        include "danhsachql/ql_nhanvien/ds_nhanvien.php";
        break;
    
        case "them_nhanvien":
            include "danhsachql/ql_nhanvien/them_nhanvien.php";
            break;
            
            case "sua_nhanvien":
                include "danhsachql/ql_nhanvien/sua_nhanvien.php";
                break;

                /*Tàu*/
                 case "dstau":
                     include "danhsachql/dstau.php";
                     break;

                 case "suatau":
                    include "danhsachql/suatau.php";
                    break;

                case "themtau":
                    include "danhsachql/themtau.php";
                    break;

                /*Toa*/
                case "dstoa":
                     include "danhsachql/dstoa.php";
                    break;

                case "suatoa":
                    include "danhsachql/suatoa.php";
                    break;

                case "themtoa":
                    include "danhsachql/themtoa.php";
                    break;
                    
                    case "themtoa2":
                        include "danhsachql/themtoa2.php";
                        break;
                

               /*Lịch Trình*/
            case "lichtrinh":
                include "danhsachql/ql_lichtrinh/lichtrinh.php";
                break;

    case "themlichtrinh":
                include "danhsachql/ql_lichtrinh/themlichtrinh.php";
                break;

                case "sualichtrinh":
                    include "danhsachql/ql_lichtrinh/sualichtrinh.php";
                    break;


             /*chi tiết Lịch Trình*/
          case "chitietlich":
               include "danhsachql/ql_chitiet_lichtrinh/chitietlich.php";
               break;

               case "themchitietlich":
                include "danhsachql/ql_chitiet_lichtrinh/themchitietlich.php";
                break;

                
               case "suachitietlich":
                include "danhsachql/ql_chitiet_lichtrinh/suachitietlich.php";
                break;

               
       /*Giá VÉ*/
       case "dsgiave":
        include "danhsachql/ql_giave/dsgiave.php";
       break;

   case "suagiave":
       include "danhsachql/ql_giave/suagiave.php";
       break;

   case "themgiave":
       include "danhsachql/ql_giave/themgiave.php";
       break;


 /*Thống Kê*/
       case "thongke":
        include "danhsachql/thongke.php";
        break;

        case "thongketoa":
            include "danhsachql/thongketoa.php";
            break;
                }
            }
             
        ?>
    </div>
 </div>     <!--/.wrapper-->   


<div class="cuoitrang">          
    <?php
         include __DIR__.'/cuoitrang.php'
    ?>
</div>
</body>
</html>