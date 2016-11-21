@extends('layouts.header')
@section('main_content')

@include('user.nav')

<h3>新增</h3>

<!-- if there are creation errors, they will show here -->
{!! HTML::ul($errors->all() )!!}

{!! Form::open(array('route' => array('user.update', $user->id), 'method' => 'PUT')) !!}

<div class="form-group">
    {!! Form::label('email', '公司信箱') !!}
    {!! Form::text('email', $user->email, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('uid', 'UID') !!}
    {!! Form::text('uid', $user->uid, array('class' => 'form-control')) !!}
</div>


<div class="form-group">
    {!! Form::label('username', '帳號名稱') !!}
    {!! Form::text('username', $user->username, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('group_id', '所屬群組') !!}
    {!! Form::select('group_id', $groups, $user->group_id, array('class' => 'form-control')) !!}
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