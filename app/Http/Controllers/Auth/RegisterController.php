<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pais;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new user as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect user after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        //Se sobreescribe el metodo de visualización de registro, permitiendo obtener los paises que se mostraran en formulario
        $data['paises'] = Pais::get(["name", "id"]);
        return view('auth.register', $data);
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
            'name' => ['required', 'string', 'max:100'],
            'celular' => ['max:10'],
            'cedula' => ['required', 'string', 'max:11'],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:'.\Carbon\Carbon::now()->subYears(18)->format('d/m/Y')],
            'ciudad' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // Requerimiento Contraseña (mínimo 8 caracteres, obliga: un número, una letra mayúscula, un carácter especial, con campo de
            //confirmación de contraseña)
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'cedula' => $data['cedula'],
            'celular' => $data['celular'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'ciudad' => $data['ciudad'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
