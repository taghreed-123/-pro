<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>لوحة التحكم</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>
  <div class="container">
    <?php require_once("main/connection.php");
    require_once("main/models/users-model.php");
    $user = new UsersModel();
    $user->GetUsers();

    if (!empty($_GET['id'])) {
      $user->user_id = $_GET['id'];
      if ($user->DeleteUser()) {
        echo "<p class='alert alert-success'>  بنجاح ( " . $_GET['id'] . " ) لقد تم حذف.</p>";
      } else
        echo "<p class='alert alert-danger'>  بنجاح ( " . $_GET['id'] . " ) لم يتم حذف</p>";
    }
    ?>
    <?php require_once("main/parts/admin_header.php"); ?>
    <a href="editProfile.php?type=new" class="btn btn-primary" style="color:white;">اضافة جديد</a>
    <div class="table-responsive">
      <table class="table">
        <caption class="text-right"> المستخدمين (<?php echo count($user->Users); ?>)</caption>
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">الاسم الكامل</th>
            <th scope="col">الايميل</th>
            <th scope="col">رقم الجوال</th>
            <th scope="col">نوع الحساب</th>
            <th scope="col">مفعل</th>
            <th scope="col">المدينه</th>
            <th scope="col">الموقع</th>
            <th scope="col">التصنيف</th>
            <th scope="col">الشركه</th>
            <th scope="col">الصوره</th>
            <th scope="col">ملاحظات</th>
            <th scope="col">التاريخ</th>
            <th scope="col">تعديل</th>
            <th scope="col">حذف</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($user->Users != null) {
            foreach ($user->Users as $key => $value) {
          ?>
              <tr>
                <th scope="row"><?php echo $value->user_id; ?></th>
                <td><?php echo $value->user_full_name; ?></td>
                <td><?php echo $value->user_email; ?></td>
                <td><?php echo $value->user_phone; ?></td>
                <td><?php echo $value->user_type; ?></td>
                <td><?php echo $value->user_active; ?></td>
                <td><?php echo $value->user_city; ?></td>
                <td><?php echo $value->user_location; ?></td>
                <td><?php echo $value->user_category; ?></td>
                <td><?php echo $value->user_store; ?></td>
                <td><a href="main/images/accounts/<?php echo $value->user_image; ?>"><img src="main/images/accounts/<?php echo $value->user_image; ?>" style="width:50px;height:50px;" class="img-fluid form-control" alt="No image"></a></td>
                <td><?php echo $value->user_notes; ?></td>
                <td><?php echo $value->user_date; ?></td>
                <td><a href="editProfile.php?id=<?php echo $value->user_id; ?>">تعديل</a></td>
                <td><a href="Users.php?id=<?php echo $value->user_id; ?>" id="delete-user" name="<?php echo $value->user_full_name; ?>" onclick="return confirm('Are you sure you want to delete ( '+document.getElementById('delete-user').getAttribute('name')+' ) user');">حذف</a></td>

              </tr>
          <?php }
          } ?>

        </tbody>
      </table>
    </div>

    <?php
    require_once("main/parts/footer.php");
    require_once("main/parts/script.php"); ?>
  </div>
</body>

</html>