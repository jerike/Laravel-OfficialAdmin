@extends('layouts.header')

@section('main_content')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@include('news.nav')
<h3>全部新聞</h3><br>
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
            <td width='600px'>標題(Title)</td>
            <td>創建時間(Created Date)</td>
            <td>修改時間(Updated Date)</td>
            <td>分類(Category)</td>
            <td width='100px'>顯示狀態(News Status)</td>
            <td width='370px'>操作</td>
        </tr>
    </thead>
    <tbody>
        @foreach($news_collection as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->title }}</td>
            <td>{{ $value->created_at }}</td>
            <td>{{ $value->updated_at }}</td>
            <td>{{ $value->category }}</td>
            <td>{{ $value->status }}</td>
            <td>
                {!! Form::open(['url' => 'news/' . $value->id, 'class' => 'pull-right', 'method' => 'DELETE']) !!}
                {!! Form::submit('刪除', array('class' => 'btn btn-warning', 'onclick' => "if(!confirm('確定要刪除?'))return false;")) !!}
                <!-- show the nerd (uses the show method found at GET /news/{id} -->
                {!! Form::close() !!}
                @if($value->top_status == 1)
                <a class="btn btn-small btn-success" href="{{ route('news.update.top', ['id' => $value->id, 'top_status' => 0]) }}">取消最新此文</a>
                @elseif( $value->top_status == 2)
                <a class="btn btn-small btn-danger" href="{{ route('news.update.top', ['id' => $value->id, 'top_status' => 0]) }}">取消置頂此文</a>
                @else
                <a class="btn btn-small btn-danger" href="{{ route('news.update.top', ['id' => $value->id, 'top_status' => 2]) }}">置頂</a>
                <a class="btn btn-small btn-success" href="{{ route('news.update.top', ['id' => $value->id, 'top_status' => 1]) }}">最新</a>
                @endif

                <!--preview-->
                <a class="btn btn-small btn-primary" href="{{ URL::route('news.show', $parameters = array($value->id)) }} " target="_blank">預覽</a>
                <!-- edit this nerd (uses the edit method found at GET /news/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('news/' . $value->id . '/edit') }}">編輯</a>
                <!-- delete the nerd (uses the destroy method DESTROY /news/{id} -->
                <!-- we will add this later since its a little more complicated than the first two buttons -->
            </td>
        </tr>
        @endforeach
    </tbody>
    {!! $news_collection->render() !!} <!--pages paginates-->
</table>
@stop