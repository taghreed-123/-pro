<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تأكيد الطلب والدفع</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>
<br/>
<br/>
<br/>
<?php require_once("main/connection.php"); 
  require_once("main/models/orders-model.php");
  $order = new OrdersModel();
  require_once("main/controls/orders-manager.php");

  if(!empty($_GET['id'])){
      if($order->GetOrderProduct($_GET['id'])) {
          $response2 = "تمت العملية بنجاح";
      } else
          $response2 = "Error \n" . "خطا في تنفيذ العملية";
  }else if(!empty($_POST['id'])){
    if($order->GetOrderProduct($_POST['id'])) {
      $response2 = "تمت العملية بنجاح";
  } else
      $response2 = "Error \n" . "خطا في تنفيذ العملية";
  }
  if ($order->Order != null) {
    if(!empty($_POST['DataManager'])){
      if($_POST['DataManager']=="AddAddress"){
        if (!str_contains($response, "Error")){
        echo "<p class='alert alert-success'>تم اضافة البيانات بنجاح
        <br/>سوف يتم تحيولك الى صفحة الدفع الان</p>";
        echo "<script>setTimeout(function () {
          document.location='payment.php?order_id=".$order->Order->order_id."';
        }, 2000);</script>";
        }else{
          echo "<p class='alert alert-success'>لم يتم اضافة البيانات بنجاح <br/> حاول مرة اخرى</p>";
        }
      }
    }
  ?>

  <div class="container">
    <div class="row ">
      <?php require_once("main/parts/header.php"); ?>
      <div class="col-12 text-right">
        <div style="position:relative; left:60px; top:1px;">
          <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
        </div>
      </div>
      <p class="text-center"> رقم الطلب:<?php echo $order->Order->order_id; ?><br/>
      المتجر:<?php echo $order->Order->user_store;?> </p>
      <form class="form-enter-price text-right" method="POST">
        <input type="hidden" name="DataManager" value="AddAddress" />
        <input type="hidden" name="id" value="<?php echo $order->Order->order_id; ?>" />
          
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">المدينة:</label>
          <div class="col-sm-10">
            <input type="text" id="address" name="address" value="<?php echo $order->Order->order_address; ?>" class="form-control" id="inputPassword" required> 
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">الشارع:</label>
          <div class="col-sm-10">
            <input type="text" id="charge_address" name="charge_address"  value="<?php echo $order->Order->order_charge_address; ?>" class="form-control" id="inputPassword" required>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-2 col-form-label">رقم المبنى:</label>
          <div class="col-sm-10">
            <input type="text" id="build_number"  name="build_number" value="<?php echo $order->Order->order_build_number; ?>"  class="form-control" id="inputPassword" required>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">السعر:</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $order->Order->order_price;?>">
          </div>
        </div>
        <div class="col-7 btn-center">
          <button class="btn btn-secondary" type="submit" role="button" style=" color:#fff; background-color: #216869; border: 2px solid #495057; padding: 2px 15px 2px 15px;margin-top: 3px;  margin-bottom: 3px;">دفـع </button>
          <a class="btn btn-secondary" href="ActiveOrder.php" role="button" style=" color:#fff; background-color: #216869; border: 2px solid #495057; padding: 2px 15px 2px 15px;margin-top: 3px;  margin-bottom: 3px;">الغـاء </a>

        </div>

      </form>

    </div>
<?php } ?>
    <?php require_once("main/parts/footer.php"); ?>
    <?php require_once("main/parts/script.php"); ?>

</body>

</html>