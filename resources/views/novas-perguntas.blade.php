@extends('layouts.principal')

    @section('titulo')
        <title>DoctorFinder - Novas Perguntas</title>
    @stop

    @section('conteudo')
      <header class="fundo-header">
        <div class="row">
          <div class="small-12 columns">
            <div class="cabecalho-flex">
              <div class="topo-left">
                <div class="logo">
                  <a href="server.php/"><img src="public/assets/doctorfind-logo.png" width="220px" height="174px" alt=""></a>
                </div>
              </div>
              <div class="topo-right">
                <div class="itens-right">
                  @if (Auth::check())
                  @if(Auth::user()->avatar != 'foto não encontrada')
                      <img src="public/uploads/avatars/{{ Auth::user()->avatar }}" alt="Avatar" width="60" style="border-radius: 50px;" >
                      @else
                      <img src="public/uploads/avatars/semfoto.png" alt="Avatar" width="45" style="border-radius: 10px;" >
                    @endif
                    <i style="color: #fff; font-style: normal;">&nbsp;{{ Auth::user()->name }} </i><span class="caret"></span>
                    <a  class="botoes-cabecalho" style="margin-left: 20px;" href="server.php/meu-perfil">Meu perfil</a>
                    <a  class="botoes-cabecalho" style="margin-left: 20px;" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                  @else
                  <a href="{{ url('/login') }}" class="botoes-cabecalho" >Logar</a>
                  <a href="{{ url('/register') }}" class="botoes-cabecalho" style="padding-left: 30px;">Registrar</a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <body class="bd-login" style="background-color: #bcd8b6;">
        <div class="">

            <div class="" style="">


            <div class="result">
              <div class="small-12 large-8 columns end ">
                @if(session('success'))
                  <div id="scs_depo" class="small-12 large-12 columns" style="text-align: center; padding-left: 0px;padding-right: 0px;margin-top: 10px;margin-bottom: 10px;">
                    <div class="success callout small" data-closable style="margin-bottom: 0px;padding: 20px;font-size: 20px;">
                      <p style="margin-bottom: 0px;">Sua resposta foi enviada!</p>
                      <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                </div>
                @endif
                @if(session('success-rem'))
                  <div id="scs_depo" class="small-12 large-12 columns" style="text-align: center; padding-left: 0px;padding-right: 0px;margin-top: 10px;margin-bottom: 10px;">
                    <div class="success callout small" data-closable style="margin-bottom: 0px;padding: 20px;font-size: 20px;">
                      <p style="margin-bottom: 0px;">A pergunta foi excluída.</p>
                      <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                </div>
                @endif
                <?php $i = 0; ?>
                @if(isset($perguntas) and null != $perguntas)
                @foreach($perguntas as $dp)
                  @if($dp->respondido != 1)
                    <div class="card" style="padding: 20px; margin-top: 20px;">
                      <p class="mt"style="font-size: 20px;">Pergunta enviada por: {{$usuarioPergunta[$i]->name}} {{$usuarioPergunta[$i]->lastname}}</p>
                      <h3 class="mt">Assunto: {{$dp->titulo_pergunta}}</h3>
                      <p class="os">Pergunta: {{$dp->texto_pergunta}}</p>
                        <form class="" action="server.php/home/responder" method="post">
                          {{ csrf_field()}}
                          <input type="hidden" name="id_pergunta" value="{{$dp->id}}">
                          <p class="mt">Responder: </p>
                          <textarea name="resposta" rows="5" cols="80" style="border-radius: 4px;">

                          </textarea>
                        <div class="botoes" style="display: flex; justify-content: center; align-items: center; flex-direction: column; ">
                        <button type="submit" style="margin-left: 20px; border-radius: 4px;" class="button primary"><i class="fa fa-reply"></i>&nbsp;&nbsp;Enviar Resposta</button>
                        <a href="server.php/depoimentos/excluirPergunta/{{$dp->id}}" style="margin-left: 20px; border-radius: 4px;" class="button alert"><i class="fa fa-trash"></i>&nbsp;&nbsp;Excluir Pergunta</a>
                        </form>
                      </div>
                    </div>
                  @endif
                <?php $i++; ?>
                <hr>
                @endforeach
              </div>
            </div>
                <div class="footer-flex">
                  <div class="row">
                    <div class="small-12 columns">
                      <div class="footer">
                        <div class="footer-left">
                          <img src="public/assets/small-logo.png" alt="" height="60px">
                          <p class="os" style="margin-bottom: 0px;">Todos os direitos reservados</p>
                        </div>
                        <div class="footer-right">
                          <span class="fa fa-facebook" style="font-size: 40px;color: #FFF;"></span>
                          <span class="fa fa-github" style="padding-left: 30px;font-size: 40px;color: #FFF;"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @else
                <div class="card" style="padding: 20px; margin-top: 20px;">
                  <p class="mt">Nenhuma pergunta para responder</p>
                </div>

              </div>
            </div>
          <div class="footer-flex" style="position: fixed; bottom: 0; width: 100%;">
            <div class="row">
              <div class="small-12 columns">
                <div class="footer">
                  <div class="footer-left">
                    <img src="public/assets/small-logo.png" alt="" height="60px">
                    <p class="os" style="margin-bottom: 0px;">Todos os direitos reservados</p>
                  </div>
                  <div class="footer-right">
                    <span class="fa fa-facebook" style="font-size: 40px;color: #FFF;"></span>
                    <span class="fa fa-github" style="padding-left: 30px;font-size: 40px;color: #FFF;"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>
        @section('scripts')
        @if (session('success') || session('success-rem'))
          <script type="text/javascript">
            setTimeout(function(){$('#scs_depo').fadeOut();}, 5000);
          </script>
        @endif
        @stop
      </body>

@stop
