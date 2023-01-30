<?php
class CategoriesModel
{
    public $con, $category_id,
        $category_name,
        $category_type,
        $category_notes,
        $category_date,
        $Categories,
        $Category, $procesState;

    function __construct()
    {
        global $connection;
        $this->con = $connection;
    }



    public function CheckInputs($checkType = "Add")
    {

        if ($checkType != "Add") {
            if (!CheckValue(filter_var($this->category_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
        }

        if ($checkType != "Delete") {
            if (!CheckValue($this->category_name))
                return false;
        }

        return true;
    }

    public function SQLBindParams($query, $bindType = "Add")
    {
        $this->procesState = false;
        try {
            if ($bindType != "Delete") {

                $query->bindParam(":category_name", $this->category_name);
                $query->bindParam(":category_type", $this->category_type);
                $query->bindParam(":category_notes", $this->category_notes);
            }

            if ($bindType != "Add")
                $query->bindParam(":category_id", $this->category_id);
            if ($query->execute()) {
                if ($bindType == "Add")
                    $this->category_id = $this->con->lastInsertId();
                $this->procesState = true;
            } else
                $this->procesState = false;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $this->procesState = false;
        }
        return $this->procesState;
    }


    public function ADDCategory()
    {
        $query = $this->con->prepare("INSERT INTO `categories`(`category_id`,`category_name`,`category_type`,`category_notes`,`category_date`) VALUES(NULL,:category_name,:category_type,:category_notes,now())");
        return $this->SQLBindParams($query);
    }

    public function EditCategory()
    {
        return $this->SQLBindParams($this->con->prepare("UPDATE `categories` SET `category_name`=:category_name,`category_type`=:category_type,`category_notes`=:category_notes WHERE `category_id`=:category_id"), "Edit");
    }

    public function DeleteCategory()
    {
        return $this->SQLBindParams($this->con->prepare("DELETE FROM `categories`  WHERE `category_id`=:category_id "), "Delete");
    }


    public function GetCategoryColumns($value)
    {
        $query = $this->con->prepare("SELECT * FROM `categories` WHERE `category_id`=:val ");
        $query->bindParam(":val", $value);
        if ($query->execute()) {
            if ($data = $query->fetchObject()) {
                $this->category_id = $data->category_id;
                $this->category_name = $data->category_name;
                $this->category_type = $data->category_type;
                $this->category_notes = $data->category_notes;
                $this->category_date = $data->category_date;
            }

            return true;
        }

        return false;
    }

    public function GetCategory($value)
    {
        $query = $this->con->prepare("SELECT * FROM `categories` WHERE `category_id`=:val");
        $query->bindParam(":val", $value);
        $this->Category = array();
        if ($query->execute()) {
            $this->Category = $query->fetchObject();
            return true;
        }

        return false;
    }


    public function GetCategories($type)
    {
        $query = $this->con->prepare("SELECT * FROM `categories` WHERE `category_type`=" . $type);
        $this->Categories = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Categories[] = $row;
            }
            if ($this->Categories != null)
                return true;
            else
                return true;
        }
        return false;
    }
    public function GetAllCategories()
    {
        $query = $this->con->prepare("SELECT * FROM `categories`");
        $this->Categories = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Categories[] = $row;
            }
            if ($this->Categories != null)
                return true;
            else
                return true;
        }
        return false;
    }
}
