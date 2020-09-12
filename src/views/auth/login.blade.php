<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Satadmin - login</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        {{-- APP BASE --}}
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{-- FA --}}
        <script src="{{ asset('satadmin/fontawesome/all.js') }}" defer></script>

        {{-- BASE SATADMIN --}}
        <script src="{{ asset('satadmin/app.js') }}" defer></script>
        <link href="{{ asset('satadmin/satadmin.css') }}" rel="stylesheet">
        
        {{-- QUILL --}}
        <script src="{{ asset('satadmin/quill/quill.js') }}"></script>
        <link href="{{ asset('satadmin/quill/quill.snow.css') }}" rel="stylesheet">
        
        {{-- BOOTSTRAP --}}
        <link href="{{ asset('satadmin/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
        {{-- <script src="{{ asset('satadmin/bootstrap/bootstrap.min.js') }}"></script> --}}

    </head>
   
    <body id="satadmin-app-backofice">
                
        <div class="sidenav">
            <div class="login-main-text">
               <h1 class="py-4">Satadmin</h1>
               <span class="pl-5"><i>Make it front-end easy for development ...</i></span>
            </div>
         </div>
         <div class="main">
            <div class="col-md-6 col-sm-12">
               <div class="login-form">
                  {{-- {% if error %}
                     <div class="alert alert-danger">{{ error.messageKey|trans(error.messageData, 'security') }}</div>
               {% endif %}
         
               {% if app.user %}
                     <div class="mb-3">
                        You are logged in as {{ app.user.username }}, <a href="{{ path('app_logout') }}">Logout</a>
                     </div>
               {% endif %} --}}
         
                  <form method="POST" id="loginFormHome" action="{{ route('admin.login.send') }}">
        
                    @csrf
                    
                     <div class="form-group">
                        <label>Email</label>
                        <input type="email" value="" name="email" id="inputEmail" class="form-control" required autofocus>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="inputPassword" class="form-control" required>
                     </div>
                        {{-- <a href="" class="btn btn-success">Login</a> --}}
                     <button type="button" onclick="submitFunc()" class="btn btn-secondary">Login</button>
                  </form>
               </div>
            </div>
         </div>

    </body>
    <script>

        function submitFunc() {
            let sidenav = document.getElementsByClassName('sidenav')[0];
            let fadeTarget = document.getElementsByClassName("main")[0];
            let Effect = setInterval(function () {
                if (!sidenav.style.left) {
                    sidenav.style.left = '0%';
                    fadeTarget.style.opacity = 1;
                }
                if (onlyNum(sidenav.style.left) > -40) {
                    sidenav.style.left = onlyNum(sidenav.style.left) - 1 + '%';
                    fadeTarget.style.opacity -= 0.05;
                } else {
                    document.getElementById("loginFormHome").submit();
                    clearInterval(Effect);
                }
            }, 5);
        }

        function onlyNum(str) { 
            let matches = str.match(/(\d+)/); 
          
            if (matches) { 
                return -parseInt(matches[0]); 
            } 
        } 
    </script>
</html>






