$(document).ready(function(){
    $.ajax({
      type: 'POST',
      url: 'php/ajax_region.php'
    })
    .done(function(listas_rep){
      $('#region').html(listas_rep)
    })
    .fail(function(){
      alert('Hubo un errror al cargar las listas_rep')
    })
  
    $('#region').on('change', function(){
      var id = $('#region').val()
      $.ajax({
        type: 'POST',
        url: 'php/ajax_comunas.php',
        data: {'id': id}
      })
      .done(function(listas_rep){
        $('#comunas').html(listas_rep)
      })
      .fail(function(){
        alert('Hubo un errror al cargar los vídeos')
      })
    })
  
  })