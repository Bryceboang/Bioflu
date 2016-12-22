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
  .search-container, .er-msg-desc{
    display: none;
  }
</style>
<div class="row">
	<div class="col-md-12">
		<div class="form-horizontal">
			<div class="col-md-12 pad-5" style = "border:1px solid #ccc; margin-top:20px;">
        <label class="col-md-2" style = "text-align:center; background-color:#fff; margin-top:-15px">Article Title : </label> 
				<div class="col-md-12">
					<input type="text" name="title" class="form-control titles inputs"><span class = "er-msg">Article Title should not be empty *</span>
				</div>
			</div>

      <div class="col-md-12 pad-5" style = "border:1px solid #ccc; margin-top:20px;">
        <label class="col-md-2" style = "text-align:center; background-color:#fff; margin-top:-15px">Author : </label> 
        <div class="col-md-12">
          <input type="text" name="author" class="form-control author inputs"><span class = "er-msg">Author should not be empty *</span>
        </div>
      </div>

      <div class="col-md-12 pad-5" style = "border:1px solid #ccc; margin-top:20px;">
        <label class="col-md-2" style = "text-align:center; background-color:#fff; margin-top:-15px">Tags : </label> 
        <div class="col-md-12">
          <input type="text" name="tags" class="form-control tags inputs"><span class = "er-msg">Tags should not be empty *</span>
        </div>
      </div>

           <div class="col-md-12 pad-5" style = "border:1px solid #ccc; margin-top:30px;">
        <label class="col-md-4" style = "text-align:center; background-color:#fff; margin-top:-15px">Thumbnail (image size: 70x70px) : </label>  
        <div class="col-md-12">
          <div class="col-md-2">
            <a class = "btn btn-success btn-select-thumb-image" style = "padding:1px 5px"> Select Image</a>
          </div>
          <div class="col-md-2 thumbimage txt-right">
        </div>
        <input type = "hidden" name = "thumbnailimage" class = "thumbnailimage inputs"><span class = "er-msg">Thumbnail should not be empty *</span>
        </div>
      </div>
		</div>
	</div>
</div>
<div class="col-md-12 pad-5" style = "border:1px solid #ccc; margin-top:30px;">
  <div class="col-md-12">
    <label class="col-md-2" style = "text-align:center; background-color:#fff; margin-top:-15px">Article Content: </label>  
	</div>
	<div class="col-md-12">
		<textarea class="article-new mytext"></textarea><span class = "er-msg-desc">Article Content should not be empty *</span>		
	</div>
</div>



<script>
    $(document).ready(function () {
     $(".article-new").cleditor();

     $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_category',
      }).done( function(data){
          var obj = JSON.parse(data);
          var htm = '';
          $.each(obj, function(index, row2){
            htm+= '<option value="'+row2.id+'" >'+row2.cat_name+'</option>';
          });
          $('.category').html('');
          $('.category').html(htm);
      });

     $('.save').click(function() {
     	 $('.msg').html('Successfully Save...');
     	var content = $('.article-new').val();
      var title = $('.titles').val();
      var state = $('.status').val();
      var catid = $('.category').val();
      var start = $('.start').val();
      var finish = $('.finish').val();
      var author = $('.author').val();
      var tags = $('.tags').val();
      var thumbnailimage = $('.thumbnailimage').val();


if(validateFields() == 0){
     	$.ajax({
	        type: 'Post',
	        url: 'dashboard.php?function=save_articles',
	        data:{author:author, tags:tags, title:title, content:content, state: state, catid: catid, start:start, finish:finish, thumbnailimage:thumbnailimage},
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

function validateFields() {

      var counter = 0;

      if($('.mytext').val() == ''){
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


  $('.btn-insert-thumbnail').click(function(){
    var path = $('.pathtocopy').val();
    $('.thumbimage').html('<span class = "glyphicon glyphicon-remove btn-remove-thumbnail"></span><img width="100%" src = "'+path+'">');
    $('.thumbnailimage').val(path);
    $('#select-thumbnail-modal').modal('hide');
  });
   
   $(document).on('click', '.btn-remove-thumbnail', function(){
    $('.thumbimage').html('');
    $('.thumbnailimage').val('');
   });

 });


</script>