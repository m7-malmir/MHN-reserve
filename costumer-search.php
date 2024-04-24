<?php
 $serverName = "192.168.27.217";
 $uid = "Faragostar";
 $pwd = "Ff12345678";
 $databaseName = "Reports";
 $connectionInfo = array("Database" => $databaseName, "CharacterSet" => "UTF-8", "UID" => $uid, "PWD" => $pwd);
 $conn = sqlsrv_connect($serverName, $connectionInfo);
 if ($conn) {
     // echo 'conn ok';
 } else {
      echo "Connection could not be established.\n";
      die(print_r(sqlsrv_errors(), true));
 }
if(isset($_POST['query'])) {
    $retval = '';
    $retval .= '<td class="list-group">';
    $query ="SELECT ID
    ,سال
    ,ماه
    ,[سال / ماه]
    ,[سازمان فروش]
    ,شعبه
    ,[ساختار فروش]
    ,[صنف مشتری]
    ,[نام و نام خانوادگی فروشنده] AS fullName
    ,[نا و نام خانوادگی مشتری] 
    ,[آدرس مشتری] FROM Reports.Faragostar.View_Unifier
WHERE [نام و نام خانوادگی فروشنده] = N'احد اردلانی کد پرسنلي: 104886'";
            $result=sqlsrv_query($conn,  $query);
    if ($result > 0) {
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_BOTH)) {
           //$retval .= '<a href="#" class="list-group-item list-group-item-action">'.$row['fullName'].'</a>';
           $retval .= '<td>' . $row['fullName'] . ' </td>';    
        }
    }
    $retval .= '</td>';
    echo $retval;
}