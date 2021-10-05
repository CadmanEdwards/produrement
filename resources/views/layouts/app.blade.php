<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-Procurement') }}</title>

    <!-- Scripts -->
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <!-- Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'E-Procurement') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                   
                </div>
            </div>
        </nav>

        <main class="py-4">
        @if(session('alert'))
                    <div class="row mb-2">
                    <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="alert alert-danger" role="alert">{{ session('alert') }}</div>
                        </div>
                    </div>
                @endif
                @if(session('success'))
                    <div class="row mb-2">
                    <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                        </div>
                    </div>
                @endif
            @yield('content')
        </main>
    </div>
    
    <script src="{{ asset('theme/plugins/jquery/dist/jquery.min.js') }}"></script>
    
    <script src="{{ asset('theme/js/numbermask.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('theme//plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script>

    $(document).on("click", ".next", function(){
        var number = $('#email').val();

        if( number.length === 0 ) {
            alert("Please enter number");
        }else{
            $('.show_after_email').show();
            $('.number_box').hide();
            
        }

        
    });

    $(document).on("click", ".pin_button", function(){
        $('.submite_register').prop('disabled', false);
        var theRandomNumber = Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1) ;
        $('.pin_insert_value').val(theRandomNumber);
    });
    
  $('#pin').numbermask({
      mask:"# # # #"

  });

  $(document).ready(function(){

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;

        $(".next").click(function(){

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });
        next_fs.css({'opacity': opacity});
        },
        duration: 600
        });
        });

        $(".previous").click(function(){

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });
        previous_fs.css({'opacity': opacity});
        },
        duration: 600
        });
        });

        $('.radio-group .radio').click(function(){
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
        });

        

        });
        $("#select_all").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        function logoImage (){
            $("#logoImage").modal('show');
        }

        function CnicFrontImage (){
            $("#CnicFrontImage").modal('show');
        }

        function CnicBackImage(){
            $("#CnicBackImage").modal('show');
        }
        function NTNImage(){
            $("#NTNImage").modal('show');
        }

        function STRNImage(){
            $("#STRNImage").modal('show');
        }

        function RegisterLogoImage(){
            $("#RegisterLogoImage").modal('show');
        }

        function RegisterCnicFrontImage(){
            $("#RegisterCnicFrontImage").modal('show');
        }

        function RegisterCnicBackImage(){
            $("#RegisterCnicBackImage").modal('show');
        }

    </script>
</body>
</html>
