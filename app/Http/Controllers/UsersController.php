<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Follower;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function profile(Request $request){
      $passwordCount = session()->get('wordCount');

      return view('users.profile', ['passwordCount'=>$passwordCount]);
    }

    public function profileup(Request $request){
      $request->validate(
      [ 'up_username' => 'required|string|min:4|max:12',
        'up_mail' => 'required|string|email|min:4|max:12',
        'up_bio' => 'max:200',
      ],
      [ 'up_username.required' =>'必須項目です',
        'up_username.min' =>'4文字以上で入力してください',
        'up_username.max' =>'12文字以内で入力してください',

        'up_mail.required' => '必須項目です',
        'up_mail.email' => 'メールアドレスではありません',
        'up_mail.min' => '4文字以上で入力してください',
        'up_mail.max' => '12文字以内で入力してください',

        'up_bio.max' => '200文字以内で入力してください',
      ]);

      $id = $request->input('id', Auth::user()->id);
      $up_username = $request->input('up_username');
      $up_mail = $request->input('up_mail');
      $up_bio = $request->input('up_bio');
      $up_images = $request->input('up_images');

      if(request('up_password')){
        $request->validate([
          'up_password' => 'required|string|min:4|max:12|different:password',
        ],
        [ 'up_password.min' => '4文字以上で入力してください',
          'up_password.max' => '12文字以内で入力してください',
          'up_password.different' => '現在のパスワードと同じです',
        ]);
        $up_password = bcrypt($request->input('up_password'));
        DB::table('users')
        ->where('id', Auth::user()->id)
        ->update(['password'=>$up_password ,]);
      }

      if(request('up_images')){
        $request->validate([
          'up_images' => 'image'
        ],
        [ 'up_images.image' => '画像ファイルを選択してください',
        ]);
        $filename=$request->file('up_images')->getClientOriginalName();
        $request->file('up_images')->storeAs('public/images', $filename);
        DB::table('users')
        ->where('id',Auth::user()->id)
        ->update(['images'=>$filename,]);
      }

      DB::table('users')
      ->where('id', Auth::user()->id)
      ->update([
        'username' => $up_username ,
        'mail'=>$up_mail ,
        'bio'=>$up_bio ,
      ]);
      return redirect('/logout');
    }

    public function personalprofile($id){
      $users = DB::table('users')->find($id);
      $posts = DB::table('posts')->where('user_id',$id)->orderBy('created_at','desc')->get();
      $follows = DB::table('follows')->where('follow',Auth::user()->id)->get();

      return view('users.personal-profile')->with(['users'=>$users , 'follows'=>$follows , 'posts'=>$posts]);
    }

    public function personalfollow($id){
      DB::table('follows')->insert([
        'follower' => $id,
        'follow' => Auth::user()->id,
    ]);

      return redirect('/top');
    }

    public function personalunfollow($id){
        DB::table('follows')
            ->where('follower', $id)
            ->where('follow', Auth::user()->id)
            ->delete();

        return redirect('/top');
    }

    public function index(){
      $follows = DB::table('follows')->where('follow',Auth::user()->id)->get();
      $users = User::all();
      return view('users.search')->with(['users'=>$users , 'follows'=>$follows]);
    }

    public function search(Request $request) {
        $follows = DB::table('follows')->where('follow',Auth::user()->id)->get();
        $keyword_username = $request->username;
        if(!empty($keyword_username)) {
        $query = User::query();
        $users = $query->where('username','like', '%' .$keyword_username. '%')->get();

        return view('users.search-result')->with(['users'=>$users , 'follows'=>$follows , 'keyword_username'=>$keyword_username ]);
      }
        else {
        return redirect('/search');
        }
    }

    public function follow($id){
      DB::table('follows')->insert([
        'follower' => $id,
        'follow' => Auth::user()->id,
    ]);

      return redirect('/search');
    }

    public function unfollow($id){
      DB::table('follows')
          ->where('follower', $id)
          ->where('follow', Auth::user()->id)
          ->delete();

      return redirect('/search');
    }
}