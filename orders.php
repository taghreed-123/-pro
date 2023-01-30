<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>لوحة التحكم</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>
  <div class="container">
    <?php require_once("main/connection.php");
    require_once("main/models/orders-model.php");
    $order = new OrdersModel();
    $order->GetAllOrders();

    if (!empty($_GET['id'])) {
      $order->order_id = $_GET['id'];
      if ($order->DeleteOrder()) {
        echo "<p class='alert alert-success'>  بنجاح ( " . $_GET['id'] . " ) لقد تم حذف.</p>";
      } else
        echo "<p class='alert alert-danger'>  بنجاح ( " . $_GET['id'] . " ) لم يتم حذف</p>";
    }
    ?>
    <?php require_once("main/parts/admin_header.php"); ?>
    <a href="orderDetails.php?type=new" class="btn btn-primary" style="color:white;">اضافة جديد</a>
    <div class="table-responsive">
      <table class="table">
        <caption class="text-right"> الطلبات (<?php echo count($order->Orders); ?>)</caption>
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">الشركه</th>
            <th scope="col">العميل</th>
            <th scope="col">المتجر</th>
            <th scope="col">السعر</th>
            <th scope="col">الخامه</th>
            <th scope="col">العرض</th>
            <th scope="col">الطول</th>
            <th scope="col">الحاله</th>
            <th scope="col">الصوره</th>
            <th scope="col">ملاحظات</th>
            <th scope="col">التاريخ</th>
            <th scope="col">تعديل</th>
            <th scope="col">حذف</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($order->Orders != null) {
            foreach ($order->Orders as $key => $value) {
          ?>
              <tr>
                <th scope="row"><?php echo $value->order_id; ?></th>
                <td><?php echo $value->user_store; ?></td>
                <td><?php echo $value->order_user_id; ?></td>
                <td><?php echo $value->user_store; ?></td>
                <td><?php echo $value->order_price; ?></td>
                <td><?php echo $value->order_type; ?></td>
                <td><?php echo $value->order_width; ?></td>
                <td><?php echo $value->order_height; ?></td>
                <td><?php echo $value->order_status; ?></td>
                <td><?php
                if(!empty($value->order_image)){ ?>
                  <img width="40" height="40" src="main/images/orders/<?php echo $value->order_image; ?>">
               <?php } else
                  echo "No image";
                ?></td>
                <td><?php echo $value->order_notes; ?></td>
                <td><?php echo $value->order_date; ?></td>
                <td><a href="orderDetails.php?id=<?php echo $value->order_id; ?>">تعديل</a></td> 
                <td><a href="orders.php?id=<?php echo $value->order_id; ?>" id="delete-order" name="<?php echo $value->product_name; ?>" onclick="return confirm('Are you sure you want to delete ( '+document.getElementById('delete-order').getAttribute('name')+' ) order ');">حذف</a></td>

              </tr>
          <?php }
          } ?>

        </tbody>
      </table>
    </div>

    <?php
    require_once("main/parts/footer.php");
    require_once("main/parts/script.php"); ?>
  </div>
</body>

</html>