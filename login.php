<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل الدخول</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php"); ?>
  <?php
  if ($con) {
    $response = "خطا في الاتصال بقاعدة البيانات";
  ?>
  <?php require_once("main/controls/users-manager.php");
  } else {
    $response = "Error \n" . "خطا في الاتصال بقاعدة البيانات";
  } ?>
  <form method="post">
    <input type="hidden" name="DataManager" value="LogIn" />
    <div class="container">
      <?php
      $process = true;
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($response)) {
          if (!str_contains($response, "Error")) {
            echo "<p class='alert alert-success'>" . $response . ".\nسوف يتم تحويلك الى الصفحة الرئيسيه...</p>";
            $process = false;
            if($_SESSION['user_type']=='admin')
              echo "<script>setTimeout(function () {
                      document.location='Users.php';
                    }, 2000);</script>";
            else
              echo "<script>setTimeout(function () {
                document.location='index.php';
                }, 2000);</script>";
          } else
            echo "<p class='alert alert-danger'>" . $response . ".</p>";
        } else
          echo "<p class='alert alert-danger'>" . $response . ".</p>";
      }
      if ($process) {
      ?>
        <div class="row">
          <div class="col-6">
            <img src="img/Register.png" alt="register" height="750" width="550" class="bi bi-arrow-left">
          </div>
          <div class="col-md-6 text-center">
            <div class="jumbotron bg-white" dir="rtl">
              <div class="col-10 text-right">
                <div style="position:relative; left:30px; top:1px;">
                  <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
                </div>
              </div>

              <a href="main.php"><img src="img/logo.png" alt="logo" class="rounded mx-auto d-block" height="150" width="150"></a>
              <h1 class="display-4" dir="rtl" float-right>اهلا ومرحباً بك!</h1>
              <p class="lead" dir="rtl" float-right>من فضلك قم بإدخال البيانات بشكل صحيح ليتم استخدام التطبيق</p>
              <hr class="my-4">
              <form>
                <div class="form-group">

                  <input type="email" name="UserEmail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="البريد الإلكتروني" required>
                </div>
                <div class="form-group">
                  <input type="password" name="UserPWD" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور" required>
                </div>
                <div>
                  <a href="forget.php" class="text-primary">هل نسيت كلمة المرور؟</a>
                </div>
                <br>
                <button type="submit" class="btn btn-primary btn-md">تسجيل الدخول</button>
              </form>
              <br>
              <p> ليس لديك حساب؟ <a href="create_account.php" class="text-danger">تسجيل </a></p>


            </div>

          </div>
        </div>
      <?php } ?>
    </div>

    </div>
  </form>
  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>

</body>

</html>