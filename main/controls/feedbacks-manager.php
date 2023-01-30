<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = "Error";
    if (!empty($_POST['DataManager'])) {
        $operationState = true;
        $manager = $_POST['DataManager'];
        if ($manager != "Add" && $manager != "SearchAll" && $manager != "LogIn")
            $feedback->feedback_id = $_POST['id'];
        if ($manager == "Add" || $manager == "Edit" || $manager == "Delete") {
            if ($manager != "Delete") {
                if(!empty($_POST['SellerID']))
                    $feedback->feedback_seller_id = $_POST['SellerID'];
                else
                    $feedback->feedback_seller_id = null;
                $feedback->feedback_customer_id = $_POST['CustomerID'];
                $feedback->feedback_owner = $_POST['Owner'];
                if(!empty($_POST['ProductID']))
                    $feedback->feedback_product_id = $_POST['ProductID'];
                else
                    $feedback->feedback_product_id = null;
                if (!empty($_POST['OrderID']))
                    $feedback->feedback_order_id = $_POST['OrderID'];
                else
                    $feedback->feedback_order_id = null;
                $feedback->feedback_msg = $_POST['MSG'];
                if(!empty($_POST['Notes']))
                    $feedback->feedback_notes = $_POST['Notes'];
                else
                    $feedback->feedback_notes = '';
                $feedback->feedback_type = $_POST['Type'];
            }
            if ($operationState) {
                if ($manager == "Add")
                    $operationState = $feedback->CheckInputs();
                else if ($manager == "Edit")
                    $operationState = $feedback->CheckInputs("Edit");
                else if ($manager == "Delete")
                    $operationState = $feedback->CheckInputs("Delete");
                else
                    $operationState = false;

                if ($operationState) {

                    if ($manager == "Add") {
                        $operationState = $feedback->ADDFeedback();
                    } else if ($manager == "Edit") {
                        $operationState = $feedback->EditFeedback();
                    } else if ($manager == "Delete")
                        $operationState = $feedback->DeleteFeedback();
                    else
                        $operationState = false;

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
            if (CheckValue($feedback->feedback_id, "Int")) {
                if ($feedback->GetFeedbackColumns($feedback->feedback_id))
                    echo $feedback->feedback_seller_id;
            }
        } else if ($manager == "Search") {
            if (CheckValue($feedback->feedback_id, "Int")) {
                if ($feedback->GetFeedbackColumns($feedback->feedback_id))
                    $response_type = "Done";
                $response = "Done" . "product_types";
            }
        } else if ($manager == "SearchAll") {
            if ($feedback->GetAllFeedbacks())
                $response_type = "Done";
            $response = "Done" . "product_types";
        }
    }
}
