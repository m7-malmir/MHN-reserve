<?php
$serverName = "192.168.27.217";
$uid = "Faragostar";
$pwd = "12341234";
$databaseName = "Reports";
$connectionInfo = array("Database" => $databaseName, "CharacterSet" => "UTF-8", "UID" => $uid, "PWD" => $pwd);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$start = 0;
$perpage = 10;
$records = "SELECT * FROM Faragostar.View_Unifier WHERE [BranchName]='زاهدان'";
$query = sqlsrv_query($conn, $records, array(), array("Scrollable" => 'static'));
$row_count = sqlsrv_num_rows($query);
$pages = ceil($row_count / $perpage);


$output = '';
if (isset($_POST['query'])) {
    $world = $_POST['query'];
   // $search = sqlsrv_query($conn, $_POST["query"]);
    $query = "SELECT TOP 10 [Year],[Month],[Year/Month],[LineName],[BranchName],[StructureName],[ActivityName],[SellerName],[Personnel_Code],[CustomerName],[CustomerCode],[Address] FROM Faragostar.View_Unifier
    WHERE [SellerName] LIKE N'%{$world}%' OR [CustomerName] LIKE N'%{$world}%' AND [BranchName]='زاهدان'";
} else {
    $query="SELECT TOP 10 [Year],[Month],[Year/Month],[LineName],[BranchName],[StructureName],[ActivityName],[SellerName],[Personnel_Code],[CustomerName],[CustomerCode],[Address] FROM Faragostar.View_Unifier WHERE [BranchName]='زاهدان'";
}

$result = sqlsrv_query($conn, $query);
$number = '';
if ($result > 0) {
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_BOTH)) {
        $number++;
        $output .= '<tr>
        <td>'.$row['Address'] .'</td>
        <td>'.$row['CustomerCode'].'</td>
        <td>' .$row['CustomerName'] . ' </td>
        <td>'.$row['Personnel_Code'].'</td>
        <td >' .$row['SellerName'] . '</td>
        <td>' .$row['ActivityName'] . '</td>
        <td>' .$row['StructureName'] . '</td>
        <td>' .$row['BranchName'] . ' </td>
        <td>' .$row['LineName'] . '</td>
        <td>' .$row['Year/Month'] . '</td>
        <td>'.$row['Month'] .'</td>
        <td>'.$row['Year'] .'</td>
        <td>' . $number . '</td>
        <td><div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
      </label>
    </div></td></tr>';
    }
    echo $output;
} else {
    echo '<center>اطلاعات مورد نظر یافت نشد</center>';
}
?>
<script>
$(document).ready(function(){

        $('table ').find('#result tr').click(function(event){
            if (event.target.type !== 'checkbox') {
                $(':checkbox', this).trigger('click');
            }
        });

        $(function() {
            $('tr td [type=checkbox]').click(function() {
                $(this).closest('tr').css('background-color', $(this).prop('checked') ? "#baddfb" : "#fff");
            });
        });  
});
</script>