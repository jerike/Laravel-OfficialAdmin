<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GameDownloadLink;
use App\Http\Requests\GameDownloadLinkRequest;

class GameDownloadLinkController extends Controller
{

    protected $game_download_link;

    public function __construct(GameDownloadLink $game_download_link)
    {
        $this->game_download_link = $game_download_link;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view_data_arr['game_download_links'] = $this->game_download_link->all();
        return view('game_download_link.index', $view_data_arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(GameDownloadLinkRequest $request, $id)
    {
        $data['url'] = $request->input('url');
        $data['note'] = $request->input('note');
        $this->game_download_link->find($id)->update($data);
        return redirect()->route('game_download_link.index');
    }

}
