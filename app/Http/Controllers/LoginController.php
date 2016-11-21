<?php

namespace App\Http\Controllers;

use App\Models\User as User;
use App\Models\Group as Group;
use App\Models\GroupPower as GroupPower;
use App\Models\MenuNavigation as MenuNavigation;
use App\Models\Menu as Menu;
// use App\Domain\Core\Entities\LoginLogs;
use Socialite,
    Session,
    Request;

class LoginController extends Controller
{

    protected $googleService;
    protected $account;
    protected $group;
    protected $group_power;
    protected $menu_navigation;
    protected $menu;

    public function __construct(User $account, Group $group, GroupPower $group_power, MenuNavigation $menu_navigation, Menu $menu)
    {
        $this->account = $account;
        $this->group = $group;
        $this->group_power = $group_power;
        $this->menu_navigation = $menu_navigation;
        $this->menu = $menu;
    }
    public function redirectToProvider()
    {
        return Socialite::with('google')->redirect();
    }

    public function loginWithGoogle()
    {
        $user = Socialite::with('google')->user();

        // OAuth Two Providers
        $token = $user->token;
        if ($token) {
            $email = $user->getEmail();

            if (!$this->account->checkPassByEmail($email)) {
                return "<script>alert('Error');window.location.href='" . Request::root() . "/auth/logout';</script>";
            }

            $account_info_obj = $this->account->getInfoByEmail($email);
            Session::put('uid', $account_info_obj->uid);
            Session::put('username', $account_info_obj->username);
            Session::put('account_id', $account_info_obj->id);
            Session::put('login_pass', true);
            Session::put('permission_arr', $this->getAccountPermissions(Session::get('uid')));

            // $log = new \stdclass();
            // $log->uid = Session::get('uid');
            // $log->login_session = Session::getId();
            // $log->ip = Request::server('REMOTE_ADDR');
            // LoginLogs::addLog($log);
            return redirect()->route('index');
        }
    }

    public function logoutGoogle()
    {
        if (isset($_COOKIE['ggphpid'])) {
            setcookie("ggphpid", "", time() - 3600, "/");
        }

        if (isset($_COOKIE['gglocal'])) {
            setcookie("gglocal", "", time() - 3600, "/");
        }

        Session::flush();

        $site_url = Request::root();

        $url = 'https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=' . $site_url;

        return redirect()->to((string) $url);
    }

    private function getAccountPermissions($uid)
    {
        $group_id = $this->account->findByUID($uid)->group_id;        

        $permission_arr = [];
        $menu_navigation_arr = [];
        $menu_arr = [];

        $group_powers = $this->group_power->join('menu_navigations', 'menu_navigation_id', '=', 'menu_navigations.id')
                        ->join('menus', 'menu_id', '=', 'menus.id')
                        ->where('group_id', $group_id)
                        ->orderBy('menu_navigations.rank')
                        ->orderBy('menus.rank')
                        ->get(['group_powers.id', 'group_powers.group_id', 'group_powers.menu_navigation_id', 'group_powers.menu_id'
                                        ,'menus.title', 'menus.link','menus.target','menu_navigations.title as menu_navigation_title'])
                        ->toArray();

         foreach ($group_powers as  $menu) {
             $permission_arr[$menu['menu_navigation_id']][] = $menu['id'];
             if(!isset($menu_arr[$menu['id']])){
                 $menu_arr[$menu['id']] = $menu;    
             }
           
             if(!isset($menu_navigation_arr[$menu['menu_navigation_id']])){
                 $menu_navigation_arr[$menu['menu_navigation_id']] = $menu['menu_navigation_title'];
             }
        }

        Session::put('menu_arr', $menu_arr);
        Session::put('menu_navigation_arr', $menu_navigation_arr);
        return $permission_arr;

    }

}
