$(document).ready(function(){
//var iconCarregando = $('<img src="assets/img/mini.gif" class="icon" /> <span class="destaque">Carregando. Por favor aguarde...</span>');
$('#formulario').submit(function(e) {
e.preventDefault();
var serializeDados = $('#formulario').serialize();

$.ajax({
      url: 'forms/contato.php?salvar=enviado', 
      dataType: 'html',
      type: 'POST',
      data: serializeDados,
      beforeSend: function(){
      //$('#send').html(iconCarregando);
      $('#send').html('<i class="fa fa-spinner fa-spin"></i> Salvando...');
      $('#send').attr('disabled', true)
      $('#send').attr('disabled', 'disabled');//desabilita
      },
      complete: function() {
        $('#send').html('<i class="fa fa-save"></i> Salvar');
        $('#send').attr('disabled', false);
      //$(iconCarregando).remove();
      },
      success: function(data, textStatus) {
        Swal.fire({
          icon: 'success',
          title: 'Email enviado com sucesso',
          showConfirmButton: true,
        });
      $('#send').removeAttr('disabled');//habilita
      },
      error: function(xhr,er) {
      // $('#mensagem_erro').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')
      }       
  });
}); 
})