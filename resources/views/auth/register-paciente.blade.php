@extends('layouts.principal')
    @section('titulo')
        <title>Cadastro de Paciente</title>
    @stop
    @section('conteudo')
    <header class="fundo-header">
      <div class="row">
        <div class="small-12 columns">
          <div class="cabecalho-flex">
            <div class="topo-left">
              <div class="logo">
                <a href="/"><img src="public/assets/doctorfind-logo.png" width="220px" height="174px" alt=""></a>
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

      <div class="wrap-bg">
          <div class="row">
              <div class="card small-12 medium-8 medium-offset-2 large-6 large-offset-3 columns end" style="margin-top: 50px;margin-bottom: 50px;">
                  <div class="" style="padding: 30px;">
                    <div class="" style="text-align: center;">
                      <h2 class="mt" style="margin-bottom: 20px; color:#666;">Faça seu cadastro</h2>
                    </div>
                      <div class="" style="font-family: 'Open Sans', sans-serif; ">

                          <form class="" role="form" method="POST" action="{{ route('register') }}">
                              {{ csrf_field() }}

                              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                  <label for="name">Nome</label>
                                  <div>
                                      <input style="border-radius: 4px;" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                      @if ($errors->has('name'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                  <label for="lastname">Sobrenome</label>
                                  <div>
                                      <input style="border-radius: 4px;" id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required>

                                      @if ($errors->has('lastname'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('lastname') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group{{ $errors->has('tel_fixo') ? ' has-error' : '' }}">
                                  <label for="tel_fixo">Telefone Fixo</label>
                                  <div>
                                      <input style="border-radius: 4px;" id="tel_fixo" type="text" class="form-control" name="tel_fixo" value="{{ old('tel_fixo') }}" required>

                                      @if ($errors->has('tel_fixo'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('tel_fixo') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group{{ $errors->has('tel_celular') ? ' has-error' : '' }}">
                                  <label for="tel_celular">Telefone Celular</label>
                                  <div>
                                      <input style="border-radius: 4px;" id="tel_celular" type="text" class="form-control" name="tel_celular" value="{{ old('tel_celular') }}" required>

                                      @if ($errors->has('tel_celular'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('tel_celular') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group{{ $errors->has('data_nascimento') ? ' has-error' : '' }}">
                                  <label for="data_nascimento">Data de Nascimento</label>
                                  <div>
                                      <input style="border-radius: 4px;" id="data_nascimento" type="text" class="form-control" name="data_nascimento" value="{{ old('data_nascimento') }}" required>

                                      @if ($errors->has('data_nascimento'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('data_nascimento') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                  <label for="email">Endereço de E-mail</label>

                                  <div>
                                      <input style="border-radius: 4px;" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                      @if ($errors->has('email'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                  <label for="password">Senha</label>

                                  <div>
                                      <input style="border-radius: 4px;" id="password" type="password" class="form-control" name="password" required>

                                      @if ($errors->has('password'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="">
                                  <label for="password-confirm">Confirme sua senha</label>

                                  <div>
                                      <input style="border-radius: 4px;" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                  </div>
                              </div>

                                <div style="text-align: center;">
                                    <button type="submit" class="button expanded botao-formatado" style="border-color:#5c715e; color: #5c715e; background-color: #FFF;border-radius: 4px" >
                                        Cadastrar
                                    </button>
                                </div>

                              <div class="form-group">
                                  <h3 class="mt" style="text-align: center;">Cadastro via redes sociais</h3>
                                  <div class="" style="display: flex; justify-content: center;">
                                      <a style="padding-right: 30px;" onclick="popupfb()"><i class="fi-social-facebook" style="font-size: 55px;"></i></a>
                                      <a style="color: #cc4420" onclick="popupgplus()"><i class="fi-social-google-plus" style="font-size: 55px;"></i></a>
                                   </div>
                              </div>

                          </form>
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
    @section('scripts')
      <script type="text/javascript">
      $('#tel_celular').mask('(00) 00000-0000');
      $('#tel_fixo').mask('(00) 00000-0000');
      $('#data_nascimento').mask('00/00/0000');
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

@stop
