@extends('layouts.header')

@section('main_content')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@include('group_power.nav')
<h3>群組權限</h3><br>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th></th>
            @foreach($groups as $group)
            <th>{{ $group->title }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($menus as $menu)
        <tr>
            <td>
                {{ $menu->MenuNavigation->title }} / {{ $menu->title }}
            </td>
            @foreach($groups as $group)
            <!--主選單ID 次選單ID 群組ID-->
            <td>
                <?php
                    $status = $group->GroupPowers->where('group_id', $group->id)->where('menu_id', $menu->id)->isEmpty() ? 'no' : 'yes';
                ?>
                <img src="{{ asset("img/backend/{$status}.png") }}" data-navigation="{{ $menu->MenuNavigation->id }}" data-menu="{{ $menu->id }}" data-group="{{ $group->id }}" data-yesno="{{ $status }}">
            </td>
            @endforeach <!--End of $group->groupPowers foreach-->
        </tr>
        @endforeach <!--End of $menus foreach-->
    </tbody>
</table>
@stop

@section('script')
@parent
<script>

    $(function() {
        $('img').click(function() {
            change_status($(this));
        });
    });

    function change_status(dom) {
        var status = dom.data('yesno'),
            menu_navigation_id = dom.data('navigation'),
            menu_id = dom.data('menu'),
            group_id = dom.data('group');

        $.post(
            "{{ URL::to('group-power/change') }}", {menu_navigation_id: menu_navigation_id, menu_id: menu_id, group_id: group_id, status: status}, function(response) {
                if (response == "success") {
                    var post_status = status == 'yes' ? 'no' : 'yes';
                    dom.data('yesno', post_status);
                    dom.attr('src', '/img/backend/' + post_status + '.png');
                } else {
                    alert("更新失敗");
                }

            });
    }
</script>
@stop