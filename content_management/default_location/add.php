<style type="text/css">
  .update{
    display: none;
  }
  .save{
    display: inline;
  }
   .pagination{
    display: none;
  }
  .inactive{
  	display: none;
  }
  .preview{
  	display: none;
  }

  .other-content{
  	display: inline !important;
  }
  .my-options{
  	display: none !important;
  }
  .search-container{
    display: none;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <div class="form-horizontal">
      <div class="col-md-12 pad-5" style = "border:1px solid #ccc; margin-top:20px;">
        <label class="col-md-2" style = "text-align:center; background-color:#fff; margin-top:-15px">Place name: </label> 
        <div class="col-md-12">
          <input type="text" name="title" class="form-control location">
        </div>
      </div>

    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-horizontal">
      <div class="col-md-12 pad-5" style = "border:1px solid #ccc; margin-top:20px;">
        <label class="col-md-2" style = "text-align:center; background-color:#fff; margin-top:-15px">Longitude : </label> 
        <div class="col-md-12">
          <input type="text" name="title" class="form-control longitude">
        </div>
      </div>

    </div>
  </div>
</div>


<div class="row">
  <div class="col-md-12">
    <div class="form-horizontal">
      <div class="col-md-12 pad-5" style = "border:1px solid #ccc; margin-top:20px;">
        <label class="col-md-2" style = "text-align:center; background-color:#fff; margin-top:-15px">Latitude : </label> 
        <div class="col-md-12">
          <input type="text" name="title" class="form-control latitude">
        </div>
      </div>

    </div>
  </div>
</div>



<script>
    $(document).ready(function () {
     $(".article-new").cleditor();


     $('.save').click(function() {
     	 $('.msg').html('Successfully Save...');
      var location = $('.location').val();
      var longitude = $('.longitude').val();
      var latitude = $('.latitude').val();

     	$.ajax({
	        type: 'Post',
	        url: 'dashboard.php?function=saved_default',
	        data:{location:location, longitude:longitude,latitude:latitude},
	      }).done( function(data){
          alert(data);
             $('#success-modal').modal('show');
	     }); 


     });

     $(document).on('click', '.image-file', function(){
        var img = $(this).attr('src');
        $('.pathtocopy').val(img);
        $('.pathtocopy').show();
        $('.btn-insert-video').show();

     });



      $('.btn-navigation').addClass('col-md-12');
     $('.btn-navigation').removeClass('col-md-7');

     $('.btn-copy').click(function(){
        var path = '<img src="'+$('.pathtocopy').val()+'">';
        var htm = $('.article-new').val() + path;
        $('.article-new').val(htm).blur();
     });

     $('.btn-insert-video').click(function(){
        var path = '<video width="400px" controls ><source title="'+$('.pathtocopy').val()+'" src="'+$('.pathtocopy').val()+'"  type="video/mp4"></video>';
        var htm = $('.article-new').val() + path;
        $('.article-new').val(htm).blur();
     });

     $('.btn-select-thumb-image').click(function(){
    $('.c-copy').hide();
    thumb_filemanager();
    $('#select-thumbnail-modal').modal('show');

});

function thumb_filemanager(){
   $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=getimages',
        data:{},
      }).done( function(data){
        $('.file-manager').html(data);
      }); 
  }

  $('.btn-insert-thumbnail').click(function(){
    var path = $('.pathtocopy').val();
    $('.thumbimage').html('<span class = "glyphicon glyphicon-remove btn-remove-thumbnail"></span><img width="100%" src = "'+path+'">');
    $('.thumbnailimage').val(path);
  });
   
   $(document).on('click', '.btn-remove-thumbnail', function(){
    $('.thumbimage').html('');
    $('.thumbnailimage').val('');
   });

 });

</script>