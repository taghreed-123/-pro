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
    require_once("main/models/categories-model.php");
    $category = new CategoriesModel();
    $category->GetAllCategories();

    if (!empty($_GET['id'])) {
      $category->category_id = $_GET['id'];
      if ($category->DeleteCategory()) {
        echo "<p class='alert alert-success'>  بنجاح ( " . $_GET['id'] . " ) لقد تم حذف.</p>";
      } else
        echo "<p class='alert alert-danger'>  بنجاح ( " . $_GET['id'] . " ) لم يتم حذف</p>";
    }
    ?>
    <?php require_once("main/parts/admin_header.php"); ?>
    <a href="main/forms/category-form.php?type=new" class="btn btn-primary" style="color:white;">اضافة جديد</a>
    <div class="table-responsive">
      <table class="table">
        <caption class="text-right"> انواع المنتجات (<?php echo count($category->Categories); ?>)</caption>
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">الاسم</th>
            <th scope="col">النوع</th>
            <th scope="col">ملاحظات</th>
            <th scope="col">التاريخ</th>
            <th scope="col">تعديل</th>
            <th scope="col">حذف</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($category->Categories != null) {
            foreach ($category->Categories as $key => $value) {
          ?>
              <tr>
                <th scope="row"><?php echo $value->category_id; ?></th>
                <td><?php echo $value->category_name; ?></td>
                <td><?php if ($value->category_type == 0)
                  echo "حساب";
                else
                  echo "منتج"; ?></td>
                <td><?php echo $value->category_notes; ?></td>
                <td><?php echo $value->category_date; ?></td>
                <td><a href="main/forms/category-form.php?id=<?php echo $value->category_id; ?>">تعديل</a></td>
                <td><a href="Categories.php?id=<?php echo $value->category_id; ?>" id="delete-product-type" name="<?php echo $value->category_name; ?>" onclick="return confirm('Are you sure you want to delete ( '+document.getElementById('delete-product-type').getAttribute('name')+' ) products type');">حذف</a></td>

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