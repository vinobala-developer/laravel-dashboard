{{-- <h2>hello welcome {{auth()->user()->name}} .. {{auth()->user()->role}}</h2>
<a href="logout">logout</a> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Login Page</title>
    <!--customized style-->
        <link rel="stylesheet" href={{URL::asset("asset/css/home_style.css")}}>
      <!--awesome fonts-->
    <script src="https://kit.fontawesome.com/6d74f7a9b3.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Jquery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

     @yield('home_chat_style')
         @yield('style')
</head>
<body>
  <div class="class main-container d-flex">
    <div class="sidebar" id="side_nav">
      <div class="header-box px-3 pt-3 pb-4 d-flex justify-content-between">
        <h1 class="fs-4">
            {{-- <span class="bg-white text-dark rounded shadow px-2 me-2">P-IQ</span> --}}
            <span class="text-white">ParcelIQ</span>
        </h1>
      <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa fa-stream"></i></button>
    </div>

    <ul class="list-unstyled px-2">
    <li class="px-3 py-2 {{ Request::is('dashboard') ? 'active' : '' }}"><a href="/dashboard" class="text-decoration-none"><i class="fa fa-home m-2"></i>Dashboard</a></li>
    <li class="px-3 py-2 {{ Request::is('home_chat') ? 'active' : '' }}"><a href="/home_chat" class="text-decoration-none"><i class="fa fa-users m-2"></i>Chat</a></li>
    </ul>
    <hr class="h-color mx-3">

    </div>
    <div class="content">
  <nav class="navbar navbar-expand-md navbar-light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between d-md-none d-block">
            <a class="navbar-brand fs-4" href="#">ParcelIQ</a>
            <button class="btn px-1 py-0 open-btn"><i class="fa fa-stream"></i></button>
        </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="sidebar">
    <ul class="navbar-nav ms-auto">
    <li class="nav-item m-1" id="notify">
    <div class="dropdown show">
    {{-- <a class="btn " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> --}}
    <button type="button" class="btn btn-primary dropdown notify position-relative" data-toggle="dropdown">
            <i class="fa fa-bell" id="notification"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger count">
             </span>
        </button>
    {{-- </a> --}}

  <div class="dropdown-menu dropdown-menu-end unread_msg mt-1" aria-labelledby="dropdownMenuLink">
    {{-- <li class="dropdown-item " href="#">action</li> --}}

  </div>
</div>
</li>
     <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle  nav-user" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{auth()->user()->name}}
         </a>
        <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="navbarDropdown">
           <div class="dropdown-item"><a class="text-decoration-none d-bock" href="/profile/{{auth()->user()->id}}">profile</a></div>
           <div class="dropdown-item"><a class="text-decoration-none d-bock" href="/logout">logout</a></div>
        </div>
      </li>
    </ul>
  </div>
</div>
</nav>
    <div class="container-fluid dashboard-content px-3 pt-4">
       <h3>@yield('title')</h3>
         @yield('content')
    </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  <script>
    notification();
    setInterval(function() {notification();}, 3000);

    // $(".sidebar ul li").on('click',function(){
    //       $(".sidebar ul li.active").removeClass('active');
    //       $(this).addClass('active');
    // });
    $(".open-btn").on("click",function(){
        $(".sidebar").addClass('active');
    });
    $(".close-btn").on("click",function(){
        $(".sidebar").removeClass('active');
    });

    //  let msg_count=$(".count").html();
    //      console.log(msg_count);

    function notification(){
         $.ajax({
        type:'GET',
        url:'/notify',
        data:{
            count:0
            },
        success:function(response){
            let list_html;
            //console.log(response);
          let count=response.length;

          if( count >0)
          {
         list_html = "<ul class='list-unstyled p-2 msg_menu'><li class='text-center read' href='#' onclick=check()>Mark as Read</li>";
          }else{
        list_html = "<ul class='list-unstyled p-2 no_msg'><li class='text-center '>No New Message</li>";
          }

         for(let i=0;i<count;i++)
         {
            list_html += "<hr><li class='p-2'>" + response[i].name +" : " + response[i].message + "</li>";
         }
            list_html += "</ul>"
          $('.unread_msg').html(list_html);
          $('.count').html(count);

        }

    });
    }
function check () {
  //$('.count').html(0);
   $.ajax({
        type:'GET',
        url:'/change_notify',
        data:{
            status:1
            },
        success:function(response){
            console.log(response);
        }

        });

}
  </script>
   @yield('chat_script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 </script>
</body>
</html>
{{-- <li class='list-group-item read' href='#' onclick=check()>Mark as Read</li></div>"; --}}
