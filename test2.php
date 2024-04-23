<?php
$serverName = "192.168.27.217";
$uid = "Faragostar";
$pwd = "Ff12345678";
$databaseName = "Reports";
$connectionInfo = array("Database" => $databaseName, "CharacterSet" => "UTF-8", "UID" => $uid, "PWD" => $pwd);
$conn = sqlsrv_connect($serverName, $connectionInfo);
if ($conn) {
    //conn ok
} else {
    echo "Connection could not be established.\n";
    die(print_r(sqlsrv_errors(), true));
}
$start = 0;
$perpage = 12;
$records = "SELECT * FROM Faragostar.View_Unifier ";
$query = sqlsrv_query($conn, $records, array(), array("Scrollable" => 'static'));
$row_count = sqlsrv_num_rows($query);
$pages = ceil($row_count / $perpage);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $perpage;
}
$sql = " SELECT TOP " . $perpage . "  * FROM Faragostar.View_Unifier";
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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            direction: ;
            color: #566787;
            background: #f5f5f5;
            font-family: 'Yekan', sans-serif;
            font-size: 13px;
        }

        @font-face {
            font-family: Yekan;
            src: url(./font/Yekan.ttf);
        }

        .table-responsive {
            margin: 30px 0;
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
            margin: 8px 0 0;
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

        .search-box input:focus {
            border-color: #3FBAE4;
        }

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

        input[type=checkbox] {
            transform: scale(1.5);
        }

        table th:nth-child(8) {
            width: 5%;
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
    <div class="container">
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
                            <h2><b>شعبه </b>قم</h2>

                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>سال / ماه</th>
                            <th>سازمان فروش<i class="fa fa-sort"></i></th>
                            <th>ساختار فروش</th>
                            <th>صنف مشتری</th>
                            <th>نام و نام خانوادگی فروشنده</th>
                            <th>نام و نام خانوادگی مشتری</th>
                            <th>#</th>
                            <th>@</th>
                        </tr>
                    
                            <th></th>
                            <th></th>
                            <th><input class="inner-search" type="text" placeholder="جستجو ساختار فروش"></th>
                            <th></th>
                            <th><input class="inner-search" type="text" placeholder="جستجو فروشنده"></th>
                            <th><input class="inner-search" type="text" placeholder="جستجو مشتری ..."></th>
                            <th></th>
                            <th>
                                <div class="form-check ">
                                    <input id="allbox" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    </label>
                                </div>
                            </th>
                        
                    </thead>
                    <tbody>
                     
                        <?php
                        $number = '';
                        if ($stmt > 0) {
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_BOTH)) {
                                $number++;

                                echo '   <tr><td>' . $row['سال / ماه'] . ' </td>';
                                echo '<td>' . $row['سازمان فروش'] . ' </td>';
                                echo '<td>' . $row['ساختار فروش'] . ' </td>';
                                echo '<td>' . $row['صنف مشتری'] . ' </td>';
                                echo '<td>' . $row['نام و نام خانوادگی فروشنده'] . ' </td>';
                                echo '<td>' . $row['نا و نام خانوادگی مشتری'] . ' </td>';
                                echo '<td>' . $number . '</td>';
                                echo '<td><div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                              <label class="form-check-label" for="flexCheckDefault">
                              </label>
                            </div></td></tr>';
                            }
                        } else {
                            echo 'no data for fetch';
                        }
                        ?>

                        <?php sqlsrv_close($conn);
                        ?>
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>

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
                                <a class="hide page-link" id="<?php echo $counter+1 ?>" href="?page-nr=<?php echo $counter+1 ?>"> <?php echo $counter + 1; ?></a>
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
            </div>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function(){
        $('table tbody tr').not(':first').click(function(event){
            //alert();
            if (event.target.type !== 'checkbox') {
                $(':checkbox', this).trigger('click');
            }
        });



        let links = document.querySelectorAll('li.active a');
        let bodyId = parseInt(document.body.id) - 1;
        links[bodyId].classList.add("shownum");

        let link = document.querySelectorAll('li.prev a');
        let bodyI = parseInt(document.body.id) - 1;
        link[bodyI].classList.add("shownum");

        let lin = document.querySelectorAll('li.next a');
        let body = parseInt(document.body.id) - 1;
        lin[body].classList.add("shownum");
    });
</script>