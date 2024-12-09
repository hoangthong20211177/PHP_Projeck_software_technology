<!--  đầu trang-->
<?php
ob_start();
 session_start();
 
    include './trangchu/dautrang.php';  
    include './trangchu/ketnoi.php';    
   
    include './trangchu/ketnoi.php';   
?>

<?php
        if(isset($_REQUEST['trangchu']))
        {
           $TrangChu=$_REQUEST['trangchu'];
           switch ($TrangChu)
           {
                /* danh mục menu */
                case "home":
                    include 'trangchu/menu/home.php';
                    include './trangchu//menu/lichtrinh.php';  
                    break;

               case "gioithieu":
                   include 'trangchu/menu/gioithieu.php';
                   break;

               case "lichtrinh":
                   include 'trangchu/menu/lichtrinh.php';
                   break;

                   case "chitietlich":
                    include 'trangchu/menu/chitietlich.php';
                    break;
 
               case "phieudatve":
                   include 'trangchu/menu/phieudatve.php';
                   break;

               case "dichvu":
                   include 'trangchu/menu/dichvu.php';
                   break;

                   
               case "dichvu":
                include 'trangchu/menu/dichvu.php';
                break;

                
               case "get_ghe":
                include 'trangchu/menu/get_ghe.php';
                break;

                     case "export_pdf":
                include 'trangchu/menu/export_pdf.php';
                break;

               
                case "fpdf":
                    include 'trangchu/menu/fpdf.php';
                    break;
     
                    case "fpdf":
                        include 'trangchu/menu/fpdf.php';
                        break;
                   
                /* danh mục vé */
            case "datve":
                   include 'trangchu/menu/datve.php';
                   break;
                   case "suaphieudatve":
                    include 'trangchu/menu/suaphieudatve.php';
                    break;
              }
        }
        else
        {
            include './trangchu/cuoitrang.php';
        }
        
       ?>

<!-- Cuối trang-->
<?php
include 'trangchu/cuoitrang.php';
include 'trangchu/cuoitrang2.php';
?>