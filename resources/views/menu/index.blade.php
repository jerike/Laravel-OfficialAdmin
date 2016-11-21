@extends('layouts.header')

@section('main_content')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@include('menu.nav')
<h3>後台次選單</h3><br>
<div class="panel panel-default">
    <div class="panel-heading">查詢</div>
    <div class="panel-body">
        {!! Form::open(['route' => 'news.search', 'method' => 'get']) !!}
            搜尋標題和內容 :
            {!! Form::text('search_str', Input::get('search_str'), ['class' => 'form-control','style' => 'width:300px; display:inline-block']) !!}
            {!! Form::submit('確定', array('class' => 'btn btn-primary')) !!}
        {!! Form::close() !!}
    </div>
</div>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td width='800px'>主選單</td>            
            <td>標題</td>
            <td>網址</td>
            <td>rank</td>
            <td>target</td>
            <td>操作</td>
        </tr>
    </thead>
    <tbody>
        @foreach($menus as $key => $menu)
        <tr>
            <td>{{ $menu->id }}</td>
            <td>{{ $menu->menuNavigation->title }}</td>
            <td>{{ $menu->title }}</td>
            <td>{{ $menu->link }}</td>
            <td>{{ $menu->rank }}</td>           
            <td>{{ $menu->target }}</td>  
             <td>
                {!! Form::open(['url' => 'menu/' . $menu->id, 'class' => 'pull-right', 'method' => 'DELETE']) !!}
                {!! Form::submit('刪除', array('class' => 'btn btn-warning', 'onclick' => "if(!confirm('確定要刪除?'))return false;")) !!}
                <!-- show the nerd (uses the show method found at GET /news/{id} -->
                {!! Form::close() !!}  
                <a class="btn btn-small btn-info" href="{{ URL::to('menu/' . $menu->id . '/edit') }}">編輯</a>
            </td>          
        </tr>
        @endforeach
    </tbody>
    {!! $menus->render() !!} <!--pages paginates-->
</table>
@stop