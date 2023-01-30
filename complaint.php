<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>الشكوى</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php"); ?>

  <div class="container">
    <div class="row">
      <?php require_once("main/parts/header.php"); ?>

      <br>
      <br><br>
      <?php 
        $is_user=true;
        if (!empty($_SESSION['user_id'])) {
          if ($_SESSION['user_type'] == 'business')
            $is_user = false;?>
          <?php }?>
          <?php if ($is_user) { ?>
      <a href="order.php"> <button type="button" class="btn btn-primary">اضافة طلب </button></a>
      <a href="ActiveOrder.php"> <button type="button" class="btn btn-primary">الطلبات النشطة </button></a>
      <?php } ?>
      <a href="Underway.php"> <button type="button" class="btn btn-primary">قيد التنفيذ</button></a>
      <a href="all_reports.php"> <button type="button" class="btn btn-primary active">شكـوى </button></a>
    </div>
    <br>
  </div>
  <br>
  <br>
  <br>
  <div class="container">
    <div class="col-md-10 text-left">
      <nav class="">

        <ul class=" nav justify-content-lift nav-tabs">
          <p>
            <a class="btn btn-secondary" href="post_report.php" role="button" style="border-radius: 15px;">ارسل شكوى</a>
            <a class="btn btn-secondary" href="all_reports.php" role="button" style="border-radius: 15px;">متابعة شكوى </a>
          </p>

        </ul>
    </div>
  </div>
  </nav>
  <br><br><br><br><br><br> <br><br>

  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>

</body>

</html>