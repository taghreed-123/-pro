<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>محادثة</title>
  <?php require_once("main/parts/style.php"); ?>

</head>
<sscript>

</script>
<body onload="setFocusToTextBox()">

  <?php require_once("main/connection.php");
    require_once('main/models/feedbacks-model.php');
  $feedback = new FeedbacksModel();
  require_once('main/controls/feedbacks-manager.php');
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

  </div>
  </div>


  </nav>


  <div class="card-body" id="chat-card-body">
  <?php
  $id=0;
  if(!empty($_GET['user_id']))
  $id=$_GET['user_id'];
  else if(!empty($_POST['user_id']))
  $id=$_POST['user_id'];
  else 
  $id=0;

  if ($id!=0 && !empty($_SESSION['user_id'])) {
    if ($feedback->GetSellerCustomersOrdersFeedbacksPrivate($id,$_SESSION['user_id'],$_SESSION['user_type'])) {
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
  }?>
  <div id="bottom-el" autofocus>

  <br/>
  <br/>
  <br/>
  <br/>
</div>
    <form class="form-group-1 " action="chat-company.php?<?php echo 'user_id='.$id;?>" method="POST" id="feedback" onfocus="document.getElementById('bottom-el').focus({preventScroll:true});">
            <input type="hidden" name="DataManager" value="Add">
            <input type="hidden" name="ProductID" value="">
            <input type="hidden" name="OrderID" value="">
            <input type="hidden" name="Owner" value="<?php if (!empty($_SESSION['user_id']))
              echo $_SESSION['user_id']; ?>"/>
            <input type="hidden" name="Type" value="2">
            <input type="hidden" name="SellerID" value="<?php if ($_SESSION['user_type'] == 'business')
              echo $_SESSION['user_id'];else echo $id;?>">
            <input type="hidden" name="CustomerID" value="<?php if ($_SESSION['user_type'] == 'business') {
              echo $id;
            }
              else echo $_SESSION['user_id']; ?>">
              <div  class="navbar fixed-bottom navbar-expand-lg bg-light">
      <div class="form-group-1">
        <div class="input-group-append">
        <input name="MSG" id="MSG" type="text" size="100" value="<?php if (!empty($_GET['msg']))
          echo $_GET['msg'];?>">

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
    document.location="chat-company.php?<?php echo 'user_id='.$id;?>&msg="+document.getElementById('MSG').value;
                    }, 10000);
</script>
  <?php require_once("main/parts/script.php"); ?>

</body>

</html>