@extends('layouts.principal')

    @section('titulo')
        <title>DoctorFinder - Bem-Vindo</title>
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
      <body class="bd-login">
        <div class="wrap-bg">
          <div class="content">
            <div class="wrap">
              <div class="small-12 large-8 columns end ">
                @if(session('error'))
                  <div id="err" >
                    <div class="alert callout small" data-closable style="margin-top: 20px;">
                      <p style="color: #666;">{{session()->get('error')}}</p>
                      <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  </div>
                @endif

                <br>
                <div class="titulo" style="text-align: center;">
                  <h2 class="mt" style="color: #5c715e">Procure por especialistas!</h2>
                  <p class="os" style="color: #666">Profissionais da saúde indicados por pessoas como você!</p>
                </div>
                <form class="" action="server.php/buscar-especialista/" method="post">
                  {{ csrf_field()}}
                  <div class="busca1" style="margin-top: 20px;display: flex; justify-content: center; align-items: center; flex-wrap: wrap;">
                    <div class="small-12 large-6 columns">
                      <label for="select-especialista" style="color: #666; font-size: 16px;">Busque por especialidade</label>
                      <select id="select-especialista" class="os" name="busca_especialidade" style="border-radius: 8px;">
                        <option value="" style="border-radius: 8px;" selected disabled>Selecione uma especialidade</option>
                        @foreach($especialidades as $esp)
                          <option value="{{$esp->id_especialidade}}" style="border-radius: 8px;">{{$esp->nome_especialidade}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="small-12 large-6 columns">
                      <em style="font-style: normal; font-size: 16px; color: #666;">em</em>
                      <input type="text" name="busca_cidade" placeholder="Cidade" maxlength="60" class="os" style="border-radius: 8px;">
                    </div>
                  </div>
                  <br>
                  <br>
                  <div class="busca2">
                    <div class="small-12 large-12 columns">
                      <em style="font-style: normal; font-size: 16px; color: #666;">Ou busque diretamente pelo nome</em>
                      <input type="text" name="busca_nome" placeholder="Ex: José de Alencar" maxlength="60" class="os" style="border-radius: 8px;">
                    </div>
                  </div>
                  <div class="botao" style="text-align: center;">
                    <button class="botao pesquisar" type="submit" style="border-radius: 8px; margin-top: 15px;"><i class="fa fa-search"></i>&nbsp;&nbsp;Pesquisar</button>
                  </div>
                </form>
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
        @stop
      </body>

@stop
