<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>عملية الطلب </title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php");
  require_once("main/models/orders-model.php");
  require_once("main/models/users-model.php");
  $order = new OrdersModel();
  $user = new UsersModel();
  require_once("main/controls/orders-manager.php");


  ?>
  <div class="container">
    <br>
    <br>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_SESSION['user_id'])) { ?>
        <p class="alert alert-danger">يجب ان تسجل الدخول حتى تتمكن من اضافة طلب جديد</p>
        <?php } else {
        if (!strpos($response, "Error")) { ?>
          <p class="alert alert-success"><?php echo $response; ?></p>

        <?php } else { ?>
          <p class="alert alert-danger"><?php echo $response; ?></p>
    <?php }
      }
    } ?>

    <div class="row">
      <?php require_once("main/parts/header.php"); ?>
      <br> <br> <br>
      <div class="col-12 text-right">
      <div style="position:relative; left:60px; top:1px;">
        <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
      </div>
    </div>
      <div class="btn-group">
        <?php if (!empty($_SESSION['user_id'])) {
          if ($_SESSION['user_type'] == "user") { ?>
            <a href="order.php" class="btn btn-primary active" aria-current="page">اضافة طلب</a>
        <?php }
        } ?>
        <a href="ActiveOrder.php" class="btn btn-primary">الطلبات النشطة </a>
        <a href="Underway.php" class="btn btn-primary">حالة الطلب  </a>
        <?php if (!empty($_SESSION['user_id'])) {
          // if ($_SESSION['user_type'] != "user") { 
        ?>
          <a href="all_reports.php" class="btn btn-primary">الشكوى </a>
        <?php
          // }
        } ?>
      </div>
    </div>
    <br>

    <form method="POST" action="" enctype="multipart/form-data">
      <input type="hidden" name="DataManager" value="Add">
      <input type="hidden" name="OrderUserID" value="<?php if (!empty($_SESSION['user_id']))
                                                        echo $_SESSION['user_id']; ?>">

      <div class="row">
        <div class="col-md-2 mb-4 float-right">
          <label class="form-label select-label" for="id_type">اسم المتجر </label>
        </div>
        <div class="col-md-6 mb-4">
          <select name="SellerID" class="select form-control" id="id_type" style="display:block !important;">
            <?php if ($user->GetUsersStores()) {
              foreach ($user->Users as $key => $value) {
            ?>
                <option value="<?php echo $value->user_id; ?>"><?php echo $value->user_store ?></option>
            <?php }
            } ?>
          </select>
        </div>

      </div>
      <div class="col form-group  mb-3">
        <div class="col form-group  mb-3">

          <div class="row" style="padding: 5px 180px 10px 20px;margin-top: 1px;  margin-bottom: 1px;">
            <div class="col-4 text-right">العرض:
              <input type="number" id="width" name="width" class="form-control" style="border-radius: 15px;" >
            </div>
            <div class="col-4 text-right">الطول:
              <input type="number" id="height" name="height" class="form-control" style="border-radius: 15px;" required>
            </div>
          </div>
        </div>
        <div class="row" style="padding: 5px 180px 10px 20px;margin-top: 1px;  margin-bottom: 1px;">

          <div class="col-4 text-right">الخامة:
            <input type="text" id="type" class="form-control" name="type" style="border-radius: 15px;" required>
          </div>
        </div>
      </div>

      <div class="row" style="padding: 5px 180px 10px 20px;margin-top: 1px;  margin-bottom: 1px;">

        <div class="col-12 form-group  mb-3">
          <div class="text-right"> الملاحظات:</div>
          <div class="col-8 text-center">
            <textarea class="form-control" name="Notes" id="floatingTextarea2" style="border-radius: 15px;padding: 30px 130px 30px 130px;"></textarea>
          </div>
        </div>
        <div class="col-12 form-group  mb-3">
     <div class="col-8 text-center">
     <input type="file" class="form-control" name="Image" id="imageOfproblem" src="img_submit.gif"style="border-radius: 15px;" alt=" ارفاق صورة لتصميم ان وجد" width="150px" height="150p" required/>
   </div>
      </div>
      </div>
      <br>
      <div class="row" style="padding: 5px 180px 10px 20px;margin-top: 1px;  margin-bottom: 1px;">

        <!-- <div class="col-12 form-group  mb-3">
        <div class="col-8 text-center">
          <input type="image" class="form-control" id="imageOfproblem" src="img_submit.gif" style="border-radius: 15px;padding: 50px 220px 50px 220px;" alt=" ارفاق صورة لتصميم ان وجد" width="150px" height="150p"></input>
        </div>
      </div> -->
        <div class="container">
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-lg " style="border-radius: 15px;padding: 3px 50px 3px 50px;margin-top: 3px;  margin-bottom: 3px;"> ارسال</button>
          </div>
        </div>

      </div>
    </form>
    <br>
  </div>

  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>

</body>

</html>