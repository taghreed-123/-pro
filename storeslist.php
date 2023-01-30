<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>المتاجر</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php");
  require_once('main/models/users-model.php');
  require_once('main/models/followers-model.php');
  $user = new UsersModel();
  $follower = new FollowersModel();
  if(!empty($_POST['Search'])){
    $user->GetSearchUsersProducts($_POST['Search']);
  }else
  $user->GetUsersStores();
  ?>

  <!-- navbar -->

  <div class="container">
    <div class="row">
      <?php require_once("main/parts/header.php"); ?>

      <br><br>
      <br><br>
    </div>
  </div>
  <div class="row">
    <div class="col-1">
      <div style="position:relative; left:40px; top:1px;">
        <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
      </div>
    </div>
  </div>



  <!-- cards -->
  <div class="container">
    <div class="row ">
      <div class="<col-md-4 m-1">
        <div class="row row-cols-1 row-cols-md-2 g-4">
          <?php if ($user->Users != null) {
            foreach ($user->Users as $key => $value) {
          ?>
              <div class="card mb-3 m-2" style="width: 360px;">
                <div class="row g-0">
                  <div class="col-md-3">
                    <img src="main/images/accounts/<?php if (!empty($value->user_image)) {
                      if (file_exists('main/images/accounts/' . $value->user_image))
                        echo $value->user_image;
                      else
                        echo 'avatar.png';
                    }else
                    echo 'avatar.png'; ?>" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="row align-items-end">
                    <div class="col-8- p-1">
                      <div class="card-body">
                        <a href="storeProfile.php?id=<?php echo $value->user_id; ?>" style="color:teal; color:black">
                          <h5 class="card-title text-right"><?php echo $value->user_store; ?></h5>
                        </a>
                        <p class="card-text"><?php echo $value->user_notes; ?></p>
                        <p class="text-right">المتابعين : <?php $follower->GetFollowers($value->user_id);
                        echo count($follower->Followers);?></p>
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
  </div>

  <br><br>

  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>

</body>

</html>