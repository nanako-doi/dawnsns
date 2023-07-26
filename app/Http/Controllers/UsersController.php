<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Follower;

class UsersController extends Controller
{
      /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,
        [
            'username' => 'required|string|min:4|max:12',
            'mail' => 'required|string|email|min:4|max:12|unique:users',
            'password' => 'required|string|min:4|max:12|confirmed',
            'password_confirmation' => 'required|string|min:4|max:12',
        ],
        [
            'username.required' =>'必須項目です',
            'username.min' =>'4文字以上で入力してください',
            'username.max' =>'12文字以内で入力してください',

            'mail.required' => '必須項目です',
            'mail.email' => 'メールアドレスではありません',
            'mail.min' => '4文字以上で入力してください',
            'mail.max' => '12文字以内で入力してください',
            'mail.unique' => 'すでに登録されています',

            'password.required' => '必須項目です',
            'password.min' => '4文字以上で入力してください',
            'password.max' => '12文字以内で入力してください',
            'password.unique' => 'すでに登録されています',
        ]
        )->validate();
    }

    //ログインユーザーのプロフィール
    public function profile(Request $request){
      $password = $request->input('password');
      // dd($password);
      return view('users.profile', ['password'=>$password]);
    }
    //ログインユーザーのプロフィールを更新する
    public function profileup(Request $request){
      $id = $request->input('id', Auth::user()->id);
      $up_username = $request->input('up_username');
      $up_mail = $request->input('up_mail');
      $up_password = bcrypt($request->input('up_password'));
      $up_bio = $request->input('up_bio');
      $up_images = $request->input('up_images');
// dd($up_username);
      if(!empty($up_password)){
        DB::table('users')
        ->where('id', Auth::user()->id)
        ->update([
          'password'=>$up_password ,
        ]);
      }
      DB::table('users')
      ->where('id', Auth::user()->id)
      ->update([
        'username' => $up_username ,
        'mail'=>$up_mail ,
        'bio'=>$up_bio ,
        'images'=>$up_images
      ]);
      return redirect('/profile');
    }

    // 指定したユーザーのプロフィール
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
    // ※リダイレクト先を指定ユーザーのプロフィールにしたい
      return redirect('/top');
    }

    public function personalunfollow($id){
        DB::table('follows')
            ->where('follower', $id)
            ->where('follow', Auth::user()->id)
            ->delete();
    // ※リダイレクト先を指定ユーザーのプロフィールにしたい
        return redirect('/top');
    }


    //ユーザー検索
    public function index(){
      // フォローリストから値を取得
      $follows = DB::table('follows')->where('follow',Auth::user()->id)->get();
      // dd($follows);
      $users = User::all();
      return view('users.search')->with(['users'=>$users , 'follows'=>$follows]);
    }

    public function search(Request $request) {
        $follows = DB::table('follows')->where('follow',Auth::user()->id)->get();
        // 検索結果の表示
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

    // フォローをする　followにログインユーザーのID　followerにフォローされたユーザーのID
    public function follow($id){
      DB::table('follows')->insert([
        'follower' => $id,//フォローされたユーザー
        'follow' => Auth::user()->id,//フォローしたユーザー
    ]);

      return redirect('/search');
    }
    // フォローを解除する
    public function unfollow($id)
    {
        DB::table('follows')
            ->where('follower', $id)
            ->where('follow', Auth::user()->id)
            ->delete();

        return redirect('/search');
    }

}
