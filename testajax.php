<!DOCTYPE html>
<html>

<head>
    <title>Webslesson Tutorial | Search HTML Table Data by using JQuery</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
   
    <form>
        <input type="text" id="vehicle" name="vehicle" value="">
        <div id="vehicle-output"></div>
      </form>
</body>

</html>
<script>
    $(document).ready(function () {
        /// Live Search ///
        $("#vehicle").keyup(function () {

            var query = $(this).val();
            if (query != "") {
                $.ajax({
                    url: "./costumer-search.php",
                    type: "POST",
                    cache: false,
                    data: {
                        query: query
                    },
                    success: function (data) {

                        $("#vehicle-output").html(data);
                        $('#vehicle-output').css('display', 'block');

                        $("#vehicle").focusout(function () {
                            $('#vehicle-output').css('display', 'none');
                        });
                        $("#vehicle").focusin(function () {
                            $('#vehicle-output').css('display', 'block');
                        });
                    }

                });
            } else {
                $("#vehicle-output").html("");
                $('#vehicle-output').css('display', 'none');
            }

        });
        /// Click to enter result ///
        $("#vehicle-output a").on("click", function () {
            $("#vehicle").val($(this).html());
        });
    });
</script>