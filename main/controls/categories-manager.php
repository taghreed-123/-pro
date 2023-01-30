<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = "Error";
    if (!empty($_POST['DataManager'])) {
        $operationState = true;
        $manager = $_POST['DataManager'];
        if ($manager != "Add" && $manager != "SearchAll" && $manager != "LogIn")
            $category->category_id = $_POST['id'];


        if ($manager == "Add" || $manager == "Edit" || $manager == "Delete") {
            if ($manager != "Delete") {

                $category->category_name = $_POST['CategoryName'];
                if (!empty($_POST['CategoryType']))
                    $category->category_type = 1;
                else
                    $category->category_type = 0;

                $category->category_notes = $_POST['Notes'];
            }

            if ($operationState) {
                if ($manager == "Add")
                    $operationState = $category->CheckInputs();
                else if ($manager == "Edit")
                    $operationState = $category->CheckInputs("Edit");
                else if ($manager == "Delete")
                    $operationState = $category->CheckInputs("Delete");
                else
                    $operationState = false;

                if ($operationState) {

                    if ($manager == "Add") {
                        $operationState = $category->ADDCategory();
                    } else if ($manager == "Edit") {
                        $operationState = $category->EditCategory();
                    } else if ($manager == "Delete")
                        $operationState = $category->DeleteCategory();
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
            if (CheckValue($category->category_id, "Int")) {
                if ($category->GetCategoryColumns($category->category_id))
                    echo $category->category_name;
            }
        } else if ($manager == "Search") {
            if (CheckValue($category->category_id, "Int")) {
                if ($category->GetCategory($category->category_id))
                    $response_type = "Done";
                $response = "Done" . "product_types";
            }
        } else if ($manager == "SearchAll") {
            if ($category->GetCategories(1))
                $response_type = "Done";
            $response = "Done" . "product_types";
        }
    }
}
