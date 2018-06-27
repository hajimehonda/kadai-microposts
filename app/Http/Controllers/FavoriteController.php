<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $favorites = $user->favoriting()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'favorites' => $favorites,
            ];
            $data += $this->counts($user);
            return view('favorites.index', $data);
        
    }}

    
    public function store(Request $request,$id)
    {
        \Auth::user()->favorites($id);
        return redirect()->back();
    }

public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);
        return redirect()->back();
    }
    }

