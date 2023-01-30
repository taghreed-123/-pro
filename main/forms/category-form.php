<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> تحرير انواع المنتجات</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/index.css">


</head>

<body class="container">

  <?php require_once("../connection.php"); ?>
  <?php
  if ($con) {
  ?>
  <?php
    require_once("../models/categories-model.php");
    $category = new CategoriesModel();
    require_once("../controls/categories-manager.php");
    if (!empty($_GET['id']))
      $category->GetCategory($_GET['id']);
  } else {
    $response = "Error \n" . "خطا في الاتصال بقاعدة البيانات";
  }
  if ($category->Category != null || !empty($_GET['type'])) {
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

          <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="DataManager" value="<?php if (!empty($_GET['id']))
                                                              echo 'Edit';
                                                            else
                                                              echo 'Add'; ?>" />
            <input type="hidden" name="id" value="<?php if (!empty($_GET['id'])) echo $category->Category->category_id; ?>" />

            <div class="col-12 form-group-center mb-3  text-right">
              <label for=" text-right"> الاسم </label>
              <input type="text" class="form-control" value="<?php if (!empty($_GET['id']))
                                                                echo $category->Category->category_name; ?>" name="CategoryName" id="" placeholder=" الاسم">
            </div>

            <div class="col-12 form-group-center mb-3  text-right">
              <div class="form-check" >
                <input type="checkbox" class="form-check-input" name="CategoryType" id="" placeholder="  تصنيف منتج" <?php if (!empty($_GET['id']))
                                                                          if($category->Category->category_type==1)echo "checked"; ?>> 
                <label class="form-check-label" for="flexCheckDefault" style="padding-right:20px;">
                   تصنيف كمنتج 
                </label>
              </div>
            </div>
            <div class="col-12 form-group-center mb-3  text-right">
              <label for=" text-right"> ملاحظات</label>
              <textarea type="text" class="form-control"  name="Notes" id="" placeholder=" ملاحظات"> <?php if (!empty($_GET['id']))
                                                                  echo $category->Category->category_notes; ?></textarea>
            </div>
            <div class="col-12 btn-center">
              <button type="submit" class="btn btn-primary btn-md" style="color:#fff;background-color: #216869;">حفظ</button>
              <a href="/FurnitureWebSite/Categories.php" class="btn btn-primary btn-md" style="color:#fff;background-color: #216869;">جدول التصنيف</a>
            </div>
        </div>

        </form>

      <?php
    }
    require_once("../parts/footer.php"); ?>
      <script src="js/popper.min.js"></script>
      <script src="js/jquery-3.6.1.min.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/index.js"></script>
</body>

</html>