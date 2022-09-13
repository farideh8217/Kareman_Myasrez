<?php
require "_core.php";

if (!$isAuth) {
    redirect("login.php");
}
$name = trim($user["first_name"] . " " .$user["last_name"]);

if (isset($_POST["submit"], $_POST["time_start"], $_POST["time_end"], $_POST["time_teach"], $_POST["description"]) 
    && is_array($_POST["time_start"])
    && is_array($_POST["time_end"])
    && is_array($_POST["time_teach"])
    && is_array($_POST["description"]))
{
    $time_starts = $_POST["time_start"];
    $time_ends = $_POST["time_end"];
    $time_teachs = $_POST["time_teach"];
    $descriptions = $_POST["description"];

    $ok = addReports($user["id"], $time_starts, $time_ends, $time_teachs, $descriptions);
}
$today_reports = getTodayReports($user["id"]);
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
                        دیوید برینکلی؛ فیلمنامه‌نویس
                    </b>
                </p>
                <p>
                    <a class="btn btn-primary btn-sm" href="logout.php" role="button">خروج</a>
                    <a class="btn btn-primary btn-sm" href="archive.php" role="button">بایگانی</a>
                </p>
            </div>
        </header>

        <main class="container">
            <form action="" method="POST">
                <h1 class="h3 mb-3 fw-normal">ثبت گزارش</h1>
                <?php if(isset($ok) && $ok === true) { ?>
                <div class="alert alert-success" role="alert">
                    گزارش با موفقیت ثبت شد.
                </div>
                <?php } ?>

                <?php if(isset($ok) && $ok !== true) { ?>
                <div class="alert alert-warning" role="alert">
                   <?= $ok ?>
                </div>
                <?php } ?>

                <div class="reports">
                    <?php foreach ($today_reports as $today_report_item) { ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">زمان ورود</label>
                                    <input name="time_start[]" type="text" class="form-control time-picker" required="" value="<?= $today_report_item["time_start"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">زمان خروج</label>
                                    <input name="time_end[]" type="text" class="form-control time-picker" required="" value="<?= $today_report_item["time_end"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">زمان تدریس</label>
                                    <input name="time_teach[]" type="text" class="form-control time-picker" required="" value="<?= $today_report_item["time_teach"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">گزارش فعالیت</label>
                                    <textarea name="descriptions[]" class="form-control"  rows="6" required=""><?= $today_report_item["description"] ?></textarea>
                                </div>
                            </div>
                        </div>
                    <?php } ?>    
                </div>
                <div class="reports-add">
                    <span>+</span>
                </div>
                

                <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">
                    ذخیره
                </button>
                <p class="mt-5 mb-3 text-muted text-center">&copy; تولید اسرز با عشق 2022</p>
            </form>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script type="text/javascript">
        var tp = {
            // (A) INIT - GENERATE TIME PICKER HTML
            hwrap : null, // entire html time picker
            hhr : null,   // html hour value
            hmin : null,  // html min value
            hap : null,   // html am/pm value
            init : () => {
                // (A1) ADD TIME PICKER TO BODY
                tp.hwrap = document.createElement("div");
                tp.hwrap.id = "tp-wrap";
                document.body.appendChild(tp.hwrap);

                // (A2) TIME PICKER INNER HTML
                tp.hwrap.innerHTML =
                `<div id="tp-box">
                <div class="tp-cell" id="tp-hr">
                    <div class="tp-up">&#65087;</div> <div class="tp-val">0</div> <div class="tp-down">&#65088;</div>
                </div>
                <div class="tp-cell" id="tp-min">
                    <div class="tp-up">&#65087;</div> <div class="tp-val">0</div> <div class="tp-down">&#65088;</div>
                </div>
                <div class="tp-cell" id="tp-ap">
                    <div class="tp-up">&#65087;</div> <div class="tp-val">AM</div> <div class="tp-down">&#65088;</div>
                </div>
                <button id="tp-close" onclick="tp.hwrap.classList.remove('show')">انصراف</button>
                <button id="tp-set" onclick="tp.set()">تنظیم</button>
                </div>`;

                // (A3) GET VALUE ELEMENTS + SET CLICK ACTIONS
                for (let segment of ["hr", "min", "ap"]) {
                let up = tp.hwrap.querySelector(`#tp-${segment} .tp-up`),
                    down = tp.hwrap.querySelector(`#tp-${segment} .tp-down`);
                tp["h"+segment] = tp.hwrap.querySelector(`#tp-${segment} .tp-val`);

                if (segment=="ap") {
                    up.onclick = () => { tp.spin(true, segment); };
                    down.onclick = () => { tp.spin(true, segment); };
                } else {
                    up.onmousedown = () => { tp.spin(true, segment); };
                    down.onmousedown = () => { tp.spin(false, segment); };
                    up.onmouseup = () => { tp.spin(null); };
                    down.onmouseup = () => { tp.spin(null); };
                    up.onmouseleave = () => { tp.spin(null); };
                    down.onmouseleave = () => { tp.spin(null); };
                }
                }
            },

            // (B) SPIN HOUR/MIN/AM/PM
            //  direction : true (up), false (down), null (stop)
            //  segment : "hr", "min", "ap" (am/pm)
            timer : null, // for "continous" time spin
            minhr : 1,    // min spin limit for hour
            maxhr : 12,   // max spin limit for hour
            minmin : 0,   // min spin limit for minute
            maxmin : 59,  // max spin limit for minute
            spin : (direction, segment) => {
                // (B1) CLEAR TIMER
                if (direction==null) {
                    if (tp.timer!=null) {
                        clearTimeout(tp.timer);
                        tp.timer = null;
                    }
                }

                // (B2) SPIN FOR AM/PM
                else if (segment=="ap") { tp.hap.innerHTML = tp.hap.innerHTML=="AM" ? "PM" : "AM"; }

                // (B3) SPIN FOR HR/MIN
                else {
                // (B3-1) INCREMENT/DECREMENT
                let next = +tp["h"+segment].innerHTML;
                next = direction ? next+1 : next-1;

                // (B3-2) MIN/MAX
                if (segment=="hr") {
                    if (next > tp.maxhr) { next = tp.maxhr; }
                    if (next < tp.minhr) { next = tp.minhr; }
                } else {
                    if (next > tp.maxmin) { next = tp.maxmin; }
                    if (next < tp.minmin) { next = tp.minmin; }
                }

                // (B3-3) SET VALUE
                if (next < 10) next = "0" + next;
                tp["h"+segment].innerHTML = next;

                // (B3-4) KEEP ROLLING - LOWER TIMEOUT WILL SPIN FASTER
                tp.timer = setTimeout(() => {
                    tp.spin(direction, segment);
                }, 100);
            }},

            // (C) ATTACH TIME PICKER TO HTML FIELD
            //  target : html field to attach to
            //  24 : 24 hours time? default false.
            //  after : optional, function to run after selecting time
            attach : (instance) => {
                // (C1) READONLY FIELD + NO AUTOCOMPLETE
                // IMPORTANT, PREVENTS ON-SCREEN KEYBOARD
                instance.target.readOnly = true;
                instance.target.setAttribute("autocomplete", "off");

                // (C2) DEFAULT 12 HOURS MODE
                if (instance["24"] == undefined) instance["24"] = false;

                // (C3) CLICK TO OPEN TIME PICKER
                instance.target.addEventListener("click", () => { tp.show(instance); });
            },

            // (D) SHOW TIME PICKER
            setfield : null, // set selected time to this html field
            set24 : false, // false,   // 24 hours mode? default false.
            setafter : null, // run this after selecting time
            show : (instance) => {
                // (D1) INIT FIELDS TO SET + OPTIONS
                tp.setfield = instance.target;
                tp.setafter = instance.after;
                tp.set24 = instance["24"];
                tp.minhr = tp.set24 ? 0 : 1 ;
                tp.maxhr = tp.set24 ? 23 : 12 ;

                // (D2) READ CURRENT VALUE
                let val = tp.setfield.value;
                // alert(tp.set24);
                if (val == "") {
                    tp.hhr.innerHTML = "0"+tp.minhr;
                    tp.hmin.innerHTML = "0"+tp.minmin;
                    tp.hap.innerHTML = "AM";
                } else {
                    tp.hhr.innerHTML = val.substring(0, 2);
                    tp.hmin.innerHTML = val.substring(3, 5);
                }

                // (D3) SHOW TIME PICKER
                if (tp.set24) { tp.hwrap.classList.add("tp-24"); }
                else { tp.hwrap.classList.remove("tp-24"); }
                tp.hwrap.classList.add("show");
            },

            // (E) SET TIME
            set : () => {
                // (E1) TIME TO FIELD
                tp.setfield.value = tp.hhr.innerHTML + ":" + tp.hmin.innerHTML; // + " " + tp.hap.innerHTML;
                tp.hwrap.classList.remove("show");

                // (E2) RUN AFTER, IF SET
                if (tp.setafter) { tp.setafter(tp.setfield.value); }
            }
            };

        // (F) ATTACH ON PAGE LOAD
        document.addEventListener("DOMContentLoaded", () => {
            tp.init();
        });
        ///////////////////////////////////
        const reports = document.querySelector(".reports");
        const reports_add = document.querySelector(".reports-add");
        const report_item_code = `<div class="card mb-3">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">زمان ورود</label>
                    <input name="time_start[]" type="text" class="form-control time-picker" required="">
                </div>
                <div class="mb-3">
                    <label class="form-label">زمان خروج</label>
                    <input name="time_end[]" type="text" class="form-control time-picker" required="">
                </div>
                <div class="mb-3">
                    <label class="form-label">زمان تدریس</label>
                    <input name="time_teach[]" type="text" class="form-control time-picker" required="">
                </div>
                <div class="mb-3">
                    <label class="form-label">گزارش فعالیت</label>
                    <textarea name="description[]" class="form-control"  rows="6" required=""></textarea>
                </div>
            </div>
        </div>`;
        const time_picker_handle = () => {
            const time_pickers = document.querySelectorAll(".time-picker");
            time_pickers.forEach((time_picker) => {
                tp.attach({
                    target: time_picker,
                    "24" : true
                });
            });
        };
        window.addEventListener("load", () => {
            reports_add.click();
            
        });
        reports_add.addEventListener("click", () => {
            const div = document.createElement("div");
            div.innerHTML = report_item_code;
            reports.appendChild(div);
            
            time_picker_handle();
        });
        </script>
    </body>
</html>
