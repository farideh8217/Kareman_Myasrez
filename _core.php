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
function addReports(int $user_id, array $time_starts, array $time_ends, array $time_teachs, string $description): any
{
    $description = trim($description);
    if ($description === "") return "خطا:وارد کردن گزارش کاری اجباری است";

    $time_starts_count = count($time_starts);
    $time_ends_count = count($time_starts);
    $time_teachs_count = count($time_starts);
}