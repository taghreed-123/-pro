<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>صفحة المتجر</title>
  <?php require_once("main/parts/style.php");

  ?>

</head>

<body>

  <?php require_once("main/connection.php"); ?>

  <?php require_once("main/models/categories-model.php");
  require_once("main/models/products-model.php");
  require_once("main/models/users-model.php");
  $user = new UsersModel();
  $category = new CategoriesModel();
  $product = new ProductsModel();
  require_once("main/controls/products-manager.php");
  if (!empty($_GET['id']))
    $product->GetProduct($_GET['id']);
  ?>

  <div class="container">
    <br />
    <br />
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (!empty($response)) {
        if (!str_contains($response, "Error")) {
          echo "<p class='alert alert-success'>" . $response . ".\n</p>";
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
      <?php if (!empty($_GET['id']) && $_SESSION['user_type'] == 'admin') require_once("main/parts/admin_header.php");
      else require_once("main/parts/header.php"); ?>
      <br><br>
      <br><br>

      <br><br>
      <form class="form-inline" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="DataManager" value="<?php if (!empty($_GET['id']))
                                                          echo 'Edit';
                                                        else
                                                          echo 'Add'; ?>" />
        <input type="hidden" name="id" value="<?php if (!empty($_GET['id'])) echo $product->Product->product_id; ?>" />
        <input type="hidden" name="LastImageName" value="<?php if (!empty($product->Product->product_image))
                                                            echo $product->Product->product_image; ?>" />
        <?php
        $is_company = false;
        if (!empty($_SESSION['user_type'])) {
          if ($_SESSION['user_type'] == "admin")
            $is_company = true;
        }
        if ($is_company) {
        ?>
          <div class="row">
            <div class="col-md-6 mb-4">
              <label class="form-label select-label" for="id_type">الشركه </label>
            </div>
            <div class="col-md-6 mb-4">
              <select name="ProductsUserId" class="select form-control" id="id_type" style="display:block !important;">
                <?php if ($user->GetUsersStores()) {
                  foreach ($user->Users as $key => $value) {
                ?>
                    <option value="<?php echo $value->user_id; ?>" <?php if (!empty($_GET['id'])) {
                                                                      if ($value->user_id == $product->Product->product_user_id)
                                                                        echo 'selected';
                                                                    } ?>><?php echo $value->user_full_name; ?></option>
                <?php }
                } ?>
              </select>
            </div>

          </div>
        <?php } else { ?>
          <input type="hidden" name="ProductsUserId" value="<?php if (!empty($_GET['id']))
                                                              echo $product->Product->product_user_id;
                                                            else echo $_SESSION['user_id']; ?>" />
        <?php } ?>

        <div class="row" style="margin-right:40px;">
          <div class="col-md-6 mb-4">
            <label class="form-label select-label" for="id_type">تصنيف المنتج </label>
          </div>
          <div class="col-md-6 mb-4">
            <select name="ProductsCategory" class="select form-control" id="id_type" style="display:block !important;">
              <?php if ($category->GetCategories(1)) {
                foreach ($category->Categories as $key => $value) {
              ?>
                  <option value="<?php echo $value->category_name; ?>" <?php if (!empty($_GET['id'])) {
                                                                          if ($value->category_name == $product->Product->product_category)
                                                                            echo 'selected';
                                                                        } ?>><?php echo $value->category_name; ?></option>
              <?php }
              } ?>
            </select>
          </div>

        </div>
        <div class="col-12 form-group  mb-3">
          <label for="prodectDesc"> اسم المنتج</label>
        </div>
        <div class="col-12 form-group  mb-3">
          <input type="text" class="form-control-plaintext" style="background-color:white;" value="<?php if (!empty($_GET['id'])) echo $product->Product->product_name; ?>" id="ProductsName" name="ProductsName" placeholder="اسم المنتج" />
        </div>
        <div class="col-12 form-group  mb-3">
          <label for="prodectDesc"> وصف المنتج:</label>
        </div>
        <div class="col-12 form-group  mb-3">
          <textarea type="text" class="form-control-plaintext" style="background-color:white;" id="ProductsDesc" name="ProductsDesc" placeholder="وصف المنتج... "><?php if (!empty($_GET['id'])) echo $product->Product->product_desc; ?></textarea>
        </div>
        <div class="col-12 form-group  mb-3">
          <label for="img_prod"> ارفاق صورة للمنتج:</label>
          <input type="file" class="form-control" id="Image" name="Image" alt="ارفاق" style="width:10; height:30;">
        </div>

        <br>

        <button type="submit" class="btn btn-primary btn-md" style="color:#fff;background-color: #216869;">حفظ</button>
      </form>





    </div>
  </div>






  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>

</body>

</html>