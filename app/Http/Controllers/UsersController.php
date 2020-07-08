<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        //ユーザ一覧を降順で取得
        $users = User::orderby('id', 'desc')->paginate(10);
        
        //ユーザ一覧ビューでそれを表示
        return view('users.index',[
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        //idの値でユーザーを検索して取得
        $user = User::findOrFail($id);
        
        //ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
        ]);
    }
}