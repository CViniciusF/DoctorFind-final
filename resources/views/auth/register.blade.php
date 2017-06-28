@extends('layouts.principal')

    @section('titulo')
        <title>DoctorFind - Login</title>
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
                    <a href="{{ url('/home')}}" class="botoes-cabecalho" >Home</a>
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
      <body class="bd-login">
        <div class="wrap-bg">
          <div class="row wrap" style="height: 79vh; display: flex; align-items: center; justify-content: center; flex-wrap: wrap;">
            <div class="oque">
              <p class="mt" style="font-size: 60px; color: #5c715e;">O que você é?</p>
              <div class="opc">
                <a href="server.php/cadastro/especialista" class="button expanded hover" style="border-radius: 4px; color: #FFF; background-color: #5c715e;">Sou especialista</a>
                <a href="server.php/cadastro/paciente" class="button expanded hover" style="margin-left: 50px; border-radius: 4px; color: #FFF; background-color: #5c715e;">Sou paciente</a>
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
          <script type="text/javascript">
              function popupfb(){
                var w = 880, h = 600,
                left = Number((screen.width/2)-(w/2)), tops = Number((screen.height/2)-(h/2)),
                signinFac = window.open("server.php/auth/facebook", "Facebook - Login", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=1, copyhistory=no, width='+w+', height='+h+', top='+tops+', left='+left);

              }
              function popupgplus(){
                var x = screen.width/2 - 700/2;
                var y = screen.height/2 - 450/2;
                signinFac = window.open("server.php/auth/google", "Google+ - Login", "width=780,height=410,left="+x+",top="+y);

              }
          </script>
        @stop
      </body>

@stop
