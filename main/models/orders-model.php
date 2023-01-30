<?php
class OrdersModel
{
    public $con, $order_id,
        $order_user_id,
        $order_store_id,
        $order_price,
        $order_type,
        $order_width,
        $order_height,
        $order_status,
        $order_image,
        $order_notes,
        $order_address,
        $order_charge_address,
        $order_build_number,
        $order_date,
        $Orders,
        $Order, $procesState;

    function __construct()
    {
        global $connection;
        $this->con = $connection;
    }



    public function CheckInputs($checkType = "Add")
    {

        if ($checkType != "Add") {
            if (!CheckValue(filter_var($this->order_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
        }

        if ($checkType != "Delete") {
            if (!CheckValue(filter_var($this->order_user_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
            if (!CheckValue(filter_var($this->order_store_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
            if (!CheckValue(filter_var($this->order_width, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
            if (!CheckValue(filter_var($this->order_height, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
            if (!CheckValue($this->order_type))
                return false;
        }

        return true;
    }

    public function SQLBindParams($query, $bindType = "Add")
    {
        $this->procesState = false;
        try {
            if ($bindType != "Delete") {

                $query->bindParam(":order_user_id", $this->order_user_id);
                $query->bindParam(":order_store_id", $this->order_store_id);
                $query->bindParam(":order_price", $this->order_price);
                $query->bindParam(":order_type", $this->order_type);
                $query->bindParam(":order_width", $this->order_width);
                $query->bindParam(":order_height", $this->order_height);
                $query->bindParam(":order_status", $this->order_status);
                $query->bindParam(":order_image", $this->order_image);
                $query->bindParam(":order_notes", $this->order_notes);
            }

            if ($bindType != "Add")
                $query->bindParam(":order_id", $this->order_id);
            if ($query->execute()) {
                if ($bindType == "Add")
                    $this->order_id = $this->con->lastInsertId();
                $this->procesState = true;
            } else
                $this->procesState = false;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $this->procesState = false;
        }
        return $this->procesState;
    }


    public function ADDOrder()
    {
        $query = $this->con->prepare("INSERT INTO `orders`(`order_id`,`order_user_id`,`order_store_id`,`order_price`,`order_type`,`order_width`,`order_height`,`order_status`,`order_image`,`order_notes`,`order_date`) VALUES(NULL,:order_user_id,:order_store_id,:order_price,:order_type,:order_width,:order_height,:order_status,:order_image,:order_notes,now())");
        return $this->SQLBindParams($query);
    }

    public function EditOrder()
    {
        return $this->SQLBindParams($this->con->prepare("UPDATE `orders` SET `order_user_id`=:order_user_id,`order_store_id`=:order_store_id,`order_price`=:order_price,`order_type`=:order_type,`order_width`=:order_width,`order_height`=:order_height,`order_status`=:order_status,`order_image`=:order_image,`order_notes`=:order_notes WHERE `order_id`=:order_id"), "Edit");
    }

    public function DeleteOrder()
    {
        return $this->SQLBindParams($this->con->prepare("DELETE FROM `orders`  WHERE `order_id`=:order_id "), "Delete");
    }


    public function GetOrderColumns($value)
    {
        $query = $this->con->prepare("SELECT * FROM `orders` WHERE `order_id`=:val ");
        $query->bindParam(":val", $value);
        if ($query->execute()) {
            if ($data = $query->fetchObject()) {
                $this->order_id = $data->order_id;
                $this->order_user_id = $data->order_user_id;
                $this->order_store_id = $data->order_store_id;
                $this->order_price = $data->order_price;
                $this->order_type = $data->order_type;
                $this->order_width = $data->order_width;
                $this->order_height = $data->order_height;
                $this->order_status = $data->order_status;
                $this->order_image = $data->order_image;
                $this->order_notes = $data->order_notes;
                $this->order_date = $data->order_date;
            }

            return true;
        }

        return false;
    }

    public function AddOrderAddress()
    {
        $query = $this->con->prepare("UPDATE `orders` SET `order_address`=:address,`order_charge_address`=:charge_address,`order_build_number`=:build_number WHERE `order_id`=:id");
        $query->bindParam(":address", $this->order_address);
        $query->bindParam(":charge_address", $this->order_charge_address);
        $query->bindParam(":build_number", $this->order_build_number);
        $query->bindParam(":id", $this->order_id);
        if ($query->execute()) {
                return true;
        }

        return false;
    }
    public function ChangeOrderPrice($value, $id)
    {
        $query = $this->con->prepare("UPDATE `orders` SET `order_price`=:val WHERE `order_id`=:id");
        $query->bindParam(":val", $value);
        $query->bindParam(":id", $id);
        if ($query->execute()) {
                return true;
        }

        return false;
    }
    public function ChangeOrderStatus($value, $id)
    {
        $query = $this->con->prepare("UPDATE `orders` SET `order_status`=:val WHERE `order_id`=:id");
        $query->bindParam(":val", $value);
        $query->bindParam(":id", $id);
        if ($query->execute()) {
                return true;
        }

        return false;
    }
    public function GetOrder($value, $id)
    {
        $query = $this->con->prepare("SELECT * FROM `orders` WHERE `order_price`=:val AND `order_store_id`=:id");
        $query->bindParam(":val", $value);
        $query->bindParam(":id", $id);
        $this->Order = array();
        if ($query->execute()) {
            if ($this->Order = $query->fetchObject()) {
                $this->GetOrderColumns($this->Order->order_id);
                return true;
            }
        }

        return false;
    }
    public function GetOrderDetails( $id)
    {
        $query = $this->con->prepare("SELECT * FROM `orders_seller_view` WHERE `order_id`=:id");
        $query->bindParam(":id", $id);
        $this->Order = array();
        if ($query->execute()) {
            if ($this->Order = $query->fetchObject()) {
                // $this->GetOrderColumns($this->Order->order_id);
                return true;
            }
        }

        return false;
    }
    public function GetOrderProduct( $id)
    {
        $query = $this->con->prepare("SELECT * FROM `orders_seller_view` WHERE  `order_id`=:id");
        $query->bindParam(":id", $id);
        $this->Order = array();
        if ($query->execute()) {
            if ($this->Order = $query->fetchObject()) {
                $this->GetOrderColumns($this->Order->order_id);
                return true;
            }
        }

        return false;
    }
    public function GetOrders($type)
    {
        $query = $this->con->prepare("SELECT * FROM `orders` WHERE `order_price`=" . $type);
        $this->Orders = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Orders[] = $row;
            }
            if ($this->Orders != null)
                return true;
            else
                return true;
        }
        return false;
    }
    public function GetAllOrders()
    {
        $query = $this->con->prepare("SELECT * FROM `orders_seller_view`");
        $this->Orders = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Orders[] = $row;
            }
            if ($this->Orders != null)
                return true;
            else
                return true;
        }
        return false;
    }
    public function GetReportAllOrders()
    {
        $query = $this->con->prepare("SELECT * FROM `orders_seller_view` GROUP BY `order_id`");
        $this->Orders = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Orders[] = $row;
            }
            if ($this->Orders != null)
                return true;
            else
                return true;
        }
        return false;
    }
    public function GetAllActiveOrders($id)
    {
        $query = $this->con->prepare("SELECT * FROM `orders_seller_view` WHERE `order_status`=0 AND ( `order_user_id`=:id OR `user_id`=:id ) ");
        $query->bindParam(":id", $id);
        $this->Orders = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Orders[] = $row;
            }
            if ($this->Orders != null)
                return true;
            else
                return true;
        }
        return false;
    }
    public function GetAllUderWareOrders($where)
    {
        $query = $this->con->prepare("SELECT * FROM `orders_seller_view` WHERE `order_status`!=0 ".$where);
        $this->Orders = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Orders[] = $row;
            }
            if ($this->Orders != null)
                return true;
            else
                return true;
        }
        return false;
    }
}
