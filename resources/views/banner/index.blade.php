@extends('layouts.header')
@section('main_content')

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@include('banner.nav')

<h3>輪播 Banners</h3><br>
<div class="panel panel-default">
    <div class="panel-heading">查詢</div>
    <div class="panel-body">
        {!! Form::open(['route' => 'banner.search', 'method' => 'get']) !!}
            <div class="form-group">
                搜尋名稱 :
                {!! Form::text('search_str', Input::get('search_str'), ['class' => 'form-control','style' => 'width:300px;display:inline-block']) !!}
                {!! Form::submit('確定', array('class' => 'btn btn-primary')) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td width="300px">Banner名稱(Title)</td>
            <td>圖片內容(Content)</td>
            <td width="300px">圖片連結(Link)</td>
            <td>圖片順序(Order)</td>
            <td>顯示狀態(S tatus)</td>
            <td width='150px'>操作</td>
        </tr>
    </thead>
    <tbody>
        @foreach($banners as $banner)
        <tr>
            <td>{{ $banner->id }}</td>
            <td style="word-break: break-all;">{{ $banner->title }}</td>
            <td><img src='{{ $banner->img_path }}' style="max-width:150px;"/></td>
            <td style="word-break: break-all;"><a href="{{ $banner->url }}" target="_blank">{{ $banner->url }}</a></td>
            <td>{{ $banner->rank }}</td>
            <td>{{ $banner->status }}</td>
            <td>
                <a class="btn btn-small btn-info" href="{!! URL::to('banner/' . $banner->id . '/edit') !!}">編輯</a>
                {!! Form::open(array('url' => 'banner/' . $banner->id, 'class' => 'pull-right')) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::submit('刪除', array('class' => 'btn btn-warning')) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
    {!! $banners->render() !!}
</table>

@stop