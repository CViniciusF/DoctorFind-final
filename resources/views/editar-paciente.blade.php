@extends('layouts.principal')

    @section('titulo')
      <link rel="stylesheet" href="public/css/jquery.Jcrop.css" />
        <title>Editar Usuário - DoctorFinder</title>
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
                      &nbsp;{{ Auth::user()->name }}<span class="caret"></span>
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
        <div class="container">
          <div class="row">
            <div class="small-12 medium-10 medium-offset-2 large-8 large-offset-2 columns end">
              <p style="font-size: 25px;margin-bottom: 0px;">Foto de Perfil</p>
              <hr style="margin-top: 0px;">
              <div>
                @if(Auth::user()->avatar == 'foto não encontrada')
                  <p id="sf">Sem foto</p>
                @else
                <!-- redefinir o tamanho da imagem no back -->
                  <img id="imgAnt" src="public/uploads/avatars/{{Auth::user()->avatar}}" alt="Avatar" width="250">
                @endif
                <img style="display: none;" id="out" width="250"/>
                <form action="server.php/meu-perfil/alterarAvatar" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <br/>
                  <input type="file" name="newavt" onchange="loadFile(event)">
                  <br/>
                  <input type="hidden" id="x" name="x" />
                  <input type="hidden" id="y" name="y" />
                  <input type="hidden" id="w" name="w" />
                  <input type="hidden" id="h" name="h" />
                 <button style="display: none;" id="bt" type="submit" style="border-radius: 4px;" name="button" class="button">Salvar</button>
                </form>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="small-12 medium-10 medium-offset-2 large-8 large-offset-2 columns end">
              <p style="font-size: 25px;margin-bottom: 0px;">E-mail</p>
              <hr style="margin-top: 0px;">
            </div>
            <form id="form-change-data" role="form" method="POST" action="{{ url('meu-perfil/alterarEmail') }}" class="form-horizontal">
          </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(Auth::user()->provider == 'registrado pelo site')
              <div class="row">
                <div class="small-12 medium-8 medium-offset-2 large-6 large-offset-3 columns end">
                  <label for="email" class="col-sm-4 control-label">E-mail</label>
                    <div class="form-group">
                      <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{Auth::User()->email}}" required>
                    </div>
                </div>
              </div>
             @endif
            <div class="row">
              <div class="form-group">
                <div class="small-12 medium-8 medium-offset-2 large-6 large-offset-3 columns end">
                  <button style="border-radius: 4px;" type="submit" class="button expanded">Alterar</button>
                </div>
              </div>
            </div>
            </form>
            @if(Auth::user()->provider == 'registrado pelo site')
           <div class="row">
             <div class="small-12 medium-10 medium-offset-2 large-8 large-offset-2 columns end">
               <p style="font-size: 25px;margin-bottom: 0px;">Senha de Acesso</p>
               <hr style="margin-top: 0px;">
             </div>
             <form id="form-change-password" role="form" method="POST" action="{{ url('meu-perfil/alterarSenha') }}" class="form-horizontal">
               <div class="small-12 medium-8 medium-offset-2 large-6 large-offset-3 columns end">
                 <label for="current-password" class="col-sm-4 control-label">Senha atual</label>
                   <div class="form-group">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Senha atual" required>
                   </div>
               </div>
             </div>
             <div class="row">
               <div class="small-12 medium-8 medium-offset-2 large-6 large-offset-3 columns end">
                 <label for="password" class="col-sm-4 control-label">Nova senha</label>
                   <div class="form-group">
                     <input type="password" class="form-control" id="password" name="password" placeholder="Nova senha" required>
                   </div>
               </div>
             </div>
             <div class="row">
               <div class="small-12 medium-8 medium-offset-2 large-6 large-offset-3 columns end">
                 <label for="password_confirmation" class="col-sm-4 control-label">Repita a nova senha</label>
                   <div class="form-group">
                     <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repita a nova senha" required>
                   </div>
               </div>
             </div>
             <div class="row">
               <div class="form-group">
                 <div class="small-12 medium-8 medium-offset-2 large-6 large-offset-3 columns end">
                   <button style="border-radius: 4px;" type="submit" class="button expanded">Alterar</button>
                 </div>
               </div>
             </div>
             </form>
           </div>
           @endif
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
    <script src="public/js/jquery.Jcrop.js"></script>
    <script type="text/javascript">

    var loadFile = function(event) {
      var file = event.target.files[0];
      if (!file.type.match('image.*')) {
        alert('Arquivo enviado não é uma imagem');
      }else{
        var out = document.getElementById('out');
        $("#imgAnt").hide();
        $("#sf").hide();

        out.src = URL.createObjectURL(event.target.files[0]);
        $("#bt").show();
        $("#out").show();

        $(function(){
            $('#out').Jcrop({
                aspectRatio: 1,
                boxWidth: 250,
                onSelect: updateCoords,
                setSelect: [0, 70, 250, 250]
            });
        });
        function updateCoords(c)
        {
            console.log('X: ' + c.x);
            console.log('Y: ' + c.y);
            console.log('W: ' + c.w);
            console.log('H: ' + c.h);
            $('#x').val(c.x); //separation from left
            $('#y').val(c.y); //separation from right
            $('#w').val(c.w);
            $('#h').val(c.h);
        };

        function checkCoords()
        {
            if (parseInt($('#w').val())) return true;
            alert('Selecione a região para recortar.');
            return false;
        };
      }
    };

    </script>
    @stop

@stop
