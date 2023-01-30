<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تغيير كلمة المرور</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php"); 
  
  require_once("main/models/users-model.php");
    $user = new UsersModel();
  ?>
  <?php
  $response = "";
  if ($con) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (!empty($_POST['email'])) {
        if ($user->checkUserEmail($_POST['email'])) {
          if (!empty($_POST['UserPWD'])&&!empty($_POST['CUserPWD'])) {
            if($_POST['UserPWD'] == $_POST['CUserPWD']){
              $user->user_pwd = o_hash($_POST['UserPWD']);
              if ($user->ChangeUserPWD($user->User->user_id, $user->user_pwd))
                $response="تمت عملية تغيير كلمة المرور بنجاح";
          }else{
            $response = "Error\n"."خطا في عملية تاكيد كلمة المرور";
          }
        }else{
          $response = "Error"."كلمة المرور او تاكيدها لا يجب ان يكون فارغ";
        }
        }else{
          $response = "Error\n"."هناك خطاء في الايميل";
        }
      } 
    }
  } else {
    $response = "Error \n" . "خطا في الاتصال بقاعدة البيانات";
  } ?>
  <form method="POST">
    <input type="hidden" name="email" value="<?php if (!empty($_GET['user']))
                  echo $_GET['user'];?>">
    <div class="container">
      <?php
      $process = true;
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($response)) {
          if (!str_contains($response, "Error")) {
            echo "<p class='alert alert-success'>" . $response . ".\nسوف يتم تحويلك الى صفحة تسجيل الدخول...</p>";
            $process = false;
              echo "<script>setTimeout(function () {
                      document.location='login.php';
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


              <a href="main.php"><img src="img/logo.png" alt="logo" class="rounded mx-auto d-block" height="150" width="150"></a>
              <h1 class="display-4" dir="rtl" float-right>اهلا ومرحباً بك!</h1>
              <p class="lead" dir="rtl" float-right>من فضلك قم بإدخال البيانات بشكل صحيح ليتم تغيير كلمة المرور</p>
              <hr class="my-4">
                
            <div class="col-12 form-group-center mb-3  text-right">
              <label for="detailsOfStore"> كلمة المرور الجديده:</label>
              <input type="password" class="form-control" name="UserPWD" id="detailsOfStore" placeholder=" كلمة المرور الجديده:">
            </div>

            <div class="col-12 form-group-center mb-3  text-right">
              <label for="detailsOfStore"> تاكيد كلمة المرور الجديده:</label>
              <input type="password" class="form-control" name="CUserPWD" id="detailsOfStore" placeholder="  تاكيد كلمة المرور الجديده:">
            </div>

                <br>
                <button type="submit" class="btn btn-primary btn-md">حفظ</button>


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