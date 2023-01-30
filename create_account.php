<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>مستخدم جديد</title>
  <?php require_once("main/parts/style.php"); ?>

</head>

<body>
  <?php require_once("main/connection.php"); ?>
  <?php
  if ($con) {
  ?>
  <?php require_once("main/controls/users-manager.php");
    require_once("main/models/categories-model.php");
    require_once("main/models/users-model.php");
    $category = new CategoriesModel();
    $user = new UsersModel();
  } else {
    $response = "Error \n" . "خطا في الاتصال بقاعدة البيانات";
  }
  ?>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="DataManager" value="Add" />
    <div class="container mg-5">
      <?php
      $process = true;
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($response)) {
          if (!str_contains($response, "Error")) {
            $process = false;
            echo "<p class='alert alert-success'>" . $response . ".\nسوف يتم تحويلك لتسجيل الدخول...</p>";
            echo "<script>setTimeout(function () {
              document.location='login.php';
            }, 2000);</script>";
          } else
            echo "<p class='alert alert-danger'>" . $response . ".</p>";
        } else
          echo "<p class='alert alert-danger'>" . $response . ".</p>";
      }
      if ($process) {
      ?>
        <div class="row">
          <div style="position:relative; left:1100px; top: 4px;">
            <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
          </div>
          <div class="col-2 text-center">

          </div>
          <div class="col-8 text-center">
            <a href="main.php"><img src="img/logo.png" alt="logo" class="rounded mx-auto d-block" height="250" width="250"></a>
            <h1 class="display-4" dir="rtl" float-right>اهلا ومرحباً بك!</h1>
            <p class="lead" dir="rtl" float-right>من فضلك قم بإدخال البيانات بشكل صحيح</p>
            <hr class="my-4">
            <form dir="rtl" class="text-right">
              <div class="form-group text-right">
                <label class="form-label ">* الأسم بالكامل</label>
                <input type="name" class="form-control  text-right" name="UserFullName" id="inputName" placeholder="* الأسم بالكامل" required>
              </div>
              <div class="form-group text-right">
                <label class="form-label ">* البريد الالكتروني</label>
                <input type="email" class="form-control  text-right" name="UserEmail" id="InputEmail1" aria-describedby="emailHelp" placeholder="* البريد الإلكتروني" required>
              </div>
              <div class="form-group text-right">
                <label class="form-label ">* كلمة المرور</label>
                <input type="password" class="form-control  text-right" name="UserPWD" id="InputPassword1" placeholder="* كلمة المرور" required>
              </div>
              <div class="form-group text-right">
                <label class="form-label ">* تاكيد كلمة المرور</label>
                <input type="password" class="form-control  text-right" name="CUserPWD" id="InputPassword1" placeholder="* تاكيد كلمة المرور" required>
              </div>
              <div class="form-group text-right">
                <label class="form-label ">رقم الجوال</label>
                <input type="text" class="form-control  text-right" name="UserPhone" id="InputEmail1" aria-describedby="emailHelp" placeholder="رقم الجوال ">
              </div>

              <div class="form-group text-right">
                <label class="form-label ">المنطقة</label>
                <input type="location" class="form-control  text-right" name="UserLocationCity" id="InputLoc" placeholder="المنطقة">
              </div>
              <div class="form-group text-right">
                <label class="form-label ">المدينة</label>
                <input type="location" class="form-control  text-right" name="UserLocation" id="InputLoc" placeholder="المدينة">
              </div>
              <div class="row">
                <div class="col-md-6 mb-4">
                  <select name="UserType" class="select form-control" onchange="terms(document.getElementById('id_type').value);" id="id_type" style="display:block !important;">
                    <?php if($user->GetUsers()){if(count($user->Users)==0){ ?>
                      <option value="admin">مدير</option>
                    <?php }else{ ?>
                    <option value="user">مستخدم</option>
                    <option value="business"> صاحب متجر </option>
                    <?php if (!empty($_SESSION['user_type'])) {
                      if ($_SESSION['user_type'] == "admin") { ?>
                        <option value="admin">مدير</option>
                    <?php }
                    }
                    
                    }
                  }
                    ?>

                  </select>
                </div>
                <div class="col-md-6 mb-4">
                  <label class="form-label select-label" for="id_type">نوع الحساب</label>
                </div>
              </div>
              <div class="col-12 form-group-center mb-3  text-right" id="store-name">
                <label for=" text-right"> اسم الشركه</label>
                <input type="text" class="form-control" name="UserStore" id="" placeholder="اسم الشركه">
              </div>
              <div class="form-group text-right">
                <label class="form-label ">صورة الملف الشخصي</label>
                <input type="file" name="Image" class="form-control" id="InputLoc" placeholder="صورة الملف الشخصي">
              </div>
              <div class="form-group text-right">
                <label class="form-label ">المزيد من المعلومات</label>
                <textarea class="form-control row-4  text-right" name="Notes" id="InputLoc" placeholder="المزيد من المعلومات"></textarea>
              </div>
              <div id="user-terms">
                <div class="form-check">
                  <input type="checkbox" name="IsApproved" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1"><a href="" class="text-primary" data-toggle="modal" data-target="#myModal">&nbsp; &nbsp; الموافقة على الشروط</a></label>
                </div>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"> الموافقة على الشروط</h4>
                      </div>
                      <div class="modal-body  text-right">
                        <p>موقعنا الالكتروني يرحّب بكم ويبلغكم بأنكم سوف تجدون أدناه الشروط والأحكام المُنظّمة لاستخدامكم لهذا الموقع
                          ، حيث أن استخدام أي شخصٍ كان لـ(موقع بالسانتي) سواءً كان مستخدماً أو صاحب لمتجر فإن هذا موافقة وقبول منه وهو بكامل أهليته المعتبرة شرعاً ونظاماً وقانوناً لكافة مواد وأحكام هذه الاتفاقية وهو تأكيد لالتزامكم بأنظمتها ولما ذُكر فيها، وتسري هذه الاتفاقية على جميع أنواع التعامل بين المستخدم وبين المتجر.</p>
                        <h6>شروط التسجيل</h6>
                        <ul>
                          <li>يجب التأكد من صحة المعلومات المدخلة</li>
                          <li>ان يلتزم المستخدم باستخدام المنصة الالكترونية الخاصة بـنا بما يتّفق مع الآداب العامة والأنظمة المعمول بها في المملكة العربية السعودية</li>
                          <li>في حال الطلب من متجر يجب ان يلتزم بالمبلغ المتفق عليه من المتجر</li>
                          <li>عدم الإساءة لأي متجر وفي حال القيام بذلك سوف نتخذ الإجراءات القانونية </li>
                          <li>في حال لم يصلك المنتج بناء على الطلب يحق للمستخدم المطالبة بإرجاع المبلغ او إعادة تصنيع المنتج</li>
                        </ul>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> خروج</button>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="business-terms">
                <!-- checkbox -->
                <div class="form-check">
                  <input type="checkbox" name="IsApproved" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1"><a href="" class="text-primary" data-toggle="modal" data-target="#myModal2">&nbsp; &nbsp; الموافقة على الشروط</a></label>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> خروج</button>
                        <button type="button" class="btn btn-primary">حفظ</button>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
              </div>
              <br />
              <button type="submit" class="btn btn-primary">تسجيل</button>
            </form>
            <br>
            <p> هل لديك حساب؟ <a href="login.php" class="text-danger">تسجيل الدخول</a> </p>


          </div>

        </div>
      <?php } ?>

    </div>

  </form>
  <?php require_once("main/parts/footer.php"); ?>
  <?php require_once("main/parts/script.php"); ?>
  <script>
    terms("user");
  </script>
</body>

</html>