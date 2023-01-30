<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = "Error";
    if (!empty($_POST['DataManager'])) {
        $operationState = true;
        $manager = $_POST['DataManager'];
        if ($manager != "Add" && $manager != "SearchAll" && $manager != "LogIn")
            $complaint->complaint_id = $_POST['id'];

        if ($manager == "Add" || $manager == "Edit" || $manager == "Delete") {
            if ($manager != "Delete") {

                $complaint->complaint_seller_id = $_POST['SellerID'];
                $complaint->complaint_customer_id = $_POST['CustomerID'];
                $complaint->complaint_order_id = $_POST['OrderID'];
                $complaint->complaint_msg = $_POST['MSG'];
                $complaint->complaint_notes = $_POST['Notes'];
                $complaint->complaint_type = $_POST['Type'];
                if (!empty($_FILES["Image"]["name"]))
                    $complaint->complaint_image = $_FILES["Image"]["name"];
                else
                    $complaint->complaint_image = $_POST['LastImageName'];
            }
            if ($operationState) {
                if ($manager == "Add")
                    $operationState = $complaint->CheckInputs();
                else if ($manager == "Edit")
                    $operationState = $complaint->CheckInputs("Edit");
                else if ($manager == "Delete")
                    $operationState = $complaint->CheckInputs("Delete");
                else
                    $operationState = false;

                if ($operationState) {

                    if ($manager == "Add") {
                        $operationState = $complaint->ADDComplaint();
                    } else if ($manager == "Edit") {
                        $operationState = $complaint->EditComplaint();
                    } else if ($manager == "Delete")
                        $operationState = $complaint->DeleteComplaint();
                    else
                        $operationState = false;

                    if ($operationState) {
                        if ($manager == "Edit" || $manager == "Delete") {
                            if (!empty($_FILES["Image"]["name"])) {
                                if (!empty($_POST['LastImageName']))
                                    if ($_POST['LastImageName'] != "null")
                                        if (file_exists("main/images/complaints/" . $_POST['LastImageName']))
                                            unlink("main/images/complaints/" . $_POST['LastImageName']);
                            }
                        }
                        if ($manager == "Add" || $manager == "Edit") {

                            if (!empty($_FILES["Image"])) {
                                if (!empty($_FILES["Image"]["name"])) {
                                    if (!is_dir("main/images/complaints/"))
                                        mkdir("main/images/complaints/");
                                    move_uploaded_file($_FILES["Image"]["tmp_name"], "main/images/complaints/" . $_FILES["Image"]["name"]);
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
        } else if ($manager == "SearchColumns") {
            if (CheckValue($complaint->complaint_id, "Int")) {
                if ($complaint->GetComplaintColumns($complaint->complaint_id))
                    echo $complaint->complaint_seller_id;
            }
        } else if ($manager == "Search") {
            if (CheckValue($complaint->complaint_id, "Int")) {
                if ($complaint->GetComplaintColumns($complaint->complaint_id))
                    $response_type = "Done";
                $response = "Done" . "product_types";
            }
        } else if ($manager == "SearchAll") {
            if ($complaint->GetAllComplaints())
                $response_type = "Done";
            $response = "Done" . "product_types";
        }
    }
}
