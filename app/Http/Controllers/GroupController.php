<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use App\Http\Requests\GroupFormRequest;
use Illuminate\Http\Request;

class GroupController extends Controller
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
        $view_data_arr['groups'] = $this->group->paginate(self::PER_PAGE);
        return view('group.index', $view_data_arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('group.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(GroupFormRequest $request)
    {
        $data = $request->all();
        $this->group->create($data);
        return redirect()->route('group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // $view_data_arr['group'] = $this->group->find($id);
        // return view('group.show', $view_data_arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $view_data_arr['group'] = $this->group->find($id);
        return view('group.edit', $view_data_arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(GroupFormRequest $request, $id)
    {
        $data = $request->all();
        $this->group->find($id)->update($data);
        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->group->destroy($id);
        return redirect()->route('group.index');
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
        $view_data_arr['groups'] = $this->group->paginateByTitle($search_str, self::PER_PAGE);
        return view('group.index', $view_data_arr);
    }
}

?>