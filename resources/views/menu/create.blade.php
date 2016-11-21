@extends('layouts.header')
@section('main_content')

@include('menu.nav')

<h3>新增次選單</h3>
<br>

<!-- if there are creation errors, they will show here -->
{!! HTML::ul($errors->all() )!!}

{!! Form::open(array('url' => 'menu', 'method' => 'POST')) !!}

<div class="form-group">
    {!! Form::label('menu_navigation', '主選項') !!}
    {!! Form::select('menu_navigation_id', $menu_navigatations, Input::old('menu_navigation'), array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('title', '標題') !!}
    {!! Form::text('title', Input::old('title'), array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('link', '連結') !!}
    {!! Form::text('link',  Input::old('link'), array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('rank', '排序') !!}
    {!! Form::text('rank',  Input::old('rank'), array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('target', '開頁方式') !!}
    {!! Form::text('target',  Input::old('target'), array('class' => 'form-control')) !!}
</div>


{!! Form::submit('確認', array('class' => 'btn btn-primary', 'id'=>'commit')) !!}

{!! Form::close() !!}
@stop

@section('script')
@parent
<script type="text/javascript">


    $(document).ready(function() {

        CKEDITOR.replace('content');

        //alert before leaving
        formmodified = 0;

        //if form elements change
        $('form *').change(function() {
            formmodified = 1;
        });

        //if ckeditor content changes
        for (var i in CKEDITOR.instances) {
            CKEDITOR.instances[i].on('change', function() {
                formmodified = 1;
            });
        }
        window.onbeforeunload = confirmExit;
        function confirmExit() {
            if (formmodified == 1) {
                return "尚未儲存更改，";
            }
        }
        $("#commit").click(function() {
            formmodified = 0;
        });
    });
</script>
@stop