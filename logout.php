<?php
require "_core.php";

unset($_SESSION["user_id"]);
 
redirect("login.php");