<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\BNET;
use App\Models\JXAccount;
use App\Providers\RouteServiceProvider;
use App\Rules\BnetUserExisted;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * @var \App\Helpers\PvPGNHash
     */
    private $pvpgnHash;

    /**
     * @var \App\Repositories\BNETRepository
     */
    private $BNETRepository;

    /**
     * Create a new controller instance.
     *
     * @param \App\Helpers\PvPGNHash $pvpgnHash
     * @param \App\Repositories\BNETRepository $BNETRepository
     */
    public function __construct(
        \App\Helpers\PvPGNHash $pvpgnHash,
        \App\Repositories\BNETRepository $BNETRepository
    )
    {
        $this->middleware('guest');
        $this->pvpgnHash = $pvpgnHash;
        $this->BNETRepository = $BNETRepository;
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
            'name' => ['required', 'alpha_num', 'min:2','max:15', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:15', 'confirmed'],
            'g-recaptcha-response'=> ['required', 'recaptcha'],
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
        $this->createBNETAccount($data);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        //$this->validate($request, ['name' => new BnetUserExisted]);
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirectPath());
    }

    public function createBNETAccount($data)
    {
        $username = $data['name'];
        $email = $data['email'];
        $passhash = md5($data['password']);

        // Start Import
        $account = new JXAccount();
        $account->loginName = $username;
        $account->password_hash = $passhash;
        $account->email = $email;
        $account->coin = 0;
        $account->save();
    }
}
