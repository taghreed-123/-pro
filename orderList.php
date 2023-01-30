<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> قائمه الطلبات </title>
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
    <br><br>



    <nav class="menue-order" style="margin-bottom:10px; ">


      <ul class=" nav justify-content-right nav-tabs">
        <p>
          <a class="btn btn-primary" href="orderList.php" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">قائمة الطلبات </a>
          <a class="btn btn-primary" href="now-execution-order-company.php" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">قيد التنفيذ</a>
        </p>

      </ul>
    </nav>





    <nav class="list-order-co">
      <form>

        <ul class=" nav justify-content nav-tabs">
          <li class="nav-item" class="nav-link" style="color:#495057;">رقم الطلب</li>
          <li class="nav-item" class="nav-link" style="color:#495057;">#12345</li>
          <li class="nav-item" class="nav-link" style="color:#495057;"> نوع الطلب </li>
          <li class="nav-item" class="nav-link" style="color:#495057;">اريكه </li>
          <li class="nav-item" class="nav-link" style="color:#495057;">حدود السعر </li>
          <li> <button type="submit" class="but-upadte-state" class="nav-item" class="nav-link" style=" color:#fff; border-radius: 15px; background-color: #216869;"><a href="enter_price.php" style="background-color: #216869; color:#fff; ">ادخال السعر </a> </button></li>
          <li style="border-bottom-left-radius:15%; border-top-left-radius:15%;"><a href="chat-list.php" style="color: #216869;"><img src="img/chat.png" alt="دردشة" height="20" width="20">الدردشة</a></li>

        </ul>
      </form>
    </nav>

    <nav class="list-order-co">
      <form>

        <ul class=" nav justify-content nav-tabs">
          <li class="nav-item" class="nav-link" style="color:#495057;">رقم الطلب</li>
          <li class="nav-item" class="nav-link" style="color:#495057;">#35678</li>
          <li class="nav-item" class="nav-link" style="color:#495057;"> نوع الطلب </li>
          <li class="nav-item" class="nav-link" style="color:#495057;">اريكه </li>
          <li class="nav-item" class="nav-link" style="color:#495057;">حدود السعر </li>
          <li> <button type="submit" class="but-upadte-state" class="nav-item" class="nav-link" style=" color:#fff; border-radius: 15px; background-color: #216869;"><a href="enter_price.php" style="background-color: #216869; color:#fff; ">ادخال السعر </a> </button></li>
          <li style="border-bottom-left-radius:15%; border-top-left-radius:15%;"><a href="chat-list.php" style="color: #216869;"><img src="img/chat.png" alt="دردشة" height="20" width="20">الدردشة</a></li>

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