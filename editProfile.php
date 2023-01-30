<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> تحرير الملف الشخصي</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php"); ?>
  <?php
  if ($con) {
  ?>
  <?php require_once("main/controls/users-manager.php");
    require_once("main/models/categories-model.php");
    $category = new CategoriesModel();
    if (!empty($_GET['id']))
      $user->GetUser($_GET['id']);
  } else {
    $response = "Error \n" . "خطا في الاتصال بقاعدة البيانات";
  }
  if ($user->User != null || !empty($_GET['type'])) {
    if ($user->User->user_id == $_SESSION['user_id'])
      $_SESSION = (array) $user->User;
  ?>

    <div class="container">
      <br />
      <br />
      <br />
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($response)) {
          if (!str_contains($response, "Error")) {
            echo "<p class='alert alert-success'>" . $response . ".</p>";
          } else
            echo "<p class='alert alert-danger'>" . $response . ".</p>";
        } else
          echo "<p class='alert alert-danger'>" . $response . ".</p>";
      } ?>
      <div class="row">
        <div class="col-12 text-right">
          <div style="position:relative; left:60px; top:1px;">
            <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
          </div>
        </div>
        <div class="col-12 text-right">
          <?php
          if (!empty($_SESSION['user_type'])) {
            if ($_SESSION['user_type'] == 'admin') {
              require_once("main/parts/admin_header.php");
            } else
              require_once("main/parts/header.php");
          } else
            require_once("main/parts/header.php");

          ?>

          <div class="col-12 text-center">
            <a href="#"><img src="main/images/accounts/<?php if (!empty($_GET['id'])) {
                                                          if (file_exists('main/images/accounts/' . $user->User->user_image))
                                                            echo $user->User->user_image;
                                                          else
                                                            echo 'avatar.png';
                                                        } else
                                                          echo 'avatar.png'; ?>" alt="" style="width:300px;height:300px;"></a>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="DataManager" value="<?php if (!empty($_GET['id']))
                                                              echo 'Edit';
                                                            else
                                                              echo 'Add'; ?>" />
            <input type="hidden" name="id" value="<?php if (!empty($_GET['id'])) echo $user->User->user_id; ?>" />
            <input type="hidden" name="LastImageName" value="<?php if (!empty($_GET['id']))
                                                                echo $user->User->user_image; ?>" />

            <div class="col-12 form-group-center mb-3  text-right">
              <label for=" text-right"> الاسم الكامل:</label>
              <input type="text" class="form-control" value="<?php if (!empty($_GET['id']))
                                                                echo $user->User->user_full_name; ?>" name="UserFullName" id="" placeholder="  الاسم الكامل:">
            </div>

            <div class="col-12 form-group-center mb-3  text-right">
              <label for=" text-right"> الايميل:</label>
              <input type="email" class="form-control" value="<?php if (!empty($_GET['id']))
                                                                echo $user->User->user_email; ?>" name="UserEmail" id="" placeholder=" الايميل:">
            </div>
            <div class="col-12 form-group-center mb-3  text-right">
              <label for=" text-right"> رقم التلفون:</label>
              <input type="text" class="form-control" value="<?php if (!empty($_GET['id']))
                                                                echo $user->User->user_phone; ?>" name="UserPhone" id="" placeholder=" رقم التلفون:">
            </div>
            <?php if (!empty($_GET['id']) && $_SESSION['user_type'] != "admin") { ?>
              <div class="col-12 form-group-center mb-3  text-right">
                <label for=" text-right"> نوع الحساب:</label>
                <input type="text" class="form-control readonly" value="<?php if (!empty($_GET['id']))
                                                                          echo $user->User->user_type; ?>" name="UserType" id="" placeholder=" نوع الحساب:" readonly>
              </div>
            <?php } else { ?>
              <div class="row">
                <div class="col-md-6 mb-4">
                  <label class="form-label select-label" for="id_type">نوع الحساب</label>
                </div>
                <div class="col-md-6 mb-4">
                  <select name="UserType" class="select form-control" onchange="terms(document.getElementById('id_type').value);" id="id_type" style="display:block !important;">
                    <option value="user" <?php if (!empty($_GET['id'])) {
                                            if ($user->User->user_type == "user")
                                              echo "selected";
                                          } ?>>مستخدم</option>
                    <option value="business" <?php if (!empty($_GET['id'])) {
                                                if ($user->User->user_type == "business")
                                                  echo "selected";
                                              } ?>> رجل اعمال</option>
                    <?php if (!empty($_SESSION['user_type'])) {
                      if ($_SESSION['user_type'] == "admin") { ?>
                        <option value="admin" <?php if (!empty($_GET['id'])) {
                                                if ($user->User->user_type == "admin")
                                                  echo "selected";
                                              } ?>>مدير</option>
                    <?php }
                    } ?>
                  </select>
                </div>

              </div>
            <?php } ?>
            <div class="col-12 form-group-center mb-3  text-right" id="<?php if (!empty($_GET['id'])) if ($_SESSION['user_type'] == "business")
                                                                          echo '';
                                                                        else
                                                                          echo 'store-name'; ?>">
              <label for=" text-right"> اسم الشركه</label>
              <input type="text" class="form-control" value="<?php if (!empty($_GET['id']))
                                                                echo $user->User->user_store; ?>" name="UserStore" id="" placeholder="اسم الشركه">
            </div>
            <div class="col-12 form-group-center mb-3  text-right">
              <label for=" text-right"> المدينه:</label>
              <input type="text" class="form-control" value="<?php if (!empty($_GET['id']))
                                                                echo $user->User->user_location; ?>" name="UserLocationCity" id="" placeholder=" المدينه:">
            </div>
            <div class="col-12 form-group-center mb-3  text-right">
              <label for=" text-right"> الموقع:</label>
              <input type="text" class="form-control" value="<?php if (!empty($_GET['id']))
                                                                echo $user->User->user_location; ?>" name="UserLocation" id="" placeholder=" الموقع:">
            </div>

            <?php if (!empty($_GET['id'])) { ?>
              <div class="col-12 form-group-center mb-3  text-right">
                <label for="detailsOfStore"> كلمة المرور القديمه:</label>
                <input type="password" class="form-control" id="detailsOfStore" name="OldUserPWD" placeholder=" كلمة المرور القديمه:">
              </div>
            <?php } ?>
            <div class="col-12 form-group-center mb-3  text-right">
              <label for="detailsOfStore"> كلمة المرور:</label>
              <input type="password" class="form-control" name="UserPWD" id="detailsOfStore" placeholder=" كلمة المرور:">
            </div>

            <div class="col-12 form-group-center mb-3  text-right">
              <label for="detailsOfStore"> تاكيد كلمة المرور:</label>
              <input type="password" class="form-control" name="CUserPWD" id="detailsOfStore" placeholder=" تاكيد كلمة المرور:">
            </div>

            <div class="col-12 form-group-center mb-3  text-right">
              <label for=" text-right"> ملاحظات:</label>
              <textarea type="text" class="form-control row-4" name="Notes" id="" placeholder=" ملاحظات:"><?php if (!empty($_GET['id']))
                                                                                                            echo $user->User->user_notes; ?></textarea>
            </div>
            <div class="col-12 form-group-center mb-3  text-right">
              <label for=" text-right"> الصوره:</label>
              <input type="file" class="form-control" name="Image" id="" placeholder=" الصوره:">
            </div>

            <div class="col-12 btn-center">
              <button type="submit" class="btn btn-primary btn-md" style="color:#fff;background-color: #216869;">حفظ</button>
            </div>
        </div>

        </form>

      <?php
    }
    require_once("main/parts/footer.php");
    require_once("main/parts/script.php"); ?>
      <script>
        terms(document.getElementById('id_type').value);
      </script>
</body>

</html>