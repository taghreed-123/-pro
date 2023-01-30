<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>صفحة المتجر</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php");
  require_once('main/models/users-model.php');
  require_once('main/models/products-model.php');
  require_once('main/models/favorites-model.php');
  require_once('main/models/followers-model.php');
  $user = new UsersModel();
  $product = new ProductsModel();
  $favorite = new FavoritesModel();
  $follower = new FollowersModel();
  if (!empty($_SESSION['user_id'])) {
    if (!empty($_POST['type'])) {
      if ($_POST['type'] == "follow")
        require_once('main/controls/followers-manager.php');
    } else
      require_once('main/controls/favorites-manager.php');
  }
  if (!empty($_GET['id']))
    $user->GetUser($_GET['id']);
  if ($user->User != null) {
  ?>

    <div class="container">
      <div class="row">
        <?php require_once("main/parts/header.php"); ?>

      </div>
    </div>

    <br><br>
    <br><br>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
      <div class="col-12 text-right">
        <div style="position:relative; left:60px; top:1px;">
          <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
        </div>
      </div>

    <script src="js/popper.min.js"></script>

    <div class="container m-4">


      <div class="card text-right " style="width:1200px;">

        <div class="card-body">
          <form method="POST">
            <input type="hidden" name="type" value="follow" />
            <input type="hidden" value="<?php if (!empty($_SESSION['user_id'])) {
                                          if ($follower->GetFollower($user->User->user_id, $_SESSION['user_id']))
                                            echo $follower->followers_id;
                                          else
                                            echo '';
                                        } else
                                          echo ''; ?>" name="id">
            <input type="hidden" name="SellerID" value="<?php echo $user->User->user_id; ?>" />
            <input type="hidden" name="CustomerID" value="<?php if (!empty($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>" />
            <input type="hidden" value="<?php if (!empty($_SESSION['user_id'])) {
                                          if ($follower->GetFollower($user->User->user_id, $_SESSION['user_id']))
                                            echo 'Delete';
                                          else
                                            echo 'Add';
                                        } else
                                          echo 'Add'; ?>" name="DataManager">
            <?php
            $try = true;
            if (!empty($_SESSION['user_id'])) {
              if ($user->User->user_id == $_SESSION['user_id'])
                $try = false;
            }
            if ($try) { ?>
              <button type="submit" class="btn btn-outline-primary pr-600; float-left  <?php if (!empty($_SESSION['user_id'])) {
                                                                                          if ($follower->GetFollower($user->User->user_id, $_SESSION['user_id']))
                                                                                            echo 'active';
                                                                                          else
                                                                                            echo '';
                                                                                        } else
                                                                                          echo ''; ?>"><img src="main/images/<?php if (!empty($_SESSION['user_id'])) {
                                                    if ($follower->GetFollower($user->User->user_id, $_SESSION['user_id']))
                                                      echo 'followed.png';
                                                    else
                                                      echo 'follow.png';
                                                  } else
                                                    echo 'follow.png'; ?>" alt="متابعين" height="15" width="15"> متابعة </button>
            <?php } ?>
          </form>
          <div class="row g-0">
            <img src="main/images/accounts/<?php if (!empty($user->User->user_image)) {
                                              if (file_exists('main/images/accounts/' . $user->User->user_image))
                                                echo $user->User->user_image;
                                              else
                                                echo 'avatar.png';
                                            } else
                                              echo 'avatar.png'; ?>" alt="" style="width:120px;height:120px;">
            <div>
              <br />
              <h5 class="card-title align-self-center"> <?php echo $user->User->user_store; ?> </h5>
              <p><?php echo $user->User->user_email; ?></p>
            </div>
          </div>

          <p class="card-text"></p>
          <!--    <a href="#" class="btn btn-primary">Go somewhere</a> -->
        </div>
        <div class="card-footer ">
          <button type="button" class="btn btn-outline-secondary" data-toggle="collapse" data-target="#collapsefoolowers" aria-expanded="undefined" aria-controls="collapsefoolowers"> <img src="main/images/follow.png" alt="متابعين" height="15" width="15"> المتابعين </button>
          <?php if (!empty($_SESSION['user_type'])) {
            if ($_SESSION['user_type'] == 'business' && $_SESSION['user_id'] == $user->User->user_id) {
          ?>
              <a href="addPost.php"><button type="button" class="btn btn-outline-secondary" data-toggle="collapse" data-target="#collapseadd" aria-expanded="undefined" aria-controls="collapseadd"> <img src="img/plus.png" alt="اضافة منشور" height="15" width="15">اضافة منشور</button> </a>
              <a href="chat-list.php"><button type="button" class="btn btn-outline-secondary" data-toggle="collapse" data-target="#collapseadd" aria-expanded="undefined" aria-controls="collapseadd"> <img src="img/chat.png" alt="اضافة منشور" height="15" width="15">المحادثات</button> </a>

          <?php }
          } ?>



          <button type="button" class="btn btn-outline-secondary" data-toggle="collapse" data-target="#collapsepost" aria-expanded="undefined" aria-controls="collapsepost">المنشورات</button>

          <div class="collapse" id="collapsefoolowers">
            <div class="container">
              <div class="row ">
                <?php if ($follower->GetFollowers($user->User->user_id)) {
                  foreach ($follower->Followers as $key => $value) {
                ?>
                    <div class="<col-md-4 m-1 p-2">
                      <div class="row row-cols-1 row-cols-md-2 g-4">

                        <div class="card mb-3 m-2" style="width: 360px;">
                          <div class="row g-0">
                            <div class="col-md-3">
                              <img src="main/images/accounts/<?php if (!empty($value->user_image)) {
                                                                if (file_exists('main/images/accounts/' . $value->user_image))
                                                                  echo $value->user_image;
                                                                else
                                                                  echo 'avatar.png';
                                                              } else
                                                                echo 'avatar.png'; ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="row align-items-end">
                              <div class="col-8- p-1">
                                <div class="card-body">
                                  <h5 class="card-title text-right"><a href="<?php if ($value->user_type == 'user' || $value->user_type == 'admin')
                                                                                echo 'userprofile.php?id=' . $value->user_id;
                                                                              else if ($value->user_type == 'business')
                                                                                echo 'storeProfile.php?id=' . $value->user_id;
                                                                              else
                                                                                echo ''; ?>"><?php echo $value->user_full_name; ?></a></h5>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
            </div>
          </div>

          <div class="collapse " id="collapsepost">

            <div class="container">
              <div class="row ">
                <div class="<col-md-4 m-1">
                  <div class="row row-cols-2 row-cols-3">
                    <?php $product->GetUserProducts($user->User->user_id);
                    if ($product->Products != null) {
                      foreach ($product->Products as $key => $value) {
                    ?>
                        <div class="card mb-3 m-2" style="width: 371px;height:400px;"> <!-- start of a card -->
                          <div class="row">
                            <div class="col pr-4 pl-4 pb-1 pt-1 text-left">
                              <a href="postdetails.php?id=<?php echo $value->product_id; ?>">
                                <img src="main/images/products/<?php if (file_exists('main/images/products/' . $value->product_image))
                                                                  echo $value->product_image;
                                                                else
                                                                  echo 'default.png'; ?>" class="card-img pb-1" style="width:348px; height:345px; " alt="...">
                                <br>
                              </a>
                              <?php echo $value->product_name; ?>
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
                                <input type="hidden" value="<?php if (!empty($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>" name="CustomerID">
                                <button type="submit" class="btn btn-outline-light btn-sm" style="color:black !important;"><img src="main/images/<?php if (!empty($_SESSION['user_id'])) {
                                                                                                                                                    if ($favorite->GetFavorite($value->product_id, $_SESSION['user_id']))
                                                                                                                                                      echo 'heart-fill.png';
                                                                                                                                                    else
                                                                                                                                                      echo 'heart.png';
                                                                                                                                                  } else
                                                                                                                                                    echo 'heart.png'; ?>" class="img-fluid rounded-start" style="width:30px; height:30px;" alt="..."><?php $favorite->GetFavorites($value->product_id);
                                                                                                                                                                                                                                                      echo count($favorite->Favorites); ?></button>
                              </form><br>

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

  <?php } ?>
  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>

</body>

</html>