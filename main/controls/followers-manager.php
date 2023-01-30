<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = "Error";
    if (!empty($_POST['DataManager'])) {
        $operationState = true;
        $manager = $_POST['DataManager'];
        if ($manager != "Add" && $manager != "SearchAll" && $manager != "LogIn")
            $follower->followers_id = $_POST['id'];


        if ($manager == "Add" || $manager == "Edit" || $manager == "Delete") {
            if ($manager != "Delete") {
                $follower->followers_seller_id = $_POST['SellerID'];
                $follower->followers_customer_id = $_POST['CustomerID'];
                $follower->followers_notes = $_POST['Notes'];
            }

            if ($operationState) {
                if ($manager == "Add")
                    $operationState = $follower->CheckInputs();
                else if ($manager == "Edit")
                    $operationState = $follower->CheckInputs("Edit");
                else if ($manager == "Delete")
                    $operationState = $follower->CheckInputs("Delete");
                else
                    $operationState = false;

                if ($operationState) {

                    if ($manager == "Add") {
                        $operationState = $follower->ADDFollower();
                    } else if ($manager == "Edit") {
                        $operationState = $follower->EditFollower();
                    } else if ($manager == "Delete")
                        $operationState = $follower->DeleteFollower();
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
            if (CheckValue($follower->followers_id, "Int")) {
                if ($follower->GetfollowerColumns($follower->followers_id))
                    echo $follower->followers_seller_id;
            }
        } else if ($manager == "Search") {
            if (CheckValue($follower->followers_id, "Int")) {
                if ($follower->GetFollowerColumns($follower->followers_id))
                    $response_type = "Done";
                $response = "Done" . "product_types";
            }
        } else if ($manager == "SearchAll") {
            if ($follower->GetAllFollowers())
                $response_type = "Done";
            $response = "Done" . "product_types";
        }
    }
}
