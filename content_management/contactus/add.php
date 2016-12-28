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
</style>
<div class="row">
	<div class="col-md-12">
		<div class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-md-2">Title : </label>	
				<div class="col-md-10">
					<input type="text" name="title" class="form-control titles">
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
		<textarea class="article-new"></textarea>		
	</div>
</div>
<!-- <div class="row">
	<div class="col-md-12">
		<input type="button" class="save" value="Save">		
	</div>
</div> -->



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

            htm+= '<option value="'+row2.id+'" >'+row2.title+'</option>';
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

     	$.ajax({
	        type: 'Post',
	        url: 'dashboard.php?function=save_articles',
	        data:{title:title, content:content, state: state, catid: catid, start:start, finish: finish},
	      }).done( function(data){
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

 });

</script>