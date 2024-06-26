<?php
session_start();
$serverName = "192.168.27.217";
$uid = "Faragostar";
$pwd = "12341234";
$databaseName = "Reports";
$connectionInfo = array("Database" => $databaseName, "CharacterSet" => "UTF-8", "UID" => $uid, "PWD" => $pwd);
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    //die( print_r( sqlsrv_errors(), true));
    echo 'not ok';
}
$start = 0;
$perpage = 12;
$records = "SELECT * FROM Faragostar.View_Unifier WHERE [BranchName]='زاهدان'";
$query = sqlsrv_query($conn, $records, array(), array("Scrollable" => 'static'));
$row_count = sqlsrv_num_rows($query);


$pages = ceil($row_count / $perpage);
if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $perpage;
}
$sql = " SELECT TOP " . $perpage . " FROM Faragostar.View_Unifier WHERE [BranchName]='زاهدان'";
$stmt = sqlsrv_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Simple Data Table</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {

            color: #566787;
            background: #f5f5f5;
            font-family: 'Yekan', sans-serif;
            font-size: 13px;
        }

        @font-face {
            font-family: Yekan;
            src: url(./font/Yekan.ttf);
        }

        .container-castum {
            max-width: 1700px;
            margin: 0 auto;
        }

        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 10px;
            margin: 0 0 10px;
            min-width: 100%;
        }

        .re_data {
            background-color: #5f3636db;
            text-align: center;
            font-size: 25px;
            color: #fff;
            position: absolute;
            width: 40%;
            border-radius: 5px;
            right: 110px;
            height: 4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            top: 20px;
        }

        .table-title h2 {
            margin: 10px 15px 0px 0px;
            font-size: 22px;
        }

        .search-box {
            position: relative;
            float: right;
            width: 47%;
        }

        .search-box input {
            height: 45px;
            border-radius: 10px;
            padding-right: 50px;
            border-color: #ddd;
            box-shadow: none;
            direction: rtl;
        }

        /* .search-box input:focus {
    border-color: #3FBAE4;
    box-shadow: 0px 0px 7px 6px rgba(0,0,0,0.59);
    -webkit-box-shadow: 0px 0px 7px 6px rgba(0,0,0,0.59);
    -moz-box-shadow: 0px 0px 7px 6px rgba(0,0,0,0.59);
    } */

        .search-box i {
            color: #a0a5b1;
            position: absolute;
            font-size: 19px;
            top: 14px;
            right: 10px;
            object-position: center;
        }

        table {
            text-align: center;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
        }

        table tr:hover {
            cursor: pointer;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #baddfb;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        /* table.table td:last-child {
    width: 130px;
    } */

        table.table td a {
            color: #a0a5b1;
            display: inline-block;
            margin: 0 5px;
        }

        .table td,
        .table th {
            padding: .6rem !important;
            align-content: center;
        }

        table {

            width: 100%;
        }

        td:nth-child(11),
        td:nth-child(10) {
            width: 3%;
            text-wrap: nowrap;
            overflow: hidden;
        }

        td:nth-child(9) {
            width: 3%;
            text-wrap: nowrap;
            overflow: hidden;
        }

        td:nth-child(8),
        td:nth-child(7) {
            width: 5%;
            text-wrap: nowrap;
            overflow: hidden;
        }

        td:nth-child(6),
        td:nth-child(5),
        td:nth-child(4),
        td:nth-child(3),
        td:nth-child(2),
        td:nth-child(1) {
            width: 8%;
            text-wrap: nowrap;
            overflow: hidden;
        }

        td:nth-child(3),
        td:nth-child(2) {
            width: 5%;
            text-wrap: nowrap;
            overflow: hidden;
        }

        td:nth-child(1) {
            min-width: 15rem;
            max-width: 15rem;
            white-space: nowrap;
            overflow: hidden;
            overflow-wrap: anywhere;
            direction: rtl;
            font-size: 11px;

        }

        table.table td a.view {
            color: #03A9F4;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #E34724;
        }

        table.table td i {
            font-size: 19px;
        }

        .pagination {
            float: right;
            margin: 0 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 95%;
            width: 30px;
            height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 30px !important;
            text-align: center;
            padding: 0;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;
            margin-top: 6px;
            font-size: 95%;
        }

        .hide {
            display: none;
        }

        .shownum {
            display: block !important;
        }

        .inner-search {
            box-shadow: inset 0px 1px 11px 0px rgba(0, 0, 0, .24);
            border: none;
            border-radius: 5px;
            height: 2rem;
            direction: rtl;
            padding-right: 10px;
            min-width: 100%;

        }

        .inner-search:focus {
            outline-width: 0;
            box-shadow: 0px 0px 5px 5px rgba(194, 218, 255, 1);
            -webkit-box-shadow: 0px 0px 5px 5px rgba(194, 218, 255, 1);
            -moz-box-shadow: 0px 0px 5px 5px rgba(194, 218, 255, 1);
            border: none;
        }

        input[type=checkbox] {
            transform: scale(1.5);
        }



        .filterIcon {
            height: 16px;
            width: 16px;
        }

        .modalFilter {
            display: none;
            height: auto;
            background: #FFF;
            border: solid 1px #ccc;
            padding: 8px;
            position: absolute;
            z-index: 1001;
        }

        .modalFilter .modal-content {
            max-height: 250px;
            overflow-y: auto;
        }

        .modalFilter .modal-footer {
            background: #FFF;
            height: 35px;
            padding-top: 6px;
        }

        .modalFilter .btn {
            padding: 0 1em;
            height: 28px;
            line-height: 28px;
            text-transform: none;
        }

        #mask {
            display: none;
            background: transparent;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1;
            width: 100%;
            height: 100%;
            opacity: 1000;
        }

        .col-md-3 {
            text-align: right;
            margin-top: 1rem;
        }

        .badge i {
            font-size: 30px;
            position: relative;
        }

        #load {
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 9999;
            background: url("/loading.gif") no-repeat center center rgba(0, 0, 0, 0.25)
        }

        .form-align {
            width: 100% !important;
            justify-content: space-between;
            direction: rtl;
            text-align: justify;

        }

        .sticky_header {
            position: fixed;
            width: 1700px;
            background-color: #fff;
            padding: 10px;
            z-index: 99999999;
            top: 14%;
            left: 50%;
            transform: translate(-50%, -50%);

        }

        .sticky_header2 {
            position: fixed;
            width: 1700px;
            background-color: #fff;
            padding: 10px;
            z-index: 99999999;
            top: 32%;
            left: 50%;
            transform: translate(-50%, -50%);

        }

        .add-list {
            background-color: #adadad;
            color: #fff;
            padding: 9px;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            width: 20%;
            text-align: center;
            position: relative;
        }

        .add-list:hover {
            text-decoration: none;
            color: #fff;
        }

        .add-list span {
            position: absolute;
            font-size: 13px;
            background-color: #dfe2f3;
            color: #000;
            border-radius: 23%;
            font-family: sans-serif;
            padding: 6px;
            left: 7px;
            bottom: 28px;
            z-index: 99999;
            display: table;
        }
    </style>
</head>
<?php
if (isset($_GET['page-nr'])) {
    $id = $_GET['page-nr'];
} else {
    $id = 1;
}
?>

<body id="<?php echo $id; ?>">
    <form action="result.php" method="post">
        <div class="container-castum">
            <section id="header">
                <div class="table-responsive">
                    <div class="table-wrapper">

                        <div class="table-title">
                            <div class="row d-flex justify-content-end">

                                <div class="col-sm-8">
                                    <div class="search-box">
                                        <i class="material-icons">&#xE8B6;</i>
                                        <input type="text" class="form-control" placeholder="جستجو ...">
                                    </div>
                                </div>

                                <div class="col-sm-4 text-right">
                                    <h6><b>شعبه : </b>قم</h6>
                                    <h6><b> </b>بستنی میهن</h6>
                                </div>

                            </div>
                        </div>

                        <?php
                        print_r($_SESSION['reapet_case'] ?? '');
                        unset($_SESSION['reapet_case']);
                        ?>

                        <div class="container row mt-2" style="direction: rtl;min-width:100%; ">
                            <div class="d-flex form-align mb-2">
                                <div class="">
                                    <label for="exampleInputEmail1" class="form-label">نام شعبه &#9733;</label>
                                    <input name="branch_name" type="text" class="form-control border" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="">
                                    <label for="exampleInputEmail1" class="form-label">سرپرست فروش &#9733;</label>
                                    <input name="boss_sale" id="search-box" type="text" class="form-control border" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div style="position:relative;" id="suggesstion-box"></div>
                                </div>
                                <div class="">
                                    <label for="exampleInputEmail1" class="form-label">مسئول لاین &#9733;</label>
                                    <input name="charge_line" id="search-box2" type="text" class="form-control border" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div style="position:relative;" id="suggesstion-box2"></div>
                                </div>

                                <div class="">
                                    <label for="exampleInputEmail1" class="form-label">مدیر شعبه &#9733;</label>
                                    <input name="branch_manage" type="text" class="form-control border" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="">
                                    <label for="exampleInputEmail1" class="form-label">کارشناس منطقه &#9733;</label>
                                    <input type="text" name="expert_area" class="form-control border" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="">
                                    <label for="exampleInputEmail1" class="form-label">مدیر منطقه فروش &#9733;</label>
                                    <input name="manager_sale_area" type="text" class="form-control border" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>

                            </div><!--d-flex-->
                            <div class="mt-4 w-50 mb-2 d-flex ">
                                <input style="width: 20%;margin-right: 10px;" id="submit" type="submit" value="ثبت " class="btn btn-success" title="ثبت موارد انتخابی">
                                <a class="add-list" href="result.php" title="نمایش موارد انتخابی">نمایش لیست
                                    <?php
                                    if (isset($_SESSION['users'])) {
                                        foreach ($_SESSION['users'] as $key => $val) {
                                            if (in_array($val, $_SESSION['users'])) {
                                                $_SESSION['users'];
                                            } else {
                                                $_SESSION['users'] = array_unique(array_merge($_SESSION['users'], $users), SORT_REGULAR);
                                            }
                                        }
                                    ?>
                                        <span><?php print_r(count($_SESSION['users'])); ?></span>
                                    <?php   } else { ?>
                                    <?php
                                    }
                                    ?>
                                </a>

                            </div>
                        </div>
            </section>
            <table class="table table-striped table-hover table-bordered">
                <thead id="thead">
                    <tr>
                        <th>آدرس مشتری</th>
                        <th>کد مشتریان/نمایندگان/پیمانکاران</th>
                        <th>نام و نام خانوادگی مشتری</th>
                        <th>کد پرسنلی فروشنده</th>
                        <th>نام و نام خانوادگی فروشنده</th>
                        <th>صنف مشتری</th>
                        <th>سال / ماه</th>
                        <th>ماه</th>
                        <th>سال </th>
                        <th>#</th>
                        <th>@</th>
                    </tr>
                    <tr>
                        <td><input class="inner-search focus" id="costomer_address" type="text" placeholder="جستجو آدرس مشتریان"></td>
                        <td><input class="inner-search focus" id="costomer_code" type="text" placeholder="جستجو کد مشتریان"></td>
                        <td><input class="inner-search focus" id="costomer_text" type="text" placeholder="جستجو فروشنده"></td>
                        <td><input class="inner-search focus" id="search_code" type="text" placeholder="جستجو کد پرسنلی"></td>
                        <td><input id="search_text" class="inner-search focus" type="text" placeholder="جستجو مشتری ..."></td>
                        <td><input class="inner-search focus" id="activity_name" type="text" placeholder="جستجو"></td>
                        <td><input class="inner-search focus" id="year_month" type="text" placeholder="جستجو سال/ماه"></td>
                        <td><input class="inner-search focus" id="month" type="text" placeholder="جستجو ماه"></td>
                        <td><input class="inner-search focus" id="year" type="text" placeholder="جستجو سال"></td>
                        <td></td>
                        <td>
                            <div class="form-check ">
                                <input id="allbox" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                </label>
                            </div>
                        </td>
                    </tr>
                </thead>
                <tbody id="result">
                </tbody>
            </table>
            <?php
            if (isset($_POST['query'])) {
                $start = 0;
                $perpage = 12;
                $world = $_POST['query'];
                $records = "SELECT TOP {$perpage} [Year],[Month],[Year/Month],[LineName],[BranchName],[StructureName],[ActivityName],[SellerName],[Personnel_Code],[CustomerName],[CustomerCode],[Address] FROM Faragostar.View_Unifier
    WHERE [SellerName] LIKE N'%{$world}%' OR [CustomerName] LIKE N'%{$world}%' AND [BranchName]='زاهدان'";
                $query = sqlsrv_query($conn, $records, array(), array("Scrollable" => 'static'));
                $row_count = sqlsrv_num_rows($query);
                $pages = ceil($row_count / $perpage);
            ?>
                <div class="clearfix">
                    <!-- <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div> -->
                    <div class="hint-text">نمایش <b><?php echo $page ?? ''; ?></b> از <b><?php echo $pages; ?></b></div>

                    <ul class="pagination">
                        <li class="page-item disabled">
                            <?php if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) { ?>
                                <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>"><i class="fa fa-angle-double-left"></i></a>
                            <?php } else { ?>
                                <a href="#"><i class="fa fa-angle-double-left"></i></a>
                            <?php } ?>
                        </li>

                        <li class="prev page-item">

                            <?php
                            for ($counter = 1; $counter <= $pages; $counter++) { ?>
                                <a class="hide page-link" id="<?php echo $counter ?>" href="?page-nr=<?php echo $counter ?>"> <?php echo $counter - 1; ?></a>
                            <?php
                            }
                            ?>
                        </li>
                        <li id="activ" class="page-item active">
                            <?php
                            for ($counter = 1; $counter <= $pages; $counter++) { ?>
                                <a class="hide page-link" value="<?php echo $counter ?>" id="<?php echo $counter ?>" href="?page-nr=<?php echo $counter ?>"> <?php echo $counter ?></a>
                            <?php
                            }
                            ?>
                        </li>
                        <li class="next page-item">
                            <?php
                            for ($counter = 1; $counter <= $pages; $counter++) { ?>
                                <a class="hide page-link" id="<?php echo $counter + 1 ?>" href="?page-nr=<?php echo $counter + 1 ?>"> <?php echo $counter + 1; ?></a>
                            <?php
                            }
                            ?>
                        </li>

                        <li class="page-item">
                            <?php if (!isset($_GET['page-nr'])) { ?>

                                <a href="?page-nr=2" class="page-link"><i class="fa fa-angle-double-right"></i></a>
                                <?php } else {
                                if ($_GET['page-nr'] >= $pages) {
                                ?>
                                    <a href=""><i class="fa fa-angle-double-right"></i></a>
                                <?php
                                } else {
                                ?>
                                    <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>"><i class="fa fa-angle-double-right"></i></a>

                            <?php  }
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            <?php } else { ?>
                <div class="clearfix">
                    <!-- <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div> -->
                    <div class="hint-text">نمایش <b><?php echo $page ?? ''; ?></b> از <b><?php echo $pages; ?></b></div>

                    <ul class="pagination">
                        <li class="page-item disabled">
                            <?php if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) { ?>
                                <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>"><i class="fa fa-angle-double-left"></i></a>
                            <?php } else { ?>
                                <a href="#"><i class="fa fa-angle-double-left"></i></a>
                            <?php } ?>
                        </li>

                        <li class="prev page-item">

                            <?php
                            for ($counter = 1; $counter <= $pages; $counter++) { ?>
                                <a class="hide page-link" id="<?php echo $counter ?>" href="?page-nr=<?php echo $counter ?>"> <?php echo $counter - 1; ?></a>
                            <?php
                            }
                            ?>
                        </li>
                        <li id="activ" class="page-item active">
                            <?php
                            for ($counter = 1; $counter <= $pages; $counter++) { ?>
                                <a class="hide page-link" value="<?php echo $counter ?>" id="<?php echo $counter ?>" href="?page-nr=<?php echo $counter ?>"> <?php echo $counter ?></a>
                            <?php
                            }
                            ?>
                        </li>
                        <li class="next page-item">
                            <?php
                            for ($counter = 1; $counter <= $pages; $counter++) { ?>
                                <a class="hide page-link" id="<?php echo $counter + 1 ?>" href="?page-nr=<?php echo $counter + 1 ?>"> <?php echo $counter + 1; ?></a>
                            <?php
                            }
                            ?>
                        </li>

                        <li class="page-item">
                            <?php if (!isset($_GET['page-nr'])) { ?>

                                <a href="?page-nr=2" class="page-link"><i class="fa fa-angle-double-right"></i></a>
                                <?php } else {
                                if ($_GET['page-nr'] >= $pages) {
                                ?>
                                    <a href=""><i class="fa fa-angle-double-right"></i></a>
                                <?php
                                } else {
                                ?>
                                    <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>"><i class="fa fa-angle-double-right"></i></a>

                            <?php  }
                            }
                            ?>
                        </li>
                    </ul>
                </div>

            <?php           } ?>


    </form>
    <section class="container rtl">
    </section><!--container-->

    </div>
    </div><!--row-->
    </div>
    <button id="button0000000002" type="button">click me</button>
</body>

</html>
<script>
    // $(window).scroll(function() {
    //     if ($(this).scrollTop() > 1) {
    //         $('#header').addClass("sticky_header");
    //     } else {
    //         $('#header').removeClass("sticky_header");
    //     }
    // });

    // $(window).scroll(function() {
    //     if ($(this).scrollTop() > 1) {
    //         $('#thead').addClass("sticky_header2");
    //     } else {
    //         $('#thead').removeClass("sticky_header2");
    //     }
    // });
    // $(document).ready(function() {
    //     // $('[data-toggle="tooltip"]').tooltip();
    //     $("#allbox").click(function() {
    //         //alert();
    //         $('input:checkbox').not(this).prop('checked', this.checked);
    //         $('input:checkbox').not(this).prop('background-color', "#baddfb");
    //     });
    // });
    $(".re_data").fadeTo(2000, 500).slideUp(1500, function() {
        $(".re_data").slide(1600);
    });
    document.onreadystatechange = function() {
        var state = document.readyState
        if (state == 'interactive') {
            document.getElementById('contents').style.visibility = "hidden";
        } else if (state == 'complete') {
            setTimeout(function() {
                document.getElementById('interactive');
                document.getElementById('load').style.visibility = "hidden";
                document.getElementById('contents').style.visibility = "visible";
            }, 1000);
        }
    }
    $(document).ready(function() {
        let links = document.querySelectorAll('li.active a');
        let bodyId = parseInt(document.body.id) - 1;
        links[bodyId].classList.add("shownum");

        let link = document.querySelectorAll('li.prev a');
        let bodyI = parseInt(document.body.id) - 1;
        link[bodyI].classList.add("shownum");

        let lin = document.querySelectorAll('li.next a');
        let body = parseInt(document.body.id) - 1;
        lin[body].classList.add("shownum");

        $('form').submit(function() {
            window.opener.location.reload();
        });

        load_data();
        function load_data(code) {
            $.ajax({
                url: "fetch.php",
                method: "post",
                data: {
                    code: code,
                    typeOfSearch: $('input#flexCheckDefault').prop('checked')
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }

        function load_data3(customer) {

            $.ajax({
                url: "fetch.php",
                method: "post",
                data: {
                    customer: customer,
                    typeOfSearch: $('input#flexCheckDefault').prop('checked')
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }

        $('#search_text').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });

        load_data3();
        $('#costomer_text').keyup(function() {
            var search3 = $(this).val();
            if (search3 != '') {
                load_data3(search3);
            } else {
                load_data3();
            }
        });

        /*
        load_data2();

        function load_data2(code) {
            $.ajax({
                url: "fetch.php",
                method: "post",
                data: {
                    code: code,
                    typeOfSearch: $('input#flexCheckDefault').prop('checked')
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }

        load_data3();

        function load_data3(customer) {
            $.ajax({
                url: "fetch.php",
                method: "post",
                data: {
                    customer: customer,
                    typeOfSearch: $('input#flexCheckDefault').prop('checked')
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }

        load_data4();

        function load_data4(cus_code) {
            $.ajax({
                url: "fetch.php",
                method: "post",
                data: {
                    cus_code: cus_code,
                    typeOfSearch: $('input#flexCheckDefault').prop('checked')
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }

        load_data5();

        function load_data5(address) {
            $.ajax({
                url: "fetch.php",
                method: "post",
                data: {
                    address: address,
                    typeOfSearch: $('input#flexCheckDefault').prop('checked')
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }

        load_data6();

        function load_data6(activity_name) {
            $.ajax({
                url: "fetch.php",
                method: "post",
                data: {
                    activity_name: activity_name,
                    typeOfSearch: $('input#flexCheckDefault').prop('checked')
                },
                success: function(data) {

                    $('#result').html(data);
                }
            });
        }

        load_data7();

        function load_data7(year_month) {
            $.ajax({
                url: "fetch.php",
                method: "post",
                data: {
                    year_month: year_month,
                    typeOfSearch: $('input#flexCheckDefault').prop('checked')
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }


        load_data8();

        function load_data8(month) {
            $.ajax({
                url: "fetch.php",
                method: "post",
                data: {
                    month: month,
                    typeOfSearch: $('input#flexCheckDefault').prop('checked')
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }

        load_data9();

        function load_data9(year) {
            $.ajax({
                url: "fetch.php",
                method: "post",
                data: {
                    year: year,
                    typeOfSearch: $('input#flexCheckDefault').prop('checked')
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }


        $('#search_text').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });
        $('#search_code').keyup(function() {
            var search2 = $(this).val();
            if (search2 != '') {
                load_data2(search2);
            } else {
                load_data2();
            }
        });

        $('#costomer_text').keyup(function() {
            var search3 = $(this).val();
            if (search3 != '') {
                load_data3(search3);
            } else {
                load_data3();
            }
        });

        $('#costomer_code').keyup(function() {
            var search4 = $(this).val();
            if (search4 != '') {
                load_data4(search4);
            } else {
                load_data4();
            }
        });


        $('#costomer_address').keyup(function() {
            var search5 = $(this).val();
            if (search5 != '') {
                load_data5(search5);
            } else {
                load_data5();
            }
        });

        $('#activity_name').keyup(function() {
            var search6 = $(this).val();
            if (search6 != '') {
                load_data6(search6);
            } else {
                load_data6();
            }
        });
        $('#year_month').keyup(function() {
            var search7 = $(this).val();
            if (search7 != '') {
                load_data7(search7);
            } else {
                load_data7();
            }
        });
        $('#month').keyup(function() {
            var search8 = $(this).val();
            if (search8 != '') {
                load_data8(search8);
            } else {
                load_data8();
            }
        });
        $('#year').keyup(function() {
            var search9 = $(this).val();
            if (search9 != '') {
                load_data9(search9);
            } else {
                load_data9();
            }
        });
*/


$('#button0000000002').click(function(){

    $(function(){
    $.ajax({
        type:'GET',
        url: 'https://mocki.io/v1/605e00ca-2e92-448e-9e25-c2a60b0a9278',
        success: function (data){
        console.log('success',data);
        }
    });
});

});


    });
</script>