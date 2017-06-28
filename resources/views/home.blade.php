@extends('layouts.principal')

    @section('titulo')
        <title>Início - DoctorFinder</title>
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
                  @if($tipo == 'paciente')
                  <a class="botoes-cabecalho" style="margin-left: 20px;" href="server.php/home/perguntas">Minhas Perguntas</a>
                  @endif
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
    <body class="bd-login">
      <div class="wrap-bg">
        <div class="content">
          @if($tipo == 'paciente')
            <div class="wrap" style="display: flex;">
          @else
            <div class="wrap" style="display: inherit;">
          @endif
            @if($tipo == 'especialista')
            <div class="row">
              <div class="small-12 columns" style="">
                      @if($tipo == 'especialista')
                        @if($UsuarioEspecialista->completou_perfil == 0)
                        <div>
                          <div class="alert callout small" data-closable style="margin-top: 20px; text-align: center; padding: 20px; position:absolute. width:86%;">
                            <p class="mt" style="margin-bottom: 0px;"><a href="server.php/meu-perfil">Você deve completar seu perfil</a></p>
                            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        </div>
                        @endif
                        <h2 class="MT" style="text-align: center; padding-top: 20px;">Painel de Controle</h2>
                        <br>
                    </div>
                </div>
                <div class="row" style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap;">
                    @if($views_telefone > 1)
                    <div class="card" style=" flex-basis: 45%; padding: 30px; text-align: center;">
                      <p class="mt" style=""><a href="server.php/home/verNotificacoes">Você possui {{$views_telefone}} novas visualizações de telefone</a></p>
                    </div>

                      @elseif($views_telefone == 0)
                      <div class="card" style=" flex-basis: 45%; padding: 30px; text-align: center;">

                        <p class="mt" style="">Você não possui nenhuma nova visualização de telefone</p>
                      </div>

                      @elseif($views_telefone == 1)
                      <div class="card" style=" flex-basis: 45%; padding: 30px; text-align: center;">

                        <p class="mt" style=""><a href="server.php/home/verNotificacoes">Você possui {{$views_telefone}} nova visualização de telefone</a></p>
                      </div>

                      @endif
                      <hr>
                      <div class="card" style=" flex-basis: 45%; padding: 30px; text-align: center;">
                        <p class="mt" style="">Seu perfil tem {{$UsuarioEspecialista->views_perfil}} visualizações</p>
                      </div>
                  </div>
                    <hr>
                    <div class="row" style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap;">
                      <div class="card" style="flex-basis: 45%; padding: 30px; text-align: center; margin-right: 60px;">
                        @if($count_indicacoes == 1)
                          <p class="mt" style="">Você possui {{$count_indicacoes}} indicação</p>
                        @elseif($count_indicacoes == 0)
                          <p class="mt" style="">Você não possui nenhuma indicação até agora</p>
                        @else
                          <p class="mt" style="">Você possui {{$count_indicacoes}} indicações</p>
                        @endif
                      </div>
                      <div class="card" style="flex-basis: 45%; padding: 30px; text-align: center; margin-left: 60px;">
                        @if($count_depoimentos == 1)
                          <p class="mt" style="">Você possui <a href="server.php/home/novosDepoimentos">{{$count_depoimentos}} novo depoimento</a> para validar.</p>
                        @elseif($count_depoimentos == 0)
                          <p class="mt" style="">Você não possui nenhum novo depoimento</p>
                        @else
                          <p class="mt" style="">Você possui <a href="server.php/home/novosDepoimentos">{{$count_depoimentos}} novos depoimentos</a> para validar.</p>
                        @endif
                      </div>
                    </div>
                    <div class="row" style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap;">
                      <div class="card" style="flex-basis: 45%; padding: 30px; text-align: center; margin-left: 60px;">
                        @if($count_perguntas == 1)
                          <p class="mt" style="">Você possui <a href="server.php/home/novasPerguntas">{{$count_perguntas}} nova pergunta</a> para responder.</p>
                        @elseif($count_perguntas == 0)
                          <p class="mt" style="">Você não possui nenhuma nova pergunta</p>
                        @else
                          <p class="mt" style="">Você possui <a href="server.php/home/novasPerguntas">{{$count_perguntas}} novas perguntas</a> para responder.</p>
                        @endif
                      </div>
                    </div>
                </div>
                      @endif
            </div>
            @if(session('error'))
              <div id="err">
                <div class="alert callout small" data-closable style="margin-top: 20px;">
                  <p style="color: #666;">{{session()->get('error')}}</p>
                  <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            @endif
            @else
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
            @endif
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
    <script>
      if($.trim($("code").html())==''){
        $('#endpoint').hide();
      }

      //Request permission from user
      function geoFindMe() {
          var output = document.getElementById("out");

          if (!navigator.geolocation){
            output.innerHTML = "<p>Geolocalização não suportada no seu navegador</p>";
            return;
          }

          function success(position) {
              var latitude  = position.coords.latitude;
              var longitude = position.coords.longitude;
              geocoder = new google.maps.Geocoder();
		          var latlng = new google.maps.LatLng(latitude,longitude);

              //output.innerHTML = '<p>Latitude é ' + latitude + '° <br>longitude é:' + longitude + '°</p>';
              var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: latitude, lng: longitude},
                scrollwheel: true,
                zoom: 15
              });
              var marker = new google.maps.Marker({map: map});
              var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            marker.setPosition(pos);
            //infoWindow.setContent('Location found.');
            map.setCenter(pos);

            geocoder.geocode({'latLng': latlng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                  var result = results[0];
                  //look for locality tag and administrative_area_level_1
                  var city = "";
                  var state = "";
                  var bairro = "";
                  var numero = "";
                  var rua = "";
                  var cep ="";
                  for(var i=0, len=result.address_components.length; i<len; i++) {
                      var ac = result.address_components[i];
                      console.log(ac);
                      if(ac.types.indexOf("locality") >= 0) city = ac.long_name;
                      if(ac.types.indexOf("administrative_area_level_1") >= 0) state = ac.long_name;
                      if(ac.types.indexOf("route") >= 0) rua = ac.long_name;
                      if(ac.types.indexOf("street_number") >= 0) numero = ac.long_name;
                      if(ac.types.indexOf("sublocality") >= 0) bairro = ac.long_name;
                      if(ac.types.indexOf("postal_code") >= 0) cep = ac.long_name;

                  }
                    //only report if we got Good Stuff
                    if(city != '' && state != '') {
                      	$("#result").html("Estado: "+state+"<br/>Cidade: "+city+"<br/>Bairro: "+bairro+"<br/>Rua: "+rua+"<br/>Número: "+numero+"");
                        /*
                        if (window.Notification && Notification.permission !== "granted") {
                          Notification.requestPermission(function (status) {
                            if (Notification.permission !== status) {
                              Notification.permission = status;
                            }
                          });
                        }
                        Notification.requestPermission(function (status) {
                          // If the user said okay
                          if (status === "granted") {
                            var n = new Notification("Cidade: "+ city);
                          }

                          // Otherwise, we can fallback to a regular modal alert
                          else {
                            alert("Cidade: "+ city);
                          }
                        });
                        */
                    }
                  }
                });

            }

            function error() {
              output.innerHTML = "Impossível retornar localização";
            }

            //output.innerHTML = "<p>Carregando...</p>";

            navigator.geolocation.getCurrentPosition(success, error);
      }


 </script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCt1NrnBF17J4QZrPPUlb_A6k_HKhbJzDQ&callback"
 async defer></script>
    @stop
  </body>

@stop
