<?php 
     
     //เงื่อนตรวจสอบการส่ง method get parameter no 
     if(isset($_GET['no'])){
      require_once 'connect.php';
      //sql query product detail *คิวรี่แบบ Single row ก็คือแสดงแค่ 1 รายการเท่านั้น
      $stmtPrdD = $conn->prepare("SELECT * FROM tbl_product WHERE no=:no");
      //bindParam str , int
      $stmtPrdD->bindParam(':no', $_GET['no'] , PDO::PARAM_INT);
      $stmtPrdD->execute();
      $rowPrdD = $stmtPrdD->fetch(PDO::FETCH_ASSOC);

      //แสดงจำนวนการคิวรี่ข้อมูลได้ คิวรี่ได้ต้องได้ 1 
      //echo $stmtPrdD->rowCount(); //เปิดคอมเม้นดูครับ

      //ถ้าคิวรี่ผิดพลาดให้กลับไปหน้าแสดงสินค้า
      if($stmtPrdD->rowCount() != 1){
          header('Location: showProduct.php');
          exit();
      }
    }//isset
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Basic PHP PDO แสดงรายละเอียดสินค้า by devbanban.com 2021</title>
  </head>
  <body>

  	<div class="container">
      <div class="row">
        <div class="col-12 col-sm-12">
          <div class="alert alert-primary" role="alert">
           หน้าแสดงรายละเอียดสินค้า <a href="showProduct.php" class="btn btn-info btn-sm">ย้อนกลับ</a>
          </div>
        </div>
        
       <div class="col-12 col-sm-4">
       <img src="upload/user_<?= $rowPrdD['no'];?>.<?= $rowPrdD['product_img'];?>" width="100%">
      </div>
       <div class="col-12 col-sm-8">
       	
         <h4> <?= $rowPrdD['product_name'];?> </h4>
          <font color="red"> ราคา 
          <?= number_format($rowPrdD['product_price'],2);?>
           บาท 
         </font>
 		<br>
        
         <b>รายละเอียดสินค้า</b> <br>
         <?= $rowPrdD['product_detail'];?>
 
          </div> <!-- //col -->
          <br><br>


        </div>
      </div>
    </div>
  </body>
</html>