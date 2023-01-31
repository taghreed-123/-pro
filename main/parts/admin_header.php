<div class="container">
  <div class="row">
    <div class="col-12 text-right">
      <nav class=" navbar fixed-top navbar-expand-sm justify-content" style="background-color:white;height:60px;">

        <div class="col-1">
          <a href="Users.php" class="navbar-brand"><img src="img/logo.png" alt="Logo" style="width:60px;height:60px;"></a>
        </div>
        <div class="col-2">

          <button class="btn bg-white" data-toggle="collapse" data-target="#demo" type="submit"><img src="img/search1.png" alt="search" style="width:20px;height:20px;"></button>
          <div id="demo" class="collapse">

          </div>

        </div>
        <div class="col-6">


          <ul class="navbar nav justify-content-center nav-tabs">
            <li class="nav-item"><a href="Users.php" class="nav-link <?php if ($active_page == 'Users.php')
                                                                        echo 'active'; ?>" style="color:teal;">الحسابات</a> </li>
            <li class="nav-item"><a href="categories.php" class="nav-link  <?php if ($active_page == 'categories.php')
                                                                              echo 'active'; ?>" style="color:teal;">التصنيفات</a> </li>
            <li class="nav-item"><a href="products.php" class="nav-link  <?php if ($active_page == 'products.php')
                                                                            echo 'active'; ?>" style="color:teal;">المنتجات</a> </li>
                    <!-- <li class="nav-item"><a href="orders.php" class="nav-link  <?php if ($active_page == 'orders.php')
                                                                            echo 'active'; ?>" style="color:teal;">الطلبات</a> </li> -->
          </ul>
        </div>
        <div class="col-3">
          <ul class="navbar nav justify-content-end ">
            <li class="nav-item">
              <div class="dropdown col-12 form-group mb-3">
                <a style="color:teal;"><?php if (!empty($_SESSION['user_full_name']))
                                          echo $_SESSION['user_full_name'];
                                        else echo "المستخدم"; ?> <img src="main/images/accounts/<?php if (!empty($_SESSION['user_image'])) {
                                                                                                  if (file_exists('main/images/accounts/' . $_SESSION['user_image']))
                                                                                                    echo $_SESSION['user_image'];
                                                                                                  else
                                                                                                    echo 'avatar.png';
                                                                                                } else echo 'avatar.png'; ?>" alt="" style="width:40px;height:40px;"></a>
                <button type="button" class="btn dropdown-toggle bg-white" data-toggle="dropdown"></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?php if ($_SESSION['user_type'] == 'user')
                                                    echo 'userProfile.php';
                                                  else if ($_SESSION['user_type'] == 'business')
                                                    echo 'storeProfile.php?id=' . $_SESSION['user_id'];
                                                  else
                                                    echo 'userProfile.php?id=' . $_SESSION['user_id']; ?>">الملف الشخصي</a>
                  <a class="dropdown-item" href="all_reports.php">الشكاوي</a>
                  <a class="dropdown-item" href="editProfile.php?id=<?php echo $_SESSION['user_id']; ?>"><img src="main/images/setting.png" style="width:20px;height:20px;" /> اعدادات الحساب</a>
                  <a class="dropdown-item" href="login.php?logout=1"> <img src="img/logout.png" alt="logout" style="width:20px;height:20px;"> تسجيل خروج </a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <br><br>
    <br><br>
  </div>
</div>
<!-- <div class="row">
    <div class="col-2">
      <div style="position:relative; left:60px; top:1px;">
        <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
      </div>
    </div>
  </div> -->
