@extends('layouts.header')

@section('main_content')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@include('user.nav')
<h3>全部使用者</h3><br>
<div class="panel panel-default">
    <div class="panel-heading">查詢</div>
    <div class="panel-body">
        {!! Form::open(['route' => 'user.search', 'method' => 'get']) !!}
            搜尋Email、Uid或帳號名稱 :
            {!! Form::text('search_str', Input::get('search_str'), ['class' => 'form-control','style' => 'width:300px; display:inline-block']) !!}
            {!! Form::submit('確定', array('class' => 'btn btn-primary')) !!}
        {!! Form::close() !!}
    </div>
</div>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>公司信箱(Email)</td>
            <td>UID</td>
            <td width='300px'>帳號名稱(username)</td>
            <td>所屬群組(group)</td>
            <td>創建時間(Created Date)</td>
            <td>修改時間(Updated Date)</td>
            <td>操作</td>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->email }}</td>
            <td>{{ $value->uid }}</td>
            <td>{{ $value->username }}</td>
            <td>{{ $value->group->title}}</td>
            <td>{{ $value->created_at }}</td>
            <td>{{ $value->updated_at }}</td>
            <td>
                {!! Form::open(['url' => 'user/' . $value->id, 'class' => 'pull-right', 'method' => 'DELETE']) !!}
                {!! Form::submit('刪除', array('class' => 'btn btn-warning', 'onclick' => "if(!confirm('確定要刪除?'))return false;")) !!}
                <!-- show the nerd (uses the show method found at GET /news/{id} -->
                {!! Form::close() !!}
                <!-- edit this nerd (uses the edit method found at GET /news/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('user/' . $value->id . '/edit') }}">編輯</a>
                <!-- delete the nerd (uses the destroy method DESTROY /news/{id} -->
                <!-- we will add this later since its a little more complicated than the first two buttons -->
            </td>
        </tr>
        @endforeach
    </tbody>
    {!! $users->render() !!} <!--pages paginates-->
</table>
@stop