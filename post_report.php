<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>البلاغات</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php");

  require_once("main/models/orders-model.php");
  require_once("main/models/complaints-model.php");

  $complaint = new ComplaintsModel();
  $order = new OrdersModel();
  require_once("main/controls/complaints-manager.php");
  $Values = null;
  if (!empty($_GET['order_id'])) {
    $order->GetOrderDetails($_GET['order_id']);
    $Values = $order->Order;
  } else if (!empty($_GET['complaint_id'])) {
    $complaint->GetComplaintDetails($_GET['complaint_id']);
    $Values = $complaint->Complaint;
  } else if (!empty($_POST['complaint_id'])) {
    $complaint->GetComplaintDetails($_POST['complaint_id']);
    $Values = $complaint->Complaint;
  }
  ?>

  <div class="container">
    <br />
    <br />
    <br />
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" || !empty($_GET['id'])) {
      if (!empty($response)) {
        if (!str_contains($response, "Error")) {
          echo "<p class='alert alert-success'>" . $response . ".\n</p>";
        } else
          echo "<p class='alert alert-danger'>" . $response . ".</p>";
      } else
        echo "<p class='alert alert-danger'>" . $response . ".</p>";
    } ?>
    <div class="row">
      <?php require_once("main/parts/header.php"); ?>

      <br><br>
      <br><br>
      <div class="col-12 text-right">
        <div style="position:relative; left:60px; top:1px;">
          <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
        </div>
      </div>
      <br><br>



      <form class="form-inline" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="DataManager" value="<?php if (!empty($_GET['complaint_id']))
                                                          echo "Edit";
                                                        else
                                                          echo "Add"; ?>">
        <input type="hidden" name="id" value="<?php if (!empty($_GET['complaint_id'])) echo $Values->complaint_id; ?>">
        <input type="hidden" name="LastImageName" value="<?php if (!empty($_GET['complaint_id'])) echo $Values->complaint_image; ?>">
        <input type="hidden" name="SellerID" value="<?php if (!empty($_GET['complaint_id']) || !empty($_GET['order_id'])) echo $Values->user_id; ?>">
        <input type="hidden" name="CustomerID" value="<?php if (!empty($_GET['complaint_id'])) {
                                                        if (!empty($Values->complaint_customer_id))
                                                          echo $Values->complaint_customer_id;
                                                        else if (!empty($_SESSION['user_id'])) echo $_SESSION['user_id'];
                                                      } else if (!empty($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>">
        <input type="hidden" name="Type" value="0">
        <div class="col-12 form-group mb-3">
          <label for="IdOrd"> رقم الطلب: </label>
        </div>
        <div class="col-12 form-group mb-3">
          <select name="OrderID" class="select form-control" id="id_type" style="display:block !important;">
            <?php if ($order->GetReportAllOrders()) {
              foreach ($order->Orders as $key => $value) {
            ?>
                <option value="<?php echo $value->order_id; ?>" <?php if (!empty($_GET['order_id'])) if ($_GET['order_id'] == $value->order_id)
                                                                  echo 'selected'; ?>><?php echo $value->order_id.''.' - '.$value->user_store; ?></option>
            <?php }
            } ?>
          </select>
        </div>

        <div class="col-12 form-group  mb-3">
          <label for="problemDetails"> وصف الشكوى:</label>
        </div>
        <div class="col-12 form-group  mb-3">
          <textarea class="form-control-plaintext" name="MSG" style="background-color:white;" rows="5" id="problemDetails" name="problemDetails" placeholder="اكتب الشكوى هنا"><?php if (!empty($_GET['complaint_id'])) echo $Values->complaint_msg; ?></textarea>
        </div>
        <?php if (!empty($_GET['complaint_id'])) {
          if (!empty($Values->complaint_image)) { ?>
            <img src="main/images/complaints/<?php echo $Values->complaint_image; ?>" style="max-height:200px;" class="card form-control">
        <?php }
        } ?>
        <div class="col-12 form-group  mb-3">

          <label for="imageOfproblem"> ارفاق صورة: </label>
          <input type="file" class="form-control" name="Image" alt="ارفاق صورة" width="30" height="30">

        </div>

        <br>

        <button type="submit" class="btn btn-primary btn-md"> إرسال </button>

      </form>

    </div>
  </div>


  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>

</body>

</html>