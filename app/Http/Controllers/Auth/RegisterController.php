<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\department;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Notifications\activateaccout;
use Illuminate\Foundation\Auth\RegistersUsers;
//use App\Http\Controllers\Auth\Request;
use Illuminate\Http\Request;
//use App\Http\Controllers\Auth\Redirect;
use DB;
use Mail;
use Redirect;
use Notification;

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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $request)
    {
        return Validator::make($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'department' => 'required',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
      $this->department($data);

      return User::create([
          'name' => $data['name'],
          'email' => $data['email'],
          // 'department' =>$data['department'],
          'role' => $data['role'],
          'password' => bcrypt($data['password']),
      ]);
    }

    public function register(Request $request){
      $input = $request->all();
      $validator = $this->validator($input);

      if($validator->passes()){
        $user = $this->create($input)->toArray();
        $user['link'] = str_random(30);

        DB::table('users_activation')->insert(['id_user' => $user['id'], 'token' => $user['link']]);
        Notification::route('mail', $user['email'])->notify(new activateaccout($user['link']));
        return redirect()->to('login')->with('success', "We sent you an activation code, please check your email!");
      }
        if($validator->fails()) {
          return Redirect::back()->withErrors($validator);
      }
    }

    public function userActivation($token){
      $check = DB::table('users_activation')->where('token', $token)->first();
      if (!is_null($check)){
        $user = User::find($check->id_user);
        if($user->is_activated == 1){
           return redirect()->to('login')->with('success', "Your account is already activated!");
      }

      $user->update(['is_activated' => 1]);
      //DB::table('users_activation')->where('token', $token)->delete();
      return redirect()->to('login')->with('success', "Your account is successfully activated!");
    }
    return redirect()->to('login')->with('warning', "Your token is invalid");
  }

    protected function department(array $data){
      foreach($data['department'] as $dep){
        $user = new department;
        $user->employeeId = $data['email'];
        $user->department = $dep;
        $user->save();
        // department::create([
        //   'employeeId' => $data['email'],
        //   'department' => $dep,
        // ]);
      }
      // return redirect()->home();
    }
  }
