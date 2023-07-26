<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

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

            'password_confirmation.required' => '必須項目です',
            'password_confirmation.min' => '4文字以上で入力してください',
            'password_confirmation.max' => '12文字以内で入力してください',
            'password_confirmation.unique' => 'すでに登録されています',
            'password_confirmation.same' => 'パスワードと確認用パスワードが一致していません',
        ])->validate();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            $this->validator($data);
            $this->create($data);
            return redirect('added')->with('username', $data['username']);
        }
        return view('auth.register');
    }

    public function added(Request $request){
        $username = $request->input('username');
        return view('auth.added', ['username'=>$username]);
    }
}
