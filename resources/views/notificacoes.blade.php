@extends('layouts.principal')

    @section('titulo')
        <title>Notificações - DoctorFinder</title>
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
      <div class="wrap-bg-home">
        <div class="content" style="">
          <div class="row">
            <div class="large-8 small-12 large-offset-2 end columns">
              <div style="text-align: center; padding-top: 20px;">
                <h2>Novas visualizações de telefone</h2>
              </div>
              <?php $i = 0; ?>
              @foreach($dadosUsuarios as $us)

              <div class="card" style="padding: 20px; border-radius: 4px;">
                <p class="os" style="font-size: 20px;">Nome: {{$us->name}} {{$us->lastname}}</p>
                <p class="os">Email: <a href="mailto:{{$us->email}}">{{$us->email}}</a></p>

              </div>
                <?php $i++; ?>
              @endforeach
          </div>
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
    </div>
    @section('scripts')
    @if (session('error'))
      <script type="text/javascript">
        setTimeout(function(){$('#err').fadeOut();}, 5000);
      </script>
    @endif
    @if (session('success'))
      <script type="text/javascript">
        setTimeout(function(){$('#scs').fadeOut();}, 5000);
      </script>
    @endif

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCt1NrnBF17J4QZrPPUlb_A6k_HKhbJzDQ&callback"
 async defer></script>
    @stop
  </body>

@stop
