<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Satadmin</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        {{-- APP BASE --}}
        {{-- <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

        {{-- FA --}}
        <script src="{{ asset('satadmin/fontawesome/all.js') }}" defer></script>

        {{-- BASE SATADMIN --}}
        <script src="{{ asset('satadmin/app.js') }}" defer></script>
        <link href="{{ asset('satadmin/satadmin.css') }}" rel="stylesheet">
        
        {{-- QUILL --}}
        <script src="{{ asset('satadmin/quill/quill.js') }}"></script>
        <link href="{{ asset('satadmin/quill/quill.snow.css') }}" rel="stylesheet">
        
        {{-- JQUERY --}}
        <script src="{{ asset('satadmin/jquery/jquery.js') }}"></script>

        {{-- BOOTSTRAP --}}
        <link href="{{ asset('satadmin/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
        <script src="{{ asset('satadmin/bootstrap/bootstrap.min.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    
        
    </head>
    <style>
        .frame{
            width: 500px;
        }
    </style>
    <body id="satadmin-app-backofice">
        <div class="wrapper" id="app">
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
                            <a href="{{ route('admin.details', ['user', Auth::user()->id ]) }}">
                            @if (Auth::user()[config('satadmin.imgProfil')])
                                <img src="{{ Storage::disk('public')->url('images/' . Auth::user()[config('satadmin.imgProfil')]) }}" class="rounded-circle" height="45" width="45">
                            @else
                                <img src="{{ asset('storage/images/satadmin/unknown.png') }}" class="rounded-circle" height="45" width="45"> 
                            @endif
                             
                                <span class="p-0 px-2 m-0 ml-2 nameAuth">
                                    {{ Auth::user()->name }}
                                </span>
                               
                            </a>
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

        <script type="text/javascript">

        $(document).ready(function () {

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
            
        });


        // IMAGE PREVIEW
        let imgInp = document.getElementsByClassName("imgInp");

        for (let i = 0; i < imgInp.length; i++) {
            imgInp[i].addEventListener("change", function(){

                readURL(this, i);

            }, false);
        }

        function readURL(input, i) {
		    if (input.files && input.files[0]) {

                let span = document.getElementsByClassName('nameImgUpload')[i];
                span.innerHTML = input.files[0].name;
                
		        let reader = new FileReader();
		        reader.onload = function (e) {
                    let img_upload = document.getElementsByClassName('img-upload')[i];
		            img_upload.setAttribute('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}
       	

        </script>
    </body>
</html>
