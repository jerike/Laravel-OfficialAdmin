@extends('layouts.header')
@section('main_content')

@include('news.nav')

<h3>顯示 {{ $news->news_title }}</h3>

<div class="jumbotron">
    <!-- 		<h2>{{ $news->news_title }}</h2> -->
    <div class="row">
        <div class="col-md-1">標題:</div>
        <div class="col-md-6">{{ $news->news_title }}</div>
    </div>
    <div class="row">
        <div class="col-md-1">內容:</div>
        <div class="col-md-6">{{ html_entity_decode($news->news_content) }}</div>
    </div>
    <div class="row">
        <div class="col-md-1">分類:</div>
        <div class="col-md-6">{{ $news->news_category }}</div>
    </div>
    <div class="row">
        <div class="col-md-1">種類:</div>
        <div class="col-md-6">{{ $news->news_status }}</div>
    </div>
</div>
@stop