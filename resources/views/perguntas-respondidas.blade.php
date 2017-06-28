@extends('layouts.principal')

    @section('titulo')
        <title>DoctorFinder - Perguntas Respondidas</title>
    @stop

    @section('conteudo')
      <header class="fundo-header">
        <div class="row">
          <div class="small-12 columns">
            <div class="cabecalho-flex">
              <div class="topo-left">
                <div class="logo">
                  <a href="server.php/home"><img src="public/assets/doctorfind-logo.png" width="220px" height="174px" alt=""></a>
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
                    <i class="botoes-cabecalho" style="color: #fff; font-style: normal;">&nbsp;{{ Auth::user()->name }} </i><span class="caret"></span>
                    <a  class="botoes-cabecalho" style="margin-left: 20px;" href="server.php/meu-perfil">Meu perfil</a>

                    <a class="botoes-cabecalho" style="margin-left: 20px;" href="server.php/home/perguntas">Minhas Perguntas</a>

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
                <?php $i = 0; ?>
                @if(isset($perguntas_usuario) and null != $perguntas_usuario)
                @foreach($perguntas_usuario as $dp)

                    <div class="card" style="padding: 20px; margin-top: 20px;">
                      @foreach($especialistas as $ep)
                        @if($ep->id == $dp->id_especialista)
                          <h3 class="mt" style='font-size: 24px;'>Sua pergunta para {{$ep->name}} {{$ep->lastname}}:</h3>
                        @endif
                      @endforeach
                      <div class="" style="text-align: center;">
                        <h3 class="mt" style='font-size: 20px;'>Assunto: {{$dp->titulo_pergunta}}</h3>
                        <p class="os">Pergunta: {{$dp->texto_pergunta}}</p>
                      </div>
                      <hr>
                      @if(isset($respostas) and $respostas !== null)

                      <?php $temresposta = false ?>
                      @foreach($respostas[$i] as $rp)
                        @if($rp->id_pergunta == $dp->id)
                        <?php $temresposta = true ?>
                          <h3 class="mt" style='font-size: 24px;'>Resposta: {{$rp->texto_resposta}}</h3>
                        @endif
                      @endforeach
                      <?php if ($temresposta != true): ?>
                          <h3 class="mt" style='font-size: 24px;'>Aguardando resposta.</h3>
                      <?php endif; ?>

                      @endif

                    </div>
                <?php $i++; ?>
                <hr>
                @endforeach
                <?php if ($i == 0): ?>
                  <div class="card" style="padding: 20px; margin-top: 20px;">
                    <p class="mt">Você ainda não fez nenhuma pergunta</p>
                  </div>
                <?php endif; ?>
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
                  <p class="mt">Você ainda não fez nenhuma pergunta</p>
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
