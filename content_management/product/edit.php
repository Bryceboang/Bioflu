<?php  require_once dirname(__FILE__) . '/../layout/config.php';?>
<style type="text/css">
  .update{
    display: inline;
  }
  .save{
    display: none;
  }
   .pagination{
    display: none;
  }
   .inactive{
    display: none !important;
  }
  .my-options {
    display: block;
  }
  .other-content {
    display: none !important;  
  }
  .btn-videomanager{
    display: inline !important;
  }
  .row{
    margin-bottom: 3%;
  }
  .preview{
    display: none;
  }
  .open{
    color: red;
  }
</style>

<div class="product-details">
<div class="row">
  <div class="col-md-12">
    <label>WHAT IS IN THE ALL‐IN‐ONE BIOFLU?</label>
  <div class="col-md-12">
    <button class="btn-filemanager btn-min btn btn-default " data-id="formulation"><span class="glyphicon glyphicon-picture"></span>Image Manager</button>
    <button class="btn-videomanager btn-min btn btn-default" data-id="formulation"><span class = "glyphicon glyphicon-film"></span>Video Manager</button>  
  </div>
    <textarea id="prod_edit" class="prod_edit formulation inputs"></textarea><span class = "er-msg">Content should not be empty *</span>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <label>HOW OFTEN SHOULD YOU TAKE BIOFLU?</label>
  <div class="col-md-12">
    <button class="btn-filemanager btn-min btn btn-default" data-id="usage"><span class="glyphicon glyphicon-picture"></span>Image Manager</button>
    <button class="btn-videomanager btn-min btn btn-default" data-id="usage"><span class = "glyphicon glyphicon-film"></span>Video Manager</button>  
  </div>
    <textarea id="prod_edit" class="prod_edit usage inputs"></textarea><span class = "er-msg">Content should not be empty *</span>
  </div>
</div>
<div class="row">

  

  <div class="col-md-12">
    <label>SIGN AND SYMPTOMS OF OVERDOSAGE</label>
    <div class="col-md-12">
      <button class="btn-filemanager btn-min btn btn-default " data-id="overdosage"><span class="glyphicon glyphicon-picture"></span>Image Manager</button>
      <button class="btn-videomanager btn-min btn btn-default " data-id="overdosage"><span class = "glyphicon glyphicon-film"></span>Video Manager</button>  
    </div>
    <textarea id="prod_edit" class="prod_edit overdosage inputs"></textarea><span class = "er-msg">Content should not be empty *</span>
  </div>
</div>
</div>

<script>
$(document).ready(function () {
$('.prod_edit').cleditor()[0].focus();


$('.btn-filemanager').click(function(){
  var id = jQuery(this).attr('data-id');
  
  if(id == "overdosage"){
    $('.btn-copy').removeClass("usage");
    $('.btn-copy').removeClass("formulation");
  } else if(id == "usage"){
    $('.btn-copy').removeClass("overdosage");
    $('.btn-copy').removeClass("formulation");
  } else if(id = "formulation"){
    $('.btn-copy').removeClass("usage");
    $('.btn-copy').removeClass("formulation");
  }

  $('.btn-copy').attr( 'id', id );
});

$('.btn-videomanager').click(function(){
  var id = jQuery(this).attr('data-id');
  
  if(id == "overdosage"){
    $('.btn-insert-video').removeClass("usage");
    $('.btn-insert-video').removeClass("formulation");
  } else if(id == "usage"){
    $('.btn-insert-video').removeClass("overdosage");
    $('.btn-insert-video').removeClass("formulation");
  } else if(id = "formulation"){
    $('.btn-insert-video').removeClass("usage");
    $('.btn-insert-video').removeClass("formulation");
  }

  $('.btn-insert-video').attr( 'id', id );
});
// $(".cleditorMain iframe").contents().find('html').bind('click', function(){
//   var body = $(this).find('body');
//   $(body).prevAll().removeClass("active");
//   $(body).nextAll().removeClass("active");
//   $(body).toggleClass('active').siblings().removeClass('active');
//   if ($(body).hasClass('active')){
//     $('iframe html').removeClass("active");   
//     alert('remove'); 
//   }else{
//     $( this ).find('body').addClass("active");
//   }
// }); 
// $(".cleditorMain iframe").contents().find('body').bind('click', function(){
//      alert( $(this).parent().find('.cleditorMain .prod_edit').addClass("id") );
// });
onload();
function onload(){
        $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=edit_product',
        // data:{id:id},
      }).done( function(data){
          var obj = JSON.parse(data);
          $.each(obj, function(index, row){
            var formulation = row.formulation;
            var usage = row.usage;
            var dosage = row.dosage;
              $('.prod_title').val(row.prod_title);
              $('.usage').html(row.usage).blur(); 
              $('.overdosage').html(row.dosage).blur();
              form = formulation.replace(/\images/g,'../images');
              usage = usage.replace(/\images/g,'../images');
              dosage = dosage.replace(/\images/g,'../images');
              $('.formulation').val(form).blur();
              $('.usage').val(usage).blur();
              $('.overdosage').val(dosage).blur();
          });
     });      
}
     
	

     

     $(document).on('click', '.image-file', function(){
        var img = $(this).attr('src');
        $('.pathtocopy').val(img);
         $('.pathtocopy').show();
        $('.btn-insert-video').show();
     });

     

     $('.btn-navigation').addClass('col-md-12');
     $('.btn-navigation').removeClass('col-md-7');

$('.btn-copy').click(function(){
  var id = jQuery(this).attr('id');
  var path = '<img src="'+$('.pathtocopy').val()+'">';
  var htm = $('.'+id).val() + path;
  $('.'+id).val(htm).blur();
});

$('.btn-insert-video').click(function(){

  var id = jQuery(this).attr('id');
  alert(id);
  var path = '<div><video width="400px" controls ><source title="'+$('.pathtocopy').val()+'" src="'+$('.pathtocopy').val()+'"  type="video/mp4"></video>';
  var htm = $('.'+id).val() + path;
  $('.'+id).val(htm).blur();
});
    


$('.update').click(function() {
      $('.msg').html('Successfully update...');
      var formulation = $('.formulation').val();
      formulation = formulation.replace(/\..\/images/g,'images');
      var usage = $('.usage').val();
      usage = usage.replace(/\..\/images/g,'images');
      var overdosage = $('.overdosage').val();
      overdosage = overdosage.replace(/\..\/images/g,'images');
      var id = 1;


      if(validateFields() == 0){
            $.ajax({
                type: 'Post',
                url: 'dashboard.php?function=update_product',
                data:{formulation:formulation, usage:usage, overdosage:overdosage,id:id},
              }).done( function(data){
                
                  var obj = JSON.parse(data);
                     alert("Successfully updated");
                     onload();
                     


                    
             });
             $('.product-details').load('product/edit.php');
      }
  
     });

      function validateFields() {

            var counter = 0;

            $('.inputs').each(function(){
                var input = $(this).val();
                if (input.length == 0) {
                  $(this).next().show();
                  counter++;
                }else{
                  $(this).next().hide();
                }
            });

          return counter;
      }
 });


</script>

