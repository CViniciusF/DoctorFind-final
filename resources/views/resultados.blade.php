@extends('layouts.principal')

    @section('titulo')
        <title>DoctorFinder - Resultados</title>
    @stop

    @section('conteudo')
      <?php $rodape = 0; ?>
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
      <body class="bd-login" style="background-color: #bcd8b6;">
        <div class="">
          @if(isset($rbasico) and $rbasico != null)
            <div class="" style="">
            @else
              <div class="" style="height: 79vh;">
            @endif
            <div class="result">
              <div class="small-12 large-10 columns end ">
                @if(isset($rbasico) and $rbasico != null)
                <?php $i = 0; ?>
                  @if(isset($busca_nome))
                    <p style="color: #666; margin-top: 20px;">Resultados para "{{$busca_nome}}".</p>
                  @else
                    <p style="color: #666; margin-top: 20px;">Procurando por profissionais na área de <b>{{$especialidade->nome_especialidade}}</b> na cidade <b>{{$respecialista[$i]->endereco_cidade}}</b></p>
                  @endif
                    <?php $rodape = 0; ?>
                    @foreach($rbasico as $rb)
                      @if($respecialista[$i]->completou_perfil != 0)
                      <div class="card" style="margin-top: 30px; position: relative; border-radius: 4px;">
                        <a href="server.php/especialistas/ver-perfil/{{$rb->id}}" style="position: absolute; top:0; left:0; right:0; bottom:0;"></a>
                        <div class="flex" style="padding: 20px;display: flex; justify-content: left; align-items: top; flex-wrap: wrap;">
                          <div class="foto">
                            @if($rb->avatar != 'foto não encontrada')
                            <img src="http://localhost/DoctorFinder/public/uploads/avatars/{{$rb->avatar}}" alt="" style="height: 150px;">
                            @else
                              <img src="http://localhost/DoctorFinder/public/uploads/avatars/semfoto.png" alt="" style="height: 150px;">
                            @endif
                          </div>
                          <div class="infos" style="padding-left: 20px; font-family: Ubuntu; ">
                            <h2 class="mt" style="font-size: 30px;">{{$rb->name}} {{$rb->lastname}}</h2>
                            @if($rb->is_valid == 1)
                              <div class="indicacoes" style="display: flex; justify-content: left; align-items: center; flex-wrap: wrap; margin-bottom: 10px;">
                                <i class="fa fa-check-circle" style="font-size: 30px; color: #1bba2e;"></i><p class="os" style="margin-bottom: 0;">&nbsp;&nbsp;Especialista Verificado</p>
                              </div>
                            @endif
                            <button class="mt button" type="button" name="button" style="margin-top: 15px;border-radius: 4px;">Ver Perfil Completo</button>
                          </div>
                        </div>
                      <?php $i++; ?>
                      </div>
                      @endif
                      <?php $rodape++; ?>
                    @endforeach
                    <div class="" style="text-align: center;">
                      <p class="mt"><a href="server.php/">Realizar uma nova busca</a></p>

                    </div>
                    @else
                      @if(isset($especialidade))
                        <p style="color: #666; margin-top: 20px;">Sua busca por profissionais na área de <b>{{$especialidade->nome_especialidade}}</b> na cidade de "<b>{{$busca_cidade}}</b>" não retornou nenhum resultado.</p>
                      @elseif(isset($busca_nome))
                        <p style="color: #666; margin-top: 20px;">Sua busca por " {{$busca_nome}}" não retornou nenhum resultado.</p>

                      @endif
                  @endif
                </div>
            </div>
          </div>
          @if($rodape > 1)
          <div class="footer-flex">
            @else
              <div class="footer-flex" style="position: fixed; bottom: 0; width: 100%;">
            @endif
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
        @stop
      </body>

@stop
