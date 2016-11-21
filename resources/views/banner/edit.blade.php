@extends('layouts.header')
@section('main_content')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@include('banner.nav')

<h3>編輯</h3>

<!-- if there are creation errors, they will show here -->
{!! HTML::ul($errors->all()) !!}

{!! Form::model($banner, array('route' => array('banner.update', $banner->id), 'method' => 'PUT')) !!}

<div class="form-group">
    {!! Form::label('title', '圖片名稱') !!}
    {!! Form::text('title', null, array('class' => 'form-control')) !!}
</div>
<div class="form-group">
    {!! Form::label('img_path', '圖片內容') !!}
    <p>請上傳尺寸 380*224 的圖檔 <a href="{{ $image_management_url }}" target="_blank">開啟檔案管理</a></p>
    {!! Form::text('img_path', null, array('class' => 'form-control')) !!}
</div>
<div class="form-group">
    {!! Form::label('url', '圖片連結') !!}
    {!! Form::text('url', null, array('class' => 'form-control')) !!}
</div>
<div class="form-group">
    {!! Form::label('rank', '顯示順序') !!}
    {!! Form::selectRange('rank', 1, 5, Input::old('rank'), array('class' => 'form-control'))!!}
</div>
<div class="form-group">
    {!! Form::label('status', '顯示狀態') !!}
    {!! Form::select('status', array('1'=>'顯示', '0'=>'隱藏'),Input::old('status'), array('class' => 'form-control'))!!}
</div>


{!! Form::submit('確認', array('class' => 'btn btn-primary')) !!}

{!! Form::close() !!}

@stop