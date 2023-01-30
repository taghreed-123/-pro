<?php
class FollowersModel
{
    public $con, $followers_id,
        $followers_seller_id,
        $followers_customer_id,
        $followers_notes,
        $followers_date,
        $Followers,
        $Follower, $procesState;

    function __construct()
    {
        global $connection;
        $this->con = $connection;
    }



    public function CheckInputs($checkType = "Add")
    {

        if ($checkType != "Add") {
            if (!CheckValue(filter_var($this->followers_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
        }

        if ($checkType != "Delete") {
            if (!CheckValue(filter_var($this->followers_seller_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
                if (!CheckValue(filter_var($this->followers_customer_id, FILTER_SANITIZE_NUMBER_INT), "Int"))
                return false;
        }

        return true;
    }

    public function SQLBindParams($query, $bindType = "Add")
    {
        $this->procesState = false;
        try {
            if ($bindType != "Delete") {

                $query->bindParam(":followers_seller_id", $this->followers_seller_id);
                $query->bindParam(":followers_customer_id", $this->followers_customer_id);
                $query->bindParam(":followers_notes", $this->followers_notes);
            }

            if ($bindType != "Add")
                $query->bindParam(":followers_id", $this->followers_id);
            if ($query->execute()) {
                if ($bindType == "Add")
                    $this->followers_id = $this->con->lastInsertId();
                $this->procesState = true;
            } else
                $this->procesState = false;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $this->procesState = false;
        }
        return $this->procesState;
    }


    public function ADDFollower()
    {
        $query = $this->con->prepare("INSERT INTO `followers`(`followers_id`,`followers_seller_id`,`followers_customer_id`,`followers_notes`,`followers_date`) VALUES(NULL,:followers_seller_id,:followers_customer_id,:followers_notes,now())");
        return $this->SQLBindParams($query);
    }

    public function EditFollower()
    {
        return $this->SQLBindParams($this->con->prepare("UPDATE `followers` SET `followers_seller_id`=:followers_seller_id,`followers_customer_id`=:followers_customer_id,`followers_notes`=:followers_notes WHERE `followers_id`=:followers_id"), "Edit");
    }

    public function DeleteFollower()
    {
        return $this->SQLBindParams($this->con->prepare("DELETE FROM `followers`  WHERE `followers_id`=:followers_id "), "Delete");
    }


    public function GetFollowerColumns($value)
    {
        $query = $this->con->prepare("SELECT * FROM `followers_customer_view` WHERE `followers_id`=:val ");
        $query->bindParam(":val", $value);
        if ($query->execute()) {
            if ($data = $query->fetchObject()) {
                $this->followers_id = $data->followers_id;
                $this->followers_seller_id = $data->followers_seller_id;
                $this->followers_customer_id = $data->followers_customer_id;
                $this->followers_notes = $data->followers_notes;
                $this->followers_date = $data->followers_date;
            }

            return true;
        }

        return false;
    }

    public function GetFollower($value,$id)
    {
        $query = $this->con->prepare("SELECT * FROM `followers_customer_view` WHERE `followers_seller_id`=:val AND `followers_customer_id`=:id");
        $query->bindParam(":val", $value);
        $query->bindParam(":id", $id);
        $this->Follower = array();
        if ($query->execute()) {
            if ($this->Follower = $query->fetchObject()) {
                $this->GetFollowerColumns($this->Follower->followers_id);
                return true;
            }
        }

        return false;
    }


    public function GetFollowers($id)
    {
        $query = $this->con->prepare("SELECT * FROM `followers_customer_view` WHERE `followers_seller_id`=" . $id);
        $this->Followers = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Followers[] = $row;
            }
            if ($this->Followers != null)
                return true;
            else
                return true;
        }
        return false;
    }

    public function GetFollowed($id)
    {
        $query = $this->con->prepare("SELECT * FROM `followers_seller_view` WHERE `followers_customer_id`=" . $id);
        $this->Followers = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Followers[] = $row;
            }
            if ($this->Followers != null)
                return true;
            else
                return true;
        }
        return false;
    }
    public function GetAllFollowers()
    {
        $query = $this->con->prepare("SELECT * FROM `followers_customer_view`");
        $this->Followers = array();
        if ($query->execute()) {

            while ($row = $query->fetchObject()) {
                $this->Followers[] = $row;
            }
            if ($this->Followers != null)
                return true;
            else
                return true;
        }
        return false;
    }
}
