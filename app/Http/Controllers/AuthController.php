<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use DB;
use App\UsuarioEspecialista;
use App\UsuarioPaciente;
use App\Especialidade;
use Validator;
use Image;
use Hash;
use Illuminate\Support\Facades\Input;
use Socialite;
use Illuminate\Http\Request;

class AuthController extends Controller{

  public function landing(){

    $especialidades = Especialidade::all();
    return view('landing')->with('especialidades', $especialidades);
  }

  public function editarPerfil(){
    if(isset(Auth::User()->id)){
      $common_id = Auth::User()->id;

      $usuarios = DB::select('select
              a.id,
              if(b.id is null, null, "Paciente") as Paciente,
              if(c.id is null, null, "Especialista") as Especialista
            from
              users AS a
              left join usuarios_pacientes AS b on a.id = b.id
              left join usuarios_especialistas AS c on a.id = c.id');
      $i = 0;

    foreach ($usuarios as $usuario) {
      if($usuario->id == $common_id){
        if($usuario->Especialista == null){
          $usuario = UsuarioPaciente::find($usuario->id);
          return view('editar-paciente')->with('UsuarioPaciente', $usuario);
        }else{
          $usuario = UsuarioEspecialista::find($usuario->id);
          $especialidades = Especialidade::all();
          $esp_usu = DB::table('pivot_usuario_especialidade')->where('id_pivot_usuario', $usuario->id)->get();
          foreach ($esp_usu as $xy) {
            $arr_esp_usu[] = $xy->id_pivot_especialidade;
          }
          if (isset($arr_esp_usu)) {
            return view('editar-especialista')->with('UsuarioEspecialista', $usuario)->with('especialidades', $especialidades)->with('esp_usu', $arr_esp_usu);

          }else{
            return view('editar-especialista')->with('UsuarioEspecialista', $usuario)->with('especialidades', $especialidades);
          }

        }
      }
    }
  }else{
    return redirect()->back()->with('error', 'Um erro');
  }
}
public function admin_credential_rules(array $data){
  $messages = [
    'current-password.required' => 'Por favor, informe sua senha atual',
    'password.required' => 'Por favor, informe sua senha',
    'password.same' => 'A confirmação de senha e a senha não são iguais',
    'password_confirmation.same' => 'A confirmação de senha e a senha não são iguais',
    'min' => 'A senha deve ter um tamanho mínimo de 6 caracteres',
  ];

  $validator = Validator::make($data, [
    'current-password' => 'required',
    'password' => 'required|min:6|same:password',
    'password_confirmation' => 'required|min:6|same:password',
  ], $messages);

  return $validator;
}
public function alterarEmail(Request $request){

  if(Auth::Check()){
    if ($request->input('email') != Auth::User()->email) {
      $email = $request->input('email');
      $array = array('email' => $email);
      $rules = array('email' => 'required|email|max:255|unique:users');
      $validator = Validator::make($array, $rules);
        if ($validator->fails()){
            return redirect()->back()->with('errou', 'Email já existe ou não é um email.');
        }
        $obj_user = User::find(Auth::User()->id);
        $obj_user->email = $email;
        $obj_user->save();
      return redirect()->back()->with('success', 'Email alterado com sucesso!');
    }
  }
    return redirect()->to('/meu-perfil');

}
public function alterarInfosEspecialista(Request $request){

  if(Auth::Check()){
      //$email = $request->input('email');
      //$array = array('email' => $email);
      //$rules = array('email' => 'required|email|max:255|unique:users');
      //$validator = Validator::make($array, $rules);
        //if ($validator->fails()){
            //return redirect()->back()->with('errou', 'Email já existe ou não é um email.');
        //}
        $obj_user = UsuarioEspecialista::find(Auth::User()->id);

        DB::table('pivot_usuario_especialidade')->where('id_pivot_usuario', '=', Auth::User()->id)->delete();
        if (null == $request->input('nova_esp_usu')) {
          return redirect()->back()->with('error', 'Selecione pelo menos uma especialidade');
        }
        foreach ($request->input('nova_esp_usu') as $espec) {
          DB::table('pivot_usuario_especialidade')->insert(['id_pivot_usuario' => Auth::User()->id, 'id_pivot_especialidade' => $espec]);
        }
        $obj_user->update($request->all());

      return redirect()->back()->with('success', 'Informações alteradas com sucesso!');
  }
    return redirect()->to('/meu-perfil');

}
public function alterarSenha(Request $request){

  if(Auth::Check())
  {
    $request_data = $request->All();
    $validator = $this->admin_credential_rules($request_data);
    if($validator->fails())
    {
      if (isset($validator->errors()->getMessages()['password'])) {
        $erro = $validator->errors()->getMessages()['password'];
        return redirect()->back()->with('error', $erro[0]);
      }
      elseif (isset($validator->errors()->getMessages()['password_confirmation'])) {
        $erro = $validator->errors()->getMessages()['password_confirmation'];
        return redirect()->back()->with('error', $erro[0]);
      }
      elseif (isset($validator->errors()->getMessages()['current-password'])) {
        $erro = $validator->errors()->getMessages()['current-password'];
        return redirect()->back()->with('error', $erro[0]);

      }

    }
    else
    {
      $current_password = Auth::User()->password;
      if(Hash::check($request_data['current-password'], $current_password))
      {
        $user_id = Auth::User()->id;
        $obj_user = User::find($user_id);
        $obj_user->password = Hash::make($request_data['password']);
        $obj_user->save();
        return redirect()->back()->with('success', 'Senha alterada com sucesso');
      }
      else
      {
        return redirect()->back()->with('error', 'Senha atual incorreta.');
      }
    }
  }
  else
  {
    return redirect()->to('/meu-perfil');
  }
}
public function alterarAvatar(Request $request){

  if(Auth::Check()){

    $img = $request->file('newavt');
    $imga = array('newavt' => $request->file('newavt'));
    $rules = array('newavt' => 'mimes:jpeg,jpg,png,gif|max:10000');
    $validator = Validator::make($imga, $rules);
      if ($validator->fails()){
          return redirect()->back()->with('error', 'Arquivo enviado não é uma imagem (jpeg,jpg,png,gif).');
      }
    //Toda validação antes.
    $current_avatar = Auth::User()->avatar;
    \File::delete(public_path() .'/uploads/avatars/' . $current_avatar);
    $ext = $img->getClientOriginalExtension();
    $data = getimagesize($img);
    $width = $data[0];
    $height = $data[1];
    $filename  =  hash('sha256', $img).'.'.$ext;

    $path = public_path('uploads/avatars/' . $filename);

    $user_id = Auth::User()->id;
    $obj_user = User::find($user_id);
    $obj_user->avatar = $filename;
    $obj_user->save();
    $quality = 90;
    if (Input::get('w') !== null) {
      $int_img = Image::make($img->getRealPath());
      $int_img->resize(250, null, function($constraint){
        $constraint->aspectRatio();
      });
      $int_img->crop(Input::get('w'), Input::get('h'), Input::get('x'), Input::get('y'));
      $int_img->fit(250);
      $int_img->save($path);
    }else{
      $int_img = Image::make($img->getRealPath());
      $int_img->resize(250, null, function($constraint){
        $constraint->aspectRatio();
      });
      $int_img->save($path);
    }
    //$img->crop(Input::get('w'), Input::get('h'), Input::get('x'), Input::get('y'));
    return redirect()->back()->with('success', 'Avatar alterado com sucesso');
  }
  else{
    return redirect()->to('/meu-perfil');
  }
}

  public function redEspecialista(){
      return view('auth/register-especialista');
  }

  public function redPaciente(){
      return view('auth/register-paciente');
  }

    public function redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider){
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return view('closepopup')->with("url", "/DoctorFind/server.php/home");
    }

    public function findOrCreateUser($user, $provider){

        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'name'     => $user->name,
            'lastname'     => $user->lastname,
            'email'    => $user->email,
            //'avatar'   => $user->avatar,
            //'gender' => $user->user['gender'],
            //'provider' => $provider,
            //'provider_id' => $user->id
        ]);
    }

}
