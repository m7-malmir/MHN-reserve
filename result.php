<?php

session_start();
$serverName = "192.168.27.217";
$uid = "Faragostar";
$pwd = "12341234";
$databaseName = "Reports";
$connectionInfo = array("Database" => $databaseName, "CharacterSet" => "UTF-8", "UID" => $uid, "PWD" => $pwd);
$conn = sqlsrv_connect($serverName, $connectionInfo);
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $users=$_POST['username'];
    $boss_sale=$_POST['boss_sale'];
    $charge_line=$_POST['charge_line'];
    $branch_name=$_POST['branch_name'];
    $branch_manage=$_POST['branch_manage'];
    $manager_sale_area=$_POST['manager_sale_area'];
    $expert_area=$_POST['expert_area'];

    if (empty($_SESSION['users'])) {
        $_SESSION['users']=$users;
    }else{
        $_SESSION['users']=array_merge($_SESSION['users'],  $users);
    }
    }
   
//var_dump($_SESSION['users']);

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
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
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
            font-size: 22px;
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
        .icons{
            width: 100%;
            display: flex;
            justify-content: right;
        }
        
        .icons i{
        font-size: 25px;
        direction: rtl;
        margin-right: 10px;
        margin-bottom: 10px;
        color: #454545;
        padding: 5px;
      }
      .icons i:hover{
        background-color: #454545;
        color: aqua;
        transition: 0.5ms;
        cursor: pointer;
        border-radius: 5px;
        padding:3px 5px 0px 5px;
      }

    </style>
    <script>
        $(document).ready(function() {
            //$('[data-toggle="tooltip"]').tooltip();
            $("#allbox").click(function() {
                //alert();
                $('input:checkbox').not(this).prop('checked', this.checked);
                $('input:checkbox').not(this).prop('background-color', "#baddfb");
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
                        <!-- <div class="search-box">
                            <i class="material-icons">&#xE8B6;</i>
                            <input type="text" class="form-control" placeholder="جستجو ...">
                        </div> -->
                        </div>
                        <div class="col-sm-2 text-right">
                            <h2><b>لاین : </b>بستنی</h2>
                        </div>
                        <div class="col-sm-2 text-right">
                            <h2><b>شعبه : </b>قم</h2>
                        </div>
                    </div>
                </div>
                <span class="icons">
            <a href=""><i class="bi bi-arrow-clockwise"></i></a> 
            <a href="result.php?delete"><i class="bi bi-trash3-fill"></i></a> 
            <a href="test2.php"><i class="bi bi-plus-square-fill"></i></a>
                          
                </span>
                <form action="result.php" method="post">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
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
                    </thead>

<tbody id="result">
<?php
$query ="SELECT * FROM Faragostar.View_Unifier WHERE [BranchName] LIKE N'%قم%' AND LineName LIKE N'%بستن%' AND";
$allrecords=$_SESSION['users'];
foreach ($allrecords as $key) {
          $query.=" ID='".$key."' OR ";
}
$query=substr($query,0, -3);
$result = sqlsrv_query($conn, $query);
$number = '';
if ($result > 0) {
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_BOTH)) {
        $number++;
        echo '<tr>
        <td>' . $row['Address'] . '</td>
        <td>' . $row['CustomerCode'] . '</td>
        <td>' . $row['CustomerName'] . ' </td>
        <td>' . $row['Personnel_Code'] . '</td>
        <td>' . $row['SellerName'] . '</td>
        <td>' . $row['ActivityName'] . '</td>
        <td>' . $row['Year/Month'] . '</td>
        <td>' . $row['Month'] . '</td>
        <td>' . $row['Year'] . '</td>
        <td>' . $number . '</td>
        <td><div class="form-check">
      <input name="username[]" value="'.$row['ID'].'" class="form-check-input" type="checkbox" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
      </label>
    </div></td></tr>';
    }

}else{
    echo 'result nothing';
}
 sqlsrv_close($conn);
                            ?>
                        </tbody>
                </table>
              

               
                </form>
                <section class="container rtl">
                </section><!--container-->
            </div>
        </div><!--row-->
    </div>
</body>
</html>
<script>
    $(document).ready(function() {

        // let links = document.querySelectorAll('li.active a');
        // let bodyId = parseInt(document.body.id) - 1;
        // links[bodyId].classList.add("shownum");

        // let link = document.querySelectorAll('li.prev a');
        // let bodyI = parseInt(document.body.id) - 1;
        // link[bodyI].classList.add("shownum");

        // let lin = document.querySelectorAll('li.next a');
        // let body = parseInt(document.body.id) - 1;
        // lin[body].classList.add("shownum");
      
        $('#result tr').click(function(event){
            var getID=$(this).find('.form-check [type=checkbox]').attr('value');
            <?php 
                if(isset($_GET['delete'])){
                    $_SESSION['getid']="<script>document.write(getID)</script>"; 
                     
                }
            ?>
            if (event.target.type !== 'checkbox') {
               $(':checkbox', this).trigger('click');
            } 
        });
        $(function() {
        $('tr [type=checkbox]').click(function() {
            $(this).closest('tr').css('background-color', $(this).prop('checked') ? "#baddfb" : "#fff");
            });
        });

    });



</script>
<?php

print_r($_SESSION['getid']);
?>