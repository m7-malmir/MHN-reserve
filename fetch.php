<?php
$serverName = "192.168.27.217";
$uid = "Faragostar";
$pwd = "Ff12345678";
$databaseName = "Reports";
$connectionInfo = array("Database" => $databaseName, "CharacterSet" => "UTF-8", "UID" => $uid, "PWD" => $pwd);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$start = 0;
$perpage = 12;
$records = "SELECT * FROM Faragostar.View_Unifier ";
$query = sqlsrv_query($conn, $records, array(), array("Scrollable" => 'static'));
$row_count = sqlsrv_num_rows($query);
$pages = ceil($row_count / $perpage);

$output = '';
if (isset($_POST['query'])) {
    $search = sqlsrv_query($conn, $_POST["query"]);
    $query = "SELECT TOP 100   شعبه FROM Faragostar.View_Unifier
    WHERE شعبه LIKE '%$search%'";
} else {

    $query = "SELECT TOP " . $perpage . " [سال / ماه],[سازمان فروش],[ساختار فروش],[شعبه],[نام و نام خانوادگی فروشنده],[نا و نام خانوادگی مشتری] FROM Faragostar.View_Unifier";
}
$result = sqlsrv_query($conn, $query);
$number = '';
if ($result > 0) {
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_BOTH)) {
        $number++;
        $output .= '
			<tr>
            <td>' . $row['سال / ماه'] . '</td>
            <td>' . $row['سازمان فروش'] . '</td>
            <td>' . $row['ساختار فروش'] . '</td>
            <td>' . $row['شعبه'] . ' </td>
            <td >' . $row['نام و نام خانوادگی فروشنده'] . '</td>
            <td>' . $row['نا و نام خانوادگی مشتری'] . ' </td>
            <td>' . $number . '</td>
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
?>
<script>

$(document).ready(function(){
        $('table ').find('#result tr').click(function(event){
            //alert();
            if (event.target.type !== 'checkbox') {
                $(':checkbox', this).trigger('click');
            }
        });
    });
</script>