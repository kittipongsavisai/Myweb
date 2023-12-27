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
        <div class="col-sm-12">
          <div class="alert alert-primary" role="alert">
           รายการสินค้าทั้งหมด
          </div>
        </div>
        
        <?php
        //เรียกไฟล์เชื่อมต่อฐานข้อมูล
        require_once 'connect.php';
        //คิวรี่ข้อมูลมาแสดงในตาราง
        $stmtPrd = $conn->prepare("SELECT* FROM tbl_product");
        $stmtPrd->execute();
        $rsPrd = $stmtPrd->fetchAll();
        foreach($rsPrd as $row) {
          $js_code = 'console.log(' . json_encode($row['no']) .');';
          echo '<script>' . $js_code . '</script>';
          ?>
           <div class="col-sm-3" style="margin-bottom:50px;">
          
          <img src="upload/user_<?= $row['no'];?>.<?= $row['product_img'];?>" width="100%"><br>
          <?= $row['product_name'];?><br>
          <font color="red"> ราคา 
          <?= number_format($row['product_price'],2);?>
           บาท 
         </font>
         <a href="productDetail.php?no=<?=$row['no'];?>" class="btn btn-info btn-sm">read more</a>
          </div> <!-- //col -->

          <?php } ?>
          <br><br>
        </div>
      </div>
    </div>
  </body>
</html>