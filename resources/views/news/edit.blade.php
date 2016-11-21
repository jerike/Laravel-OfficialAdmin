@extends('layouts.header')

@section('style')
@parent
<link rel="stylesheet" type="text/css" href="/datetimepicker-2.3.7/jquery.datetimepicker.css">
@stop

@section('main_content')

@include('news.nav')

<h3>編輯</h3>

<!-- if there are creation errors, they will show here -->
{!! HTML::ul($errors->all()) !!}

{!! Form::model($news, array('route' => array('news.update', $news->id), 'method' => 'PUT')) !!}

<div class="form-group">
    {!! Form::label('title', '標題') !!}
    {!! Form::text('title', $news->title, array('class' => 'form-control')) !!}
</div>
<div class="form-group">
    {!! Form::label('content', '內容') !!}
    <p><a href="{{ $image_management_url }}" target="_blank">開啟檔案管理</a></p>
    {!! Form::textarea('content', html_entity_decode($news->content), ['size' => '185x5']) !!}
</div>

<div class="form-group">
    {!! Form::label('category', '分類') !!}
    {!! Form::select('news_category_id', $categories, null, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('status', '顯示狀態') !!}
    {!! Form::select('status', array('2'=>'設定排程顯示', '1'=>'顯示', '0'=>'隱藏'), Input::old('status'), array('class' => 'form-control')) !!}
</div>

<div class="form-group" id="show_time_div">
    {!! Form::label('show_time', '發佈時間') !!}
    {!! Form::text('show_time', $news->newsPublish ? $news->newsPublish->show_time:'', array('class' => 'form-control')) !!}
</div>

{!! Form::submit('確認', array('class' => 'btn btn-primary', 'name' => 'commit')) !!}


{!! Form::close() !!}
@stop

@section('script')
@parent
<script src="/datetimepicker-2.3.7/jquery.datetimepicker.full.min.js"></script>
<script>

    CKEDITOR.replace('content');

    $(document).ready(function() {

        jQuery('#show_time').datetimepicker({step:30});

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

        $('#status').change(function () {
            if ($(this).val() == 2) {
                $('#show_time_div').show();
            } else {
                $('#show_time_div').hide();
            }
        });

        if ($('#status').val() == 2) {
            $('#show_time_div').show();
        } else {
            $('#show_time_div').hide();
        }
    });
</script>
@stop