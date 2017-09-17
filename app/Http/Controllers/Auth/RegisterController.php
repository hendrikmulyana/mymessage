<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'namadepan' => 'required|string|max:10',
            'namabelakang' => 'required|string|max:20',
            'gender' => 'required',
            'email' => 'required|string|email|max:30',
            'notelp' => 'required|string|max:12',
            'username' => 'required|string|max:10',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $admin = Admin::create([
            'namadepan' => $data['namadepan'],
            'namabelakang' => $data['namabelakang'],
            'gender' => $data['gender'],
            'slug' => str_slug($data['username'],'-'),
            'email' => $data['email'],
            'notelp' => $data['notelp'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);

        Profile::create(['admin_id'=> $admin->id]);
        return $admin;
    }
}
