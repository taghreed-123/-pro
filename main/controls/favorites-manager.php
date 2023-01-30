<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = "Error";
    if (!empty($_POST['DataManager'])) {
        $operationState = true;
        $manager = $_POST['DataManager'];
        if ($manager != "Add" && $manager != "SearchAll" && $manager != "LogIn")
            $favorite->favorite_id = $_POST['id'];


        if ($manager == "Add" || $manager == "Edit" || $manager == "Delete") {
            if ($manager != "Delete") {

                $favorite->favorite_seller_id = $_POST['SellerID'];
                $favorite->favorite_customer_id = $_POST['CustomerID'];

                $favorite->favorite_product_id = $_POST['ProductID'];
                $favorite->favorite_notes = $_POST['Notes'];
            }
            if ($operationState) {
                if ($manager == "Add")
                    $operationState = $favorite->CheckInputs();
                else if ($manager == "Edit")
                    $operationState = $favorite->CheckInputs("Edit");
                else if ($manager == "Delete")
                    $operationState = $favorite->CheckInputs("Delete");
                else
                    $operationState = false;

                if ($operationState) {

                    if ($manager == "Add") {
                        $operationState = $favorite->ADDFavorite();
                    } else if ($manager == "Edit") {
                        $operationState = $favorite->EditFavorite();
                    } else if ($manager == "Delete")
                        $operationState = $favorite->DeleteFavorite();
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
            if (CheckValue($favorite->favorite_id, "Int")) {
                if ($favorite->GetfavoriteColumns($favorite->favorite_id))
                    echo $favorite->favorite_seller_id;
            }
        } else if ($manager == "Search") {
            if (CheckValue($favorite->favorite_id, "Int")) {
                if ($favorite->GetFavoriteColumns($favorite->favorite_id))
                    $response_type = "Done";
                $response = "Done" . "product_types";
            }
        } else if ($manager == "SearchAll") {
            if ($favorite->GetAllfavorites())
                $response_type = "Done";
            $response = "Done" . "product_types";
        }
    }
}
