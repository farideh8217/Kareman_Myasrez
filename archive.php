<?php
require "_core.php";

$name = trim($user["first_name"] . " " .$user["last_name"]);

print_r($_POST);
if (isset($_POST["submit"], $_POST["type"], $_POST["description"], $_FILES["file"])) {
    $type = $_POST["type"];
    $description = $_POST["description"];
    $filename = "";

    $file_name = rand(100000,999999)."_".$_FILES["file"]["name"];
    $file_path = "files/".$file_name;

    if ($type === "" || $description === "") {
        $ok = "خطا :لطفا نوع وتوضیح پرونده را وارد کنید";
    }else if (move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
        $ok = addFile($type,$description,$filename);
    }else {
        $ok = "خطا: مشکلی در آپلود فایل بوجود آمده است";
    }
}
$files = getFiles($user["id"]);
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
        * {
            box-sizing: border-box;
        }
        body {
            font-family: "Vazirmatn";
            background-color: #f5f5f5;
        }
        header {
            padding: 2rem 1rem;
            margin-bottom: 2rem;
            background-color: #e9ecef;
        }
#tp-wrap *::selection {
  background: transparent;
}
#tp-wrap {
  width: 100vw; height: 100vh;
  position: fixed; top: 0; left: 0; z-index: 999;
  background: rgba(0, 0, 0, 0.7);
  opacity: 0; visibility: hidden;
  transition: opacity 0.3s;
}
#tp-wrap.show {
  opacity: 1; visibility: visible;
}

/* (B) BOX */
#tp-box {
  position: absolute;
  top: 50%; left: 50%;
  transform: translate(-50%, -50%);
  width: 320px;
  display: flex;
  flex-wrap: wrap;
  flex-direction: row-reverse;
  border: 1px solid #000;
  background: #2d2d2d;
  border-radius: 10px;
}

/* (C) HR/MIN/AM/PM */
.tp-cell {
  width: 33.3%; padding: 0 15px;
  text-align: center;
}
.tp-up, .tp-down {
  padding: 10px 0;
  color: rgb(237, 189, 0);
  font-size: 32px;
  font-weight: 700;
  cursor: pointer;
}
.tp-val {
  width: 100%; padding: 10px 0;
  text-align: center; font-size: 22px;
  background: #fff;
}

/* (D) CLOSE & SET BUTTON */
#tp-close, #tp-set {
  width: 50%; padding: 15px 0; border: 0;
  font-size: 18px; font-weight: 700;
  color: #fff; cursor: pointer;
}
#tp-close {
    background: #c2c2c2;
    border-bottom-left-radius: 10px;
}
#tp-set {
    background: rgb(237, 189, 0);
    border-bottom-right-radius: 10px;
}

/* (E) 24-HOUR MODIFY */
#tp-wrap.tp-24 #tp-ap { display: none; }
#tp-wrap.tp-24 #tp-hr, #tp-wrap.tp-24 #tp-min { width: 50%; }

.widget-wrap {
  width: 500px;
  padding: 30px;
  border-radius: 20px;
  background: rgba(255, 255, 255, 0.5);
}
.widget-wrap label, .widget-wrap input {
  display: block;
  padding: 10px;
  width: 100%;
}

/* SVG */
#hash {
  width: 100px; height:100px;
  background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 640 512" width="100" xmlns="http://www.w3.org/2000/svg"><path d="M496 224c-79.59 0-144 64.41-144 144s64.41 144 144 144 144-64.41 144-144-64.41-144-144-144zm64 150.29c0 5.34-4.37 9.71-9.71 9.71h-60.57c-5.34 0-9.71-4.37-9.71-9.71v-76.57c0-5.34 4.37-9.71 9.71-9.71h12.57c5.34 0 9.71 4.37 9.71 9.71V352h38.29c5.34 0 9.71 4.37 9.71 9.71v12.58zM496 192c5.4 0 10.72.33 16 .81V144c0-25.6-22.4-48-48-48h-80V48c0-25.6-22.4-48-48-48H176c-25.6 0-48 22.4-48 48v48H48c-25.6 0-48 22.4-48 48v80h395.12c28.6-20.09 63.35-32 100.88-32zM320 96H192V64h128v32zm6.82 224H208c-8.84 0-16-7.16-16-16v-48H0v144c0 25.6 22.4 48 48 48h291.43C327.1 423.96 320 396.82 320 368c0-16.66 2.48-32.72 6.82-48z" /></svg>');
  background-repeat: no-repeat;
  background-position: center;
}

/* FOOTER */
#code-boxx {
  font-weight: 600;
  margin-top: 30px;
}
#code-boxx a {
  display: inline-block;
  padding: 5px;
  text-decoration: none;
  background: #b90a0a;
  color: #fff;
}


.reports {
    
}
.reports-add {
    width: 60px;
    margin: auto;
    cursor: pointer;
}
.reports-add span {
    font-size: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgb(237, 189, 0);
    border-radius: 100%;
    width: 60px;
    height: 60px;
}
</style>
</head>
<body>
<header>
    <div class="container d-flex align-items-center justify-content-center flex-column">
        <img class="mb-2" src="logo.png" alt="" width="100px">
        <h3 class="display-5">سلام <?= $name ?>!</h3>
        <p class="mt-4">
            <?= $nice_statments ?>
            <b>
                دیوید برینکلی؛ فیلمنامه‌نویس-----------
            </b>
        </p>
        <p>
            <a class="btn btn-primary btn-sm" href="logout.php" role="button">خروج</a>
            <a class="btn btn-primary btn-sm" href="archive.php" role="button">بایگانی</a>
        </p>
    </div>
</header>

<main class="container">
<form action="" method="POST" enctype="multipart/form-data">
    <h1 class="h3 mb-3 fw-normal">ثبت پرونده</h1>
    <?php if(isset($ok) && $ok === true) { ?>
    <div class="alert alert-success" role="alert">
        پزونده جدید با موفقیت ثبت شد.
    </div>
    <?php } ?>

    <?php if(isset($ok) && $ok !== true) { ?>
    <div class="alert alert-warning" role="alert">
        <?= $ok ?>
    </div>
    <?php } ?>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">نوع</label>
            <select name="type" class="form-control">
                <option value="">متفرقه</option>
                <option value="">مصاحبه</option>
                <option value="">گزارش</option>
                <option value="" selected="">قرارداد</option>
            </select>    
        </div>
        <div class="mb-3">
            <label class="form-label">توضیح</label>
            <textarea name="description" rows="5" class="form-control" required=""></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">انتخاب فایل</label>
            <input name="file" type="file" class="form-control" required="">
        </div>
        <button name="submit" type="submit" class="btn btn-primary">ذخیره</button>
</form>        
<!----------------------------------------------------------------------------------------->
    <h1 class="mt-4 h3 mb-3 fw-normal">پرونده ها </h1>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">نوع</th>
        <th scope="col">توضیح</th>
        <th scope="col">پیوست</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($files as $file_item) { ?>
        <tr>
        <th scope="row">1</th>
        <td><?= $file_item["type"] ?></td>
        <td><?= $file_item["description"] ?></td>
        <td>
            <a target="_blank" href="files/<?= $file_item["filename"] ?>"><!-- برای اینکه روی عکس کلیک کردیم آن را در صفحه ی جدید بزرگ شده نشان دهد-->
                <?php if(str_ends_with($file_item["filename"], ".jpeg") || 
                str_ends_with($file_item["filename"], ".jpg") || 
                str_ends_with($file_item["filename"], ".png") || 
                str_ends_with($file_item["filename"], ".bmp") || 
                str_ends_with($file_item["filename"], ".gif")) { ?>
            <img src = "files/<?= $file_item["filename"] ?>" width="200px">
            <?php } else { ?>
                <?= $file_item["filename"] ?>
            <?php } ?>    
        </td>
        </tr>
    <?php } ?>    
    </tbody>
    </table>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script type="text/javascript">
    </body>
</html>
