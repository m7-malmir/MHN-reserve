<?php
session_start();
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
if(isset($_POST['code'])) {
    $code = $_POST['code'] ?? '';
    // $world = $_POST['query'] ?? '';
    // $cus_code = $_POST['cus_code'] ?? '';
    // $address = $_POST['address'] ?? '';
    // $activity_name= $_POST['activity_name'] ?? '';
    // $year_month= $_POST['year_month'] ?? '';
    // $month= $_POST['month'] ?? '' ;
    // $year= $_POST['year'] ?? '' ;
    $query = "SELECT * FROM Faragostar.View_Unifier WHERE BranchName LIKE N'%قم%' AND LineName LIKE N'%بستن%'  
    AND SellerName LIKE N'%$code%' ";
    if(isset($_POST['customer'])){
        $customer = $_POST['customer'] ?? '';
        $query .=" 
         CustomerName LIKE N'%$customer%'"; 
    }
}else{
    $query ="SELECT * FROM Faragostar.View_Unifier WHERE [BranchName] LIKE N'%قم%' AND LineName LIKE N'%بستن%'";
     }
     print_r($query);
$result = sqlsrv_query($conn, $query);
$number = '';
if ($result > 0) {
    $output ='';

    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_BOTH)) {
        if (isset($_SESSION['users'])) {    
            if (!in_array($row['ID'], $_SESSION['users'])) {
                $number++;
                $output .= '<tr>
                <td>' . $row['Address'] . '</td>
                <td>' . $row['CustomerCode'] . '</td>
                <td>' . $row['CustomerName'] . '</td>
                <td>' . $row['Personnel_Code'] . '</td>
                <td>' . $row['SellerName'] . '</td>
                <td>' . $row['ActivityName'] . '</td>
                <td>' . $row['Year/Month'] . '</td>
                <td>' . $row['Month'] . '</td>
                <td>' . $row['Year'] . '</td>
                <td>' . $number . '</td>
                <td>
                    <div class="form-check">
                        <input name="username[]" value="' . $row['ID'] . '" class="form-check-input" type="checkbox" id="flexCheckDefault" >
                        <label class="form-check-label" for="flexCheckDefault">
                        </label>
                    </div>
                </td>
                </tr>';
            } 
            else {
                        $disable = 'style="background-color:#82e74c4d;pointer-events:none;"';
                        $number++;
                        $output .= '<tr ' . $disable . '>
                <td>' . $row['Address'] . '</td>
                <td>' . $row['CustomerCode'] . '</td>
                <td>' . $row['CustomerName'] . '</td>
                <td>' . $row['Personnel_Code'] . '</td>
                <td>' . $row['SellerName'] . '</td>
                <td>' . $row['ActivityName'] . '</td>
                <td>' . $row['Year/Month'] . '</td>
                <td>' . $row['Month'] . '</td>
                <td>' . $row['Year'] . '</td>
                <td>' . $number . '</td>
                <td>
                    <div class="form-check">
                    
                        <label class="form-check-label" for="flexCheckDefault">
                        </label>
                    </div>
                </td>
                </tr>';
            }
        } else {
            $number++;
            $output .= '<tr>
                <td>' . $row['Address'] . '</td>
                <td>' . $row['CustomerCode'] . '</td>
                <td>' . $row['CustomerName'] . '</td>
                <td>' . $row['Personnel_Code'] . '</td>
                <td>' . $row['SellerName'] . '</td>
                <td>' . $row['ActivityName'] . '</td>
                <td>' . $row['Year/Month'] . '</td>
                <td>' . $row['Month'] . '</td>
                <td>' . $row['Year'] . '</td>
                <td>' . $number . '</td>
                <td>
                    <div class="form-check">
                        <input name="username[]" value="' . $row['ID'] . '" class="form-check-input" type="checkbox" id="flexCheckDefault" >
                        <label class="form-check-label" for="flexCheckDefault">
                        </label>
                    </div>
                </td>
                </tr>';
        }
    }

    echo $output;
} else {
    echo '<center>اطلاعات مورد نظر یافت نشد</center>';
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
        $(function() {
        $('tr [type=checkbox]').click(function() {
            $(this).closest('tr').css('background-color', $(this).prop('checked') ? "#baddfb" : "#fff");
            });
        });
    });
</script>