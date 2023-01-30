<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = "Error";
    if (!empty($_POST['DataManager'])) {
        $operationState = true;
        $manager = $_POST['DataManager'];
        if ($manager != "Add" && $manager != "SearchAll" && $manager != "LogIn")
            $product->product_id = $_POST['id'];


        if ($manager == "Add" || $manager == "Edit" || $manager == "Delete") {
            if ($manager != "Delete") {
                $product->product_user_id = $_POST['ProductsUserId'];
                $product->product_name = $_POST['ProductsName'];
                $product->product_category = $_POST['ProductsCategory'];
                $product->product_desc = $_POST['ProductsDesc'];
            }
            if ($operationState) {
                if (!empty($_FILES["Image"]["name"]))
                    $product->product_image = $_FILES["Image"]["name"];
                else if ($manager == "Edit") {
                    if (!empty($_POST['LastImageName']))
                        $product->product_image = $_POST['LastImageName'];
                }

                if ($manager == "Add")
                    $operationState = $product->CheckInputs();
                else if ($manager == "Edit")
                    $operationState = $product->CheckInputs("Edit");
                else if ($manager == "Delete")
                    $operationState = $product->CheckInputs("Delete");
                else
                    $operationState = false;

                if ($operationState) {

                    if ($manager == "Add") {
                        $operationState = $product->ADDProduct();
                    } else if ($manager == "Edit") {
                        $operationState = $product->EditProduct();
                    } else if ($manager == "Delete")
                        $operationState = $product->DeleteProduct();
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
                                    move_uploaded_file($_FILES["Image"]["tmp_name"], "main/images/products/" . $_FILES["Image"]["name"]);
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
        } else if ($manager == "SearchColumns") {
            if (CheckValue($product->product_id, "Int")) {
                if ($product->GetProductColumns($product->product_id))
                    echo $product->product_name;
            }
        } else if ($manager == "Search") {
            if (CheckValue($product->product_id, "Int")) {
                if ($product->GetProduct($product->product_id))
                    $response_type = "Done";
                $response = "Done" . "Users";
            }
        } else if ($manager == "SearchAll") {
            if ($product->GetProductsView())
                $response_type = "Done";
            $response = "Done" . "Users";
        }
    }
}
