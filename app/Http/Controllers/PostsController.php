<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \App\User;

class PostsController extends Controller
{
    public function index(){
        $follow_ids=DB::table('follows')
        ->where('follow',Auth::id())
        ->pluck('follower');
        $posts = DB::table('posts')
        ->join('users','posts.user_id','=','users.id')
        ->whereIn('posts.user_id',$follow_ids)
        ->orWhere('posts.user_id',Auth::id())
        ->select('users.images','users.username','posts.id','posts.user_id','posts.post','posts.created_at as created_at')
        ->orderBy('posts.created_at','desc')->get();

        return view('posts.index')->with(['posts'=>$posts]);
    }

    public function create(Request $request){
        $request->validate(
            ['newPost' => 'max:150',],
            ['newPost.max' => '200文字以内で入力してください',]
        );
        $id = $request->input('id');
        $post = $request->input('newPost');
        DB::table('posts')->insert([
            'post' => $post,
            'user_id' => Auth::user()->id,
        ]);
        return redirect('/top');
    }

    public function update(Request $request){
        $request->validate(
            ['upPost' => 'max:150',],
            ['upPost.max' => '200文字以内で入力してください',]
        );
        $id = $request->input('id');
        $post = DB::table('posts')->where('id', $id)->get();
        $up_post = $request->input('upPost');
        DB::table('posts')
        ->where('id', $id)
        ->update(['post' => $up_post]);

        return redirect('/top');
    }

    public function delete($id){
        DB::table('posts')->where('id', $id)->delete();

        return redirect('/top');
    }
}