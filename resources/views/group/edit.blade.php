@extends('layouts.header')
@section('main_content')

@include('group.nav')

<h3>新增</h3>

<!-- if there are creation errors, they will show here -->
{!! HTML::ul($errors->all() )!!}

{!! Form::open(array('route' => array('group.update', $group->id), 'method' => 'PUT')) !!}

<div class="form-group">
    {!! Form::label('title', '群組名稱') !!}
    {!! Form::text('title', $group->title, array('class' => 'form-control')) !!}
</div>

{!! Form::submit('確認', array('class' => 'btn btn-primary', 'id'=>'commit')) !!}

{!! Form::close() !!}
@stop

@section('script')
@parent
<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
@stop