<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>@yield('title')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style type="text/css">
.dropdown:hover .dropdown-menu {display: block;}
</style>
</head>
<body>
    <header>
        <div class="container-fluid navbar-style">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand pl-lg-5 pl-md-3 pl-sm-1" href="/"><img src="img/logo.png" alt=""> </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="active nav-item active">
                          <a href="/">Activation</a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('rent_number') }}">Rent numbers</a>
                        </li> 
                        <li class="nav-item">
                          <a href="{{ route('support') }}">Support</a>
                        </li>
                    </ul> 
                    @if(Auth::check('email'))
                    <div class="navbar-nav">
                      <a href="{{ route('payment') }}" class="nav-item balance"><span style="color:black;text-decoration:none;cursor:pointer;font-size:15px;font-weight:bold">Balance: </span> 
                        <div class="dollar ">
                          <input type="text" readonly class="form-control-plaintext col-lg-12" style="width:60px;cursor:pointer;font-size:15px;font-weight:bold" id="balance" value="{{ Auth::user()->balance }}">
                        </div>
                      </a>
                      <div class="dropdown nav-item mx-3 my-1">
                        <a id="dropdownMenuButton" style="cursor:pointer;color:black;font-size:15px;font-weight:bold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-caret-down"></i>
                          {{ Auth::user()->user_name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                          <a class="dropdown-item" href="{{ route('history') }}">History</a>
                          <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                        </div>
                      </div>
                    </div>
                    @else
                    <ul class="navbar-nav">
                        <li class="nav-item">
                          <a href="{{ route('register') }}">Sign up</a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('login') }}">Log in</a>
                        </li>
                    </ul>
                    @endif

                  
                </div>
              </nav> 
        </div>
    </header>


    <div class="button">
    </div>


    <section class="main-section" id="opacity" style="min-height:800px">
        @yield('content')
    </section>
    <div id="myDIV"></div>

<!-- footer -->
  <div class="navbar navbar-expand-lg navbar-light bg-light">
    <p class="navbar-nav mx-auto">
      &copy;PvaText.Com. All Right Reserved.&nbsp;&nbsp;<a href="{{ route('terms') }}" style="color:black">Terms And Condition</a>&nbsp;&nbsp;<a href="{{ route('privacy') }}" style="color:black">Privacy And Policy</a>&nbsp;&nbsp;<a href="{{ route('about') }}" style="color:black">About Us</a>
    </p>
  </div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
<script type='text/javascript' src='//code.jquery.com/jquery-1.10.1.js'></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable #myTR").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$(document).ready(function(){
  $("#serv").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myService #mySer").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
$(document).ready(function(){
  $("#history").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#historyTable #historyTR").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script type='text/javascript'>
    $(window).load(function(){
        $(".country").click(function () {
          $(".country").removeClass("selected")
            $(this).toggleClass("selected");
        });
    });

    $(window).load(function(){
        $(".provider").click(function () {
          $(".provider").removeClass("selected")
            $(this).toggleClass("selected");
        });
    });

    
    function myFunction(conutryCODE) {
      document.getElementById("myDIV").classList.add("loading");
      document.getElementById("opacity").classList.add("opa");
      $.ajax({
         url : '/countrycode/' +conutryCODE,
         type : "GET",
         dataType : "json",
         success:function(data)
         {
            console.log(data);

            for(var i = 0; i < data[1].length; i++) {
                //var price = (data[0]*100 + data[1][i]['price']*100) / 100;
                
                document.getElementById(data[1][i]["code"]).innerHTML = '<span class="my-auto" style="font-size:15px"><span style="color:#37E85B">'+ data[2][i] +'</span> Pcs</span><input class="countrycode" type="hidden" required="required" value="'+ conutryCODE +'" />';
            }
            document.getElementById("myDIV").classList.remove("loading");
            document.getElementById("opacity").classList.remove("opa");
         }
      });
    }

    function confirmFunction(code) {
        document.getElementById("myDIV").classList.add("loading");
        document.getElementById("opacity").classList.add("opa");
        var countrycode = $(".countrycode").val();
        if (countrycode) {
            
          $.ajax({
            url : '/confirmnumber',
            type : "GET",
            data: {country: countrycode, service: code},
            dataType : "json",
            success:function(data)
            {
                console.log(data);
                var price = (data[0]*100 + data[1][0]['price']*100) / 100;

                $(".modal-body").html('<strong>You Will Confirm The Order?'+ country '+ data[2][0]['country'] +'data[3][0]['service'] +', 'price +'?</strong><input class="countrycode" type="hidden" required="required" value="'+ countrycode +'" /><input class="servicecode" type="hidden" required="required" value="'+ code +'" /><input class="'+ code +'" type="hidden" required="required" value="'+ price +'" />');
                document.getElementById("myDIV").classList.remove("loading");
                document.getElementById("opacity").classList.remove("opa");
                $("#getnumberDialog").show();

              }
          });
      }
      else {
          document.getElementById(code).innerHTML = '<div style="font-size:12px">select a country first</div>';
          document.getElementById("myDIV").classList.remove("loading");
          document.getElementById("opacity").classList.remove("opa");
      } 
    }

    function cancel() {
      $("#getnumberDialog").hide();
    }

    function numberFunction() {
      $("#getnumberDialog").hide();
        document.getElementById("myDIV").classList.add("loading");
        document.getElementById("opacity").classList.add("opa");
        var countrycode = $(".countrycode").val();
        var servicecode = $(".servicecode").val();
        var balance = $("#balance").val();
        var cost = $("."+servicecode).val();
        if (countrycode) {
          if (balance > cost) {
            $("#ot").show();
            
            $.ajax({
              url : '/servicecode',
              type : "GET",
              data: {countrycode: countrycode, servicecode: servicecode},
              dataType : "json",
              success:function(data)
              {
                  console.log(data);

                  if (data[1][0]["response"] == 1) {
                    var myVar;

                    myVar = setInterval(function(){ alertFunc(); }, 3000);

                    function alertFunc() {
                      var id = data[1][0]["id"];
                      $.ajax({
                        url : '/getsms',
                        type : "GET",
                        data: {id: id, countrycode: countrycode, servicecode: servicecode, number: data[1][0]["number"], cost: cost, c_code: data[1][0]["CountryCode"]},
                        dataType : "json",
                        success:function(data)
                        {
                            console.log(data);
                            if (data[0]["response"] == 1) {
                              $("#ac").html(data[0]["sms"]);
                              $("#na").html(data[0]["text"]);
                              clearInterval(myVar);
                              var balance = $("#balance").val();
                              var cost = $("."+servicecode).val();
                              var new_balance = balance - cost;
                              $.ajax({
                                url : '/updatebalance',
                                type : "GET",
                                data: {balance: (new_balance).toFixed(2)},
                                dataType : "json",
                                success:function(data)
                                {
                                  console.log(data);
                                  $("#balance").val(data);
                                }
                              });
                            }
                        }
                      });
                    }
                    
                    var countDownDate = new Date().getTime() + 572000;

                    // Update the count down every 1 second
                    var x = setInterval(function() {

                      // Get today's date and time
                      var now = new Date().getTime();
                        
                      // Find the distance between now and the count down date
                      var distance = countDownDate - now;
                        
                      // Time calculations for days, hours, minutes and seconds
                      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                      // If the count down is over, write some text 
                      if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("ot").innerHTML = "EXPIRED";
                        document.getElementById("action").innerHTML = '<button type="button" class="btn btn-primary btn-sm">Reuse</button>';
                      }
                      else{
                        document.getElementById("ot").innerHTML = minutes + "m " + seconds + "s ";
                      }
                    }, 1000);

                    $("#ser").html(data[0]['service']);
                    $("#cc").html(data[1][0]["CountryCode"]);
                    $("#pn").html(data[1][0]["number"]);
                    $("#ac").html('....');
                    $("#na").html('Please wait, searcing for SMS...');
                    $("#action").html('<button type="button" onclick="cancelnumber()" class="btn btn-primary btn-sm btn-block" id="canbtn">Cancel</button><input class="id" type="hidden" required="required" value="'+ data[1][0]["id"] +'" /><input class="service" type="hidden" required="required" value="'+ data[0]['code'] +'" />'); 
                  }
                  document.getElementById("myDIV").classList.remove("loading");
                  document.getElementById("opacity").classList.remove("opa");
                  $(".provider").click(function () {
                    clearInterval(x);
                    $("#ot").empty();
                  });
                }
            });
        }
        else{
          document.getElementById("myDIV").classList.remove("loading");
          document.getElementById("opacity").classList.remove("opa");
          location.href="{{ route('payment') }}";
        }
      }
      else {
          document.getElementById(code).innerHTML = '<div style="font-size:12px">select a country first</div>';
          document.getElementById("myDIV").classList.remove("loading");
          document.getElementById("opacity").classList.remove("opa");
      }
        
    }
    
  function cancelnumber() {
    var id = $(".id").val();
    var country = $(".countrycode").val();
    var service = $(".service").val();
      $.ajax({
         url : '/cancelnumber',
         type : "GET",
         data: {id: id, country: country, service: service},
         dataType : "json",
         success:function(data)
         {
            console.log(data);
            $("#ser").empty();
            $("#cc").empty();
            $("#pn").empty();
            $("#ac").empty();
            $("#na").empty();
            $("#action").empty();
            $("#ot").hide();

         }
      });
    }
</script>
<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="country"]').on('change',function(){
               var Code = jQuery(this).val();
               if(Code)
               {
                  jQuery.ajax({
                     url : '/getservice/' +Code,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     { 
                        console.log(data);
                        
                        let text = "";
                        const service = data[1][0]['data'];
                        service.forEach(forFunction);

                        document.getElementById("rentservice").innerHTML = text;
                        
                        function forFunction(item) {
                          var parcent = (data[0]/100)*item['price_day'];
                          var price = ((parcent).toFixed(2)*100 + item['price_day']*100) / 100;
                          if(item['count'] > 0) {
                            text += '<tr class="service"><td style="text-align:left">'+ item["name"] +'</td><td>'+ item["count"] +'</td><td>'+ price +'</td><td><input type="radio" name="check" id="myCheck" onclick="serFunction(\'' + item['name'] + '\',\'' + item['service'] + '\',\'' + price + '\')"></td></tr>'; 
                          }
                          else{
                            text += '<tr class="noservice"><td style="text-align:left">'+ item["name"] +'</td><td>'+ item["count"] +'</td><td>'+ price +'</td><td><input type="radio" name="check" id="myCheck" disabled></td></tr>'; 
                          }
                        }
                     }
                  });
               }
            });
    });

    function serFunction(name, code, price) {
          $(".service").removeClass("selected");
            $("#"+code).toggleClass("selected");
      console.log(name);
      var country = $("#country").val();
      var dcount = $("#dcount").val();
      var dtype = $("#dtype").val();
      if (dtype == 'week'){
        var cost = dcount*price*7;
      }
      else{
        var cost = dcount*price*30;
      }
      $('#rentcode').html('<input type="hidden" id="service" value="'+ code +'" required><input type="hidden" id="cost" value="'+ cost +'">');
      $('.desci').html('Rent phone number of '+ country +' for service '+ name +' for  '+ dcount +' '+ dtype +'(s). Total amount '+ (cost).toFixed(2) +' USD');
    }

    function rentnumber() {
    var balance = $("#balance").val();
    var country = $("#country").val();
    var service = $("#service").val();
    var dcount = $("#dcount").val();
    var dtype = $("#dtype").val();
    var cost = $("#cost").val();
    if (balance > cost) {
      if(service){
        $("#mi-modal").show();
        var balance = $("#balance").val();
        var new_balance = balance - cost;
        $("#modal-btn-si").on("click", function(){
          $.ajax({
          url : '/rentnumber',
          type : "GET",
          data: {country: country, service: service, dcount: dcount, dtype: dtype, cost: (new_balance).toFixed(2)},
          dataType : "json",
          success:function(data)
          {
              console.log(data);
              $("#balance").val((new_balance).toFixed(2));
              if(data[0]['status'] == 1){
                $('#messege').html('<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>Rent Number Successful, Go to My Number to use rented number</strong></div>');
              }
              else{
                $('#messege').html('<div class="alert alert-danger alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>Rent Number Error, Try Again</strong></div>');
              }
          }
          });
          $("#mi-modal").hide();
        });
        
        $("#modal-btn-no").on("click", function(){
          $("#mi-modal").hide();
        });
      }
    }
    else{
      document.getElementById("myDIV").classList.remove("loading");
      document.getElementById("opacity").classList.remove("opa");
      location.href="{{ route('payment') }}";
    }
  }

</script>
<script>
  function activebtn(ID) {
    if(ID){
        $.ajax({
        url : '/activerent/'+ ID,
        type : "GET",
        dataType : "json",
        success:function(data)
        {
            console.log(data);
            $("#"+data[1]['id']).html('active');
            document.getElementById(data[1]['phone_number']).disabled = true;

        }
        });
    }
  }
  
  function prolongbtn(ID) {
    if(ID){
        $.ajax({
        url : '/loadprolongmodal/'+ID,
        type : "GET",
        dataType : "json",
        success:function(data)
        {
          $("#pronum").html(data[1].phone_number);
          if(data[0]){
          $("#proser").html(data[0].service);
          }
          $("#prodate").html(data[2]);
          $("#prolong").show();
          console.log(data);
          $("#pro").on("click", function(){
            var dtype = $("#dtype").val();
            var dcount = $("#dcount").val();
            if (dtype == 'week'){
              var day = dcount*7;
            }
            else{
              var day = dcount*30;
            }
            const d = new Date(data[1].created_at);
            d.setDate(d.getDate() + 136);

            const e = new Date(data[1].created_at);
            e.setDate(e.getDate() + day);
            console.log(e);

            if(e <= d){
            $.ajax({
            url : '/prolongrent/'+ID,
            type : "GET",
            data: {dtype: dtype, dcount: dcount},
            dataType : "json",
            success:function(data)
            {
                console.log(data);
                $("#"+data[1]).html(data[0]);
            }
            });

            $("#prolong").hide();
            }
            else {
              $("#proerr").html('Cant been prolonged. Max 135 days');
            }

          });
        }
        });
    }
  }

  function cancelbtn(ID) {
    if(ID){
        $.ajax({
        url : '/cancelrent/'+ ID,
        type : "GET",
        dataType : "json",
        success:function(data)
        {
            console.log(data);
            $("#"+ID).empty();
            $("#table").empty();
        }
        });
    }
  }

  function getsmsbtn(ID) {
    if(ID){
      $.ajax({
      url : '/getsmsrent/'+ ID,
      type : "GET",
      dataType : "json",
      success:function(data)
      {
        console.log(data);
          if (data[0][0]["data"] == "") {
            var unixTimestamp = data[0][0]["data"]["date"];
            var date = new Date(unixTimestamp*1000);
            var date2 = date.getDate()+
                      "/"+(date.getMonth()+1)+
                      "/"+date.getFullYear()+
                      " "+date.getHours()+
                      ":"+date.getMinutes()+
                      ":"+date.getSeconds()
            $("#table").html('<table class="table"><thead class="thead-light"><tr><th class="col-2">Number</th><th class="col-3">Text</th><th class="col-3">Date</th></tr></thead><tbody><tr><td>'+data[1]+'</td><td>'+data[0][0]["data"]["text"]+'</td><td>'+date2+'</td></tr></tbody></table>');
          }
          else{
            $("#table").html('<table class="table"><tbody><tr><td>no SMS</td></tr></tbody></table>');
          }
      }
      });
    }
  }
</script>

</html>