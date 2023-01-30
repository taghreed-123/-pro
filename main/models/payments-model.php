<?php
class PaymentsModel
{
    public $con, $payment_id,
        $payment_user_id,
        $payment_order_id,
        $payment_type,
        $payment_card_number,
        $payment_card_name,
        $payment_card_expiry,
        $payment_card_code,
        $payment_date,
        $Payments,
        $Payment, $procesState;

    function __construct()
    {
        global $connection;
        $this->con = $connection;
    }



    public function CheckInputs($checkType = "Add")
    {

        if ($checkType != "Add") {
            if (!CheckValue(filter_var($this->payment_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
        }

        if ($checkType != "Delete") {
            if (!CheckValue(filter_var($this->payment_user_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
            if (!CheckValue(filter_var($this->payment_order_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
                if (!CheckValue(filter_var($this->payment_card_number, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
                if (!CheckValue(filter_var($this->payment_card_code, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
                if (!CheckValue($this->payment_card_name))
                return false;
                if (!CheckValue($this->payment_card_expiry))
                return false;
                if(strlen($this->payment_card_number)!= 16)
                    return false;
                if(strlen($this->payment_card_code) < 3)
                    return false;
        }

        return true;
    }

    public function SQLBindParams($query, $bindType = "Add")
    {
        $this->procesState = false;
        try {
            if ($bindType != "Delete") {

                $query->bindParam(":payment_user_id", $this->payment_user_id);
                $query->bindParam(":payment_order_id", $this->payment_order_id);
                $query->bindParam(":payment_type", $this->payment_type);
                $query->bindParam(":payment_card_number", $this->payment_card_number);
                $query->bindParam(":payment_card_name", $this->payment_card_name);
                $query->bindParam(":payment_card_expiry", $this->payment_card_expiry);
                $query->bindParam(":payment_card_code", $this->payment_card_code);
            }
            if ($bindType != "Add")
                $query->bindParam(":payment_id", $this->payment_id);
            if ($query->execute()) {
                if ($bindType == "Add")
                    $this->payment_id = $this->con->lastInsertId();
                $this->procesState = true;
            } else
                $this->procesState = false;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $this->procesState = false;
        }
        return $this->procesState;
    }


    public function ADDPayment()
    {
        $query = $this->con->prepare("INSERT INTO `payments`(`payment_id`,`payment_user_id`,`payment_order_id`,`payment_type`,`payment_card_number`,`payment_card_name`,`payment_card_expiry`,`payment_card_code`,`payment_date`) VALUES(NULL,:payment_user_id,:payment_order_id,:payment_type,:payment_card_number,:payment_card_name,:payment_card_expiry,:payment_card_code,now())");
        return $this->SQLBindParams($query);
    }

    public function EditPayment()
    {
        return $this->SQLBindParams($this->con->prepare("UPDATE `payments` SET `payment_user_id`=:payment_user_id,`payment_order_id`=:payment_order_id,`payment_type`=:payment_type,`payment_card_number`=:payment_card_number,`payment_card_name`=:payment_card_name,`payment_card_expiry`=:payment_card_expiry,`payment_card_code`=:payment_card_code WHERE `payment_id`=:payment_id"), "Edit");
    }

    public function DeletePayment()
    {
        return $this->SQLBindParams($this->con->prepare("DELETE FROM `payments`  WHERE `payment_id`=:payment_id "), "Delete");
    }


    public function GetPaymentColumns($value)
    {
        $query = $this->con->prepare("SELECT * FROM `payments` WHERE `payment_id`=:val ");
        $query->bindParam(":val", $value);
        if ($query->execute()) {
            if ($data = $query->fetchObject()) {
                $this->payment_id = $data->payment_id;
                $this->payment_user_id = $data->payment_user_id;
                $this->payment_order_id = $data->payment_order_id;
                $this->payment_type = $data->payment_type;
                $this->payment_card_number = $data->payment_card_number;
                $this->payment_card_name = $data->payment_card_name;
                $this->payment_card_expiry = $data->payment_card_expiry;
                $this->payment_card_code = $data->payment_card_code;
                $this->payment_date = $data->payment_date;
            }

            return true;
        }

        return false;
    }

    public function GetPayment($value, $id)
    {
        $query = $this->con->prepare("SELECT * FROM `payments` WHERE `payment_type`=:val AND `payment_order_id`=:id");
        $query->bindParam(":val", $value);
        $query->bindParam(":id", $id);
        $this->Payment = array();
        if ($query->execute()) {
            if ($this->Payment = $query->fetchObject()) {
                $this->GetPaymentColumns($this->Payment->payment_id);
                return true;
            }
        }

        return false;
    }

    public function GetPaymentProduct( $id)
    {
        $query = $this->con->prepare("SELECT * FROM `Payments_products_seller_view` WHERE  `payment_id`=:id");
        $query->bindParam(":id", $id);
        $this->Payment = array();
        if ($query->execute()) {
            if ($this->Payment = $query->fetchObject()) {
                $this->GetPaymentColumns($this->Payment->payment_id);
                return true;
            }
        }

        return false;
    }
    public function GetPayments($type)
    {
        $query = $this->con->prepare("SELECT * FROM `payments` WHERE `payment_type`=" . $type);
        $this->Payments = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Payments[] = $row;
            }
            if ($this->Payments != null)
                return true;
            else
                return true;
        }
        return false;
    }
    public function GetAllPayments()
    {
        $query = $this->con->prepare("SELECT * FROM `payments`");
        $this->Payments = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Payments[] = $row;
            }
            if ($this->Payments != null)
                return true;
            else
                return true;
        }
        return false;
    }
}
