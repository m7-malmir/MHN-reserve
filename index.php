   <!DOCTYPE html>
   <html lang="en">

   <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
   </head>
   <style>
        @font-face {
             font-family: Yekan;
             src: url(./font/Yekan.ttf);
        }

        body {
             font-family: 'Yekan';
        }

        table {
             font-family: 'Yekan';
             border-collapse: collapse;
             max-width: 100% !important;
             height: inherit;
             width: inherit;
             /* max-height: 40rem!important;*/
        }
          tr{
               height: 2rem; 
               overflow: hidden;
               white-space: nowrap;
          }
     
        td,th {
             border: 1px solid #bcefab;
             text-align: center;
             overflow: hidden;
              border: none;
        }

        table tr td:nth-child(1),table tr td:nth-child(2), table tr td:nth-child(3),table tr td:nth-child(4) {
          max-width: 5rem;
          
        }
        table tr td:nth-child(5),table tr td:nth-child(6) {
          max-width: 15rem;

        }
        table tr td:nth-child(7) {
          max-width: 1rem;

        }

        table tr td:nth-child(8) {
          max-width: 1rem;

        }

        tr:nth-child(even):hover,
        tr:hover {
             background-color: #f1d2ac;
             cursor: pointer;
        }

        tr:nth-child(even) {
             background-color: #e2f3e3;

        }

        table tr:first-child td {
             border: 2px solid black;
             background-color: #abffaf;
             font-weight: bold;
        }

        a {
             border: 1px solid black;
             margin: 10px;
             padding: 10px;
             text-decoration: none;
             border-radius: 5px;
             color: black;
             font-family: system-ui;
             font-size: 12px;
        }

        .active {
             background-color: #0d81cd;
             color: #fff;
             border: thin solid #0d81cd;
             display: block !important;
        }

        .hedden {
             display: none;
        }

        .filter {
             width: 1.8rem;
             display: flex;
        }

        .flex-td {
             display: flex;
             justify-content: center;
        }

        table tr td input {
             border: none;
             width: 100%;
        }
   </style>
   <?php
     if (isset($_GET['page-nr'])) {

          $id = $_GET['page-nr'];
     } else {
          $id = 1;
     }
     ?>

   <body id="<?php echo $id; ?>">
        <?php
          $serverName = "";
          $uid = "";
          $pwd = "";
          $databaseName = "";
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
        <center>
             <section class="header mt-5">
                  <div class="d-flex justify-content-evenly">

                       <h3>درختواره عوامل فروش</h3>
                       <h5 style="padding: 10px;
    border-radius: 5px;
    background-color: antiquewhite;">شعبه مربوطه : کرج</h5>
                  </div>
             </section>

             <section>
                  <div style="height:700px;" class="container">
                       <table>
                            <tr>


                                 <td>سال / ماه</td>
                                 <td>سازمان فروش</td>
                                 <td>ساختار فروش</td>
                                 <td>صنف مشتری</td>
                                 <td>نام و نام خانوادگی فروشنده</td>
                                 <td>نا و نام خانوادگی مشتری</td>
                                 <td></td>
                                 <td>#</td>
                            </tr>
                            <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td>
                                 </td>
                                 <td>
                                      <div class="flex-td">
                                           <img class="filter" src="./img/search.png" alt=""><input type="text">

                                      </div>
                                 </td>
                                 <td>
                                      <div class="flex-td">
                                           <img class="filter" src="./img/search.png" alt=""><input type="text">

                                      </div>
                                 </td>
                                 <td>

                                 </td>

                                 <td></td>

                            </tr>
          <tr>
                            <?php
                              $number = '';
                              if ($stmt > 0) {
                                   while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_BOTH)) {
                                        $number++;

                                        echo '<td>' . $row['سال / ماه'] . ' </td>';
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
                            </div></td>';
                                        echo '</tr>';
                                   }
                              } else {
                                   echo 'no data for fetch';
                              }
                              ?>

                       </table>
                  </div><!--container-->
             </section>

        </center>
        <?php sqlsrv_close($conn);
          ?>
        <div style="display: flex;align-items: center;justify-content: center;">showing <?php echo $page ?? ''; ?> of <?php echo $pages; ?></div>
        <div class="" style="display: flex;align-items: center;justify-content: center;">

             <a href="?page-nr=1">اولین</a>
             <?php if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) { ?>

                  <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>">قبلی</a>

             <?php } else { ?>
                  <a href="">قبلی</a>
             <?php } ?>
             <div class="page-numbers">
                  <?php
                    for ($counter = 1; $counter <= $pages; $counter++) { ?>
                       <a class="hedden" id="<?php echo $counter ?>" href="?page-nr=<?php echo $counter ?>">
                            <?php echo $counter ?>
                       </a>
                  <?php
                    }
                    ?>

             </div>
             <?php if (!isset($_GET['page-nr'])) { ?>

                  <a href="?page-nr=2">بعدی</a>
                  <?php } else {
                    if ($_GET['page-nr'] >= $pages) {
                    ?>
                       <a href="">بعدی</a>
                  <?php
                    } else {
                    ?>
                       <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>">یعدی</a>

             <?php  }
               } ?>

             <a href="?page-nr=<?php echo $pages; ?>">آخرین</a>
        </div>
        <script>
             let links = document.querySelectorAll('.page-numbers > a');
             let bodyId = parseInt(document.body.id) - 1;
             links[bodyId].classList.add("active");
        </script>
   </body>

   </html>