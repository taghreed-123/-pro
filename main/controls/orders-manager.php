<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = "Error";
    if (!empty($_POST['DataManager'])) {
        $operationState = true;
        $manager = $_POST['DataManager'];
        if ($manager != "Add" && $manager != "SearchAll" && $manager != "LogIn")
            $order->order_id = $_POST['id'];


        if ($manager == "Add" || $manager == "Edit" || $manager == "Delete") {
            if ($manager != "Delete") {
                $order->order_user_id = $_POST['OrderUserID'];
                $order->order_store_id = $_POST['SellerID'];
                if(!empty($_POST['price']))
                    $order->order_price = $_POST['price'];
                else
                    $order->order_price = "";
                $order->order_type = $_POST['type'];
                $order->order_width = $_POST['width'];
                $order->order_height = $_POST['height'];
                $order->order_status = 0;
                
                $order->order_notes = $_POST['Notes'];
            }

            if ($operationState) {
                if ($manager == "Add")
                    $operationState = $order->CheckInputs();
                else if ($manager == "Edit")
                    $operationState = $order->CheckInputs("Edit");
                else if ($manager == "Delete")
                    $operationState = $order->CheckInputs("Delete");
                else
                    $operationState = false;

                if ($operationState) {
                    if (!empty($_FILES["Image"]["name"]))
                        $order->order_image = $_FILES["Image"]["name"];
                    else if ($manager == "Edit") {
                    if (!empty($_POST['LastImageName']))
                        $order->order_image = $_POST['LastImageName'];
                    }
                    if ($manager == "Add") {
                        $operationState = $order->ADDOrder();
                    } else if ($manager == "Edit") {
                        $operationState = $order->EditOrder();
                    } else if ($manager == "Delete")
                        $operationState = $order->DeleteOrder();
                    else
                        $operationState = false;

                    if ($operationState) {
                        if ($manager == "Edit" || $manager == "Delete") {
                            if (!empty($_FILES["Image"]["name"])) {
                                if (!empty($_POST['LastImageName']))
                                    if ($_POST['LastImageName'] != "null")
                                        if (file_exists("main/images/orders/" . $_POST['LastImageName']))
                                            unlink("main/images/orders/" . $_POST['LastImageName']);
                            }
                        }
                        if ($manager == "Add" || $manager == "Edit") {

                            if (!empty($_FILES["Image"])) {
                                if (!empty($_FILES["Image"]["name"])) {
                                    if (!is_dir("main/images/orders/"))
                                        mkdir("main/images/orders/");
                                    move_uploaded_file($_FILES["Image"]["tmp_name"], "main/images/orders/" . $_FILES["Image"]["name"]);
                                }
                            }
                        }
                        $response_type = "تمت العملية بنجاح";
                    } else
                        $response_type = "Error \n" . "خطا في تنفيذ العملية";
                } else
                    $response_type = "Error \n" . "خطا في فحص البيانات\nهناك بيانات مفقوده يجب عليك ان تكملها";
                $response = $response_type;
            } else {
                $response = "Error \n" . "خطا في تاكيد كلمية المرور";
            }
        } else if ($manager == "AddAddress") {
            if (CheckValue($_POST['id'], "Int")&&CheckValue($_POST['address'])) {
                $order->order_address = $_POST['address'];
                $order->order_charge_address = $_POST['charge_address'];
                $order->order_build_number = $_POST['build_number'];
                $order->order_id = $_POST['id'];
                if ($order->AddOrderAddress())
                    $response = "Done" . "تم التعديل بنجاح";
                else
                    $response = "Done" . "فشلت عملية التعديل";
            }else
            $response = "Done" . "يجب ان تدخل السعر اولا";
        } else if ($manager == "AddPrice") {
            if (CheckValue($_POST['price'], "Int")) {
                if ($order->ChangeOrderPrice($_POST['price'],$_POST['id']))
                    $response = "Done" . "تم التعديل بنجاح";
                else
                    $response = "Done" . "فشلت عملية التعديل";
            }else
            $response = "Done" . "يجب ان تدخل السعر اولا";
        } else if ($manager == "SearchColumns") {
            if (CheckValue($order->order_id, "Int")) {
                if ($order->GetOrderColumns($order->order_id))
                    echo $order->order_id;
            }
        } else if ($manager == "Search") {
            if (CheckValue($order->order_id, "Int")) {
                if ($order->GetOrderColumns($order->order_id))
                    $response_type = "Done";
                $response = "Done" . "product_types";
            }
        } else if ($manager == "SearchAll") {
            if ($order->GetAllOrders())
                $response_type = "Done";
            $response = "Done" . "product_types";
        }
    }
}
