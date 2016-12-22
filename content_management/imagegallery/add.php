<style type="text/css">
.update {
  display: none;
}
.pagination{
  display: none;
}
.img_add{
  display: inline !important;
}
.inactive{
  display: none;
}
</style>
<div class="col-md-12">

<div class="col-md-12 pad-5">
    <div class="col-md-2">Image</div>
    <div class = "col-md-10"><button class = "btn btn-success btn-standard btn-select-image"><span class = "glyphicon glyphicon-plus  right-5"></span>Select Image</button></div>
</div>

<div class="col-md-12 pad-5">
    <div class="col-md-2"></div>
    <div class = "col-md-10 selected-image"><input style = "display:none" class = "imgsrc inputs" value=""/><span class = "er-msg">Image should not be empty *</span></div>
    
</div>

<div class="col-md-12 pad-5">
    <div class="col-md-2">Title: </div>
    <div class = "col-md-10"><input type = "text" class = "titles fullwidth inputs"><span class = "er-msg">Title should not be empty *</span></div>
    
</div>

<div class="col-md-12 pad-5">
    <div class="col-md-2">Description: </div>
    <div class = "col-md-10"><textarea class = "description fullwidth inputs"></textarea><span class = "er-msg">Decription should not be empty *</span></div>
</div>

<div class="col-md-12 pad-5">
    <div class="col-md-2">Url:  (Optional)</div>
    <div class = "col-md-10"><input type = "text" class = "url fullwidth"></div>
</div>

</div>

<script type="text/javascript">

$('.btn-select-image').click(function(){
  $('.c-copy').hide();
filemanager();
$('#select-image-modal').modal('show');

});


function filemanager(){
   $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=getimages',
        data:{},
      }).done( function(data){
        $('.file-manager').html(data);
      }); 
}

 $(document).on('click', '.image-file', function(){
        var img = $(this).attr('src');
        $('.pathtocopy').val(img);
        $('.pathtocopy').show();
        $('.btn-insert-video').show();

     });

 $(document).on('click', '.btn-copy', function(){
  var pathtocopy = $('.pathtocopy').val();
  $('.selected-image').html('<img class = "imgsrc" src="'+pathtocopy+'"/><input style = "display:none" class = "imgsrc inputs" value="'+pathtocopy+'"/>');
 });

 $(document).on('click', '.save', function(){
  var img = $('.imgsrc').attr('src');
  var title = $('.titles').val();
  var description = $('.description').val();
  var url = $('.url').val();
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

if(counter == 0){

  $.ajax({
          type: 'Post',
          url: 'dashboard.php?function=save_imagegallery',
          data:{image:img, title:title, description: description, url: url},
        }).done( function(data){
             $('#success-modal').modal('show');
       }); 

      }
 });


</script>