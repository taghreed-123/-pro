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
    require_once('main/models/feedbacks-model.php');
    require_once('main/models/orders-model.php');
  $feedback = new FeedbacksModel();
  $order=new OrdersModel();
  require_once('main/controls/feedbacks-manager.php');
  if(!empty($_GET['order_id'])){
    $order->GetOrderDetails($_GET['order_id']);
  }
  if (!empty($_SESSION['user_id'])) {
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
  <nav class="bar-control-chat">

  </nav>


  <div class="card-body" id="chat-card-body">
  <?php
  if (!empty($_GET['order_id']) && !empty($_SESSION['user_id'])) {
    if ($feedback->GetSellerCustomersOrdersFeedbacks($order->Order->user_id, $_SESSION['user_id'], $order->Order->order_id, $_SESSION['user_type'])) {
      foreach ($feedback->Feedbacks as $key => $value) {
        if ($value->feedback_owner != $_SESSION['user_id']) {
          ?>
      <div class="d-flex flex-row justify-content-right mb-4">
      <div class="p-3 me-3 border" style="border-radius: 15px; background-color: #fbfbfb;">
        <p class="small mb-0 "><?php echo $value->feedback_msg; ?></p>

      </div>

    </div>
    <?php } else { ?> 
    <div class="d-flex flex-row justify-content-end mb-4 ">
      <div class="p-3 me-3 border" style="border-radius: 15px; background-color: #90EE90;">
        <p class="small mb-0"><?php echo $value->feedback_msg; ?></p>
      </div>

    </div>
    <?php }
      }
    }
  } ?>
    <div id="bottom-el" autofocus>

<br/>
</div>
    <form class="form-group-1 " action="?<?php echo 'order_id=' . $_GET['order_id']; ?>" method="POST" id="feedback">
            <input type="hidden" name="DataManager" value="Add">
            <input type="hidden" name="OrderID" value="<?php if (!empty($_GET['order_id']))
              echo $order->Order->order_id; ?>">
            <input type="hidden" name="Owner" value="<?php if (!empty($_SESSION['user_id']))
              echo $_SESSION['user_id']; ?>"/>
            <input type="hidden" name="Type" value="1">
            <input type="hidden" name="SellerID" value="<?php if (!empty($_SESSION['user_type']))if ($_SESSION['user_type'] == 'business')
              echo $_SESSION['user_id'];
            else
              echo $order->Order->order_store_id; ?>">
            <input type="hidden" name="CustomerID" value="<?php if (!empty($_SESSION['user_type']))if ($_SESSION['user_type'] == 'business')
              echo $order->Order->order_user_id;
            else
              echo $_SESSION['user_id']; ?>">
              <div  class="navbar fixed-bottom navbar-expand-lg bg-light">
      <div class="form-group-1">
        <div class="input-group-append">
        <input name="MSG" type="text" id="MSG" size="100" value="<?php if (!empty($_GET['msg']))
          echo $_GET['msg']; ?>">

          <button class="input-group-text-1" type="submit" style="color:#495057;"> ارسال </button>

        </div>
      </div>
</div>
    </form>

  </div>
  <script>
    setFocusToTextBox();
function setFocusToTextBox(){
    document.getElementById("bottom-el").focus({preventScroll:true});
    document.getElementById("bottom-el").scrollIntoView();
}
  
  document.getElementById('bottom-el').focus();
  setTimeout(function () {
    document.location="chat-user.php?<?php echo 'order_id=' . $_GET['order_id']; ?>&msg="+document.getElementById('MSG').value;
                    }, 10000);
</script>
<?php } else {
    echo "<p class='alert alert-danger'>You must be signed in to have access to this page<br/>You will redirected to the login page</p>";
    echo "<script>setTimeout(function () {
      document.location='login.php';
    }, 2000);</script>";
  }?>
<?php require_once("main/parts/script.php"); ?>

</body>

</html>