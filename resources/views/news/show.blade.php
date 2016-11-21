<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta id="viewport" name="viewport" content="initial-scale=0.8, maximum-scale=0.8, width=device-width, target-densitydpi=high-dpi" />
        <title>《戰國炎舞》官方網站 － 華麗史詩‧布武天下</title>
        <link rel="stylesheet" href="/css/preview/jquery-ui-1.9.2.custom.css" /> <!-- Jquery UI CSS -->
        <link rel="stylesheet" type="text/css" href="/css/preview/slick.css"/>  <!-- http://kenwheeler.github.io/slick/  Copyright (c) 2014 Ken Wheeler. Licensed under the MIT license. -->
        <link href="/css/preview/bootstrap.min.css" rel="stylesheet">
        <link href="/css/preview/carousel.css" rel="stylesheet"> <!-- the css editable in USE -->
        <link href="/css/preview/inner.css" rel="stylesheet">
    </head>
    <!-- NAVBAR
    ================================================== -->
    <body>
        <div class="container marketing">
            <div class=" featurette paddT2 wrapper">
                <div class="col-md-12 col-sm-12 ">
                    <div class="boxA minhs">
                        <div class="w100left">
                            <div class="ptitle">
                                {{ $news->title }}
                            </div>
                        </div>
                        <div class="w100left">
                            <div class="newsbox" >
                                {{ html_entity_decode($news->content) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script> <!-- Jquery library -->
        <script type="text/javascript">

        $(document).ready(function(){
        @if ($isMobile)
            $(".newsbox").find("img").css({"width":"100%", "height":"auto"});
            $(".newsbox").find("iframe").css({"width":"100%"});
            $(".newsbox").find("table").css({"width":"100%", "height":"auto"});
            @endif
        });
        </script>
    </body>
</html>


