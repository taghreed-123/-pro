
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$con = false;
$con_err = "";

try {
    $connection = new PDO("mysql:host=localhost;dbname=furniture-db;port=3306;charset=utf8", "root", "");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
    if ($connection) {
        $con = true;
        $con_err = "";
    }
} catch (Exception $ex) {
    $con = false;

    $con_err = $ex->getMessage();
}

function CleaningInputs($value, $pwd_v = false)
{

    if (!empty($value)) {
        if ($pwd_v)
            return preg_replace("/\s+/", "", htmlspecialchars($value));
        else
            return htmlspecialchars($value);
    } else
        return $value;
}

function CheckValue($value, $checkType = "String")
{
    if (!empty($value)) {

        $value = str_replace(" ", "", CleaningInputs($value));
        if (!empty($value)) {
            if ($checkType == "Int") {
                if (is_numeric($value))
                    return true;
            } if ($checkType == "Float") {
                if (is_float($value))
                    return true;
            }else if ($checkType == "String") {
                if (is_string($value) && !is_numeric($value))
                    return true;
            }

            return false;
        }
    }
    return false;
}

function o_hash($str)
{
    return password_hash($str, PASSWORD_BCRYPT);
}
function o_check($p, $p_hashed)
{
    if (!empty($p) && !empty($p_hashed))
        return password_verify($p, $p_hashed);
    return "";
}

function getDateTime($value)
{
    $dateTime = getdate(strtotime($value));
    return  $dateTime['year'] . "-" . $dateTime['mon'] . "-" . $dateTime['mday'] . " " . $dateTime['hours'] . ":" . $dateTime['minutes'] . ":" . $dateTime['seconds'];
}

session_start();
if (!empty($_GET['logout']))
    session_unset();

$server_name = explode('/', $_SERVER['REQUEST_URI']);
$active_page = explode('?', $server_name[2]);
if (count($active_page) > 1)
    $active_page = $active_page[0];
else
    $active_page = $server_name[2];
$main_sidebar_dir = $server_name[0] . "/" . $server_name[1] . "/";
if (!empty($_SESSION)) {
} else {
    // if (empty($active_page))
    //     echo "<script>document.location='mainbefor.php';</script>";
    // else if ($active_page != "login.php" && $active_page != "create_account.php" && $active_page != "mainbefore.php" && $active_page != "postdetails.php" && $active_page != "storeProfile.php" && $active_page != "userprofile.php" && $active_page != "storeslist.php")
    //     echo "<script>document.location='login.php';</script>";
}

?>