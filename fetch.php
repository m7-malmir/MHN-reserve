<?php
$serverName = "192.168.27.217";
$uid = "Faragostar";
$pwd = "Ff12345678";
$databaseName = "Reports";
$connectionInfo = array("Database" => $databaseName, "CharacterSet" => "UTF-8", "UID" => $uid, "PWD" => $pwd);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$output = '';
if (isset($_POST['query'])) {
    $search = sqlsrv_query($conn, $_POST["query"]);
    $query = "SELECT TOP 100   شعبه FROM Faragostar.View_Unifier
    WHERE شعبه LIKE '%$search%'";
} else {

    $query = "SELECT TOP 20 [سال / ماه],[سازمان فروش],[ساختار فروش],[شعبه],[نام و نام خانوادگی فروشنده],[نا و نام خانوادگی مشتری] FROM Faragostar.View_Unifier";
}
$result = sqlsrv_query($conn, $query);
if ($result > 0) {
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_BOTH)) {
        $output .= '
			<tr>
            <td>' . $row['سال / ماه'] . '</td>
            <td>' . $row['سازمان فروش'] . '</td>
            <td>' . $row['ساختار فروش'] . '</td>
            <td>' . $row['شعبه'] . ' </td>
            <td >' . $row['نام و نام خانوادگی فروشنده'] . '</td>
            <td>' . $row['نا و نام خانوادگی مشتری'] . ' </td>
            <td></td>
            <td><div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
          </label>
        </div></td>
			</tr>
		';
    }
    echo $output;
} else {
    echo 'Data Not Found';
}
