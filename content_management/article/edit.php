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
    display: inline !important;  
  }
  .btn-videomanager{
    display: inline !important;
  }
  .search-container{
    display: none;
  }
  .er-msg-desc {
    display: none;
  }
</style>

<script>
    $(document).ready(function () {
      var base_path = window.location.href;
      base_path = base_path.replace('content_management/articles.php','');
      $(".article-edit").cleditor(); 
      var id = "<?php echo $_GET['id'];?>";
       $('.edit-id').attr('data-edit-id',id);

      
      var table = 'flunew_articles';
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
              if(row.author == null){
                var author = '';
              }else{
                var author = row.author;
              }
              $('.titles').val(row.article_title);
              $('.created-by').html(author);
              $('.date-created').html(row.created); 
              $('.date-modified').html(row.modified);
              $('.start').val(row.date_published); 
              $('.finish').val(row.end_published);
              $('.hits').val(row.hits);
              $('.author').val(row.author);
              $('.tags').val(row.tags);


              var content = row.intro_text;
              
              content = content.replace(/\images/g,'../images');

              $('.article-edit').val(content).blur();

              $('.status option[value='+row.state+']').attr('selected','selected');

              if (row.image != '') {

              $('.thumbimage').html('<span class = "glyphicon glyphicon-remove btn-remove-thumbnail"></span><img width="100%" src = "../'+row.image+'">');
              $('.thumbnailimage').val(row.image);

            }
              $.ajax({
                type: 'Post',
                url: 'dashboard.php?function=get_category',
              }).done( function(data){
                  var obj = JSON.parse(data);
                  var htm = '';
                  $.each(obj, function(index, row2){
                    if(row.cat_type==row2.id){
                      var selected = 'selected';
                    }
                    else{
                      var selected = '';
                    }
                    htm+= '<option value="'+row2.id+'" '+ selected+'>'+row2.cat_name+'</option>';
                  });
                  $('.category').html('');
                  $('.category').html(htm);
              });


          });
     });      
      }
     
	

     $('.update').click(function() {
      $('.msg').html('Successfully update...');
     	var content = $('.article-edit').val();
     	content = content.replace(/\..\/images/g,'images');
     	var title = $('.titles').val();
     	// var id = "<?php echo $_GET['id'];?>";
      var id =  $('.edit-id').attr('data-edit-id');
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
	        url: 'dashboard.php?function=update_articles',
	        data:{author:author, tags:tags, id:id, title:title, content:content, state: state, catid: catid, start:start, finish:finish, thumbnailimage:thumbnailimage},
	      }).done( function(data){
          // alert(data);
               $('#success-modal').modal('show');
	     });
}

     });

     $('.preview').click(function() {
        $('.msg').html('<iframe name="iframe2" src="'+base_path+$('.alias').val()+'" style="width:100%; height:80%;"></iframe>');
        $('#preview').modal('show');
     });

     $('.btn-close').click(function() {
        $('.article_add').show();
        $('.article_list').show();
        $('.content-container').load('article/edit.php?id='+id);
       
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
		<textarea class="article-edit mytext"></textarea><span class = "er-msg-desc">Article Content should not be empty *</span>    
	</div>
</div>
<div class="row author_modified">
  <div class="col-md-12">
      <!-- <div class="col-md-6">
        <div class="col-md-3 pad-0">
          <p>Created By: </p>
        </div>
        <div class="col-md-8">
          <p class="created-by"></p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="col-md-3 pad-0">
          <p>Date Modified: </p>
        </div>
        <div class="col-md-8">
          <p class="date-modified"></p>
        </div>
      </div> -->
      <div class="col-md-6">
        <div class="col-md-3 pad-0">
          <p>Date Created: </p>
        </div>
        <div class="col-md-8">
          <p class="date-created"></p>
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

