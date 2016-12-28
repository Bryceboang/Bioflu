function filemanager(){
   $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=getimages',
        data:{},
      }).done( function(data){
        $('.file-manager').html(data);
      }); 
}

$(document).on('click', '.image-file',  function(){

  var image = $(this).attr('src');
  var id = $('.id-image').html();
  var data_id = $(this).attr('data-id');
  $('.img_'+id).attr('src',image);
  var imgtrim ='';
  imgtrim = image.replace('../','');
  imgtrim = imgtrim.replace(/[\/]/g,'\\/');
  $('.img_'+id).val(imgtrim);
  $('.check').hide();
  $('.check_'+data_id).show();
  $('.c-copy').show();
  $('.img_'+id).show();

  $('.pathtocopy').val(image);
  $('.pathtocopy').show();

});

$('.upload').on('click', function() {
    var file_data = $('#imgfiles').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data); 

    if ($('#imgfiles').val() == '' ) {

    }else{
      $('.loader').show();
      $('.uploadlabel').html('Uploading ');
    $.ajax({
                url: './dashboard.php?function=uploadfile', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                  setTimeout(function(){
                    $('.loader').hide();
                    $('.uploadlabel').html('Upload');
                     filemanager();
                     $('#imgfiles').val('');
                      $('.filename').html('');
                 }, 4000);
                  
                }
     });

}
});

