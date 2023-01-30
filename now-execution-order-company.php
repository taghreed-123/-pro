<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>قيد التنفيذ</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php"); ?>

  <div class="container">
    <div class="row">
      <?php require_once("main/parts/header.php"); ?>
      <br><br>
      <br><br>
      <div class="col-12 text-right">
        <div style="position:relative; left:60px; top:1px;">
          <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
        </div>
      </div>
    </div>
  </div>


  <nav class="menue-order">


    <ul class=" nav justify-content-right nav-tabs">
      <p>
        <a class="btn btn-primary" href="orderList.php" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">قائمة الطلبات </a>
        <a class="btn btn-primary" href="now-execution-order-company.php" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">قيد التنفيذ</a>
      </p>

    </ul>
  </nav>

  <nav class="order-after-paymant-side-company">
    <form>

      <ul class=" nav justify-content nav-tabs">
        <li class="nav-item" class="nav-link" style="color:#495057;">رقم الطلب</li>
        <li class="nav-item" class="nav-link" style="color:#495057;">#12345</li>
        <li class="nav-item" class="nav-link" style="color:#495057;"> حالة الطلب : </li>


        <select name="state-order" class="nav-item" class="nav-link" style="color:#495057;">
          <option selected>قيدالتنفيذ</option>
          <option>تم التسليم </option>
        </select>
        <li class="control-butt"><button type="submit" class="but-upadte-state" class="nav-item" class="nav-link" style=" color:#fff; border-radius: 15px; background-color: #216869;"> تحديث </button> </li>
      </ul>
    </form>
  </nav>

  <nav class="order-after-paymant-side-company">
    <form>

      <ul class=" nav justify-content nav-tabs">
        <li class="nav-item" class="nav-link" style="color:#495057;">رقم الطلب</li>
        <li class="nav-item" class="nav-link" style="color:#495057;">#67890</li>
        <li class="nav-item" class="nav-link" style="color:#495057;"> حالة الطلب : </li>


        <select name="state-order" class="nav-item" class="nav-link" style="color:#495057;">
          <option selected>قيدالتنفيذ</option>
          <option>تم التسليم </option>
        </select>
        <li class="control-butt"><button type="submit" class="but-upadte-state" class="nav-item" class="nav-link" style=" color:#fff; border-radius: 15px; background-color: #216869;"> تحديث </button> </li>
      </ul>
    </form>
  </nav>



  <nav class="bar-control">

  </nav>


  <br><br><br>


  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>

</body>

</html>