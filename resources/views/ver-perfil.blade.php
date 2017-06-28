@extends('layouts.principal')

    @section('titulo')
      <link rel="stylesheet" href="public/css/jquery.Jcrop.css" />
        <title>{{$user->name}} {{$user->lastname}} - DoctorFinder</title>
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
    <body style="background-color: #bcd8b6;">
      <div class="reveal" id="depoimento-modal" data-reveal>
        <p class="os" style="font-size: 25px;">Escreva seu depoimento para {{$user->name}} {{$user->lastname}}.</p>
        <div class="body-modal" style="text-align: center;">
          <form action="server.php/especialistas/enviarDepoimento" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id_especialista" value="{{$user->id}}">
            <textarea name="texto" rows="6" cols="80" style="border-radius: 4px;" required></textarea>
            <button type="submit" name="button" class="button" style="border-radius: 4px;">Enviar depoimento</button>
          </form>
        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="reveal" id="pergunta-modal" data-reveal>
        <p class="os" style="font-size: 25px;">Envie sua pergunta para {{$user->name}} {{$user->lastname}}.</p>
        <div class="body-modal" style="text-align: center;">
          <form action="server.php/especialistas/enviarPergunta" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id_especialista" value="{{$user->id}}">
          <label class="os"for="pergunta_titulo">Assunto</label>
          <input id="pergunta_titulo" type="text" name="titulo_pergunta" style="border-radius: 4px;" placeholder="Informe um assunto" required>
          <label class="os"for="pergunta_texto">Pergunta</label>
          <textarea id="pergunta-texto" name="texto_pergunta" rows="6" cols="80" style="border-radius: 4px;" required></textarea>
          <button type="submit" name="button" class="button" style="border-radius: 4px;">Enviar pergunta</button>
        </form>
        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="container">
          <br>
          <div class="row">
            @if(session('error'))
              <div id="err" class="small-12 medium-10 medium-offset-2 large-8 large-offset-2 columns end" style="padding-left: 0px;">
                <div class="alert callout small" data-closable style="margin-bottom: 0px;padding: 20px;font-size: 20px;">
                  <p>{{session()->get('error')}}</p>
                  <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            @endif
            @if(session('depoimento_escrito'))
              <div id="scs_depo" class="small-12 large-12 columns" style="text-align: center;">
                <div class="success callout small" data-closable style="margin-bottom: 0px;padding: 20px;font-size: 20px;">
                  <p>Seu depoimento foi enviado e deverá ser autorizado por {{$user->name}} {{$user->lastname}} para ser exibido!</p>
                  <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>
            @endif
            @if(session('pergunta_escrita'))
              <div id="scs_pergunta" class="small-12 large-12 columns" style="text-align: center;">
                <div class="success callout small" data-closable style="margin-bottom: 0px;padding: 20px;font-size: 20px;">
                  <p>Sua pergunta foi enviada! Você receberá uma notificação quando {{$user->name}} {{$user->lastname}} responder.</p>
                  <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>
            @endif
              <div class="large-12 columns">
                <div class="card" style="margin-bottom: 0;">
                  <div class="" style="display: flex; justify-content: space-between; padding: 15px; flex-wrap: wrap; margin-bottom: 0; align-items: center;">
                  <div class="" style="display: flex; justify-content: left; padding: 15px; flex-wrap: wrap; margin-bottom: 0;">
                    <div class="foto">
                      @if($user->avatar != 'foto não encontrada')
                        <img src="http://localhost/DoctorFinder/public/uploads/avatars/{{$user->avatar}}" alt="" style="height: 200px;">
                      @else
                        <img src="http://localhost/DoctorFinder/public/uploads/avatars/semfoto.png" alt="" style="height: 200px;">
                      @endif
                    </div>
                    <div class="desc" style="padding-left: 30px;">
                        <h2 class="mt" style="font-size: 30px;">{{$user->name}} {{$user->lastname}}</h2>
                        @if($user->is_valid == 1)
                          <div class="indicacoes" style="display: flex; justify-content: left; align-items: center; flex-wrap: wrap; margin-bottom: 10px;">
                            <i class="fa fa-check-circle" style="font-size: 30px; color: #1bba2e;"></i><p class="os" style="margin-bottom: 0;">&nbsp;&nbsp;Especialista Verificado</p>
                          </div>
                        @endif
                        @if($count_indicacoes == 1)
                          <div class="indicacoes" style="display: flex; justify-content: left; align-items: center; margin-bottom: 10px;">
                            <i class="fa fa-star" style="font-size: 30px; color: #FFD700;"></i><p class="os" style="margin-bottom: 0;">&nbsp;&nbsp;{{$count_indicacoes}} indicação</p>
                          </div>
                        @elseif($count_indicacoes == 0)
                          <div class="indicacoes" style="display: flex; justify-content: left; align-items: center; margin-bottom: 10px;">
                            <i class="fa fa-star" style="font-size: 30px; color: #FFD700;"></i><p class="os" style="margin-bottom: 0;">&nbsp;&nbsp;Ainda não indicado</p>
                          </div>
                        @else
                          <div class="indicacoes" style="display: flex; justify-content: left; align-items: center; margin-bottom: 10px;">
                            <i class="fa fa-star" style="font-size: 30px; color: #FFD700;"></i><p class="os" style="margin-bottom: 0;">&nbsp;&nbsp;{{$count_indicacoes}} indicações</p>
                          </div>
                        @endif


                      <em class="os" style="font-style: normal;">Especialista em:</em>
                      <ul class="os" style="list-style-type: none; font-size: 14px; color: #514747;">
                        @foreach($userEspecialidades as $ue)
                          <li>{{$ue->nome_especialidade}}</li>
                        @endforeach
                      </ul>
                      <p class="os" style="color: #514747;">Número de identificação profissional: <b>{{$userEspecialista->registro}}</b></p>
                    </div>
                  </div>
                  <div class="acoes" style="display: flex; flex-direction: column; float: right;">
                    <?php $i = 0;
                    $jaindicou = 0; ?>
                    @if(isset(Auth::User()->id))
                      @foreach($indicacoes as $inds)
                        @if($indicacoes[$i]->id_paciente == Auth::User()->id)
                          <?php $jaindicou = 1; ?>
                        @endif
                          <?php $i++; ?>
                      @endforeach
                    @endif
                    @if($jaindicou == 1)
                      <button class="button os" name="button" style="border-radius: 4px;" disabled><i class="fa fa-star-o"></i>&nbsp;&nbsp;Indicado!</button>
                    @else
                      @if(isset(Auth::User()->id) and Auth::User()->id == $userEspecialista->id)
                        <button class="button os" name="button" style="border-radius: 4px;" disabled><i class="fa fa-star-o"></i>&nbsp;&nbsp;Você não pode se indicar</button>
                      @else
                        <a class="button os" href="server.php/especialistas/indicar/{{$userEspecialista->id}}" name="button" style="border-radius: 4px;"><i class="fa fa-star-o"></i>&nbsp;&nbsp;Indicar</a>
                      @endif
                    @endif

                    <a class="button os" href="server.php/especialistas/escreverDepoimento/{{$userEspecialista->id}}" name="button" style="border-radius: 4px;"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Escrever Depoimento</a>
                    <a class="button os" href="server.php/especialistas/escreverPergunta/{{$userEspecialista->id}}" name="button" style="border-radius: 4px;"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Enviar Pergunta</a>

                  </div>
                </div>
                @if(session('success'))
                  <div style="text-align: center;">
                    <p class="os" style="color: #514747;">Telefone do Consultório: <b>{{$userEspecialista->tel_consultorio}}</p></p>
                    <p class="os" style="color: #514747;">Endereço de E-mail: <a href="mailto:{{$user->email}}">{{$user->email}}</a></p>
                  </div>
                @else
                  <div style="text-align: center;">
                    @if(isset(Auth::User()->id) and Auth::User()->id == $userEspecialista->id)
                      <button type="button" class="button" style="border-radius: 4px; background-color: #1bba2e; " disabled><i class="fa fa-phone"></i>&nbsp;&nbsp;Visualizar Telefone</a>
                    @else
                      <a href="server.php/especialistas/verTelefone/{{$userEspecialista->id}}" type="button" class="button" style="border-radius: 4px; background-color: #1bba2e; "><i class="fa fa-phone"></i>&nbsp;&nbsp;Dados de Contato</a>
                    @endif
                  </div>
                </div>
              @endif

                <div class="espaco" style="background-color: #D3FFCE; height: 20px;">

                </div>
                <div class="card perfil" style="padding: 15px; margin-bottom: 0;">
                  <h2 class="mt" style="font-size: 30px;">Apresentação</h2>
                  <div class="bq" style="display: flex; justify-content: center;">
                    <blockquote class="small-12 large-8 columns" style="text-align: center;">
                      <p>"{{$userEspecialista->apresentacao}}"</p>
                    </blockquote>
                  </div>
                </div>
                <div class="espaco" style="background-color: #D3FFCE; height: 20px;">

                </div>
                <div class="card perfil" style="padding: 15px; margin-bottom: 0;">
                  <h2 class="mt" style="font-size: 30px;">Endereço</h2>
                    <p class="os" style="color: #514747">Rua: <b>{{$userEspecialista->endereco_rua}}</b></p>
                    <p class="os" style="color: #514747">Número: <b>{{$userEspecialista->endereco_numero}}</b></p>
                    @if(null != $userEspecialista->endereco_complemento)
                    <p class="os" style="color: #514747">Complemento: <b>{{$userEspecialista->endereco_complemento}}</b></p>
                    @endif
                    @if(isset($userEspecialista->endereco_bairro))
                    <p class="os" style="color: #514747">Bairro: <b>{{$userEspecialista->endereco_bairro}}</b></p>
                    @endif
                    <p class="os" style="color: #514747">Cidade: <b>{{$userEspecialista->endereco_cidade}}</b></p>
                    <div class="map-wrap" style="height: 300px;">
                      <div id="map" style="height: 300px;">
                      </div>
                      <!--<div id="loading-img" class="imagem" style="display: none; position: absolute; top:0; left:0; right:0; bottom:0; text-align: center;">
                        <img src="portalJet/public/imagens/map-loading.gif" style="height: 300px;" alt="">
                      </div>-->
                    </div>

                </div>
                <div class="espaco" style="background-color: #D3FFCE; height: 20px;">

                </div>
                @if(isset($depoimentos) and $depoimentos != null)
                <div class="card perfil" style="padding: 15px;margin-bottom: 0px;">
                  <h2 class="mt" style="font-size: 30px;">Depoimentos para {{$user->name}} {{$user->lastname}}</h2>
                  <div class="bq" style="padding: 20px;">
                    <?php $i = 0; ?>
                    @foreach($depoimentos as $dp)
                      @if($dp->autorizado == 1)
                      <p class="mt">Escrito por {{$user_depo[$i]->name}} {{$user_depo[$i]->lastname}}</p>
                      <blockquote class="os">"{{$dp->texto_depoimento}}"</blockquote>
                      <hr>
                      <?php $i++; ?>
                      @endif
                    @endforeach
                  </div>
                </div>
                @endif
                <div class="espaco" style="background-color: #D3FFCE; height: 20px;">

                </div>
                <div class="card perfil" style="padding: 15px;">
                  <h2 class="mt" style="font-size: 30px;">Horário de Atendimento</h2>
                  <div class="bq" style="display: flex; justify-content: center; padding-top: 20px;">
                    <div class="small-12 large-8 columns" style="">
                      <p>{{$userEspecialista->horario_atendimento}}</p>
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
    @section('scripts')
    <script src="public/js/jquery.Jcrop.js"></script>
    @if (session('error'))
      <script type="text/javascript">
        setTimeout(function(){$('#err').fadeOut();}, 5000);
      </script>
    @endif
    @if (session('depoimento_escrito'))
      <script type="text/javascript">
        setTimeout(function(){$('#scs_depo').fadeOut();}, 5000);
      </script>
    @endif
    @if (session('pergunta_escrita'))
      <script type="text/javascript">
        setTimeout(function(){$('#scs_pergunta').fadeOut();}, 5000);
      </script>
    @endif
    @if (session('success'))
      <script type="text/javascript">
        setTimeout(function(){$('#scs').fadeOut();}, 5000);
      </script>
    @endif
    @if(session('abrir_modal'))
    <script type="text/javascript">
    var popup3 = new Foundation.Reveal($('#depoimento-modal'));
        popup3.open();
    </script>
    @endif
    @if(session('modal_pergunta'))
    <script type="text/javascript">
    var popup2 = new Foundation.Reveal($('#pergunta-modal'));
      popup2.open();
    </script>
    @endif
    <script type="text/javascript">

    $('#tel_consultorio').mask('(00) 00000-0000');
    $('#endereco_cep').mask('00000-000');
    $('#endereco_uf').mask('AA');


    </script>
    <script src="public/js/cep-autocomplete.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCt1NrnBF17J4QZrPPUlb_A6k_HKhbJzDQ&callback"></script>
    <script>

      var marker;
      geocoder = new google.maps.Geocoder();
      map = new google.maps.Map(document.getElementById('map'));
      map.addListener("click", function (e) {
          setTimeout(function () {
              map.setOptions({scrollwheel: true})
          }, 1);
      });
      map.addListener("mouseout", function (e) {
          setTimeout(function () {
              map.setOptions({scrollwheel: false});
          }, 500);
      });
      geocoder.geocode({address: 'Brasil'}, function(results, status) {
            var myResult = results[0].geometry.location; // referência ao valor LatLng

            map.setCenter(myResult);
            map.setZoom(3);

      });

      function searchAddress() {

        $("#map").css({ opacity: 0.2 });
        var cep =  "{{$userEspecialista->endereco_cep}}";
        var rua =  "{{$userEspecialista->endereco_rua}}";
        var numero =  "{{$userEspecialista->endereco_numero}}";

        if (rua != null) {

          var arrEnd = [cep, rua];
        }
        if (numero != null){

          var arrEnd = [cep, rua, numero];
        }

        var address = arrEnd.join(',');
        console.log('Buscando por: ' + address);
        geocoder.geocode({address: address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              var myResult = results[0].geometry.location; // referência ao valor LatLng
              console.log(results[0].geometry.location);
              createMarker(myResult); // adicionar chamada à função que adiciona o marcador
              map.setZoom(17);
              console.log('panTo');
              map.panTo(myResult);

            }
            else{
              console.log("O Geocode não foi bem sucedido pela seguinte razão: " + status);
            }
        });
        map.addListener('idle', function() {
          console.log("PRONTO");

          $("#map").css({ opacity: 1 });
        });

      }
      function createMarker(latlng) {

       // Se o utilizador efetuar outra pesquisa é necessário limpar a variável marker
       if(marker != undefined && marker != ''){
         console.log('caiu no marker null');
        marker.setMap(null);
        marker = '';
       }

      marker = new google.maps.Marker({
          position: latlng,
          animation: google.maps.Animation.DROP,
          visible: true,
          //label: 'Seu Imóvel',
          //icon: 'portalJet/public/imagens/marker.png'
       });

       marker.setMap(map);
       var lat= marker.getPosition().lat();
       var lng = marker.getPosition().lng();
       console.log(lat);
       console.log(lng);
       $("#lat").val(lat);
       $("#lng").val(lng);
       marker.addListener('dragend', function (event){
         console.log('dragend');
        lat= marker.getPosition().lat();
        lng = marker.getPosition().lng();
        console.log(lat);
        console.log(lng);
        $("#lat").val(lat);
        $("#lng").val(lng);
       });
    }

    searchAddress();
    </script>
    @stop

@stop
