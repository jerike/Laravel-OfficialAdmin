<!DOCTYPE html>
<html>
    <head>
        <title>後台</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="shortcut icon" href="/img/ico.ico">
        @section('style')
        {!! HTML::style('bootstrap-3.2.0/css/bootstrap.min.css') !!}
        <!-- Optional theme -->
        {!! HTML::style('bootstrap-3.2.0/css/bootstrap-theme.min.css') !!}
        {!! HTML::style('bootstrap-3.2.0/css/bootstrap-multiselect.css') !!}
        {!! HTML::style('bootstrap-3.2.0/css/datepicker3.css') !!}
        {!! HTML::style('css/ts.css') !!}

        <!--For news preview-->
        {!! HTML::style('css/carousel.css') !!}
        {!! HTML::style('css/inner.css') !!}

        <!--Image system css-->
        {!! HTML::style('css/image_system.css') !!}
        @show
        <!--ajax X-CSRF-TOKEN-->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body>        
        <div class="container-fluid">
            <div class="row">                
                <div class="col-xs-2">                    
                    @include('layouts.sidebar', $sidebar_data_arr)
                </div>
                <div class="col-xs-10">
                    @yield('main_content')
                </div>
            </div>
        </div>

        @section('script')
        {!! HTML::script('js/jquery/1.11.1/jquery.min.js') !!}
        {!! HTML::script('bootstrap-3.2.0/js/bootstrap.min.js') !!}
        {!! HTML::script('bootstrap-3.2.0/js/bootstrap-datepicker.js') !!}

        {!! HTML::script('js/jquery/jquery.cookie.js') !!}
        {!! HTML::script('ckeditor/ckeditor.js') !!}
        {!! HTML::script('js/address/aj-address.js') !!}
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function() {
                //when a group is shown, save it as the active accordion group
                $("#accordion").on('shown.bs.collapse', function() {
                    var active = $("#accordion .in").attr('id');
                    $.cookie('activeAccordionGroup', active);
                    //  alert(active);
                });
                $("#accordion").on('hidden.bs.collapse', function() {
                    $.removeCookie('activeAccordionGroup');
                });
                var last = $.cookie('activeAccordionGroup');
                if (last != null) {
                    //remove default collapse settings
                    $("#accordion .panel-collapse").removeClass('in');
                    //show the account_last visible group
                    $("#" + last).addClass("in");
                }

                //ajax X-CSRF-TOKEN
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>
        @show
    </body>
</html>