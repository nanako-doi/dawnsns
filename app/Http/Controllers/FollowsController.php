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

        $follow_ids=DB::table('follows')
        ->where('follow',Auth::id())
        ->pluck('follower');
        $posts = DB::table('posts')
        ->join('users','posts.user_id','=','users.id')
        ->whereIn('posts.user_id',$follow_ids)
        ->select('users.images','users.username','posts.id','posts.user_id','posts.post','posts.created_at as created_at')
        ->orderBy('posts.created_at','desc')->get();

        return view('follows.followList')->with(['users'=>$users , 'follows'=>$follows , 'posts'=>$posts]);
    }

    //フォロワーリスト
    public function followerList(){
        $followers = DB::table('follows')->where('follower',Auth::user()->id)->get();
        $users = User::all();

        $follower_ids=DB::table('follows')
        ->where('follower',Auth::id())
        ->pluck('follow');
        $posts = DB::table('posts')
        ->join('users','posts.user_id','=','users.id')
        ->whereIn('posts.user_id',$follower_ids)
        ->select('users.images','users.username','posts.id','posts.user_id','posts.post','posts.created_at as created_at')
        ->orderBy('posts.created_at','desc')->get();

        return view('follows.followerList')->with(['users'=>$users , 'followers'=>$followers , 'posts'=>$posts]);
    }

}
