<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>الطلبات النشطة </title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php");
  require_once("main/models/orders-model.php");
  $order = new OrdersModel();
  require_once("main/controls/orders-manager.php");
  if (!empty($_GET['id'])) {
    $order->order_id = $_GET['id'];
    if ($order->DeleteOrder()) {
      $response = "تمت العملية بنجاح";
    } else
      $response = "Error \n" . "خطا في تنفيذ العملية";
  }

  ?>

  <div class="container">
    <br />
    <br />
    <br />

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" || !empty($_GET['id'])) {
      if (!empty($response)) {
        if (!str_contains($response, "Error")) {
          echo "<p class='alert alert-success'>" . $response . ".\n</p>";
        } else
          echo "<p class='alert alert-danger'>" . $response . ".</p>";
      } else
        echo "<p class='alert alert-danger'>" . $response . ".</p>";
    } ?>
    <div class="row">
      <?php require_once("main/parts/header.php"); ?>
      <br>
      <br><br>
      <div class="col-12 text-right">
        <div style="position:relative; left:60px; top:1px;">
          <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
        </div>
      </div>
      <?php if (!empty($_SESSION['user_id'])) {
            if ($_SESSION['user_type'] == "user") { ?>
          <a href="order.php" class="btn btn-primary" aria-current="page">اضافة طلب</a>
          <?php }
          } ?>
          <a href="ActiveOrder.php" class="btn btn-primary active">الطلبات النشطة </a>
          <a href="Underway.php" class="btn btn-primary">حالة الطلب  </a>
          <?php if (!empty($_SESSION['user_id'])) {
            if ($_SESSION['user_type'] == "user") { ?>
          <a href="all_reports.php" class="btn btn-primary">الشكوى </a>
          <?php 
           }
          } ?>
    </div>
    <br>

  </div>
  <br>
  <br><br><br>
  
  <nav class="list-complaint-company">

    <?php
    if (!empty($_SESSION['user_id']))
      if ($order->GetAllActiveOrders($_SESSION['user_id'])) {
        foreach ($order->Orders as $key => $value) {
    ?>
        <ul class="nav row" style="background-color:white;">

          <li class="" class="" style="color:#495057;"> رقم الطلب</li>
          <li class="" class="" style="color:#495057;"><?php echo $value->order_id; ?></li>
          <li class="" class="" style="color:#495057;">المتجر</li>
          <li class="" class="" style="color:#495057;"><?php echo $value->user_store; ?></li>
          <?php if ($_SESSION['user_type'] == 'user'){ if($value->order_price!=0.00){  ?>
          <li class="" class="" style="color:#495057;">السعر</li>
          <li class="" class="" style="color:#495057;"><?php if ($_SESSION['user_type'] == 'user')
          echo $value->order_price;?>
          </li>
          <?php }
          } else { ?>
           <?php if ($_SESSION['user_type'] == 'business') { ?>
            <li class="" class="" style="color:#495057;">السعر</li>
            <li class="" class="" style="color:#495057;">
              <form action="" method="post">
              <input type="hidden" name="DataManager" value="AddPrice" />
              <input type="hidden" name="id" value="<?php echo $value->order_id; ?>" />
              <div class="row text-right">السعر:
                <input type="number" step="0.01" class="form-control" name="price" style="border-radius: 15px;width:120px; margin-left:10px;margin-right:10px;" value="<?php echo $value->order_price; ?>">
                <input class="btn btn-primary" type="submit" value="Save">
              </div>
              </form>
              </li>
              <?php }
          } ?>
              <li class="" class="" style="color:#495057;">الطول</li>
              <li class="" class="" style="color:#495057;"><?php 
                echo $value->order_height;?>
                </li>
              <li class="" class="" style="color:#495057;">العرض</li>
              <li class="" class="" style="color:#495057;"><?php
                echo $value->order_width;?>
                </li>
              <li class="" class="" style="color:#495057;">
              <?php if (!empty($value->order_image)) { ?>
                <a href="main/images/orders/<?php
              echo $value->order_image; ?>">
              <img width="40" height="40" src="main/images/orders/<?php
              echo $value->order_image; ?>">
              </a>
                <?php } else
                echo "no image";?>
          </li>
            
          <div class="col float-left">
            <a class="btn btn-primary" href="chat-user.php?order_id=<?php echo $value->order_id; ?>" role="button" style=" color:#fff; border-radius: 15px; background-color: #216869;  border: 2px solid #495057; padding: 2px 15px 2px 15px;margin-top: 3px;  margin-bottom: 3px;">محـادثة </a>
            <?php if ($_SESSION['user_type'] == 'user') {
              if ($value->order_price != 0.00) { ?>
            <a class="btn btn-secondary" href="beforePayment.php?id=<?php echo $value->order_id; ?>" role="button" style=" color:#fff; border-radius: 15px; background-color: #216869; border: 2px solid #495057; padding: 2px 15px 2px 15px;margin-top: 3px;  margin-bottom: 3px;">اتمـام البيع </a>
            <?php } ?>
            <a type="submit" href="ActiveOrder.php?id=<?php echo $value->order_id; ?>" class="btn btn-primary" style=" color:#fff; border-radius: 15px; background-color: #216869;border: 2px solid #495057;  padding: 2px 15px 2px 15px;margin-top: 3px;  margin-bottom: 3px;">الغاء الطلب </a>
            <?php } ?>
          </div>
        </ul><br />
    <?php }
      } ?>
  </nav>
  <br><br><br><br><br><br> <br><br><br>

  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>
</body>

</html>