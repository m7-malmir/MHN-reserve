<?php
if (isset($_POST["limit"], $_POST["start"])) {
    $serverName = "192.168.27.217";
    $uid = "Faragostar";
    $pwd = "12341234";
    $databaseName = "Reports";
    $connectionInfo = array("Database" => $databaseName, "CharacterSet" => "UTF-8", "UID" => $uid, "PWD" => $pwd);
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    // $count="SELECT * FROM Faragostar.View_Unifier WHERE [BranchName]='زاهدان'";
    // $query1 = sqlsrv_query($conn,$count, array(), array("Scrollable" => 'static'));
    // $row_count = sqlsrv_num_rows($query1);
    $query = "SELECT TOP(50) FROM Faragostar.View_Unifier WHERE [BranchName]='زاهدان'";
    $result = sqlsrv_query($conn, $query);
    $number = '';

    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_BOTH)) {
        $number++;
        echo '<tr>
        <td>' . $row['Address'] . '</td>
        <td>' . $row['CustomerCode'] . '</td>
        <td>' . $row['CustomerName'] . ' </td>
        <td>' . $row['Personnel_Code'] . '</td>
        <td >' . $row['SellerName'] . '</td>
        <td>' . $row['ActivityName'] . '</td>
        <td>' . $row['StructureName'] . '</td>
        <td>' . $row['BranchName'] . ' </td>
        <td>' . $row['LineName'] . '</td>
        <td>' . $row['Year/Month'] . '</td>
        <td>' . $row['Month'] . '</td>
        <td>' . $row['Year'] . '</td>
        <td>' . $number . '</td>
        <td><div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
      </label>
    </div></td></tr>';
    }
}
