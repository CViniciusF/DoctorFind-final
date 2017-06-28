<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use App\UsuarioPaciente;
use App\UsuarioEspecialista;
use App\Especialidade;

class HomeController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            $usuarioPaciente = UsuarioPaciente::find(Auth::User()->id);
            $especialidades = Especialidade::all();
            return view('home')->with('tipo', 'paciente')->with('UsuarioPaciente', $usuarioPaciente)->with('especialidades', $especialidades);
          }
          else{
            $usuarioEspecialista = UsuarioEspecialista::find(Auth::User()->id);
            $especialidades = Especialidade::all();
            $count_indicacoes = DB::table('indicacoes')->where('id_especialista', Auth::User()->id)->count();
            $views_telefone = DB::table('views_telefone')->where([['id_especialista', Auth::User()->id],['lido', 0]])->count();
            $count_depoimentos = DB::table('depoimentos')->where([['lido', 0],['id_especialista', Auth::User()->id]])->count();
            $count_perguntas = DB::table('perguntas')->where([['respondido', 0],['id_especialista', Auth::User()->id]])->count();

            return view('home')->with('count_indicacoes', $count_indicacoes)->with('count_depoimentos', $count_depoimentos)->with('tipo', 'especialista')->with('UsuarioEspecialista', $usuarioEspecialista)->with('especialidades', $especialidades)->with('views_telefone', $views_telefone)->with('count_perguntas', $count_perguntas);
          }
        }

      }
    }
    public function verNotificacoes()
    {
      if (Auth::Check()) {
        $views_telefone = DB::table('views_telefone')->where([['id_especialista', Auth::User()->id],['lido',0]])->get();
        $i = 0;
        foreach ($views_telefone as $vt) {
          $usuarios[] = User::Find($views_telefone[$i]->id_paciente);
          $i++;
        }
        $views_telefone = DB::table('views_telefone')->where('id_especialista', Auth::User()->id)->update(['lido' => 1]);
        if(null != $usuarios){
          return view('notificacoes')->with('dadosUsuarios', $usuarios);

        }
      }
    }
    public function verPerguntasPaciente(){
      if(Auth::Check()){
        $especialistas = [];
        $respostas = [];
        $perguntas_usuario = DB::table('perguntas')->where('id_paciente', Auth::User()->id)->get();
        foreach ($perguntas_usuario as $pu) {
          $especialistas[] = User::find($pu->id_especialista);
          $respostas[] = DB::table('respostas')->where('id_pergunta', $pu->id)->get();
        }
        return view('perguntas-respondidas')->with('perguntas_usuario', $perguntas_usuario)->with('especialistas', $especialistas)->with('respostas', $respostas);
      }
    }

}
