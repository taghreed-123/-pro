<?php
class ProductsModel
{
    public $con, $product_id,
        $product_user_id,
        $product_name,
        $product_category,
        $product_desc,
        $product_image,
        $product_notes,
        $product_date,
        $Products,
        $Product, $procesState;

    function __construct()
    {
        global $connection;
        $this->con = $connection;
    }



    public function CheckInputs($checkType = "Add")
    {

        if ($checkType != "Add") {
            if (!CheckValue(filter_var($this->product_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
        }

        if ($checkType != "Delete") {
            if (!CheckValue(filter_var($this->product_user_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
            if (!CheckValue($this->product_name))
                return false;
            if (!CheckValue($this->product_category))
                return false;
            if (!CheckValue($this->product_desc))
                return false;

            // if (!CheckValue(filter_var($this->, FILTER_SANITIZE_NUMBER_FLOAT), "Float")||!CheckValue(filter_var($this->, FILTER_SANITIZE_NUMBER_INT), "Int"))
            //     return false;
            }

        return true;
    }

    public function SQLBindParams($query, $bindType = "Add")
    {
        $this->procesState = false;
        try {
            if ($bindType != "Delete") {

                $query->bindParam(":product_user_id", $this->product_user_id);
                $query->bindParam(":product_name", $this->product_name);
                $query->bindParam(":product_category", $this->product_category);
                $query->bindParam(":product_desc", $this->product_desc);
                $query->bindParam(":product_image", $this->product_image);
                $query->bindParam(":product_notes", $this->product_notes);
            }

            if ($bindType != "Add")
                $query->bindParam(":product_id", $this->product_id);
            if ($query->execute()) {
                if ($bindType == "Add")
                    $this->product_id = $this->con->lastInsertId();
                $this->procesState = true;
            } else
                $this->procesState = false;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $this->procesState = false;
        }
        return $this->procesState;
    }


    public function ADDProduct()
    {
        $query = $this->con->prepare("INSERT INTO `products`(`product_id`,`product_user_id`,`product_name`,`product_category`,`product_desc`,`product_image`,`product_notes`,`product_date`) VALUES(NULL,:product_user_id,:product_name,:product_category,:product_desc,:product_image,:product_notes,now())");
        return $this->SQLBindParams($query);
    }

    public function EditProduct()
    {
        return $this->SQLBindParams($this->con->prepare("UPDATE `products` SET `product_user_id`=:product_user_id,`product_name`=:product_name,`product_category`=:product_category,`product_desc`=:product_desc,`product_notes`=:product_notes,`product_notes`=:product_notes WHERE `product_id`=:product_id"), "Edit");
    }

    public function DeleteProduct()
    {
        return $this->SQLBindParams($this->con->prepare("DELETE FROM `products`  WHERE `product_id`=:product_id "), "Delete");
    }


    public function GetProductColumns($value)
    {
        $query = $this->con->prepare("SELECT * FROM `products` WHERE `product_id`=:val ");
        $query->bindParam(":val", $value);
        if ($query->execute()) {
            if ($data = $query->fetchObject()) {
                $this->product_id = $data->product_id;
                $this->product_user_id = $data->product_user_id;
                $this->product_name = $data->product_name;
                $this->product_category = $data->product_category;
                $this->product_desc = $data->product_desc;
                $this->product_image = $data->product_image;
                $this->product_notes = $data->product_notes;
                $this->product_date = $data->product_date;
            }

            return true;
        }

        return false;
    }

    public function GetProduct($value)
    {
        $query = $this->con->prepare("SELECT * FROM `users_products_view` WHERE `product_id`=:val");
        $query->bindParam(":val", $value);
        $this->Product = array();
        if ($query->execute()) {
            $this->Product = $query->fetchObject();
            return true;
        }

        return false;
    }


    public function GetProducts()
    {
        $query = $this->con->prepare("SELECT * FROM `users_products_view` GROUP BY `product_category`,`product_id` ");
        $this->Products = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Products[] = $row;
            }
            if ($this->Products != null)
                return true;
            else
                return true;
        }

        return false;
    }

    public function GetUserProducts($id)
    {
        $query = $this->con->prepare("SELECT * FROM `users_products_view`  WHERE `product_user_id`=:id GROUP BY `product_category`,`product_id`");
        $query->bindParam(':id', $id);
        $this->Products = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Products[] = $row;
            }
            if ($this->Products != null)
                return true;
            else
                return true;
        }

        return false;
    }

    public function GetProductsView()
    {
        $query = $this->con->prepare("SELECT * FROM `users_products_view` GROUP BY `product_category`,`product_id` ");
        $this->Products = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Products[] = $row;
            }
            if ($this->Products != null)
                return true;
            else
                return true;
        }

        return false;
    }
    public function GetUserFavoriteProductsView($id)
    {
        $query = $this->con->prepare("SELECT * FROM `favorites_products_view` WHERE `favorite_customer_id`=:val ");
        $query->bindParam(':val',$id);
        $this->Products = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Products[] = $row;
            }
            if ($this->Products != null)
                return true;
            else
                return true;
        }

        return false;
    }
}
