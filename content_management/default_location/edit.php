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
    display: none;
  }
  .other-content {
    display: none !important;  
  }
  .btn-videomanager{
    display: inline !important;
  }
  .search-container{
    display: none;
  }
</style>

<script>
    $(document).ready(function () {
      var base_path = window.location.href;
      base_path = base_path.replace('content_management/default_location.php','');
      $(".article-edit").cleditor(); 
      var id = "1"; 
       $('.edit-id').attr('data-edit-id',id);

      
      var table = 'maps_default';
      var field = 'id';
      

      on_load(id,table,field);


      function on_load(id,table,field){
        $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=edit_global',
        data:{id:id,table:table,field:field},
      }).done( function(data){
          var obj = JSON.parse(data);
          $.each(obj, function(index, row){
              $('.location').val(row.name);
              $('.longitude').val(row.default_long);
              $('.latitude').val(row.default_lat);
          });
     });      
      }
     
	

     $('.update').click(function() {
      $('.msg').html('Successfully update...');
     	var content = $('.article-edit').val();
     	
     	var location = $('.location').val();
      var longitude = $('.longitude').val();
      var latitude = $('.latitude').val();
      var id =  $('.edit-id').attr('data-edit-id');
     	$.ajax({
	        type: 'Post',
	        url: 'dashboard.php?function=update_default',
	        data:{id:id, location:location,longitude:longitude,latitude:latitude,action: 'update'},
	      }).done( function(data){
               $('#success-modal').modal('show');

	     }); 
     });

     $('.preview').click(function() {
        $('.msg').html('<iframe name="iframe2" src="'+base_path+$('.alias').val()+'" style="width:100%; height:80%;"></iframe>');
        $('#preview').modal('show');
     });

     $('.btn-close').click(function() {
        $('.article_add').show();
        $('.article_list').show();
        $('.content-container').load('default_location/edit.php?id='+id);
       
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
        var htm = $('.article-edit').val() + path;
        $('.article-edit').val(htm).blur();
     });

     $('.btn-insert-video').click(function(){
        var path = '<div><video width="400px" controls ><source title="'+$('.pathtocopy').val()+'" src="'+$('.pathtocopy').val()+'"  type="video/mp4"></video>';
        var htm = $('.article-edit').val() + path;
        $('.article-edit').val(htm).blur();
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


   
   $(document).on('click', '.btn-remove-thumbnail', function(){
    $('.thumbimage').html('');
    $('.thumbnailimage').val('');
   });

  $('.btn-insert-thumbnail').click(function(){
    var path = $('.pathtocopy').val();
    $('.thumbimage').html('<span class = "glyphicon glyphicon-remove btn-remove-thumbnail"></span><img width="100%" src = "'+path+'">');
    $('.thumbnailimage').val(path);
  });




});

</script>
<div class="edit-id" data-edit-id = ""></div>
<form id="edit_article">
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

<!-- <div class="row">
	<div class="col-md-12">
		<input type="button" class="update" value="Save">		
	</div>
</div> -->
</form>

