<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>الطلبات قيد التنفيذ</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>
  <?php require_once("main/connection.php");
  require_once("main/models/orders-model.php");
  $order = new OrdersModel();
  require_once("main/controls/orders-manager.php");
  if (!empty($_GET['order_id']) && !empty($_GET['status'])) {
    if ($order->ChangeOrderStatus($_GET['status'], $_GET['order_id'])) {
      $response = "تمت العملية بنجاح";
    } else
      $response = "Error \n" . "خطا في تنفيذ العملية";
  }

  ?>

  <div class="container">
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
      <div class="btn-group">
      <?php if (!empty($_SESSION['user_id'])) {
            if ($_SESSION['user_type'] == "user") { ?>
          <a href="order.php" class="btn btn-primary" aria-current="page">اضافة طلب</a>
          <?php }
          } ?>
          <a href="ActiveOrder.php" class="btn btn-primary ">الطلبات النشطة </a>
          <a href="Underway.php" class="btn btn-primary active">حالة الطلب   </a>
          <?php if (!empty($_SESSION['user_id'])) { if($_SESSION['user_type']=="user"){ ?>
          <a href="all_reports.php" class="btn btn-primary">الشكوى </a>
          <?php } }?>
      </div>
    </div>
    <br>

    <br><br>
    <nav class="list-complaint-company">
      <form>
        <?php
        $where = "";
        if (!empty($_SESSION['user_id'])) {
          if ($_SESSION['user_type'] == 'business')
            $where = " AND `user_id`=" . $_SESSION['user_id'];
          else
            $where = " AND `order_user_id`=" . $_SESSION['user_id'];
        }
        if ($order->GetAllUderWareOrders($where)) {
          foreach ($order->Orders as $key => $value) {
        ?>
            <ul class="nav row" style="background-color:white;">

              <li class="" class="" style="color:#495057;"> رقم الطلب</li>
              <li class="" class="" style="color:#495057;"><?php echo $value->order_id; ?></li>
              <li class="" class="" style="color:#495057;">المتجر</li>
              <li class="" class="" style="color:#495057;"><?php echo $value->user_id; ?></li>
              <li class="" class="" style="color:#495057;">السعر</li>
              <li class="" class="" style="color:#495057;"><?php echo $value->order_price; ?></li>
              
              <?php if (!empty($_SESSION['user_id'])) {
                if ($_SESSION['user_type'] == 'business') { ?>
                  <li class="" class="" style="color:#495057;">حالة الطلب</li>
                  <li class="" class="" style="color:#495057;">
                    <select name="OrderProductID" class="select form-control" id="id_type_<?php echo $value->order_id; ?>" style="display:block !important;" onchange="document.location=document.getElementById('id_type_<?php echo $value->order_id; ?>').value;">
                      <option value="Underway.php?order_id=<?php echo $value->order_id; ?>&status=1" <?php if ($value->order_status == 1) echo 'selected'; ?>>قيد التنفيذ</option>
                      <option value="Underway.php?order_id=<?php echo $value->order_id; ?>&status=2" <?php if ($value->order_status == 2) echo 'selected'; ?>>جاهز وجاري التسليم</option>
                      <option value="Underway.php?order_id=<?php echo $value->order_id; ?>&status=3" <?php if ($value->order_status == 3) echo 'selected'; ?>>تم التسليم</option>

                    </select>
                  </li>
                <?php } else { ?>
                  <li class="" class="" style="color:#495057;">حالة الطلب</li>
                  <li class="" class="" style="color:#495057;"><?php if ($value->order_status == 1) echo "قيد التنفيذ";
                                                                else if ($value->order_status == 2) echo "جاهز وجاري التسليم";
                                                                else if ($value->order_status == 3) echo "تم التسليم"; ?></li>
                <?php } ?>
              <?php } else { ?>
                <li class="" class="" style="color:#495057;">حالة الطلب</li>
                <li class="" class="" style="color:#495057;"><?php if ($value->order_status == 1) echo "قيد التنفيذ";
                                                              else if ($value->order_status == 2) echo "جاهز وجاري التسليم";
                                                              else if ($value->order_status == 3) echo "تم التسليم"; ?></li>
              <?php } ?>
              <div class="col" style="float:right !important;">
                <?php if (!empty($_SESSION['user_id'])) {
                  if ($_SESSION['user_type'] == 'user') { ?>
                  <a class="btn btn-primary" href="post_report.php?order_id=<?php echo $value->order_id; ?>" role="button" style=" color:#fff; border-radius: 15px; background-color: #216869;  border: 2px solid #495057; padding: 2px 15px 2px 15px;margin-top: 3px;  margin-bottom: 3px;">شكوى </a>
                <?php }
                }?>
              </div>
            </ul><br />
        <?php }
        } ?>
        
      </form>
    </nav>
    <br>
    <br><br><br><br><br><br> <br><br>

    <?php require_once("main/parts/footer.php"); ?>
    <?php require_once("main/parts/script.php"); ?>

</body>

</html>