<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserFollowController extends Controller
{
    /**
     * ユーザをフォローするアクション。
     * 
     * @param $id 相手のユーザのid
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        //認証済みユーザ(閲覧者)が、idのユーザをフォローする
        \Auth::user()->follow($id);
        //前のURLへリダイレクトさせる
        return back();
    }
    
    /**
     * ユーザをアンフォローするアクション。
     * 
     * @param $id 相手のユーザのid
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //認証済みユーザ(閲覧者)が、idのユーザをアンフォローする
        \Auth::user()->unfollow($id);
        //前のURLへリダイレクトさせる
        return back();
    }
    
    public function followings($id)
    {
        //idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        //ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);
        //フォロー一覧ビューでそれらを表示
        return view('users.followings',[
            'user' => $user,    
            'users' => $followings,
        ]);
    }
    
    public function followers($id)
    {
        //idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        //ユーザのフォロー一覧を取得
        $followers = $user->followers()->paginate(10);
        //フォロー一覧ビューでそれらを表示
        return view('users.followers',[
            'user' => $user,    
            'microposts' => $followers,
        ]);
    }
}
