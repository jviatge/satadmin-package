<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

         <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/fontawesome/all.js') }}" defer></script>
   
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/satadmin.css') }}" rel="stylesheet">
   
        
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar-header text-center">
                    <a href="{{ route('admin.home')}}">
                        <h3>{{ config('satadmin.appName') }}</h3>
                    </a>
                </div>
    
                <ul class="list-unstyled components">

                    <div class="d-flex align-items-center justify-content-lg-between profile-bar px-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/images/satadmin/unknown.png') }}" class="rounded-circle" height="45" width="45"> 
                            <div>
                                <p class="p-0 px-2 m-0 ml-2">
                                    {{ Auth::user()->name }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('logout') }}" style="font-size: 1rem;"><i class="fas fa-sign-out-alt fa-lg"></i></a>
                    </div>
                
                    
                    <li>
                        @for ($i = 0; $i < count($supports); $i++)
                            <a href="{{ route('admin', [ strtolower($supports[$i]) ]) }}">{{ $labels[$i] }}</a>
                        @endfor
                    </li>




                    {{-- <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="#">Home 1</a>
                            </li>
                            <li>
                                <a href="#">Home 2</a>
                            </li>
                            <li>
                                <a href="#">Home 3</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="#">Page 1</a>
                            </li>
                            <li>
                                <a href="#">Page 2</a>
                            </li>
                            <li>
                                <a href="#">Page 3</a>
                            </li>
                        </ul>
                    </li> --}}
                   
                </ul>
    
                {{-- <ul class="list-unstyled CTAs">
                    <li>
                        <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                    </li>
                    <li>
                        <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                    </li>
                </ul> --}}
            </nav>
    
            <!-- Page Content  -->
            <div id="content">
    
                @yield('nav')
                
                @yield('content')

            </div>
        </div>  

    
        <script src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript">

        $(document).ready(function () {

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
            
        });

        </script>
    </body>
</html>
