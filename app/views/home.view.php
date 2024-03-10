<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <!-- Required meta tags -->
  <title>Doc</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?= ROOT ?>public/assets/css/style.css">
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <main>
    <section class="container">
    <form action="" method="post">
      <h3 class="mt-5 mb-5">رزرو تایم مصاحبه برای کارمندان</h3>
      <div class="d-flex">
        <div class="row">
          <div class="">
            <input  class="form-control me-2 mt-5 " id="search" type="search" placeholder="جستجوی شماره پرسنلی" aria-label="Search">
          </div>
        </div><!--row-->
        <button class="btn btn-outline-success mt-5 mx-3" type="submit">جستجو</button>
      </div>
      <table id="box1" class="table hidden-class">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">شماره پرسنلی</th>
            <th scope="col">نام</th>
            <th scope="col">نام خانوادگی</th>
            <th scope="col">محل خدمت</th>
            <th scope="col">پست سازمانی</th>
            <th scope="col">شماره ملی</th>
          </tr>
        </thead>
       
        <tbody id="result">
         
           
          
        </tbody>
      </table>

      <div class="row mt-5">
      <h5><label for="" > وضعیت کنونی</label></h5>
        <div class="col-md-3">
          <select name="award" class="form-select form-select-lg mb-3" aria-label="Default select example">
            <option selected>انتخاب کنید</option>
            <option value="1">استخدام</option>
            <option value="2">ارتقا</option>
          </select>
        </div>
      </div><!--row-->
      <div class="row mt-5">
      <h5><label for="" > وضعیت پیشنهادی</label></h5>
        <div class="col-md-3">
        <label for="staticEmail2" class="">پست</label>
        <input name="post-offer" class="form-control" type="text" placeholder="" aria-label="default input example">
        </div>
        <div class="col-md-3">
        <label for="staticEmail2" class="">واحد</label>
        <input name="unit-offer" class="form-control" type="text" placeholder="" aria-label="default input example">
        </div>
        <div class="col-md-3">
        <label for="staticEmail2" class="">محل خدمت</label>
        <input name="location-offer" class="form-control" type="text" placeholder="" aria-label="default input example">
        </div>
      </div><!--row-->

      <div class="row mt-5">
      <h5><label for="" >انتخاب اعضا کمیته برای مصاحبه</label></h5>
        <div class="col-md-5">
        <div class="d-flex">
        <div class="row">
          <div class="">
            <input class="form-control me-5 mt-5 " type="search" placeholder="جستجوی اعضا کمیته ارزیابی" aria-label="Search">
          </div>
        </div><!--row-->
        <button class="btn btn-outline-success mt-5 mx-3" type="submit">جستجو</button>
      </div>
      <table class="table hidden-class">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">نام و نام خانوادگی</th>
            <th scope="col">زمان حضور</th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              </div>
            </th>
            <td>لهراسبی</td>
            <td>8-14</td>

          </tr>
        </tbody>
      </table>
        </div>
    
      </div><!--row-->
      <input type="submit" value="ثبت رویداد" class="btn btn-warning mt-5"> 
      </form>
    </section>

  </main>
</head>

<body>
  <h1></h1>
</body>

</html>
<script>
$(document).ready(function(){


  $(function() {
  $(".form-check input[type='checkbox']").change(function(event) {
    var $self = $(this);
    var tip;
    $(".form-check input[type='checkbox']").not($self).prop("checked", false);
    if ($(".form-check input[type='checkbox']:checked").length == 0) {
      tip = 0;
    } else {
      tip = parseInt($self.val());
    }
    console.log(tip);
  });
});



  $('#search').on('click', function() {
    $(this).parent().parent().parent().parent().find('#box1').removeClass('hidden-class') ;
      });
 $.ajaxSetup({ cache: false });
 $('#search').keyup(function(){
  $('#result').html('');
  $('#state').val('');
  var searchField = $('#search').val();
  var expression = new RegExp(searchField, "i");
  $.getJSON('../app/api/sap.json', function(data) {
    
   $.each(data, function(key, value){
 if (value.code.search(expression) != -1)
    { 
     $('#result').append('<tr><th scope="row"><div class="form-check"><input name="id" class="form-check-input" name="codepersonel" type="radio" value="'+value.code+'" id="flexCheckDefault"></div></th><td>'+value.code+'</td><td>'+value.name+'</td><td>'+value.status+'</td><td>'+value.jobtitle+'</td><td>'+value.unit+'</td><td>'+value.location+'</td></tr>');
    }
   });   
  });
 });
 
 $('#result').on('click', 'li', function() {
  var click_text = $(this).text().split('|');
  $('#search').val($.trim(click_text[0]));
  $("#result").html('');
 });
});
</script>