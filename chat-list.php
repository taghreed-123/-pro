<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>محادثة</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php");
  require_once('main/models/followers-model.php');
  $follower = new FollowersModel();

  if(!empty($_SESSION['user_id'])){
    if($_SESSION['user_type']=='business')
      $follower->GetFollowers($_SESSION['user_id']);
    else 
      $follower->GetFollowed($_SESSION['user_id']);
  }
  
  ?>

  <div class="container">
    <div class="row">
      <?php require_once("main/parts/header.php"); ?>

      <div class="col-12 text-right">
        <nav class=" navbar fixed-top navbar-expand-sm justify-content" style="background-color:white;height:60px;">

          <div class="col-1">
            <a href="main.php" class="navbar-brand"><img src="img/logo.png" alt="Logo" style="width:60px;height:60px;"></a>
          </div>

          <div class="title-chat">

            <ul class="nav justify-content-center nav-tabs">
              <li>
                <p style="  color:#216869;"> المحادثة</p>
              </li>

            </ul>
          </div>
          <div class="col-3">
            <ul class="navbar nav justify-content-end ">
              <li class="nav-item">
                <p>
                <ul>


                  <div class="arrow-back-from-chat">
                    <i><a href="ActiveOrder.php"> <svg class="bi bi-arrow-left " style="color:#216869;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg></a>
              </li>
          </div>



          </ul>
          </p>


          </ul>
      </div>
      </nav>
    </div>
    <br><br>
    <br><br>

  </div>
  </div>




  </nav>

  <div class="card-body" id="chat-card-body">
  <?php
  if (!empty($_SESSION['user_id'])) {
      foreach ($follower->Followers as $key => $value) { ?>
      <a href="chat-company.php?user_id=<?php echo $value->user_id;?>">
      <div class="card mb-3" >
  <div class="row no-gutters">
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $value->user_full_name;?></h5>
        <p class="card-text"><?php echo $value->user_notes; ?></p>
        
      </div>
      
    </div>
    <div class="col-md-4" style="max-height:200px;max-width:200px;">
      <img src="main/images/accounts/<?php if (!empty($value->user_image)) {
        if (file_exists($value->user_image))
          echo $value->user_image;else echo 'avatar.png';}else echo 'avatar.png';?>" class="card-img" style="max-height:200px;max-width:200px;" alt="...">
    </div>
  </div>
</div>
      </a>
     <?php  }
    }?>

  </div>

  <script>setTimeout(function () {
                      document.load('body');
                    }, 2000);</script>
  <?php require_once("main/parts/script.php"); ?>

</body>

</html>