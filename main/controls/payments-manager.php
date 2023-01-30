<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = "Error";
    if (!empty($_POST['DataManager'])) {
        $operationState = true;
        $manager = $_POST['DataManager'];
        if ($manager != "Add" && $manager != "SearchAll" && $manager != "LogIn")
            $payment->payment_id = $_POST['id'];


        if ($manager == "Add" || $manager == "Edit" || $manager == "Delete") {
            if ($manager != "Delete") {
                $payment->payment_user_id = $_POST['UserID'];
                $payment->payment_order_id = $_POST['OrderID'];

                $payment->payment_type = 'card';
                $payment->payment_card_number = $_POST['paymentCardNumber'];
                $payment->payment_card_name = $_POST['paymentCardName'];
                $payment->payment_card_expiry = '10-'.$_POST['month'].'-'.$_POST['year'];
                $payment->payment_card_code = $_POST['paymentCardCode'];
            }

            if ($operationState) {
                if ($manager == "Add")
                    $operationState = $payment->CheckInputs();
                else if ($manager == "Edit")
                    $operationState = $payment->CheckInputs("Edit");
                else if ($manager == "Delete")
                    $operationState = $payment->CheckInputs("Delete");
                else
                    $operationState = false;

                if ($operationState) {

                    if ($manager == "Add") {
                        $operationState = $payment->ADDPayment();
                    } else if ($manager == "Edit") {
                        $operationState = $payment->EditPayment();
                    } else if ($manager == "Delete")
                        $operationState = $payment->DeletePayment();
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
            if (CheckValue($payment->payment_id, "Int")) {
                if ($payment->GetPaymentColumns($payment->payment_id))
                    echo $payment->payment_id;
            }
        } else if ($manager == "Search") {
            if (CheckValue($payment->payment_id, "Int")) {
                if ($payment->GetPaymentColumns($payment->payment_id))
                    $response_type = "Done";
                $response = "Done" . "product_types";
            }
        } else if ($manager == "SearchAll") {
            if ($payment->GetAllPayments())
                $response_type = "Done";
            $response = "Done" . "product_types";
        }
    }
}
