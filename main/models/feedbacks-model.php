<?php
class FeedbacksModel
{
    public $con, $feedback_id,
        $feedback_seller_id,
        $feedback_customer_id,
        $feedback_product_id,
        $feedback_order_id,
        $feedback_msg,
        $feedback_notes,
        $feedback_type,
        $feedback_owner,
        $feedback_date,
        $Feedbacks,
        $Feedback, $procesState;

    function __construct()
    {
        global $connection;
        $this->con = $connection;
    }



    public function CheckInputs($checkType = "Add")
    {

        if ($checkType != "Add") {
            if (!CheckValue(filter_var($this->feedback_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
        }

        if ($checkType != "Delete") {
            if (!CheckValue(filter_var($this->feedback_customer_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
            if (!CheckValue(filter_var($this->feedback_seller_id, FILTER_SANITIZE_NUMBER_INT), "Int") && !CheckValue(filter_var($this->feedback_product_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
            if (!CheckValue($this->feedback_msg))
                return false;

        }

        return true;
    }

    public function SQLBindParams($query, $bindType = "Add")
    {
        $this->procesState = false;
        try {
            if ($bindType != "Delete") {

                $query->bindParam(":feedback_seller_id", $this->feedback_seller_id);
                $query->bindParam(":feedback_customer_id", $this->feedback_customer_id);
                $query->bindParam(":feedback_product_id", $this->feedback_product_id);
                $query->bindParam(":feedback_order_id", $this->feedback_order_id);
                $query->bindParam(":feedback_msg", $this->feedback_msg);
                $query->bindParam(":feedback_notes", $this->feedback_notes);
                $query->bindParam(":feedback_type", $this->feedback_type);
                $query->bindParam(":feedback_owner", $this->feedback_owner);
            }
            if ($bindType != "Add")
                $query->bindParam(":feedback_id", $this->feedback_id);
            if ($query->execute()) {
                if ($bindType == "Add")
                    $this->feedback_id = $this->con->lastInsertId();
                $this->procesState = true;
            } else
                $this->procesState = false;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $this->procesState = false;
        }
        return $this->procesState;
    }


    public function ADDFeedback()
    {
        $query = $this->con->prepare("INSERT INTO `feedbacks`(`feedback_id`,`feedback_seller_id`,`feedback_customer_id`,`feedback_product_id`,`feedback_order_id`,`feedback_msg`,`feedback_notes`,`feedback_type`,`feedback_owner`,`feedback_date`) VALUES(NULL,:feedback_seller_id,:feedback_customer_id,:feedback_product_id,:feedback_order_id,:feedback_msg,:feedback_notes,:feedback_type,:feedback_owner,now())");
        return $this->SQLBindParams($query);
    }

    public function EditFeedback()
    {
        return $this->SQLBindParams($this->con->prepare("UPDATE `feedbacks` SET `feedback_seller_id`=:feedback_seller_id,`feedback_customer_id`=:feedback_customer_id,`feedback_product_id`=:feedback_product_id,`feedback_order_id`=:feedback_order_id,`feedback_msg`=:feedback_msg,`feedback_notes`=:feedback_notes,`feedback_type`=:feedback_type,`feedback_owner`=:feedback_owner WHERE `feedback_id`=:feedback_id"), "Edit");
    }

    public function DeleteFeedback()
    {
        return $this->SQLBindParams($this->con->prepare("DELETE FROM `feedbacks`  WHERE `feedback_id`=:feedback_id "), "Delete");
    }


    public function GetFeedbackColumns($value)
    {
        $query = $this->con->prepare("SELECT * FROM `feedbacks` WHERE `feedback_id`=:val ");
        $query->bindParam(":val", $value);
        if ($query->execute()) {
            if ($data = $query->fetchObject()) {
                $this->feedback_id = $data->feedback_id;
                $this->feedback_seller_id = $data->feedback_seller_id;
                $this->feedback_customer_id = $data->feedback_customer_id;
                $this->feedback_product_id = $data->feedback_product_id;
                $this->feedback_order_id = $data->feedback_order_id;
                $this->feedback_msg = $data->feedback_msg;
                $this->feedback_notes = $data->feedback_notes;
                $this->feedback_type = $data->feedback_type;
                $this->feedback_owner = $data->feedback_owner;
                $this->feedback_date = $data->feedback_date;
            }

            return true;
        }

        return false;
    }

    public function GetFeedback($value,$id)
    {
        $query = $this->con->prepare("SELECT * FROM `feedbacks` WHERE `feedback_product_id`=:val AND `feedback_customer_id`=:id");
        $query->bindParam(":val", $value);
        $query->bindParam(":id", $id);
        $this->Feedback = array();
        if ($query->execute()) {
            if ($this->Feedback = $query->fetchObject()) {
                $this->GetFeedbackColumns($this->Feedback->feedback_id);
                return true;
            }
        }

        return false;
    }


    public function GetProductCustomersFeedbacks($id)
    {
        $query = $this->con->prepare("SELECT * FROM `products_feedbacks_customers_view` WHERE `feedback_product_id`=" . $id);
        $this->Feedbacks = array();
        if ($query->execute()) {
            while ($row = $query->fetchObject()) {
                $this->Feedbacks[] = $row;
            }
            if ($this->Feedbacks != null)
                return true;
            else
                return true;
        }
        return false;
    }
    public function GetSellerCustomersOrdersFeedbacks($id,$user_id,$order_id,$type)
    {
        if($type=="business")
            $query = $this->con->prepare("SELECT * FROM `feedbacks_sellers_customers_orders_view` WHERE `feedback_seller_id`=" . $id." AND `order_id`=".$order_id." ORDER BY `feedback_id` ASC");
        else
            $query = $this->con->prepare("SELECT * FROM `feedbacks_sellers_customers_orders_view` WHERE `feedback_seller_id`=" . $id." AND `feedback_customer_id`=".$user_id."  AND `order_id`=".$order_id." ORDER BY `feedback_id` ASC");
        $this->Feedbacks = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Feedbacks[] = $row;
            }
            if ($this->Feedbacks != null)
                return true;
            else
                return true;
        }
        return false;
    }
    public function GetSellerCustomersOrdersFeedbacksPrivate($id,$user_id,$type)
    {
        if($type=="business")
            $query = $this->con->prepare("SELECT * FROM `feedbacks` WHERE `feedback_seller_id`=" . $user_id." AND `feedback_customer_id`=".$id." ORDER BY `feedback_id` ASC");
        else
            $query = $this->con->prepare("SELECT * FROM `feedbacks` WHERE `feedback_seller_id`=" . $id." AND `feedback_customer_id`=".$user_id."  ORDER BY `feedback_id` ASC");
        $this->Feedbacks = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Feedbacks[] = $row;
            }
            if ($this->Feedbacks != null)
                return true;
            else
                return true;
        }
        return false;
    }
    public function GetAllFeedbacks()
    {
        $query = $this->con->prepare("SELECT * FROM `feedbacks`");
        $this->Feedbacks = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Feedbacks[] = $row;
            }
            if ($this->Feedbacks != null)
                return true;
            else
                return true;
        }
        return false;
    }
}
