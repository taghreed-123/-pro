<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>شكوى </title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php"); ?>

  <div class="container">
    <div class="row">
      <?php require_once("main/parts/header.php"); ?>

      <br><br>
      <br><br>

    </div>
  </div>
  <div class="col-1">
    <div style="position:relative; left:60px; top:1px;">
      <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
    </div>
  </div>

  <nav class="menue-order">


    <ul class=" nav justify-content-right nav-tabs">
      <p style="font-size:25px; text-align:center; color:#495057;">قائمة الشكاوي</p>

    </ul>
  </nav>

  <nav class="list-complaint-company">
    <form>

      <ul class=" nav justify-content nav-tabs">
        <li class="nav-item" class="nav-link" style="color:#495057;">رقم الطلب</li>
        <li class="nav-item" class="nav-link" style="color:#495057;">#12345</li>
        <li class="nav-item" class="nav-link" style="color:#495057;">المشكلة : </li>
        <li class="nav-item" class="nav-link" style="color:#495057;">اللون </li>
        <li class="control-li-complaint"><button type="submit" class="but-upadte-state" class="nav-item" class="nav-link" style="color:#fff; border-radius: 15px; background-color: #216869"><a href="implement-complaint.php" style="background-color: #216869; color:#fff; "> معالجة الشكوى </a> </button> </li>
      </ul>
    </form>
  </nav>

  <nav class="list-complaint-company">
    <form>

      <ul class=" nav justify-content nav-tabs">
        <li class="nav-item" class="nav-link" style="color:#495057;">رقم الطلب</li>
        <li class="nav-item" class="nav-link" style="color:#495057;">#12345</li>
        <li class="nav-item" class="nav-link" style="color:#495057;">المشكلة : </li>
        <li class="nav-item" class="nav-link" style="color:#495057;">المقاسات غير صحيحة </li>
        <li class="control-li-complaint"><button type="submit" class="but-upadte-state" class="nav-item" class="nav-link" style="color:#fff; border-radius: 15px; background-color: #216869"><a href="implement-complaint.php" style="background-color: #216869; color:#fff; "> معالجة الشكوى </a> </button> </li>
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