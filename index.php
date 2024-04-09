   <!DOCTYPE html>
   <html lang="en">

   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
   </head>
   <style>
        table,
        th,
        td {
             border: 1px solid;
             text-align: center;
        }
   </style>

   <body>
        <?php
          $serverName = "";
          $uid = "";
          $pwd = "";
          $databaseName = "Reports";
          $connectionInfo = array("Database" => $databaseName, "CharacterSet" => "UTF-8", "UID" => $uid, "PWD" => $pwd);
          $conn = sqlsrv_connect($serverName, $connectionInfo);
          if ($conn) {
               //conn ok
          } else {
               echo "Connection could not be established.\n";
               die(print_r(sqlsrv_errors(), true));
          }

          $sql = "SELECT * FROM Faragostar.View_Unifier";
          $stmt = sqlsrv_query($conn, $sql);
        //$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
         
          ?>
        <center>
             <table>
                  <tr>    
                      <td>ID</td>
                       <td>سال</td>
                       <td>ماه</td>
                       <td>سال / ماه</td>
                       <td>سازمان فروش</td>
                       <td>ساختار فروش</td>
                       <td>شعبه</td>
                       <td>صنف مشتری</td>
                       <td>نام و نام خانوادگی فروشنده</td>
                       <td>نا و نام خانوادگی مشتری</td>
                       <td>آدرس مشتری</td>
                  </tr>
                
                       <?php
                   while ($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
                   {
                     
                    
                         echo '<tr><td>' . $row['ID'] . ' </td>';
                         echo '<td>' . $row['سال'] . ' </td>';
                         echo '<td>' . $row['ماه'] . ' </td>';
                         echo '<td>' . $row['سال / ماه'] . ' </td>';
                         echo '<td>' . $row['سازمان فروش'] . ' </td>';
                         echo '<td>' . $row['شعبه'] . ' </td>';
                         echo '<td>' . $row['ساختار فروش'] . ' </td>';
                         echo '<td>' . $row['صنف مشتری'] . ' </td>';
                         echo '<td>' . $row['نام و نام خانوادگی فروشنده'] . ' </td>';
                         echo '<td>' . $row['نا و نام خانوادگی مشتری'] . ' </td>';
                         echo '<td></td></tr>';

                              }
                         ?>
                         
             </table>
        </center>
        <!-- sqlsrv_close($conn);
        ?> -->
   </body>

   </html>