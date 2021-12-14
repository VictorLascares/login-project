$(document).ready(function(){
    $('#invalido').hide();
    $('#valido').hide();
    
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
$('#correo').keyup(function(){
    
  if($('#correo').val()){
    let mail = $('#correo').val();
    var ruta = '/verificarcorreo'
    // $('#valido').show();
    $.ajax({
        url: ruta,
        type: 'post',
        data: {
            mail,
            '_token': $('#token').val()
         },
        success: function(response) {
         if(mail){
            $('#invalido').hide();
            $('#valido').show();
            $('#registrar').show();
         }
         response.forEach(element => {
             if(mail){        
                    if(mail == element.correo){
 
                         $('#invalido').show();
                         $('#registrar').hide();
                         $('#valido').hide();
                    }else{
                        $('#invalido').hide();
                        $('#valido').show();
                        $('#registrar').show();
                    }
             }           
         });
    }
    })
  }
})
});
