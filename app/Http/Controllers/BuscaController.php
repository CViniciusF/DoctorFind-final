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
use App\Depoimento;
use App\Pergunta;
use App\Resposta;
use Illuminate\Http\Request;

class BuscaController extends Controller
{
   public function buscarEspecialista(Request $request){

    $especialidade = null;
    $rbasico = array();
    $respecialista = array();
    //pra verificar se ele preencheu algo antes de buscar
    if ($request->input('busca_especialidade') == null && $request->input('busca_cidade') == null && $request->input('busca_nome') == null) {
      return redirect()->back()->with('error', 'Preencha pelo menos um campo para realizar a busca');
    }else{
      //Pesquisou só por especialidade
      if ($request->input('busca_especialidade') != null && $request->input('busca_cidade') == null) {
        return redirect()->back()->with('error', 'Preencha o campo Cidade para realizar uma busca');
      }
      //BUSCA SO PELO NOME
      elseif ($request->input('busca_nome') != null) {
        $busca_basico = User::where('name', 'LIKE', '%'.$request->input('busca_nome').'%')->orderBy('indicacoes_orderby', 'desc')->get();
        $j = 0;
        if ($busca_basico != null) {

          foreach ($busca_basico as $bu) {
            $buscaEsp = UsuarioEspecialista::Find($busca_basico[$j]->id);
              if ($buscaEsp != null) {
                array_push($rbasico, $busca_basico[$j]);

                array_push($respecialista, $buscaEsp);
              }
            else{


              return view('resultados')->with('busca_nome', $request->input('busca_nome'));
            }
            $j++;
          }
          return view('resultados')->with('rbasico', $rbasico)->with('respecialista', $respecialista)->with('busca_nome', $request->input('busca_nome'));

        }else{
          //não achou nem common

          return view('resultados')->with('busca_nome', $request->input('busca_nome'));
        }


      }
      elseif ($request->input('busca_especialidade') != null && $request->input('busca_cidade') != null){
        //Pega os dados referente a especialidade
        $especialidade = Especialidade::Find($request->input('busca_especialidade'));
        //vai na tabela n-n e pega todos os ids de usuario relacionados aquela especialidade
        $n = DB::table('pivot_usuario_especialidade')->where('id_pivot_especialidade', '=', $request->input('busca_especialidade'))->get();
        //adiciona somente os ids no array.
        function removeAccents($string) {
          //função com regex para remover acentos para facilitar a busca
            return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'))), ' '));
        }
        foreach ($n as $xy) {
          //pra cada especialista encontrado com aquela especialidade tem que buscar os dados dele pra verificar se a cidade é a mesma da busca.
          $buscaEsp = UsuarioEspecialista::Find($xy->id_pivot_usuario);
          if(removeAccents($buscaEsp->endereco_cidade) == removeAccents($request->input('busca_cidade'))){
            $ids_usu[] = $xy->id_pivot_usuario;
          }
        }
        if (isset($ids_usu)) {
          foreach ($ids_usu as $iu) {
            $busca_basico = User::Find($iu);
            $buscaEsp = UsuarioEspecialista::Find($iu);
            array_push($rbasico, $busca_basico);
            array_push($respecialista, $buscaEsp);
          }
        }else{
          return view('resultados')->with('especialidade', $especialidade)->with('busca_cidade', $request->input('busca_cidade'));
        }
      }elseif ($request->input('busca_especialidade') == null) {
        return redirect()->back()->with('error', 'Escolha alguma especialidade para realizar a busca');
      }
       return view('resultados')->with('rbasico', $rbasico)->with('respecialista', $respecialista)->with('especialidade', $especialidade);

   }

  }
  public function verPerfil($id){

    $busca_basico = User::Find($id);
    if (null != $busca_basico) {
      $buscaEsp = UsuarioEspecialista::Find($busca_basico->id);
      $buscaEsp->views_perfil++;
      $buscaEsp->save();
      $esp_usu = DB::table('pivot_usuario_especialidade')->where('id_pivot_usuario', $busca_basico->id)->get();
      $indicacoes = DB::table('indicacoes')->where('id_especialista', $busca_basico->id)->get();
      $depoimentos = DB::table('depoimentos')->where('id_especialista', $busca_basico->id)->get();
      $i = 0;
      foreach ($depoimentos as $dp) {
        $user_depo[$i] = User::Find($dp->id_paciente);
        $i++;
      }

      $count_indicacoes = 0;
      foreach($indicacoes as $ind){
        $count_indicacoes++;
      }
      foreach ($esp_usu as $xy) {
        $arr_esp_usu[] = $xy->id_pivot_especialidade;
        $especialidades[] = Especialidade::Find($xy->id_pivot_especialidade);
      }
      if ((isset($depoimentos) && null != $depoimentos) && (isset($user_depo) && null != $user_depo)) {
        return view('ver-perfil')->with('user', $busca_basico)->with('userEspecialista', $buscaEsp)->with('userEspecialidades', $especialidades)->with('indicacoes', $indicacoes)->with('count_indicacoes', $count_indicacoes)->with('depoimentos', $depoimentos)->with('user_depo', $user_depo);

      }else {
        return view('ver-perfil')->with('user', $busca_basico)->with('userEspecialista', $buscaEsp)->with('userEspecialidades', $especialidades)->with('indicacoes', $indicacoes)->with('count_indicacoes', $count_indicacoes);
      }
    }else{
      return redirect('/')->with('error', 'Especialista não encontrado');
    }
  }
  public function indicarEspecialista($id){

      if (Auth::guest()) {
      return redirect()->guest('login');
    }else{
      $id_usuario = Auth::user()->id;
      $id_indicado = $id;
      $indicacao = DB::table('indicacoes')->insert(['id_especialista' => $id_indicado,'id_paciente' => $id_usuario]);
      $increase_orderby = User::Find($id_indicado);
      $increase_orderby->indicacoes_orderby++;
      $increase_orderby->save();
      return redirect()->action(
      'BuscaController@verPerfil', ['id' => $id_indicado]
      );
    }

  }
  public function escreverDepoimento($id){

      if (Auth::guest()) {
      return redirect()->guest('login');
    }else{
      $id_usuario = Auth::user()->id;
      $id_indicado = $id;
      return redirect()->action(
      'BuscaController@verPerfil', ['id' => $id_indicado]
      )->with('abrir_modal', '1');
    }
  }
  public function enviarDepoimento(Request $request){
    if (Auth::check()) {
      $id_usuario = Auth::user()->id;
      $id_especialista = $request->input('id_especialista');
      if ($request->input('texto') != null) {
         $depoimento = new Depoimento;
         $depoimento->id_especialista = $id_especialista;
         $depoimento->id_paciente = Auth::User()->id;
         $depoimento->texto_depoimento = $request->input('texto');
         $depoimento->autorizado = 0;
         $depoimento->save();
         return redirect()->back()->with('depoimento_escrito', '1');

      }else{
        return redirect()->back()->with('error', 'Texto do depoimento em branco.');
      }
    }else{

    }
  }
  public function escreverPergunta($id){

      if (Auth::guest()) {
      return redirect()->guest('login');
    }else{
      $id_usuario = Auth::user()->id;
      $id_indicado = $id;
      return redirect()->action(
      'BuscaController@verPerfil', ['id' => $id_indicado]
      )->with('modal_pergunta', '1');
    }
  }
  public function enviarPergunta(Request $request){
    if (Auth::check()) {
      $id_usuario = Auth::user()->id;
      $id_especialista = $request->input('id_especialista');
      if ($request->input('titulo_pergunta') != null && $request->input('texto_pergunta') != null) {
         $pergunta = new Pergunta;
         $pergunta->id_especialista = $id_especialista;
         $pergunta->id_paciente = Auth::User()->id;
         $pergunta->titulo_pergunta = $request->input('titulo_pergunta');
         $pergunta->texto_pergunta = $request->input('texto_pergunta');
         $pergunta->save();
         return redirect()->back()->with('pergunta_escrita', '1');

      }else{
        return redirect()->back()->with('error', 'Texto ou titulo da pergunta em branco.');
      }
    }else{

    }
  }
  public function verTelefone($id){
      if (Auth::guest()) {
      return redirect()->guest('login');
    }else{
      $id_usuario = Auth::user()->id;
      $id_indicado = $id;
      $view_telefone = DB::table('views_telefone')->insert(['id_especialista' => $id_indicado,'id_paciente' => $id_usuario]);
      return redirect()->action(
      'BuscaController@verPerfil', ['id' => $id_indicado]
      )->with('success', true);
    }

  }
  public function novosDepoimentos(){
    if (Auth::check()) {
      $id_usuario = Auth::user()->id;
      $depoimentos = DB::table('depoimentos')->where([['id_especialista', Auth::User()->id],['lido',0]])->get();
      foreach ($depoimentos as $dp) {
        $usuarioDepoimento[] = User::Find($dp->id_paciente);
      }
      //Atualiza a tabela update
      //$depoimentos2 = DB::table('depoimentos')->where([['id_especialista', Auth::User()->id],['lido',0]])->update(['lido' => 1]);
      if (!isset($usuarioDepoimento)) {
        return view('novos-depoimentos');
      }else{
        return view('novos-depoimentos')->with('depoimentos', $depoimentos)->with('usuarioDepoimento', $usuarioDepoimento);
      }
    }else{
        return redirect()->back()->with('error', 'Não autorizado.');
    }
  }
  public function novasPerguntas(){
    if (Auth::check()) {
      $id_usuario = Auth::user()->id;
      $perguntas = DB::table('perguntas')->where([['id_especialista', Auth::User()->id],['respondido',0]])->get();
      foreach ($perguntas as $dp) {
        $usuarioPergunta[] = User::Find($dp->id_paciente);
      }
      //Atualiza a tabela update
      //$depoimentos2 = DB::table('depoimentos')->where([['id_especialista', Auth::User()->id],['lido',0]])->update(['lido' => 1]);
      if (!isset($usuarioPergunta)) {
        return view('novas-perguntas');
      }else{
        return view('novas-perguntas')->with('perguntas', $perguntas)->with('usuarioPergunta', $usuarioPergunta);
      }
    }else{
        return redirect()->back()->with('error', 'Não autorizado.');
    }
  }
  public function autorizarDepoimento($id){
    if (Auth::check()) {
      $depoimentos2 = DB::table('depoimentos')->where(['id' => $id])->update(['autorizado' => 1, 'lido' => 1]);
      return redirect()->back()->with('success-alt', 'Depoimento autorizado!.');
    }else{
        return redirect()->back()->with('error', 'Não autorizado.');
    }
  }
  public function excluirDepoimento($id){
    if (Auth::check()) {
      $depoimentos2 = DB::table('depoimentos')->where(['id' => $id])->delete();
      return redirect()->back()->with('success-rem', 'Depoimento removido!.');
    }else{
        return redirect()->back()->with('error', 'Não autorizado.');
    }
  }
  public function excluirPergunta($id){
    if (Auth::check()) {
      $perguntas2 = DB::table('perguntas')->where(['id' => $id])->delete();
      return redirect()->back()->with('success-rem', 'Pergunta removida!.');
    }else{
        return redirect()->back()->with('error', 'Não autorizado.');
    }
  }
  public function responderPergunta(Request $request)
  {
    if (Auth::Check()) {
      $texto_resposta = $request->input('resposta');
      $id_pergunta = $request->input('id_pergunta');
      $resposta = new Resposta;
      $resposta->id_pergunta = $id_pergunta;
      $resposta->texto_resposta = $texto_resposta;
      $resposta->save();
      $atualizar_pergunta = DB::table('perguntas')->where(['id' => $id_pergunta])->update(['respondido' => 1]);
      return redirect()->action(
          'BuscaController@novasPerguntas', ['id_usuario' => Auth::user()->id]
      )->with('success', 'Sua resposta foi enviada.');
    }else{
        return redirect()->back()->with('error', 'Não autorizado.');
    }
  }

}
