$(document).ready(function() {

  function atualizarCep() {

      //Nova variável "cep" somente com dígitos.
      var cep = $('#endereco_cep').val().replace(/\D/g, '');

      //Verifica se campo cep possui valor informado.
      if (cep != "") {

          //Expressão regular para validar o CEP.

          var validacep = /^[0-9]{8}$/;

          //Valida o formato do CEP.
          if(validacep.test(cep)) {

              //Preenche os campos com "..." enquanto consulta webservice.
              $("#endereco_rua").prop('readonly', true);
              $("#endereco_bairro").prop('readonly', true);
              $("#endereco_cidade").prop('readonly', true);
              $("#endereco_uf").prop('readonly', true);
              $("#endereco_numero").focus();
              //$("#ibge").val("...");

              //Consulta o webservice viacep.com.br/
              $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                  if (!("erro" in dados)) {
                      //Atualiza os campos com os valores da consulta.


                      $("#endereco_rua").val(dados.logradouro);
                      $("#endereco_bairro").val(dados.bairro);
                      $("#endereco_cidade").val(dados.localidade);
                      $("#endereco_uf").val(dados.uf);

                      if ($('#endereco_rua').val() == '' || $('#bairro').val() == '') {
                        $("#endereco_rua").prop("readonly",false);
                        $("#endereco_bairro").prop("readonly",false);
                        $("#endereco_bairro").focus();
                      }
                      //$("#ibge").val(dados.ibge);
                  } //end if.
                  else {

                      console.log('CEP não encontrado');
                      $("#endereco_rua").prop('readonly', false);
                      $("#endereco_bairro").prop('readonly', false);
                      $("#endereco_cidade").prop('readonly', false);
                      $("#endereco_uf").prop('readonly', false);
                      $("#endereco_cep").focus();

                  }
              });
          } //end if.
          else {
              //cep é inválido.
              alert("Formato de CEP inválido.");
              $("#endereco_rua").prop('readonly', false);
              $("#endereco_bairro").prop('readonly', false);
              $("#endereco_cidade").prop('readonly', false);
              $("#endereco_uf").prop('readonly', false);
          }
      } //end if.
      else {
          //cep sem valor, limpa formulário.
          $("#endereco_rua").prop('readonly', false);
          $("#endereco_bairro").prop('readonly', false);
          $("#endereco_cidade").prop('readonly', false);
          $("#endereco_uf").prop('readonly', false);
      }
    }
    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#endereco_rua").val("");
        $("#endereco_bairro").val("");
        $("#endereco_cidade").val("");
        $("#endereco_uf").val("");
        //$("#ibge").val("");
    }
    function checkMaxLength (text, max) {
                return (text.length >= max);
    }

    $("#endereco_cep").keyup(function verifica(){
      var len = $(this).val().length;
       if (len == 9) {
         atualizarCep();
         setTimeout(function(){
           //maps
            //searchAddress();
         }, 1500);

       }
    });
        //Quando o campo cep perde o foco.
    $("#endereco_cep").blur(function verifica(){
      var len = $(this).val().length;
       if (len != 9) {
         atualizarCep();
         //maps
        // searchAddress();
       }
    });
});
