<?php
session_start();
require "_secret.php";

try {
    $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed: " .$e->getMessage() . "\n";
    exit();
}
////////////////////////////
function redirect($path) 
{
    header("Location: " . $path);
    exit();
}
/////////////////////////////
function getUser($user_id): ?array //تنها استفاده ی آن در نمایش نام کاربر است
{
    global $db;

    $sql = "SELECT * FROM  `users` WHERE `id` = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id",$user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user === false) return null;
    return $user;
}
/////////////////////////////
function getUserIdByUserPass(string $username, string $password): ?int
{
    global $db;

    $password = md5($password);

    $sql = "SELECT id FROM `users` WHERE `username` = :username AND `password` = :password";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $user_id = $stmt->fetchColumn();
    if ($user_id === false) return null;
    return $user_id;
}
///////////////////////////
if (isset($_SESSION["user_id"])) $isAuth = true;
else $isAuth = false;

if($isAuth === true) {
    $user = getUser($_SESSION["user_id"]);
    if ($user === null) $isAuth = false;    
}
//////////////////////////
function addReport(int $user_id, string $time_start, string $time_end, string $time_teach, string $description)
{
    global $db;

    $today = date("Y_m_d");

    $sql = "INSERT INTO `reports`(`user_id`, `date`, `time_start`, `time_end`, `time_teach`,`description`) 
    VALUES (:user_id,:date,:time_start,:time_end,:time_teach,:description)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":user_id",$user_id);
    $stmt->bindParam(":date",$today);
    $stmt->bindParam(":time_start",$time_start);
    $stmt->bindParam(":time_end",$time_end);
    $stmt->bindParam(":time_teach",$time_teach);
    $stmt->bindParam(":description",$description);
    $stmt->execute();
}
//////////////////////////
function addReports(int $user_id, array $time_starts, array $time_ends, array $time_teachs, string $description): mixed
{

    $description = trim($description);
    if ($description === "") return "خطا:وارد کردن گزارش کاری اجباری است";

    $time_starts_count = count($time_starts);
    $time_ends_count = count($time_starts);
    $time_teachs_count = count($time_starts);

    if ($time_starts_count === 0 || $time_ends_count === 0 || $time_teachs_count === 0 ) return "وارد کردن ساعت کاری اجباری است";

    if ($time_starts_count !== $time_ends_count || $time_starts_count !== $time_teachs_count || $time_ends_count !== $time_teachs_count) return "تعداد ساعت شروع و پایان وآموزش باید یکسان باشد"; 

    $data = [];
    foreach ($time_starts as $i => $time_start) {
        if (!isset($time_ends[$i]) || 
        !isset($time_teachs[$i]) ||
        trim($time_start) === "" || 
        trim($time_ends[$i]) === "" || 
        trim($time_teachs[$i]) === "") {
            continue;
        }else {
            if ($time_start === $time_end) {
                return "زمان آغاز و پایان نمی تواند یکسان باشد";
            }else {
                $data[]= [
                "time_start" => $time_start,
                "time_end" => $time_ends[$i],
                "time_teach" => $time_teachs[$i],
                ];
        }
    }
    if (count($data) === 0) {
        return "خطا:وارد کردن ساعت کاری اجباری است";
    }else {
        foreach ($data as $data_item) {
            addReport($user_id, $data_item["time_start"], $data_item["time_end"], $data_item["time_teach"], $description);
        }
        return true;
    }
}
}
/////////////////////////////////////////