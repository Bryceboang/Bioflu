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
</style>

<script>
    $(document).ready(function () {
     $(".ads-edit").cleditor(); 

     var id = "<?php echo $_GET['id'];?>";
	$.ajax({
        type: 'Post',
        url: 'dashboard.php?function=edit_ads',
        data:{id:id},
      }).done( function(data){
          var obj = JSON.parse(data);
          $.each(obj, function(index, row){
          		$('.titles').val(row.title);
          		var content = row.content;
          		content = content.replace(/\images/g,'../images');
          		$('.ads-edit').val(content).blur();
      		});
     });      

     $('.update').click(function() {
      $('.msg').html('Successfully Update...');
     	var content = $('.ads-edit').val();
     	content = content.replace(/\..\//g,'');
     	var title = $('.titles').val();
     	var id = "<?php echo $_GET['id'];?>";

     	$.ajax({
	        type: 'Post',
	        url: 'dashboard.php?function=update_ads',
	        data:{id:id, title:title, content:content},
	      }).done( function(data){
               $('#success-modal').modal('show');
	     }); 
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
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<textarea class="ads-edit"></textarea>
	</div>
</div>
<!-- <div class="row">
	<div class="col-md-12">
		<input type="button" class="update" value="Save">		
	</div>
</div> -->
</form>
