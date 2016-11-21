@extends('layouts.header')

@section('main_content')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <!--<a class="navbar-brand" href="{{ URL::to('news') }}">News Alert</a>-->
    </div>
    <ul class="nav navbar-nav">
        <li><a href="">顯示全部</a></li>
    </ul>
</nav>
<h3>當前遊戲APK下載連結</h3><br><br>
{!! HTML::ul($errors->all()) !!}
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>標題(TITLE)</td>
            <td>備註</td>
            <td width="800px">URL</td>
            <td>時間(Date)</td>
            <td>操作</td>
        </tr>
    </thead>
    <tbody>
        @foreach($game_download_links as $game_download_link)
        {!! Form::open(['route' => ['game_download_link.update', $game_download_link->id], 'method' => 'PUT']) !!}
        <tr>
            <td>{!! Form::text('id', $game_download_link->id, ['class' => 'form-control', 'disabled']) !!}</td>
            <td>{{ $game_download_link->title }} APK Url</td>
            <td>{!! Form::text('note', $game_download_link->note, ['class' => 'form-control']) !!}</td>
            <td>{!! Form::text('url', $game_download_link->url, ['class' => 'form-control']) !!}</td>
            <td>{{ $game_download_link->created_at }}</td>
            <td>
                {!! Form::submit('更新', ['class' => 'btn btn-warning', 'onclick' => "if(!confirm('確定要更新?'))return false;"]) !!}
            </td>

        </tr>
        {!! Form::close() !!}
        @endforeach
    </tbody>
</table>
@stop