<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \App\User;

class PostsController extends Controller
{
    //
    public function index(){
        $posts = DB::table('posts')->orderBy('created_at','desc')->get();
        $follows = DB::table('follows')->where('follow',Auth::user()->id)->get();
        return view('posts.index')->with(['posts'=>$posts , 'follows'=>$follows ]);
    }

    public function create(Request $request){
        $id = $request->input('id');
        $post = $request->input('newPost');
        DB::table('posts')->insert([
            'post' => $post,
            'user_id' => Auth::user()->id,
        ]);
        return redirect('/top');
    }
    // public function updateform($id){
    //     $post = DB::table('posts')->where('id', $id)->get();
    // }

    public function update(Request $request){
        $id = $request->input('id');
        $post = DB::table('posts')->where('id', $id)->get();
        $up_post = $request->input('upPost');
        DB::table('posts')->where('id', $id)->update(['post' => $up_post]);

        return redirect('/top');
    }

    public function delete($id){
        DB::table('posts')->where('id', $id)->delete();

        return redirect('/top');
    }
}
