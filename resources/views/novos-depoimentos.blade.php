@extends('layouts.principal')

    @section('titulo')
        <title>DoctorFinder - Novos Depoimentos</title>
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
                @if(session('success-alt'))
                  <div id="scs_depo" class="small-12 large-12 columns" style="text-align: center; padding-left: 0px;padding-right: 0px;margin-top: 10px;margin-bottom: 10px;">
                    <div class="success callout small" data-closable style="margin-bottom: 0px;padding: 20px;font-size: 20px;">
                      <p style="margin-bottom: 0px;">O depoimento será exibido em seu perfil.</p>
                      <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                </div>
                @endif
                @if(session('success-rem'))
                  <div id="scs_depo" class="small-12 large-12 columns" style="text-align: center; padding-left: 0px;padding-right: 0px;margin-top: 10px;margin-bottom: 10px;">
                    <div class="success callout small" data-closable style="margin-bottom: 0px;padding: 20px;font-size: 20px;">
                      <p style="margin-bottom: 0px;">O depoimento não será exibido em seu perfil.</p>
                      <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                </div>
                @endif
                <?php $i = 0; ?>
                @if(isset($depoimentos) and null != $depoimentos)
                @foreach($depoimentos as $dp)

                <div class="card" style="padding: 20px; margin-top: 20px;">
                  <p class="mt"style="font-size: 25px;">Escrito por: {{$usuarioDepoimento[$i]->name}} {{$usuarioDepoimento[$i]->lastname}}</p>
                  <p class="os">{{$dp->texto_depoimento}}</p>
                  <div class="botoes" style="display: flex; justify-content: center; align-items: center; ">
                    <a href="server.php/depoimentos/autorizarDepoimento/{{$dp->id}}" class="button success" style="border-radius: 4px;">Exibir no Perfil</a>
                    <a href="server.php/depoimentos/excluirDepoimento/{{$dp->id}}" style="margin-left: 20px; border-radius: 4px;" class="button alert">Excluir</a>
                  </div>
                </div>
                <?php $i++; ?>
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
                  <p class="mt">Nenhum depoimento para validar</p>
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
        @if (session('success-alt') || session('success-rem'))
          <script type="text/javascript">
            setTimeout(function(){$('#scs_depo').fadeOut();}, 5000);
          </script>
        @endif
        @stop
      </body>

@stop
