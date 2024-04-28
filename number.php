$serverName = "192.168.27.217";
$uid = "Faragostar";
$pwd = "Ff12345678";
$databaseName = "Reports";
$connectionInfo = array("Database" => $databaseName, "CharacterSet" => "UTF-8", "UID" => $uid, "PWD" => $pwd);
$conn = sqlsrv_connect($serverName, $connectionInfo);

$start = 0;
$perpage = 12;
 $records = "SELECT COUNT(*) FROM Faragostar.View_Unifier WHERE [BranchName]='قم'";
 $query = sqlsrv_query($conn, $records, array(), array("Scrollable" => 'static'));
 var_dump($query);
 //$row_count = sqlsrv_num_rows($query);
 $pages = ceil( $records / $perpage);

if ($conn) {
   echo 'conn ok';
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



                <?php sqlsrv_close($conn);
                        ?>





<?php
                        // $number = '';
                        // if ($stmt > 0) {
                        //     while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_BOTH)) {
                        //         $number++;
                        //         echo '<tr><td>' . $row['سال / ماه'] . '</td>';
                        //         echo '<td>' . $row['سازمان فروش'] . '</td>';
                        //         echo '<td>' . $row['ساختار فروش'] . '</td>';
                        //         echo '<td>' . $row['صنف مشتری'] . ' </td>';
                        //         echo '<td >' . $row['نام و نام خانوادگی فروشنده'] . '</td>';
                        //         echo '<td>' . $row['نا و نام خانوادگی مشتری'] . ' </td>';
                        //         echo '<td>' . $number . '</td>';
                        //         echo '<td><div class="form-check">
                        //       <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        //       <label class="form-check-label" for="flexCheckDefault">
                        //       </label>
                        //     </div></td></tr>';
                        //     }
                        // } else {
                        //     echo 'no data for fetch';
                        // }
                        ?>