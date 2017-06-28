<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UsuarioPaciente;
use App\UsuarioEspecialista;
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
        return Validator::make($data, [
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $userDefault =  User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if (isset($data['tel_fixo'])) {
          $usuarioPaciente = UsuarioPaciente::create([
            'id' => $userDefault->id,
            'tel_fixo' => $data['tel_fixo'],
            'tel_celular' => $data['tel_celular'],
            'data_nascimento' => $data['data_nascimento'],
          ]);
        }else{
          $usuarioEspecialista = UsuarioEspecialista::create([
            'id' => $userDefault->id,
            'tel_consultorio' => $data['tel_consultorio'],
            'registro' => $data['registro'],
          ]);
        }
        return $userDefault;
    }
}
