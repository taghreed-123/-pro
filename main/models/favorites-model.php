<?php
class FavoritesModel
{
    public $con, $favorite_id,
        $favorite_seller_id,
        $favorite_customer_id,
        $favorite_product_id,
        $favorite_notes,
        $favorite_date,
        $Favorites,
        $Favorite, $procesState;

    function __construct()
    {
        global $connection;
        $this->con = $connection;
    }



    public function CheckInputs($checkType = "Add")
    {

        if ($checkType != "Add") {
            if (!CheckValue(filter_var($this->favorite_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
        }

        if ($checkType != "Delete") {
            if (!CheckValue(filter_var($this->favorite_seller_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
                if (!CheckValue(filter_var($this->favorite_customer_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
                if (!CheckValue(filter_var($this->favorite_product_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
        }

        return true;
    }

    public function SQLBindParams($query, $bindType = "Add")
    {
        $this->procesState = false;
        try {
            if ($bindType != "Delete") {

                $query->bindParam(":favorite_seller_id", $this->favorite_seller_id);
                $query->bindParam(":favorite_customer_id", $this->favorite_customer_id);
                $query->bindParam(":favorite_product_id", $this->favorite_product_id);
                $query->bindParam(":favorite_notes", $this->favorite_notes);
            }

            if ($bindType != "Add")
                $query->bindParam(":favorite_id", $this->favorite_id);
            if ($query->execute()) {
                if ($bindType == "Add")
                    $this->favorite_id = $this->con->lastInsertId();
                $this->procesState = true;
            } else
                $this->procesState = false;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $this->procesState = false;
        }
        return $this->procesState;
    }


    public function ADDFavorite()
    {
        $query = $this->con->prepare("INSERT INTO `favorites`(`favorite_id`,`favorite_seller_id`,`favorite_customer_id`,`favorite_product_id`,`favorite_notes`,`favorite_date`) VALUES(NULL,:favorite_seller_id,:favorite_customer_id,:favorite_product_id,:favorite_notes,now())");
        return $this->SQLBindParams($query);
    }

    public function EditFavorite()
    {
        return $this->SQLBindParams($this->con->prepare("UPDATE `favorites` SET `favorite_seller_id`=:favorite_seller_id,`favorite_customer_id`=:favorite_customer_id,`favorite_product_id`=:favorite_product_id,`favorite_notes`=:favorite_notes WHERE `favorite_id`=:favorite_id"), "Edit");
    }

    public function DeleteFavorite()
    {
        return $this->SQLBindParams($this->con->prepare("DELETE FROM `favorites`  WHERE `favorite_id`=:favorite_id "), "Delete");
    }


    public function GetFavoriteColumns($value)
    {
        $query = $this->con->prepare("SELECT * FROM `favorites` WHERE `favorite_id`=:val ");
        $query->bindParam(":val", $value);
        if ($query->execute()) {
            if ($data = $query->fetchObject()) {
                $this->favorite_id = $data->favorite_id;
                $this->favorite_seller_id = $data->favorite_seller_id;
                $this->favorite_customer_id = $data->favorite_customer_id;
                $this->favorite_product_id = $data->favorite_product_id;
                $this->favorite_notes = $data->favorite_notes;
                $this->favorite_date = $data->favorite_date;
            }

            return true;
        }

        return false;
    }

    public function GetFavorite($value,$id)
    {
        $query = $this->con->prepare("SELECT * FROM `favorites` WHERE `favorite_product_id`=:val AND `favorite_customer_id`=:id");
        $query->bindParam(":val", $value);
        $query->bindParam(":id", $id);
        $this->Favorite = array();
        if ($query->execute()) {
            if ($this->Favorite = $query->fetchObject()) {
                $this->GetFavoriteColumns($this->Favorite->favorite_id);
                return true;
            }
        }

        return false;
    }


    public function GetFavorites($type)
    {
        $query = $this->con->prepare("SELECT * FROM `favorites` WHERE `favorite_product_id`=" . $type);
        $this->Favorites = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Favorites[] = $row;
            }
            if ($this->Favorites != null)
                return true;
            else
                return true;
        }
        return false;
    }
    public function GetAllfavorites()
    {
        $query = $this->con->prepare("SELECT * FROM `favorites`");
        $this->Favorites = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Favorites[] = $row;
            }
            if ($this->Favorites != null)
                return true;
            else
                return true;
        }
        return false;
    }
}
