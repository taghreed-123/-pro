<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كلمة مرور جديدة</title>
    <?php require_once("main/parts/style.php"); ?>

</head>

<body>

    <?php require_once("main/connection.php"); ?>

    <div class="container">
        <br />
        <br />
        <div class="col-12 text-right">
        <div style="position:relative; left:60px; top:1px;">
          <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
        </div>
      </div>
        <div class="col-md-11 text-right">
            <div class="jumbotron bg-white" dir="rtl">
                <div style="position:relative; left:10px; top:1px;">
                    <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
                </div>
                <div class="col-md-11 text-right">
                    <div class="jumbotron bg-white" dir="rtl">
                        <img src="img/logo.png" alt="logo" class="rounded mx-auto d-block" height="150" width="150">

                        <hr class="my-4">
                        <form>
                            <div class="form-group mb-3">
                                <label for="exampleFormControlInput1" class="form-label">كلمة المرور الجديدة: </label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleFormControlInput1" class="form-label">تأكيد كلمة المرور</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-md">تحديث</button>
                        </form>
                        <br>

                    </div>

                </div>
            </div>
        </div>

    </div>

    <?php require_once("main/parts/footer.php"); ?>
    <?php require_once("main/parts/script.php"); ?>

</body>

</html>