<div style="text-align: center;margin-bottom: 10px;margin-top: 10px;">
    {!! HTML::image('img/backend/logo.png', null) !!}
    <br/><br/>
    <span class="glyphicon glyphicon-user"></span>
    管理員 : {{ $username }}
    <button type="button" class="btn btn-default btn-xs">
        <span class="glyphicon"></span>
        <a href="{{ route('auth.logout') }}">登出</a>
    </button>
</div>
<div class="panel-group" id="accordion">
    @foreach($permission_arr as $prm_menu_navigation_id => $prm_menus)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $prm_menu_navigation_id }}">
                    {{ $menu_navigations[$prm_menu_navigation_id] }}
                </a>
            </h4>
        </div>
        <div id="collapse{{ $prm_menu_navigation_id }}" class="panel-collapse collapse in">
            <div class="panel-body">
                <ul class="nav">
                    @foreach($prm_menus as $prm_menu_id)
                        <li><a href="{{ url($menus[$prm_menu_id]['link']) }}">{{ $menus[$prm_menu_id]['title'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>