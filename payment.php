<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> الدفع عن طريق البطاقة </title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body class="container">

<?php require_once("main/connection.php"); 
  require_once("main/models/orders-model.php");
  require_once("main/models/payments-model.php");
  $order = new OrdersModel();
  $payment = new PaymentsModel();
  require_once("main/controls/payments-manager.php");
  if(!empty($_GET['order_id'])){
      if($order->GetOrderProduct($_GET['order_id'])) {
          $response2 = "تمت العملية بنجاح";
      } else
          $response2 = "Error \n" . "خطا في تنفيذ العملية";
  }
// if ($order->Order != null) {
  if($_SERVER['REQUEST_METHOD'] =='POST'){
  if (strlen($payment->payment_card_number) != 16)
    $response = $response . "<br/>لو سمحت تاكد من ادخال رقم البطاقه المكون من 16 رقما";
    if (strlen($payment->payment_card_code) < 3)
    $response = $response . "<br/>لو سمحت تاكد من ادخال كود البطاقه المكون من 3ارقام على الاقل";
  }
  ?>
      <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_SESSION['user_id'])) { ?>
        <p class="alert alert-danger">يجب ان تسجل الدخول حتى تتمكن من اضافة تفاصيل الدفع</p>
        <?php } else {
        if (!str_contains($response, "Error")) { ?>
          <p class="alert alert-success"><?php echo $response; ?><br/>سوف يتم تحويلك الى صفحة متابعة حالة الطلب</p>
          <?php
          $order->ChangeOrderStatus(1,$order->Order->order_id);
          echo "<script>setTimeout(function () {
                      document.location='Underway.php';
                    }, 2000);</script>";?>
        <?php } else { ?>
          <p class="alert alert-danger"><?php echo $response; ?></p>
    <?php }
      }
    } ?>
     <div class="col-12 text-right">
        <div style="position:relative; left:60px; top:1px;">
          <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
        </div>
      </div>
  <form method="POST">
    <input type="hidden" name="DataManager" value="Add">
    <input type="hidden" name="UserID" value="<?php if(!empty($_SESSION['user_id']))echo $_SESSION['user_id'];?>">
    <input type="hidden" name="OrderID" value="<?php if(!empty($_GET['order_id']))echo $_GET['order_id'];?>">
    <div class="card text-center">
      <div class="card-header" class="active">بطـاقة جديدة
      </div>
    </div>
    <div class="card-body">
      <div class="">
        <div class="row mb-3">
          <p>الأسم على البطاقة:</p>
          <label for="inputEmail3" class="col-sm-2 col-form-label"> </label>
          <div class="col-sm-10">
            <div class="col-7 text-right">
              <input type="text" id="paymentCardName" name="paymentCardName" onchange="allLetter()" class="form-control" id="inputEmail3" required>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <p>رقم البطاقة:</p>
          <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
          <div class="col-sm-10">
            <div class="col-7 text-left">
              <input type="number" name="paymentCardNumber" class="form-control" id="inputPassword3" placeholder=""  minlength="16"  maxlength="16" required>
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <p>كود الحماية CVC/CVV:</p>
          <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
          <div class="col-sm-10">
            <div class="col-7 text-left">
              <input type="number" name="paymentCardCode" class="form-control" id="inputPassword3" pattern='.{3}' placeholder="CVC/CVV:" required>
            </div>
          </div>
        </div>
        <div class="row mb-3">
        <p>تاريخ انتهاء البطاقة </p>
        </div>
        <div class="col form-group  mb-3">
          <div class="row" style="margin-top: 1px;  margin-bottom: 1px;">
          
            <div class="col-4 text-right">
              <input type="number" name="month" placeholder="MM" class="form-control" style="border-radius: 15px;" required>
            </div>
            <div class="col-4 text-right">
              <input type="number" name="year" placeholder="YYYY" class="form-control" style="border-radius: 15px;" required>
            </div>
          </div>
        </div>

        <br>
        <div class="col-4 text-right">
          <input class="" type="checkbox" value="" id="flexCheckDefault">
          <label class="" for="flexCheckDefault">
            احفظ البطاقة لتسهيل عملية الدفع في المستقبل </label>
        </div>
        <button type="submit" class="btn btn-primary btn-lg">دفــع</button>
        <a class=" btn btn-secondary btn-lg" href="ActiveOrder.php" role="button">الغاء الأمـر</button></a>
      </div>
  </form>
  <?php //}?>
  </div>

  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>

</body>

</html>