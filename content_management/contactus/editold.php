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
</style>

<script>
    $(document).ready(function () {
      var base_path = window.location.href;
      base_path = base_path.replace('content_management/articles.php','');
      $(".article-edit").cleditor(); 
      var id = "<?php echo $_GET['id'];?>";


      

      

      on_load(id);


      function on_load(id){
        $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=edit_article',
        data:{id:id},
      }).done( function(data){
          var obj = JSON.parse(data);
          $.each(obj, function(index, row){

              $('.titles').val(row.title);
              $('.alias').val(row.alias);
              $('.created-by').html(row.name);
              $('.date-created').html(row.created); 
              $('.date-modified').html(row.modified);
              $('.start').val(row.publish_up); 
              $('.finish').val(row.publish_down);
              $('.hits').val(row.hits);

              var content = row.introtext;
              
              content = content.replace(/\images/g,'../images');

              $('.article-edit').val(content).blur();

              $('.status option[value='+row.state+']').attr('selected','selected');

              $.ajax({
                type: 'Post',
                url: 'dashboard.php?function=get_category',
              }).done( function(data){
                  var obj = JSON.parse(data);
                  var htm = '';
                  $.each(obj, function(index, row2){
                    if(row.catid==row2.id){
                      var selected = 'selected';
                    }
                    else{
                      var selected = '';
                    }
                    htm+= '<option value="'+row2.id+'" '+ selected+'>'+row2.title+'</option>';
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
     	content = content.replace(/\..\//g,'');
     	var title = $('.titles').val();
     	var id = "<?php echo $_GET['id'];?>";
      var state = $('.status').val();
      var catid = $('.category').val();
      var start = $('.start').val();
        var finish = $('.finish').val();
        
     	$.ajax({
	        type: 'Post',
	        url: 'dashboard.php?function=update_articles',
	        data:{id:id, title:title, content:content, state: state, catid: catid, start:start, finish:finish},
	      }).done( function(data){
               $('#success-modal').modal('show');
	     }); 
     });

     $('.preview').click(function() {
       /*alert(base_path);
       exit(0);*/
        $('.msg').html('<iframe name="iframe2" src="'+base_path+$('.alias').val()+'" style="width:100%; height:80%;"></iframe>');
        $('#preview').modal('show');

       /*var id = "<?php echo $_GET['id'];?>";
       alert(id);
        $('.article_add').show();
        $('.article_list').show();*/

//        $('.content-container').html('');

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
    

 });

</script>
<form id="edit_article">
<div class="row">
	<div class="col-md-12">
		<div class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-md-2">Title : </label>	
				<div class="col-md-10">
					<input type="text" name="title" class="form-control titles">
          <input type="hidden" name="title" class="form-control alias">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
  <div class="col-md-12">
    <label>Content :</label>
  </div>
	<div class="col-md-12">
		<textarea class="article-edit"></textarea>
	</div>
</div>
<div class="row author_modified">
  <div class="col-md-12">
      <div class="col-md-6">
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
      </div>
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
