<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store($micropostId)
    {
        \Auth::user()->favorite($micropostId);
        
        return back();
    }
    
    
    public function destroy($micropostId)
    {
        \Auth::user()->unfavorite($micropostId);
        
        return back();
    }
    
    public function favorites($id)
    {
        $user = User::findOrFail($id);  
        
        $user->loadRelationshipCounts();
        
        $favorites = $user->favorites()->paginate(10);
        
        return view('users.favorites',[
            'user' => $user,
            'microposts' => $favorites,
            ]);
    }
}
