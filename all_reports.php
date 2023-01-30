<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> حالة البلاغات</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php");
  require_once("main/models/complaints-model.php");
  $complaint = new ComplaintsModel();
  require_once("main/controls/complaints-manager.php");
  if (!empty($_GET['complaint_id']) && !empty($_GET['status'])) {
    if ($complaint->ChangeComplaintStatus($_GET['complaint_id'], $_GET['status'])) {
      $response = "تمت العملية بنجاح";
    } else
      $response = "Error \n" . "خطا في تنفيذ العملية";
  } else if (!empty($_GET['id'])) {
    $complaint->complaint_id = $_GET['id'];
    if ($complaint->DeleteComplaint())
      $response = "تم الحذف بنجاح";
    else
      $response = "Error.<br/> لم يتم الحذف";
  }
  ?>

  <div class="container">
    <br><br><br>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" || !empty($_GET['complaint_id']) || !empty($_GET['id'])) {
      if (!empty($response)) {
        if (!str_contains($response, "Error")) {
          echo "<p class='alert alert-success'>" . $response . ".\n</p>";
        } else
          echo "<p class='alert alert-danger'>" . $response . ".</p>";
      }
    } ?>
    <div class="row">
      <?php
      if(!empty($_SESSION['user_id'])){
        if($_SESSION['user_type']=='admin')
        require_once("main/parts/admin_header.php"); 
      else
        require_once("main/parts/header.php"); 
      }else
        require_once("main/parts/header.php"); ?>

      <br><br>
      <br><br>
      <div class="col-12 text-right">
        <div style="position:relative; left:60px; top:1px;">
          <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
        </div>
      </div>
    </div>
    <br><br>



    <div class=" text-right">
      <p>الشكاوي المرسلة: </p>

      <table class="table table-responsive-lg " style="width:50%;">
        <?php
        if (!empty($_SESSION['user_type'])) {
          if ($_SESSION['user_type'] == "admin")
            $complaint->GetAllComplaints();
          else if ($_SESSION['user_type'] == "business" || $_SESSION['user_type'] == "user")
            $complaint->GetSellerCustomersComplaints($_SESSION['user_id']);
          else
            $complaint->Complaints = null;
          if ($complaint->Complaints != null) {
            foreach ($complaint->Complaints as $key => $value) {
        ?>
              <tr>
                <th style="border-bottom-right-radius:10%; border-top-right-radius:10%;">رقم الطلب: </th>
                <td><?php echo $value->order_id; ?></td>
                <th style="min-width:120px;">حالة الطلب: </th>
                <td style="border-bottom-left-radius:10%; border-top-left-radius:10%;min-width:150px;">
                  <?php if (!empty($_SESSION['user_id'])) {
                    if ($_SESSION['user_type'] == 'business') { ?>
                      <select name="OrderProductID" class="select form-control" id="id_type_<?php echo $key; ?>" style="display:block !important;" onchange="document.location=document.getElementById('id_type_<?php echo $key; ?>').value;">
                        <option value="all_reports.php?complaint_id=<?php echo $value->complaint_id; ?>&status=0" <?php if ($value->complaint_type == 0)
                                                                                                                    echo 'selected'; ?>>قيد المراجعه</option>
                        <option value="all_reports.php?complaint_id=<?php echo $value->complaint_id; ?>&status=1" <?php if ($value->complaint_type == 1)
                                                                                                                    echo 'selected'; ?>>ارجاع المال</option>
                        <option value="all_reports.php?complaint_id=<?php echo $value->complaint_id; ?>&status=2" <?php if ($value->complaint_type == 2)
                                                                                                                    echo 'selected'; ?>>اعادة تصنيع</option>
                        <option value="all_reports.php?complaint_id=<?php echo $value->complaint_id; ?>&status=3" <?php if ($value->complaint_type == 3)
                                                                                                                    echo 'selected'; ?>>ليست هناك مشكله</option>

                      </select>
                    <?php } else { ?>
                      <?php if ($value->complaint_type == 0)
                        echo 'قيد المراجعه';
                      else if ($value->complaint_type == 1)
                        echo "ارجاع المال";
                      else if ($value->complaint_type == 2)
                        echo "اعادة تصنيع";
                      else if ($value->complaint_type == 3)
                        echo "ليست هناك مشكله"; ?>
                  <?php }
                  } ?>
                </td>
                <th>
                  الشكوى
                </th>
                <td>
                  <?php echo $value->complaint_msg; ?>
                </td>
                <th>
                  الملاحظات
                </th>
                <td>
                  <?php echo $value->complaint_notes; ?>
                </td>
                <td>
                  <?php
                  if (!empty($value->complaint_image)) { ?>
                    <a href="main/images/complaints/<?php echo $value->complaint_image; ?>">
                      <img src="main/images/complaints/<?php echo $value->complaint_image; ?>" style="min-width:70px;max-height:70px;" class="card form-control">
                    </a>
                  <?php }
                  ?>
                </td>
                <?php if ($_SESSION['user_type'] == "admin" ) { ?>
                  <!-- <td> -->
                    <!-- <a class="btn btn-primary" href="post_report.php?complaint_id=<?php //echo $value->complaint_id; ?>" role="button" style=" color:#fff; border-radius: 15px; background-color: #216869;  border: 2px solid #495057; padding: 2px 15px 2px 15px;margin-top: 3px;  margin-bottom: 3px;">تعديل </a> -->
                  <!-- <td> -->
                  <!-- <td>
                    <a class="btn btn-primary" href="all_reports.php?id=<?php //echo $value->complaint_id; ?>" role="button" style=" color:#fff; border-radius: 15px; background-color: #216869;  border: 2px solid #495057; padding: 2px 15px 2px 15px;margin-top: 3px;  margin-bottom: 3px;">حذف </a>
                  <td> -->
                    <!-- <td>
                    <a class="btn btn-primary" href="chat-user.php?order_id=<?php //echo $value->complaint_order_id; ?>" role="button" style=" color:#fff; border-radius: 15px; background-color: #216869;  border: 2px solid #495057; padding: 2px 15px 2px 15px;margin-top: 3px;  margin-bottom: 3px;">دردشه </a>
                  <td> -->
                  <?php } ?>

              </tr>
        <?php }
          }
        }
        ?>

      </table>


    </div>
  </div>



  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>

</body>

</html>