<?php
class UsersModel
{
    public $con, $table, $table_prefix, $user_id,
        $user_full_name,
        $user_email,
        $user_pwd,
        $user_phone,
        $user_image,
        $user_location,
        $user_city,
        $user_category,
        $user_type,
        $user_store,
        $user_active,
        $user_notes,
        $user_date,
        $Users,
        $User, $procesState;

    function __construct()
    {
        global $connection;
        $this->con = $connection;
    }



    public function CheckInputs($checkType = "Add")
    {

        if ($checkType != "Add") {
            if (!CheckValue(filter_var($this->user_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
        }

        if ($checkType != "Delete") {
            if (!CheckValue($this->user_full_name))
                return false;
            // if ($checkType == "Edit") {
            //     if (!CheckValue($this->user_pwd))
            //         return false;
            // }

        }

        return true;
    }

    public function SQLBindParams($query, $bindType = "Add")
    {
        $this->procesState = false;
        if (!empty($this->user_pwd)) {
            $this->user_pwd = o_hash($this->user_pwd);
        }
        try {
            if ($bindType != "Delete") {

                $query->bindParam(":user_full_name", $this->user_full_name);
                $query->bindParam(":user_email", $this->user_email);
                if (!empty($this->user_pwd))
                    $query->bindParam(":user_pwd", $this->user_pwd);
                $query->bindParam(":user_phone", $this->user_phone);
                $query->bindParam(":user_type", $this->user_type);
                $query->bindParam(":user_store", $this->user_store);
                $query->bindParam(":user_active", $this->user_active);
                $query->bindParam(":user_image", $this->user_image);
                $query->bindParam(":user_city", $this->user_city);
                $query->bindParam(":user_location", $this->user_location);
                $query->bindParam(":user_category", $this->user_category);
                $query->bindParam(":user_notes", $this->user_notes);
            } else {
                $query->bindParam(":user_pwd", $this->user_pwd);
            }

            if ($bindType != "Add")
                $query->bindParam(":user_id", $this->user_id);
            if ($query->execute()) {
                if ($bindType == "Add")
                    $this->user_id = $this->con->lastInsertId();
                $this->procesState = true;
            } else
                $this->procesState = false;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $this->procesState = false;
        }
        return $this->procesState;
    }


    public function ADDUser()
    {
        $query = $this->con->prepare("INSERT INTO `users`(`user_id`,`user_full_name`,`user_email`,`user_pwd`,`user_phone`,`user_type`,`user_store`,`user_active`,`user_image`,`user_city`,`user_location`,`user_category`,`user_notes`,`user_date`) VALUES(NULL,:user_full_name,:user_email,:user_pwd,:user_phone,:user_type,:user_store,:user_active,:user_image,:user_city,:user_location,:user_category,:user_notes,now())");
        return $this->SQLBindParams($query);
    }

    public function EditUser()
    {
        $pwd = "";
        if (!empty($this->user_pwd))
            $pwd = "`user_pwd`=user_pwd,";
        return $this->SQLBindParams($this->con->prepare("UPDATE `users` SET `user_full_name`=:user_full_name,`user_email`=:user_email,$pwd`user_phone`=:user_phone,`user_type`=:user_type,`user_store`=:user_store,`user_active`=:user_active,`user_image`=:user_image,`user_city`=:user_city,`user_location`=:user_location,`user_category`=:user_category,`user_notes`=:user_notes WHERE `user_id`=:user_id"), "Edit");
    }

    public function DeleteUser()
    {
        return $this->SQLBindParams($this->con->prepare("DELETE FROM `users`  WHERE `user_id`=:user_id and `user_pwd`=:user_pwd"), "Delete");
    }


    public function GetUserColumns($value)
    {
        $query = $this->con->prepare("SELECT * FROM `users` WHERE `user_id`=:val ");
        $query->bindParam(":val", $value);
        if ($query->execute()) {
            if ($data = $query->fetchObject()) {
                $this->user_id = $data->user_id;
                $this->user_full_name = $data->user_full_name;
                $this->user_email = $data->user_email;
                $this->user_pwd = $data->user_pwd;
                $this->user_phone = $data->user_phone;
                $this->user_type = $data->user_type;
                $this->user_store = $data->user_store;
                $this->user_active = $data->user_active;
                $this->user_image = $data->user_image;
                $this->user_city = $data->user_city;
                $this->user_location = $data->user_location;
                $this->user_category = $data->user_category;
                $this->user_notes = $data->user_notes;
                $this->user_date = $data->user_date;
            }

            return true;
        }

        return false;
    }

    public function GetUser($value)
    {
        $query = $this->con->prepare("SELECT * FROM `users` WHERE `user_id`=:val");
        $query->bindParam(":val", $value);
        $this->User = array();
        if ($query->execute()) {
            $this->User = $query->fetchObject();
            return true;
        }

        return false;
    }

    public function checkUserEmail($value)
    {
        $query = $this->con->prepare("SELECT * FROM `users` WHERE `user_email`=:val");
        $query->bindParam(":val", $value);
        $this->User = array();
        if ($query->execute()) {
            $this->User = $query->fetchObject();
            if($this->User!=null)
                return true;
        }

        return false;
    }
    public function ChangeUserPWD($id,$value)
    {
        $query = $this->con->prepare("UPDATE `users` SET `user_pwd`=:pwd WHERE `user_id`=:id");
        $query->bindParam(":pwd", $value);
        $query->bindParam(":id", $id);
        $this->User = array();
        if ($query->execute()) {
            return true;
        }

        return false;
    }
    public function GetUserLogIn($email, $pwd)
    {
        return $this->logIn($email, $pwd);
    }

    public function logIn($email, $pwd)
    {
        $query = $this->con->prepare("SELECT * FROM `users` WHERE `user_email`=:email ");
        $query->bindParam(":email", $email);
        $this->User = array();

        if ($query->execute()) {

            if ($row = $query->fetchObject()) {
                if (!o_check($pwd, $row->user_pwd))
                    return false;
                else {
                    do {
                        $this->User[] = $row;
                    } while ($row = $query->fetchObject());
                    return true;
                }
            }
        }
        return false;
    }

    public function GetUsers()
    {
        $query = $this->con->prepare("SELECT * FROM `users` ");
        $this->Users = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Users[] = $row;
            }
            return true;
        }

        return false;
    }

    public function GetSearchUsersProducts($search)
    {
        $query = $this->con->prepare("SELECT * FROM `users_products_view` WHERE `user_type`='business' AND (`user_full_name` LIKE ('%".$search."%') || `user_store` LIKE ('%".$search."%') || `user_email` LIKE ('%".$search."%') || `product_category` LIKE ('%".$search."%') || `product_name` LIKE ('%".$search."%'))");
        $this->Users = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Users[] = $row;
            }
            return true;
        }

        return false;
    }
    public function GetUsersStores()
    {
        $query = $this->con->prepare("SELECT * FROM `users` WHERE `user_type`='business'");
        $this->Users = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Users[] = $row;
            }
            return true;
        }

        return false;
    }
}
