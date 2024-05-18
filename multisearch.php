<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
<form action= "../model/dataentry.php?formname=enter_deposit" method="POST" id="ajaxform" name="ajaxform">
<div class = "label"><p1>Revenue Account Name</p1></div><div class = "field"><input class = "textinput" type="input" name="acctname" id="acctname" value = ""  autocomplete="off">
<p class = "options"></p></div>
<div class = "label"><p1>Revenue Account Number</p1></div><div class = "field"><input class = "textinput" type="input" name="acctno" id="acctno" value = ""  autocomplete="off">
<p class = "options"></p></div>
<input class = "submit" name = "Submit" type = "button" id = "ajaxsubmit" value = "Submit"  >
<input class = "submit" name = "Close" type = "button" id = "close" value = "Close"  >
</div>
</form>
</body>
</html>

<script>
    $(document).ready(function() {

//sets the chosen value into the input
$( ".options").on( "click", function(event) {
   var item =  $(event.target).text(); 
   var clickedid = $(this).attr('id'); 
   var targetid = clickedid.split('_'); //remove the '_opt' suffice to get the target id
   $('#' + targetid).val(item);//place chosed result into the acctname input
   $('.options').hide();//hide result options after click
}); 

//On pressing a key in input field, this function will be called.
$(".textinput").keyup(function() {
   var id = $(this).attr("id");
   var optid = id + '_opt'; //set the target element id
   var val = $(this).val();
   if (val === '') { //Validating, if "name" is empty.
   $('#' + optid).html('').show();
   }else {//If input is not empty.
        $.ajax({
           type: "POST",
           url: "fetch.php",
           data: {id: id, val: val},
           success: function(html) {//place the result into the p element and set the proper css
              $('#' + optid).html(html).show().css({"position":"absolute","z-index":"+1","cursor":"pointer","color":"black","background-color":"white"});
              }
       });
   }
});
});
</script>