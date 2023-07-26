<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \App\User;

class FollowsController extends Controller
{
    //フォローリスト
    public function followList(){
        $follows = DB::table('follows')->where('follow',Auth::user()->id)->get();
        $users = User::all();
        $posts = DB::table('posts')->orderBy('created_at','desc')->get();

        return view('follows.followList')->with(['users'=>$users , 'follows'=>$follows , 'posts'=>$posts]);
    }

    //フォロワーリスト
    public function followerList(){
        $followers = DB::table('follows')->where('follower',Auth::user()->id)->get();
        $users = User::all();
        $posts = DB::table('posts')->orderBy('created_at','desc')->get();

        return view('follows.followerList')->with(['users'=>$users , 'followers'=>$followers , 'posts'=>$posts]);
    }

}
