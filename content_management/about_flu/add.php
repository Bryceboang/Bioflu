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
        <label class="col-md-2" style = "text-align:center; background-color:#fff; margin-top:-15px">About Title : </label> 
				<div class="col-md-12">
					<input type="text" name="title" class="form-control titles inputs"><span class = "er-msg">About Title should not be empty *</span>
				</div>
			</div>

		</div>
	</div>
</div>
<div class="col-md-12 pad-5" style = "border:1px solid #ccc; margin-top:30px;">
  <div class="col-md-12">
    <label class="col-md-2" style = "text-align:center; background-color:#fff; margin-top:-15px">About Content: </label>  
	</div>
	<div class="col-md-12">
		<textarea class="article-new inputs"></textarea><span class = "er-msg-desc">About content should not be empty *</span>		
	</div>
</div>



<script>
    $(document).ready(function () {
     $(".article-new").cleditor();


     $('.save').click(function() {
      if(validateFields() == 0){
     	 $('.msg').html('Successfully Save...');
     	var content = $('.article-new').val();
     	var title = $('.titles').val();
      var state = 1;

     	$.ajax({
	        type: 'Post',
	        url: 'dashboard.php?function=saved_about',
	        data:{title:title, content:content, state: state},
	      }).done( function(data){
             $('#success-modal').modal('show');
	     }); 
      }

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


      function validateFields() {

      var counter = 0;

      if($('.article-new').val() == ''){
                $('.er-msg-desc').show();
                counter++;
      } else{
          $('.er-msg-desc').hide();
      }

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