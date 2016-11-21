@extends('layouts.header')
@section('main_content')

@include('menu.nav')

<h3>編輯</h3>

<!-- if there are creation errors, they will show here -->
{!! HTML::ul($errors->all()) !!}

{!! Form::model($menu, array('route' => array('menu.update', $menu->id), 'method' => 'PUT')) !!}

<div class="form-group">
    {!! Form::label('menu_navigation_id', '標題') !!}
    {!! Form::select('menu_navigation_id', $menu_navigatations, null, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('title', '標題') !!}
    {!! Form::text('title', $menu->title, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('link', '連結') !!}
    {!! Form::text('link', $menu->link, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('rank', '排序') !!}
    {!! Form::text('rank', $menu->rank, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('target', '開頁方式') !!}
    {!! Form::text('target', $menu->target, array('class' => 'form-control')) !!}
</div>



{!! Form::submit('確認', array('class' => 'btn btn-primary', 'name' => 'commit')) !!}


{!! Form::close() !!}
@stop

@section('script')
@parent
<script>

    CKEDITOR.replace('content');

    $(document).ready(function() {
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
        $("input[name='commit']").click(function() {
            formmodified = 0;
        });
    });
</script>
@stop