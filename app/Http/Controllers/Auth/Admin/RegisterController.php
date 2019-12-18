<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Model\Admin\Admin;
use App\Mail\verifyAdminEmail;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Mail;
use Session;
use Auth;

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

    use RegistersUsers ;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    //guard for Admin 
    protected function guard()
    {
        return Auth::guard('admin');
    }

    // user registration form
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     */
    protected function create(array $data)
    {
        $admin = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'verifyToken' => Str::random(40)
        ]);

        $thisAdmin = Admin::findorFail($admin->id);
        $this->sendEmail($thisAdmin);
        
        Session::flash('status','Registered! but verify your email to active your account');

        return $admin;

    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        // dd("Hello");
        $this->guard()->login($user);
        return redirect(route('admin.verification.notice'));//if any other view

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function sendEmail($thisAdmin){
        
        $verificationUrl = URL::temporarySignedRoute(
                'admin.verification.verify',
                Carbon::now()->addMinutes(60),
                ['id' => $thisAdmin->id]
            );
        Mail::to($thisAdmin['email'])->send(new verifyAdminEmail($verificationUrl));
    }

}
