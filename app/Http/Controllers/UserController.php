<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use App\Http\Requests\UserFormRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const PER_PAGE = 20;
    protected $user;
    protected $group;

    public function __construct(User $user, Group $group)
    {
        $this->user = $user;
        $this->group = $group;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // return dd($this->user->all());
        $view_data_arr['users'] = $this->user->paginate(self::PER_PAGE);
        return view('user.index', $view_data_arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $view_data_arr['groups'] = $this->group->lists('title', 'id');
        return view('user.create', $view_data_arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(UserFormRequest $request)
    {
        $data = $request->all();
        $this->user->create($data);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $view_data_arr['user'] = $this->user->find($id);
        $view_data_arr['groups'] = $this->group->lists('title', 'id');
        return view('user.edit', $view_data_arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UserFormRequest $request, $id)
    {
        $data = $request->all();
        $this->user->find($id)->update($data);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->user->destroy($id);
        return redirect()->route('user.index');
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function search(Request $request)
    {
        $search_str = $request->input('search_str');
        $view_data_arr['users'] = $this->user->paginateByEmailOrUidOrUsername($search_str, self::PER_PAGE);
        return view('user.index', $view_data_arr);
    }
}