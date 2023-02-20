
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!--customized style-->
     <link rel="stylesheet" href="../css/style.css">
     {{-- assest include --}}
      <!--awesome fonts-->
  <script src="https://kit.fontawesome.com/6d74f7a9b3.js" crossorigin="anonymous"></script>
  <style>
    body
{
margin:0;
padding: 0;
}
.container
{
   padding: 20px 50px 20px 30px;
   background-color: rgb(133, 171, 237);
   border-radius: 7%;
   width:300px;
   margin: 2% 10% 2% 35%;

}
h1{
    text-align: center;
}
.icon{
    width:100%;
    height:50px;
    padding: 10px;
    margin: 10px;
    text-align: center;
}
.fa-facebook {
    background: #3B5998;
    color: white;

    transition: transform .2s;
  }
  .fa-google {
    background: #dd4b39;
    color: white;
    transition: transform .2s;
  }
  .fa-google:hover{
    transform: scale(1.2);
  }
  .fa-facebook:hover{
    transform: scale(1.2);
  }
  .fa{
    padding: 10px;
  font-size: 30px;
  width: 30px;
  border-radius: 50%;
  text-decoration: none;
  margin: 5px 2px;
  cursor:pointer;
  }

form input[type=text], input[type=password]
{

    width: 100%;
    padding: 10px;
    margin: 5px 5px 22px 0;
    border: none;
    border-radius:7px;
    background: #f1f1f1;
}

form button
{
    width: 50%;
    padding: 10px;
    margin: 20px 0 20px 70px;
    background: #3375e8;
    border:#3375e8;
    border-radius:7px;

}
form .form_signup,.form_forgot_password
{
margin:auto;
text-align:center;
}
 form button:hover{
    background: #113f8e;
    color: white;
    cursor:pointer;
 }
</style>
</head>

<body>
    <div class="container">
        <h1>Member Login</h1>
   <form method="POST" action="authenticate" >
      <!-- csrf token is to avoid hacking post data -->
    @csrf

    <div class="error">
    @if ($errors->any())
    <ul>
        {!! implode('',$errors->all('<li>:message</li>'))!!}
    </ul>
    @endif
         </div>
    <div class="form_text">
     <input type="text"  name="mail_id" placeholder="Mail ID"/>
    </div>

    <div class="form_text">
        <input type="password"  name="password" placeholder="Password"/>
        <div class="form_forgot_password">
            <a href="">Forgot Password ?</a>
        </div>
    </div>

    <div class="form_button">
        <button type="submit" name="submit">Login</button>
    </div>

     <div class="form_signup">
        Not a member ? <a href=<?=url('register')?>>Resiger here</a>
    </div>

  </div>
  </form>

</body>
</html>
