<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>الصفحة الرئيسية</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php"); ?>
  <?php require_once("main/models/products-model.php");
  require_once('main/models/favorites-model.php');
  $favorite = new FavoritesModel();
  if (!empty($_SESSION['user_id'])) {
    require_once('main/controls/favorites-manager.php');
  }
  $product = new ProductsModel();
  $product->GetProductsView();
  ?>
  <!-- navbar -->

  <?php require_once("main/parts/header.php"); ?>
  <!--<div class="btn-group btn-group-toggle" data-toggle="buttons">
       <label class="btn btn-outline-light btn-sm">
         <input type="radio" name="options" id="option1" autocomplete="off"> <img src="main/images/heart.png" class="img-fluid rounded-start" style="width:30px; height:30px;" alt="...">
        </label> </div> -->

  <div class="container">
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_SESSION['user_id'])) { ?>
        <p class="alert alert-danger">يجب ان تسجل الدخول حتى تتمكن من اضافته الا المفضله</p>
        <?php } else {
        if (!strpos($response, "Error")) { ?>
          <p class="alert alert-success"><?php echo $response; ?></p>

        <?php } else { ?>
          <p class="alert alert-danger"><?php echo $response; ?></p>
    <?php }
      }
    } ?>
    <div class="row ">
      <div class="<col-md-4 m-1">
        <div class="row row-cols-2 row-cols-3">
          <?php if ($product->Products != null) {
            foreach ($product->Products as $key => $value) {
          ?>
              <div class="card mb-3 m-2" style="width: 371px;"> <!-- start of a card -->
                <div class="row">
                  <div class="col-md-3">
                    <img src="main/images/accounts/<?php if (file_exists('main/images/accounts/' . $value->user_image))
                                                      echo $value->user_image;
                                                    else
                                                      echo 'avatar.png'; ?>" class="img-fluid rounded-start" alt="..." style="width:100px;height:100px;margin-bottom:5px;">
                  </div>
                  <div class="row align-items-end">
                    <div class="col">
                      <div class="card-body">
                        <a href="storeProfile.php?id=<?php echo $value->user_id; ?>" style="color:teal; color:black">
                          <h5 class="card-title text-right"><?php echo $value->user_store ?> </h5>
                        </a>
                        <a href="PostDetails.php?id=<?php echo $value->product_id; ?>" style="color:teal; color:black">
                          <span class="text-right"><?php echo $value->product_name ?> </span>
                        </a>

                        <!--    <p class="card-text "> التعليق هنا </p> -->
                      </div>
                    </div>
                  </div>

                  <div class="col pr-4 pl-4 pb-1">
                    <a href="postdetails.php?id=<?php echo $value->product_id; ?>"> <img src="main/images/products/<?php if (file_exists('main/images/products/' . $value->product_image))
                                                                                                                      echo $value->product_image;
                                                                                                                    else
                                                                                                                      echo 'default.png'; ?>" class="card-img pb-1" style="width:348px; height:345px; " alt="..."> </a> <br>
                    <form method="POST">
                      <input type="hidden" value="<?php if (!empty($_SESSION['user_id'])) {
                                                    if ($favorite->GetFavorite($value->product_id, $_SESSION['user_id']))
                                                      echo 'Delete';
                                                    else
                                                      echo 'Add';
                                                  } else
                                                    echo 'Add'; ?>" name="DataManager">
                      <input type="hidden" value="<?php if (!empty($_SESSION['user_id'])) {
                                                    if ($favorite->GetFavorite($value->product_id, $_SESSION['user_id']))
                                                      echo $favorite->favorite_id;
                                                    else
                                                      echo '';
                                                  } else
                                                    echo ''; ?>" name="id">
                      <input type="hidden" value="<?php echo $value->product_user_id; ?>" name="SellerID">
                      <input type="hidden" value="<?php echo $value->product_id; ?>" name="ProductID">
                      <input type="hidden" value="<?php if (!empty($_SESSION['user_id']))echo $_SESSION['user_id']; ?>" name="CustomerID">
                      <button type="submit" class="btn btn-outline-light btn-sm" style="color:black !important;"><img src="main/images/<?php if (!empty($_SESSION['user_id'])) {
                                                                                                          if ($favorite->GetFavorite($value->product_id, $_SESSION['user_id']))
                                                                                                            echo 'heart-fill.png';
                                                                                                          else
                                                                                                            echo 'heart.png';
                                                                                                        } else
                                                                                                          echo 'heart.png'; ?>" class="img-fluid rounded-start" style="width:30px; height:30px;" alt="..."><?php $favorite->GetFavorites($value->product_id);echo count($favorite->Favorites);?></button>
                    </form>
                    <br>

                  </div>



                </div>
              </div>
          <?php }
          } ?>

        </div>
      </div>
    </div>
  </div> <!-- end of cards container-->
  <br><br><br>

  <?php require_once("main/parts/footer.php") ?>
  <?php require_once("main/parts/script.php") ?>
</body>

</html>