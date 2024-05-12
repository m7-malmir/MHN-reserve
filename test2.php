<?php
$serverName = "";
$uid = "";
$pwd = "";
$databaseName = "Reports";
$connectionInfo = array("Database" => $databaseName, "CharacterSet" => "UTF-8", "UID" => $uid, "PWD" => $pwd);
$conn = sqlsrv_connect($serverName, $connectionInfo);
if( $conn === false ) {
    //die( print_r( sqlsrv_errors(), true));
echo 'shit';
}
$start = 0;
$perpage = 12;
$records = "SELECT * FROM Faragostar.View_Unifier WHERE [BranchName]='زاهدان'";
$query = sqlsrv_query($conn, $records, array(), array("Scrollable" => 'static'));
$row_count = sqlsrv_num_rows($query);




$pages = ceil($row_count / $perpage);
if(isset($_GET['page-nr'])){
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
            max-width: 1400px;
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

        table.table td:last-child {
            width: 130px;
        }

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

        td:nth-child(14),
        td:nth-child(13) {
            width: 3%;
            overflow: hidden;
            overflow-wrap: anywhere;
        }

        td:nth-child(11) {
            width: 3%;
            overflow: hidden;
            overflow-wrap: anywhere
        }

        td:nth-child(12),
        td:nth-child(10) {
            width: 8%;
            overflow: hidden;
            overflow-wrap: anywhere;
        }

        td:nth-child(6),
        td:nth-child(7),
        td:nth-child(8),
        td:nth-child(9),
        td:nth-child(2),
        td:nth-child(4) {
            width: 8%;
            overflow: hidden;
            overflow-wrap: anywhere;
        }

        td:nth-child(3),
        td:nth-child(5) {
            width: 5%;
            overflow: hidden;
            overflow-wrap: anywhere;
        }

        td:nth-child(1) {
            width: 23%;
            overflow: hidden;
            overflow-wrap: anywhere;

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
    </style>
    <script>
        $(document).ready(function() {
            // $('[data-toggle="tooltip"]').tooltip();
            $("#allbox").click(function() {
                //alert();
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        });
    </script>
</head>
<?php
if (isset($_GET['page-nr'])) {

    $id = $_GET['page-nr'];
} else {
    $id = 1;
}
?>

<body id="<?php echo $id; ?>">
    <div class="container-castum">
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
                            <h2><b>شعبه : </b>قم</h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>آدرس مشتری</th>
                            <th>کد مشتریان/نمایندگان/پیمانکاران</th>
                            <th>نام و نام خانوادگی مشتری</th>
                            <th>کد پرسنلی فروشنده</th>
                            <th>نام و نام خانوادگی فروشنده</th>
                            <th>صنف مشتری</th>
                            <th>ساختار فروش</th>
                            <th>شعبه</th>
                            <th>سازمان فروش</th>
                            <th>سال / ماه</th>
                            <th>ماه</th>
                            <th>سال </th>
                            <th>#</th>
                            <th>@</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><input name="search_text" id="search_text" class="inner-search focus" type="text" placeholder="جستجو مشتری ..."></td>
                            <td></td>
                            <td><input class="inner-search focus" type="text" placeholder="جستجو فروشنده"></td>
                            <td></td>
                            <td><input class="inner-search focus" type="text" placeholder="جستجو ساختار فروش"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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

                        <?php //sqlsrv_close($conn);
                        ?>
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
                <form action="" method="post" style="direction: rtl;">
                    <div class="container row mt-2" style="direction: rtl;">
                        <div id="mask"></div>
                        <table id="example" class="bordered material-table centered striped green lighten-1"></table>
                        <div class="mt-5"></div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="form-label">سرپرست فروش &#9733;</label>
                            <input id="search-box" type="email" class="form-control border" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div style="position:relative;" id="suggesstion-box"></div>
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="form-label">مسئول لاین &#9733;</label>
                            <input id="search-box2" type="email" class="form-control border" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div style="position:relative;" id="suggesstion-box2"></div>
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="form-label">نام شعبه &#9733;</label>
                            <input type="email" class="form-control border" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="form-label">مدیر شعبه &#9733;</label>
                            <input type="email" class="form-control border" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="form-label">مدیر منطقه فروش &#9733;</label>
                            <input type="email" class="form-control border" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="form-label">کارشناس منطقه &#9733;</label>
                            <input type="email" class="form-control border" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-success">ذخیره نهایی</button>
                </form>
            </div>
        </div>
        <section class="container rtl">
        </section><!--container-->

    </div>
    </div><!--row-->
    </div>
</body>

</html>
<script>
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

        //load data
        load_data();

        function load_data(query) {
            $.ajax({
                url: "fetch.php",
                method: "post",
                data: {
                    query: query
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

    });
</script>