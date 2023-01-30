<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>المنشور</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php");
  require_once('main/models/products-model.php');
  require_once('main/models/favorites-model.php');
  require_once('main/models/followers-model.php');
  require_once('main/models/feedbacks-model.php');
  $favorite = new FavoritesModel();
  $follower = new FollowersModel();
  $feedback = new FeedbacksModel();

  if (!empty($_SESSION['user_id'])) {
    if (!empty($_POST['process_type'])) {
      if ($_POST['process_type'] == "follow")
        require_once('main/controls/followers-manager.php');
      else if ($_POST['process_type'] == "feedback") {
        require_once('main/controls/feedbacks-manager.php');
      }
    } else
      require_once('main/controls/favorites-manager.php');
  }

  $product = new ProductsModel(); ?>

  <!-- navbar -->
  <div class="container">
    <br />
    <br />
    <br />
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_SESSION['user_id'])) { ?>
        <p class="alert alert-danger">يجب ان تسجل الدخول حتى تتمكن من تنفيذ هذه العمليه</p>
        <?php } else {
        if (!empty($response)) {
          if (!strpos($response, "Error")) { ?>
            <p class="alert alert-success"><?php echo $response; ?></p>

          <?php } else { ?>
            <p class="alert alert-danger"><?php echo $response; ?></p>
    <?php }
        }
      }
    } ?>
    <div class="row">
      <?php require_once("main/parts/header.php"); ?>

      <div class="col-12 text-right">
        <div style="position:relative; left:40px; top:1px;">
          <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
        </div>
      </div>

      <script src="js/popper.min.js"></script>

    </div>
  </div>

  <?php if (!empty($_GET['id'])) {
    $product->GetProduct($_GET['id']);
    if ($product->Product != null) {
  ?>

      <div class="container m-4">


        <div class="card  " style="width:1200px;">

          <div class="card-body">
            <form method="POST">
              <input type="hidden" name="process_type" value="follow" />
              <input type="hidden" name="SellerID" value="<?php echo $product->Product->user_id; ?>" />
              <input type="hidden" name="CustomerID" value="<?php if (!empty($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>" />
              <input type="hidden" value="<?php if (!empty($_SESSION['user_id'])) {
                                            if ($follower->GetFollower($product->Product->user_id, $_SESSION['user_id']))
                                              echo $follower->followers_id;
                                            else
                                              echo '';
                                          } else
                                            echo ''; ?>" name="id">
              <input type="hidden" value="<?php if (!empty($_SESSION['user_id'])) {
                                            if ($follower->GetFollower($product->Product->user_id, $_SESSION['user_id']))
                                              echo 'Delete';
                                            else
                                              echo 'Add';
                                          } else
                                            echo 'Add'; ?>" name="DataManager">
              <?php
              $try = true;
              if (!empty($_SESSION['user_id'])) {
                if ($_SESSION['user_id'] == $product->Product->user_id)
                  $try = false;
              }
              if ($try) { ?>
                <button type="submit" class="btn btn-outline-primary pr-600; float-left <?php if (!empty($_SESSION['user_id'])) {
                                                                                          if ($follower->GetFollower($product->Product->user_id, $_SESSION['user_id']))
                                                                                            echo 'active';
                                                                                          else
                                                                                            echo '';
                                                                                        } else
                                                                                          echo ''; ?>"><img src="main/images/<?php if (!empty($_SESSION['user_id'])) {
                                                      if ($follower->GetFollower($product->Product->user_id, $_SESSION['user_id']))
                                                        echo 'followed.png';
                                                      else
                                                        echo 'follow.png';
                                                    } else
                                                      echo 'follow.png'; ?>" alt="متابعين" height="15" width="15"> متابعة </button>
              <?php } ?>
            </form>
            <div class="row g-0">
              <img src="main/images/accounts/<?php if (file_exists('main/images/accounts/' . $product->Product->user_image))
                                                echo $product->Product->user_image;
                                              else
                                                echo 'avatar.png'; ?>" alt="Avatar" class="img-fluid rounded-start col-md-1">

              <div>

                <h5 class="card-title align-self-center nameStores"> <?php echo $product->Product->user_store; ?></h5><br>
                <h7 class="card-title text-muted"><?php echo $product->Product->user_notes; ?></h7>
              </div>
            </div>

            <p class="card-text"></p>
            <!--    <a href="#" class="btn btn-primary">Go somewhere</a> -->
          </div>
          <div class="card-footer text-right">
            <button type="button" class="btn btn-outline-secondary" data-toggle="collapse" data-target="#collapsefoolowers" aria-expanded="undefined" aria-controls="collapsefoolowers"> <img src="main/images/follow.png" alt="متابعين" height="15" width="15"> المتابعين </button>

            <button type="button" class="btn btn-outline-secondary" data-toggle="collapse" data-target="#collapsepost" aria-expanded="undefined" aria-controls="collapsepost">المنشورات</button>

            <div class="collapse" id="collapsefoolowers">
              <div class="container">
                <div class="row ">

                  <div class="<col-md-4 m-1 p-2">
                    <div class="row row-cols-1 row-cols-md-2 g-4">

                      <div class="container">

                        <h6>عدد المتابعين: </h6>



                        <h7><?php $follower->GetFollowers($product->Product->user_id);
                            echo count($follower->Followers); ?></h7>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="collapse " id="collapsepost">

              <div class="container">
                <div class="row ">
                  <div class="<col-md-4 m-1">
                    <div class="row row-cols-2 row-cols-3">
                      <?php $product->GetUserProducts($product->Product->user_id);
                      if ($product->Products != null) {
                        foreach ($product->Products as $key => $value) {
                      ?>
                          <div class="card mb-3 m-2" style="width: 371px;height:400px;"> <!-- start of a card -->
                            <div class="row">
                              <div class="col pr-4 pl-4 pb-1 pt-1 text-left">
                              <a href="postdetails.php?id=<?php echo $value->product_id; ?>">
                                <img src="main/images/products/<?php if (!empty($value->product_image))
                                                                  echo $value->product_image;
                                                                else
                                                                  echo 'default.png'; ?>" class="card-img pb-1" style="width:348px; height:345px; " alt="...">
                              </a>
                                <br>
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
                                  <input type="hidden" value="<?php echo $product->Product->user_id; ?>" name="SellerID">
                                  <input type="hidden" value="<?php echo $value->product_id; ?>" name="ProductID">
                                  <input type="hidden" value="<?php if (!empty($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>" name="CustomerID">
                                  <button type="submit" class="btn btn-outline-light btn-sm" style="color:black !important;"><img src="main/images/<?php if (!empty($_SESSION['user_id'])) {
                                                                                                                                                      if ($favorite->GetFavorite($value->product_id, $_SESSION['user_id']))
                                                                                                                                                        echo 'heart-fill.png';
                                                                                                                                                      else
                                                                                                                                                        echo 'heart.png';
                                                                                                                                                    } else
                                                                                                                                                      echo 'heart.png'; ?>" class="img-fluid rounded-start" style="width:30px; height:30px;" alt="..."><?php $favorite->GetFavorites($value->product_id);
                                                                                                                                                                                                                                                        echo count($favorite->Favorites); ?></button>
                                </form>
                                <br>

                              </div>
                            </div>
                          </div> <!-- end of a card -->
                      <?php }
                      } ?>

                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>



      <div class="container m-4">

        <div class="col pr-4 pl-4 pb-1">
          <img src="main/images/products/<?php if (file_exists('main/images/products/' . $product->Product->product_image))
                                            echo $product->Product->product_image;
                                          else
                                            echo 'default.png'; ?>" class="card-img pb-1 " style="width:1000px; height:500px; " alt="...">
          <br>
          <?php echo $product->Product->product_desc; ?>
          <form method="POST">
            <input type="hidden" value="<?php if (!empty($_SESSION['user_id'])) {
                                          if ($favorite->GetFavorite($product->Product->product_id, $_SESSION['user_id']))
                                            echo 'Delete';
                                          else
                                            echo 'Add';
                                        } else
                                          echo 'Add'; ?>" name="DataManager">
            <input type="hidden" value="<?php if (!empty($_SESSION['user_id'])) {
                                          if ($favorite->GetFavorite($product->Product->product_id, $_SESSION['user_id']))
                                            echo $favorite->favorite_id;
                                          else
                                            echo '';
                                        } else
                                          echo ''; ?>" name="id">
            <input type="hidden" value="<?php echo $product->Product->user_id; ?>" name="SellerID">
            <input type="hidden" value="<?php echo $product->Product->product_id; ?>" name="ProductID">
            <input type="hidden" value="<?php if (!empty($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>" name="CustomerID">
            <button type="submit" class="btn btn-outline-light btn-sm" style="color:black !important;"><img src="main/images/<?php if (!empty($_SESSION['user_id'])) {
                                                                                                                                if ($favorite->GetFavorite($product->Product->product_id, $_SESSION['user_id']))
                                                                                                                                  echo 'heart-fill.png';
                                                                                                                                else
                                                                                                                                  echo 'heart.png';
                                                                                                                              } else
                                                                                                                                echo 'heart.png'; ?>" class="img-fluid rounded-start" style="width:30px; height:30px;" alt="..."><?php $favorite->GetFavorites($product->Product->product_id);
                                                                                                                                                                                                                                  echo count($favorite->Favorites); ?></button>
          </form><br>

          <?php if (!empty($_SESSION['user_id'])) { ?>
            <p class="text-right pr-5">  </p>
          <?php } ?>

        </div>

        <div class="card-body" style="margin-right:50px;">
          <?php if ($feedback->GetProductCustomersFeedbacks($product->Product->product_id)) {
            foreach ($feedback->Feedbacks as $key2 => $value2) { ?>
              <div class="d-flex flex-row justify-content-start">
                <a href="userprofile.php?id=<?php echo $value2->user_id; ?>"><img src="main/images/accounts/<?php if (!empty($value2->user_image)) {
                                                                                                              if (file_exists('main/images/accounts/' . $value2->user_image))
                                                                                                                echo $value2->user_image;
                                                                                                              else
                                                                                                                'avatar.png';
                                                                                                            } else
                                                                                                              'avatar.png'; ?>" alt="avatar 1" style="width: 45px; height: 60px">
                </a>
                <div class="d-flex flex-row justify-content-right mb-4" style="margin-left:6px;margin-right:6px;">
                  <div class="p-3 me-3 border" style="border-radius: 15px; background-color: #fbfbfb;">
                    <p class="small mb-0" ><?php echo $value2->feedback_msg; ?></p>

                  </div>

                </div>
              </div>
            <?php }
          }
          if (!empty($_SESSION['user_id'])) {
            ?>

            <form action="?id=<?php echo $product->Product->product_id; ?>#feedback" class="form-group-1" method="POST" id="feedback">
              <input type="hidden" name="process_type" value="feedback" />
              <input type="hidden" name="Owner" value="<?php if (!empty($_SESSION['user_id']))
                                                          echo $_SESSION['user_id']; ?>" />
              <input type="hidden" name="DataManager" value="Add">
              <input type="hidden" name="ProductID" value="<?php echo $product->Product->product_id; ?>">
              <input type="hidden" name="Type" value="0">
              <input type="hidden" name="CustomerID" value="<?php if (!empty($_SESSION['user_id']))
                                                              echo $_SESSION['user_id']; ?>">
              <div class="form-group-1">
                <div class="input-group-append" class="input-group mb-3">
                  <input name="MSG" type="text" size="40">
                  <button class="input-group-text-1" type="submit" style=" background-color: #216869;  color:#fff;"> ارسال </button>


                </div>
              </div>
            </form>
          <?php } ?>
        </div>


      </div>

      <br><br><br>
  <?php }
  } ?>

  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>
</body>

</html>