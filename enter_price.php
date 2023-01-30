<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> اخال السعر</title>
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

  <nav class="background-detal">

    <div class="row">
      <div class="col-12 text-right">
        <a href="orderList.php"> <img src="img/right-arrow.png" alt="back" height="20" width="20" style=" margin-top: 20px;margin-right:  30px;"></a>
      </div>
    </div>


    <div class="enter-price">
      <p style="font-family:Arial; font-size:30px; text-align:center; color:#495057;">السعر</p>
    </div>
    <form class="form-enter-price">
      <ul class=" nav justify-content nav-tabs">
        <li class="nav-item" class="nav-link" style=" font-family:Arial;font-size: 20px;padding-left: 10px;color:#495057;">ادخل السعر</li>
        <li class="nav-item" class="nav-link" style="margin-bottom:5px; color:#495057;"> <input name="name" type="text" size="25"></li>
        <li class="btn-enter-price"><button type="submit" style=" border: 1px solid #495057;
        padding: 5px 30px 5px 30px; color:#fff; border-radius: 15px; background-color: #216869;"> ارسال </button></li>

      </ul>

    </form>

  </nav>


  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>

</body>

</html>