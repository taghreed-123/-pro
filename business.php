<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل صاحب المتجر</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>

  <?php require_once("main/connection.php"); ?>

  <div class="container mg-5">
    <div class="row">
      <?php require_once("main/parts/header.php"); ?>

      <div class="col-2 text-center">

      </div>
      <div class="col-8 text-center">
        <a href="main.php"><img src="img/logo.png" alt="logo" class="rounded mx-auto d-block" height="250" width="250"></a>
        <h1 class="display-4" dir="rtl" float-right>اهلا ومرحباً بك!</h1>
        <p class="lead" dir="rtl" float-right>من فضلك قم بإدخال البيانات بشكل صحيح</p>
        <hr class="my-4">
        <form dir="rtl">
          <div class="form-group">
            <input type="name" class="form-control" id="exampleInputPassword1" placeholder="الأسم بالكامل">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="البريد الإلكتروني ">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور">
          </div>
          <div class="form-group">
            <input type="location" class="form-control" id="exampleInputPassword1" placeholder="الموقع">
          </div>
          <!-- checkbox -->
          <p>للموافقة على الشروط: <a href="" class="text-primary" data-toggle="modal" data-target="#myModal">اضغط هنا</a></p>

          <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"> الموافقة على الشروط</h4>
                </div>
                <div class="modal-body  text-right" dir="rtl">
                  <h6>شروط الموقع:</h6>
                  <p>اذا كنت ترغب بإستعمال هذا الموقع (بالسانتي) فأنت ملزم بالموافقة على الشروط التالية:</p>
                  <ol>
                    <li> يجب الإلتزام بطلب العميل وتوصيله بالوقت المناسب.</li>
                    <li>في حال عدم الإلتزام بطلب العميل فأنت ملزم تقوم بإجراءات (ارجاع المبلغ للعميل – او إعادة تصنيع المنتج)</li>
                  </ol>
                  <h6>شروط التسجيل</h6>
                  <ul>
                    <li>يلزم اختيار اسم لائق ومناسب خلال عملية التسجيل.</li>
                    <li>يُمنع استخدام اكثر من عضوية في الموقع لكل شخص أو جهة.</li>
                    <li>يجب ان تقوم بتحديث رقم جوالك المرتبط بالعضوية في حال تغيير رقم جوالك او فقدانه.</li>
                    <li>اذا كان اسم عضويتك يحتوي على اسم تجاري أو علامة تجارية ، يجب ان تكون المالك للعلامة التجارية او مخول لك باستخدام الاسم او العلامة التجارية.</li>
                  </ul>
                  <h6>شروط اضافة محتوى للموقع</h6>
                  <ul>
                    <li>تتعهد بعدم الإعلان عن أي سلعة ممنوعة بالموقع.</li>
                    <li>تتعهد بعدم اضافة أي ردود ممنوعة بالموقع.</li>
                    <li>تتعهد بعدم ارسال أي رسائل ممنوعة بالموقع.</li>
                    <li>تتعهد بتحديد سعر بيع السلعة المعلن عنها.</li>
                    <li> تتعهد بمتابعة إعلانك والرد على استفسارات العملاء من خلال الردود او من خلال الرسائل الخاصة.</li>
                    <li>تتعهد بالالتزام بسياسة الإعلانات المكررة.</li>
                    <li>يلزم أن تكون المادة الإعلانية المعلن عنها سلعة أو خدمة فقط.</li>
                    <li>يحق للموقع حذف أي إعلان من دون ذكر سبب الحذف.</li>
                    <li> يُمنع نسخ أي إعلان من الموقع.</li>
                    <li> تتعهد بعدم الإعلان لشخص لا تعرفه او التسجيل لشخص لا تعرفه</li>
                    <li>لإنشاء والتحديث والتعديل مسؤولية المستخدم (صاحب المتجر).</li>
                  </ul>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">

                  <label class="form-check-label" for="exampleCheck1">&nbsp; &nbsp; الموافقة على الشروط </label>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"> خروج</button>
                  <button type="button" class="btn btn-primary">حفظ</button>
                </div>
              </div>
            </div>
          </div>
          <br>

          <button type="submit" class="btn btn-primary">تسجيل</button>
        </form>
        <br>
        <p> هل لديك حساب؟ <a href="login.php" class="text-danger">تسجيل الدخول</a> </p>


      </div>

    </div>
  </div>
  </div>

  </div>

  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>

</body>

</html>