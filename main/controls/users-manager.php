<?php
require_once("main/models/users-model.php");
$user = new UsersModel();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = "Error";
    if (empty($_POST['DataManager']))
        $_POST['DataManager'] = "";
    if (!empty($_POST['IsApproved']) || !empty($_SESSION['user_id']) || $_POST['DataManager'] == "LogIn") {
        if (!empty($_POST['DataManager'])) {
            $operationState = true;
            $manager = $_POST['DataManager'];
            if ($manager != "Add" && $manager != "SearchAll" && $manager != "LogIn")
                $user->user_id = $_POST['id'];


            if ($manager == "Add" || $manager == "Edit" || $manager == "Delete") {
                if ($manager != "Delete") {

                    if (!empty($_POST['UserStore']))
                        $user->user_store = $_POST['UserStore'];
                    else
                        $user->user_store = "";
                    $user->user_full_name = $_POST['UserFullName'];
                    $user->user_email = $_POST['UserEmail'];
                    $user->user_phone = $_POST['UserPhone'];
                    $user->user_type = $_POST['UserType'];
                    if (!empty($_POST['UserCategory']))
                        $user->user_category = $_POST['UserCategory'];
                    else
                        $user->user_category = "";
                    $user->user_city = $_POST['UserLocationCity'];
                    $user->user_location = $_POST['UserLocation'];
                    $user->user_notes = $_POST['Notes'];
                }

                if ($manager == "Edit" || ($manager == "Delete")) {
                    $user->GetUser($user->user_id);
                    if (!empty($_POST['UserOldPWD'])) {
                        if (!empty($_POST['UserPWD']) && !empty($_POST['CUserPWD'])) {
                            if ($_POST['UserPWD'] == $_POST['CUserPWD']) {
                                if (o_check($_POST['UserOldPWD'], $user->user_pwd)) {
                                    $user->user_pwd = $_POST['UserPWD'];
                                    $operationState = true;
                                } else
                                    $operationState = false;
                            } else
                                $operationState = false;
                        } else
                            $operationState = false;
                    } else {
                        if (!empty($_POST['UserPWD'])) {
                            if (o_check($_POST['UserPWD'], $user->user_pwd))
                                $operationState = true;
                        } else {
                            if ($manager == "Add")
                                $operationState = false;
                            else
                                $operationState = true;
                        }
                    }
                } else {
                    if (!empty($_POST['UserPWD']) && !empty($_POST['CUserPWD'])) {
                        if ($_POST['UserPWD'] == $_POST['CUserPWD']) {
                            $user->user_pwd = $_POST['UserPWD'];
                            $operationState = true;
                        }
                    } else {
                        if ($manager == "Add")
                            $operationState = false;
                        else
                            $operationState = true;
                    }
                }
                if ($operationState) {
                    if ($manager != "Add") {
                        if (!empty($_POST['UserActive']))
                            $user->user_active = $_POST['UserActive'];
                    } else
                        $user->user_active = 0;

                    if (!empty($_FILES["Image"]["name"]))
                        $user->user_image = $_FILES["Image"]["name"];
                    else if ($manager == "Edit") {
                        if (!empty($_POST['LastImageName']))
                            $user->user_image = $_POST['LastImageName'];
                    }

                    if ($manager == "Add")
                        $operationState = $user->CheckInputs();
                    else if ($manager == "Edit")
                        $operationState = $user->CheckInputs("Edit");
                    else if ($manager == "Delete")
                        $operationState = $user->CheckInputs("Delete");
                    else
                        $operationState = false;

                    if ($operationState) {

                        if ($manager == "Add") {
                            if ($user->user_pwd == $_POST['CUserPWD'])
                                $operationState = $user->ADDUser();
                            else {
                                $operationState = false;
                            }
                        } else if ($manager == "Edit") {
                            $operationState = $user->EditUser();
                        } else if ($manager == "Delete")
                            $operationState = $user->DeleteUser();
                        else
                            $operationState = false;

                        if ($operationState) {
                            if ($manager == "Edit" || $manager == "Delete") {
                                if (!empty($_FILES["Image"]["name"])) {
                                    if (!empty($_POST['LastImageName']))
                                        if ($_POST['LastImageName'] != "null")
                                            if (file_exists("main/images/accounts/" . $_POST['LastImageName']))
                                                unlink("main/images/accounts/" . $_POST['LastImageName']);
                                }
                            }
                            if ($manager == "Add" || $manager == "Edit") {

                                if (!empty($_FILES["Image"])) {
                                    if (!empty($_FILES["Image"]["name"])) {
                                        if (!is_dir("main/images/accounts/"))
                                            mkdir("main/images/accounts/");
                                        move_uploaded_file($_FILES["Image"]["tmp_name"], "main/images/accounts/" . $_FILES["Image"]["name"]);
                                    }
                                }
                            }
                        }
                        if ($operationState) {
                            $response_type = "تمت العملية بنجاح";
                        } else
                            $response_type = "Error \n" . "خطا في تنفيذ العملية";
                    } else
                        $response_type = "Error \n" . "خطا في فحص البيانات\nهناك بيانات مفقوده يجب عليك ان تكملها";
                    $response = $response_type;
                } else {
                    $response = "Error \n" . "خطا في تاكيد كلمية المرور";
                }
            } else if ($manager == "LogIn") {
                $search = false;
                if (!empty($_POST['UserPWD'])) {
                    if (!empty($_POST['UserEmail'])) {
                        if (CheckValue($_POST['UserEmail'])) {
                            if ($user->GetUserLogIn($_POST['UserEmail'], $_POST['UserPWD']))
                                $search = true;
                        }
                    }
                }

                if ($search) {
                    if (!empty($_SESSION))
                        session_unset();
                    $_SESSION = (array) $user->User[0];
                    $response = "تم تسجيل الدخول بنجاح";
                } else {
                    $response = "Error \n" . "خطا في عملية تسجيل الدخول\nتاكد من كلمة المرور واسم المستخدم ثم حاول مرة اخرى";
                }
            } else if ($manager == "SearchColumns") {
                if (CheckValue($user->user_id, "Int")) {
                    if ($user->GetUserColumns($user->user_id))
                        echo $user->user_full_name;
                }
            } else if ($manager == "Search") {
                if (CheckValue($user->user_id, "Int")) {
                    if ($user->GetUser($user->user_id))
                        $response_type = "Done";
                    $response = "Done" . "Users";
                }
            } else if ($manager == "SearchAll") {
                if ($user->GetUsers())
                    $response_type = "Done";
                $response = "Done" . "Users";
            }
        }
    } else {
        $response = "Error \n" . "يجب عليك ان توافق على شروط الخصوصية اولا";
    }
}
