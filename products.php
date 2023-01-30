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
    require_once("main/models/products-model.php");
    $product = new ProductsModel();
    $product->GetProductsView();

    if (!empty($_GET['id'])) {
      $product->product_id = $_GET['id'];
      if ($product->DeleteProduct()) {
        echo "<p class='alert alert-success'>  بنجاح ( " . $_GET['id'] . " ) لقد تم حذف.</p>";
      } else
        echo "<p class='alert alert-danger'>  بنجاح ( " . $_GET['id'] . " ) لم يتم حذف</p>";
    }
    ?>
    <?php require_once("main/parts/admin_header.php"); ?>
    <!-- <a href="addPost.php?type=new" class="btn btn-primary" style="color:white;">اضافة جديد</a> -->
    <div class="table-responsive">
      <table class="table">
        <caption class="text-right"> المنتجات (<?php echo count($product->Products); ?>)</caption>
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">الشركه</th>
            <th scope="col">الاسم</th>
            <th scope="col">النوع</th>
            <th scope="col">الوصف</th>
            <th scope="col">الصوره</th>
            <th scope="col">ملاحظات</th>
            <th scope="col">التاريخ</th>
            <th scope="col">تعديل</th>
            <th scope="col">حذف</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($product->Products != null) {
            foreach ($product->Products as $key => $value) {
          ?>
              <tr>
                <th scope="row"><?php echo $value->product_id; ?></th>
                <td><?php echo $value->user_store; ?></td>
                <td><?php echo $value->product_name; ?></td>
                <td><?php echo $value->product_category; ?></td>
                <td><?php echo $value->product_desc; ?></td>
                <td><a href="main/images/products/<?php if (file_exists('main/images/products/' . $value->product_image))
                                                    echo $value->product_image;
                                                  else
                                                    echo 'default.png'; ?>"><img src="main/images/products/<?php if (file_exists('main/images/products/' . $value->product_image))
                                                                          echo $value->product_image;
                                                                        else
                                                                          echo 'default.png'; ?>" style="width:50px;height:50px;" class="img-fluid form-control" alt="No image"></a></td>
                <td><?php echo $value->product_notes; ?></td>
                <td><?php echo $value->product_date; ?></td>
                <td><a href="addPost.php?id=<?php echo $value->product_id; ?>">تعديل</a></td>
                <td><a href="products.php?id=<?php echo $value->product_id; ?>" id="delete-product-type" name="<?php echo $value->product_name; ?>" onclick="return confirm('Are you sure you want to delete ( '+document.getElementById('delete-product-type').getAttribute('name')+' ) products type');">حذف</a></td>

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