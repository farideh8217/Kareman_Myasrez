<?php
require "_core.php";

if ($isAuth === true) {
    redirect ("index.php");
}

if (isset($_POST["username"], $_POST["password"], $_POST["submit"])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if ($username === "" || $password === "") {
        $error = "خطا: وارد کردن رمزعبور ونام کاربری اجباری است";
    }else {
        $user_id = getUserIdByUserPass($username,$password);
        if ($user_id !== null) {
            $_SESSION["user_id"] = $user_id;
            redirect("index.php");
        }else {
            $error = "خطا: کد پرسنلی یا رمز عبور نادرست است";
        }
    }  
}
?>
<!doctype html>
<html lang="fa_IR" dir="rtl">
    <head>
        <meta charset="utf-8">
        <title>کارمن - ورود</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="generator" content="KareMan">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.rtl.min.css" integrity="sha384-+4j30LffJ4tgIMrq9CwHvn0NjEvmuDCOfk6Rpg2xg7zgOxWWtLtozDEEVvBPgHqE" crossorigin="anonymous">
        <style type="text/css">
        body {
            font-family: "Vazirmatn";
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="number"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        </style>
    </head>
    <body class="text-center">
        <main class="form-signin">
            <form action="" method="POST">
                <img class="mb-4" src="logo.png" alt="" width="140">
                <h1 class="h3 mb-3 fw-normal">ورود به سامانه</h1>
                <?php if(isset($error)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
                <?php } ?>
                <div class="form-floating">
                    <input name="username" dir="ltr" type="number" class="form-control" id="floatingInput" placeholder="Username" required="">
                    <label for="floatingInput">کد پرسنلی</label>
                </div>
                <div class="form-floating">
                    <input name="password" dir="ltr" type="password" class="form-control" id="floatingPassword" placeholder="Password" required="">
                    <label for="floatingPassword">رمزعبور</label>
                </div>
                <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">
                    ورود
                </button>
                <p class="mt-5 mb-3 text-muted">&copy; تولید اسرز با عشق 2022</p>
            </form>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </body>
</html>
