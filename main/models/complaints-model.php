<?php
class ComplaintsModel
{
    public $con, $complaint_id,
        $complaint_seller_id,
        $complaint_customer_id,
        $complaint_order_id,
        $complaint_msg,
        $complaint_notes,
        $complaint_type,
        $complaint_image,
        $complaint_date,
        $Complaints,
        $Complaint, $procesState;

    function __construct()
    {
        global $connection;
        $this->con = $connection;
    }



    public function CheckInputs($checkType = "Add")
    {

        if ($checkType != "Add") {
            if (!CheckValue(filter_var($this->complaint_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
        }

        if ($checkType != "Delete") {
            if (!CheckValue(filter_var($this->complaint_customer_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
            if (!CheckValue(filter_var($this->complaint_seller_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
            if (!CheckValue(filter_var($this->complaint_order_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
            if (!CheckValue($this->complaint_msg))
                return false;
        }

        return true;
    }

    public function SQLBindParams($query, $bindType = "Add")
    {
        $this->procesState = false;
        try {
            if ($bindType != "Delete") {

                $query->bindParam(":complaint_seller_id", $this->complaint_seller_id);
                $query->bindParam(":complaint_customer_id", $this->complaint_customer_id);
                $query->bindParam(":complaint_order_id", $this->complaint_order_id);
                $query->bindParam(":complaint_msg", $this->complaint_msg);
                $query->bindParam(":complaint_notes", $this->complaint_notes);
                $query->bindParam(":complaint_type", $this->complaint_type);
                $query->bindParam(":complaint_image", $this->complaint_image);
            }
            if ($bindType != "Add")
                $query->bindParam(":complaint_id", $this->complaint_id);
            if ($query->execute()) {
                if ($bindType == "Add")
                    $this->complaint_id = $this->con->lastInsertId();
                $this->procesState = true;
            } else
                $this->procesState = false;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $this->procesState = false;
        }
        return $this->procesState;
    }


    public function ADDComplaint()
    {
        $query = $this->con->prepare("INSERT INTO `complaints`(`complaint_id`,`complaint_seller_id`,`complaint_customer_id`,`complaint_order_id`,`complaint_msg`,`complaint_notes`,`complaint_type`,`complaint_image`,`complaint_date`) VALUES(NULL,:complaint_seller_id,:complaint_customer_id,:complaint_order_id,:complaint_msg,:complaint_notes,:complaint_type,:complaint_image,now())");
        return $this->SQLBindParams($query);
    }

    public function EditComplaint()
    {
        return $this->SQLBindParams($this->con->prepare("UPDATE `complaints` SET `complaint_seller_id`=:complaint_seller_id,`complaint_customer_id`=:complaint_customer_id,`complaint_order_id`=:complaint_order_id,`complaint_msg`=:complaint_msg,`complaint_notes`=:complaint_notes,`complaint_type`=:complaint_type,`complaint_image`=:complaint_image WHERE `complaint_id`=:complaint_id"), "Edit");
    }

    public function DeleteComplaint()
    {
        return $this->SQLBindParams($this->con->prepare("DELETE FROM `complaints`  WHERE `complaint_id`=:complaint_id "), "Delete");
    }


    public function GetComplaintColumns($value)
    {
        $query = $this->con->prepare("SELECT * FROM `complaints` WHERE `complaint_id`=:val ");
        $query->bindParam(":val", $value);
        if ($query->execute()) {
            if ($data = $query->fetchObject()) {
                $this->complaint_id = $data->complaint_id;
                $this->complaint_seller_id = $data->complaint_seller_id;
                $this->complaint_customer_id = $data->complaint_customer_id;
                $this->complaint_order_id = $data->complaint_order_id;
                $this->complaint_msg = $data->complaint_msg;
                $this->complaint_notes = $data->complaint_notes;
                $this->complaint_type = $data->complaint_type;
                $this->complaint_date = $data->complaint_date;
                $this->complaint_image = $data->complaint_image;
            }

            return true;
        }

        return false;
    }
    public function ChangeComplaintStatus($id, $status)
    {
        $query = $this->con->prepare("UPDATE  `complaints` SET `complaint_type`=:status WHERE `complaint_id`=:id ");
        $query->bindParam(":status", $status);
        $query->bindParam(":id", $id);
        $this->Complaint = array();
        if ($query->execute()) {
                return true;
            }

        return false;
    }
    public function GetComplaint($value, $id)
    {
        $query = $this->con->prepare("SELECT * FROM `complaints_orders_sellers_customers_view` WHERE `complaint_order_id`=:val AND `complaint_customer_id`=:id");
        $query->bindParam(":val", $value);
        $query->bindParam(":id", $id);
        $this->Complaint = array();
        if ($query->execute()) {
            if ($this->Complaint = $query->fetchObject()) {
                $this->GetComplaintColumns($this->Complaint->complaint_id);
                return true;
            }
        }

        return false;
    }

    public function GetComplaintDetails( $id)
    {
        $query = $this->con->prepare("SELECT * FROM `complaints_orders_sellers_customers_view` WHERE  `complaint_id`=:id");
        $query->bindParam(":id", $id);
        $this->Complaint = array();
        if ($query->execute()) {
            if ($this->Complaint = $query->fetchObject()) {
                $this->GetComplaintColumns($this->Complaint->complaint_id);
                return true;
            }
        }

        return false;
    }
    public function GetOrderCustomersComplaints($type)
    {
        $query = $this->con->prepare("SELECT * FROM `complaints_orders_sellers_customers_view` WHERE `complaint_order_id`=" . $type);
        $this->Complaints = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Complaints[] = $row;
            }
            if ($this->Complaints != null)
                return true;
            else
                return true;
        }
        return false;
    }
    public function GetSellerCustomersComplaints($id)
    {
        $query = $this->con->prepare("SELECT * FROM `complaints_orders_sellers_customers_view` WHERE `complaint_seller_id`=" . $id . " OR `complaint_customer_id`=" . $id . " ORDER BY `complaint_id` ASC");
        $this->Complaints = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Complaints[] = $row;
            }
            if ($this->Complaints != null)
                return true;
            else
                return true;
        }
        return false;
    }
    public function GetAllComplaints()
    {
        $query = $this->con->prepare("SELECT * FROM `complaints_orders_sellers_customers_view`");
        $this->Complaints = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Complaints[] = $row;
            }
            if ($this->Complaints != null)
                return true;
            else
                return true;
        }
        return false;
    }
}
