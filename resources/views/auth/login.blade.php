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
            <div class="small-12 large-5 columns end">
              <div class="">
                <div class="card" style="padding: 30px; margin-bottom: 0px;display: flex; flex-direction:column; justify-content: center; align-items: center;">
                  <div class="small-12 medium-10 medium-offset-1 large-10 large-offset-1 columns end" style="margin-left: 0px;">
                    <p class="mt" style="text-align: center; font-size: 35px;">Acesse sua conta</p>
                    <form class="" role="form" method="POST" action="{{ route('login') }}">
                      {{ csrf_field() }}
                      <div class="os form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="">E-mail</label>
                        <div class="">
                          <input id="email" type="email" class="form-control" style="border-radius: 4px;" name="email" value="{{ old('email') }}" placeholder="Informe seu e-mail..." required autofocus>
                            @if ($errors->has('email'))
                              <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                              </span>
                            @endif
                          </div>
                        <div>
                          <div class="os form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                              <label for="password" class="">Senha</label>
                              <div class="">
                                <input id="password" type="password" class="form-control" style="border-radius: 4px;" name="password" placeholder="Informe sua senha..." required>
                                  @if ($errors->has('password'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                  @endif
                                </div>
                            </div>
                          <div class="form-group os">
                            <div class="">
                              <div class="checkbox">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar-me
                              </div>
                            </div>
                          </div>
                          <div class="form-group os">
                            <div style="display:flex; justify-content: center; align-items: center; flex-direction: column;">
                              <button type="submit" class="button expanded" style="color: green; border-radius: 4px; background-color: #FFF; border-color: #5c715e;">Login</button>
                              <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                            </div>
                          </div>
                          <!--
                          <hr>
                      <h3 class="mt" style="text-align: center;">Login via redes sociais</h3>
                      <div class="form-group">
                        <div class="" style="display: flex; justify-content: center;">
                          <a style="padding-right: 30px;" onclick="popupfb();"><i class="fi-social-facebook" style="font-size: 55px;"></i></a>
                          <a style="color: #cc4420" onclick="popupgplus();"><i class="fi-social-google-plus" style="font-size: 55px;"></i></a>
                        </div>
                      </div>
                    -->
                    </form>
                  </div>
                </div>
              </div>
            </div>
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
